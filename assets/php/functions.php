<?php

if (!defined('DEFAULT_LANG')) {
    $dl =
        getenv('DEFAULT_LANG')
        ?: ($_SERVER['DEFAULT_LANG'] ?? null)
        ?: 'en';

    define('DEFAULT_LANG', (string) $dl);
}

/**
 * Load translations once per request.
 */
function loadTranslations(): array
{
    static $translations = null;
    if ($translations === null) {
        $translations = include __DIR__ . '/lang.php';
        if (!is_array($translations)) {
            throw new RuntimeException('lang.php must return an array');
        }
    }
    return $translations;
}

function defaultLang(): string
{
    $supported = array_keys(loadTranslations());

    if (in_array(DEFAULT_LANG, $supported)) return DEFAULT_LANG;

    return $supported[0];
}


/**
 * Parse request once: language + path without language prefix + page slug (first segment).
 */
function requestContext(): array
{

    $translations = loadTranslations();
    $supported = array_keys($translations);

    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $path = '/' . ltrim($path, '/');
    $path = preg_replace('#/+#', '/', $path);

    $segments = array_values(array_filter(explode('/', trim($path, '/'))));

    $lang = defaultLang();
    if (!empty($segments) && in_array($segments[0], $supported)) {
        $lang = $segments[0];
        array_shift($segments);
    }

    // Remaining path without language prefix
    $pathNoLang = implode('/', $segments);
    $slug = $segments[0] ?? '';


    return [
        'lang' => $lang,
        'pathNoLang' => $pathNoLang,
        'slug' => $slug,
    ];
}

/**
 * Backward-compatible: returns current language from URL.
 */
function getLangFromFolder(): string
{
    return requestContext()['lang'];
}


function getLang(string $key): string
{
    $lang = getLangFromFolder();
    $t = loadTranslations();

    $default = defaultLang();
    if (isset($t[$lang][$key])) return (string) $t[$lang][$key];
    if (isset($t[$default][$key])) return (string) $t[$default][$key];
    return '';
}

function urlFor(string $path = '', ?string $lang = null): string
{
    $lang = $lang ?? getLangFromFolder();
    $path = trim($path, '/');

    if ($path === '') return "/$lang/";

    return "/$lang/$path";
}

/**
 * Backward-compatible href builder.
 */
function getHref(string $page = ''): string
{
    $page = preg_replace('/\.php$/i', '', (string) $page);
    $page = trim($page, '/');

    if ($page === 'index') $page = '';

    return urlFor($page);
}

/**
 * Current requested page slug (first segment after optional language).
 * '' means homepage.
 */
function currentSlug(): string
{
    return requestContext()['slug'];
}

/**
 * Full path without language prefix (can include more segments).
 */
function currentPathNoLang(): string
{
    return requestContext()['pathNoLang'];
}
function detectPageSlug(string $filePath): string
{
    $slug = basename($filePath, '.php');
    return $slug === '' ? 'index' : $slug;
}
function looksLikeLangCode(string $s): bool
{
    return (bool) preg_match('/^[a-z]{2}(?:[_-][a-z]{2})?$/i', $s);
}

/**
 * Must be called very early (before output).
 * Ensures URL uses a valid language from lang.php.
 */
function enforceValidLanguagePrefix(): void
{
    $translations = loadTranslations();
    $supported = array_keys($translations);

    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $segments = array_values(array_filter(explode('/', trim($path, '/'))));

    if (empty($segments)) return;

    $first = $segments[0];

    if (looksLikeLangCode($first) && !in_array($first, $supported, true)) {
        array_shift($segments);
        $rest = implode('/', $segments);
        $def = defaultLang();
        $dest = "/$def/" . ($rest !== '' ? $rest : '');
        $dest = rtrim($dest, '/') . '/';
        if ($rest !== '') {
            $dest = "/$def/$rest";
        }

        header('Location: ' . $dest, true, 302);
        exit;
    }
}

/**
 * hreflang tags for current path (no lang prefix).
 * x-default points to English.
 */
function generateHreflangTags(): void
{
    $baseUrl = 'https://equiloom-pro.co';
    $translations = loadTranslations();
    $pathNoLang = currentPathNoLang();

    $xDefault = rtrim($baseUrl . urlFor($pathNoLang, defaultLang()), '/');
    if ($xDefault === $baseUrl) $xDefault .= '/';
    echo '<link rel="alternate" href="' . htmlspecialchars($xDefault, ENT_QUOTES, 'UTF-8') . '" hreflang="x-default">' . PHP_EOL;

    foreach ($translations as $lang => $data) {
        $locale = (string) ($data['locale'] ?? $lang);
        $href = rtrim($baseUrl . urlFor($pathNoLang, $lang), '/');
        if ($href === $baseUrl) $href .= '/';
        echo '<link rel="alternate" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" hreflang="' . htmlspecialchars($locale, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    }
}

/**
 * Language selector menu (links to same path in other locales).
 */
function generateLanguageSelector(bool $isMobile = false): void
{
    $currentLang = getLangFromFolder();
    $translations = loadTranslations();
    $languages = array_keys($translations);

    $flagsBase = '/assets/images/flags/';
    $pathNoLang = currentPathNoLang();

    // current label/flag
    $curr = $translations[$currentLang] ?? [];
    $currCountry = $curr['country_name'] ?? $curr['country'] ?? strtoupper($currentLang);
    $currLangName = $curr['language_name'] ?? $curr['language_use'] ?? ucfirst($currentLang);
    $currIso = strtolower((string) ($curr['country_code'] ?? $curr['country_iso'] ?? $currentLang));
    $currLabel = $currCountry . ' (' . $currLangName . ')';

    echo '<button class="lang-btn" type="button" aria-haspopup="listbox" aria-expanded="false">' . PHP_EOL;
    echo '  <span class="flag"><img src="' . $flagsBase . $currIso . '.svg" alt="' . htmlspecialchars($currCountry, ENT_QUOTES, 'UTF-8') . '" width="18" height="12"></span>' . PHP_EOL;
    echo '  <span class="label">' . htmlspecialchars($currLabel, ENT_QUOTES, 'UTF-8') . '</span>' . PHP_EOL;
    echo '  <span class="chevron">▾</span>' . PHP_EOL;
    echo '</button>' . PHP_EOL;

    $menuIdAttr = $isMobile ? ' id="lang-menu"' : '';
    echo '<ul class="lang-menu" role="listbox"' . $menuIdAttr . '>' . PHP_EOL;

    foreach ($languages as $lang) {
        if ($lang === $currentLang) continue;

        $entry = $translations[$lang] ?? [];
        $countryName = $entry['country_name'] ?? $entry['country'] ?? strtoupper($lang);
        $languageName = $entry['language_name'] ?? $entry['language_use'] ?? ucfirst($lang);
        $iso = strtolower((string) ($entry['country_code'] ?? $entry['country_iso'] ?? $lang));

        $href = urlFor($pathNoLang, $lang);

        echo '  <li class="lang-option" role="option">' . PHP_EOL;
        echo '    <a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
        echo '      <span class="flag"><img src="' . $flagsBase . $iso . '.svg" alt="' . htmlspecialchars($countryName, ENT_QUOTES, 'UTF-8') . '" width="18" height="12"></span>' . PHP_EOL;
        echo '      <span>' . htmlspecialchars($countryName . ' (' . $languageName . ')', ENT_QUOTES, 'UTF-8') . '</span>' . PHP_EOL;
        echo '    </a>' . PHP_EOL;
        echo '  </li>' . PHP_EOL;
    }

    echo '</ul>' . PHP_EOL;
}

/**
 * Meta tags based on page slug.
 * $page should be 'index' or any slug like 'about', 'privacy', etc.
 */
function generateMetaTags(string $page = 'index'): void
{
    $page = preg_replace('/\.php$/i', '', $page);
    if ($page === '') $page = 'index';

    $title_key = $page === 'index' ? 'title' : "title";
    $desc_key = $page === 'index' ? 'meta_description' : "meta_description";
    $keywords_key = $page === 'index' ? 'meta_keywords' : "meta_keywords";

    echo '<title>' . htmlspecialchars(getLang($title_key), ENT_QUOTES, 'UTF-8') . ' | ' . htmlspecialchars(getLang('city'), ENT_QUOTES, 'UTF-8') . '</title>' . PHP_EOL;
    echo '<meta name="description" content="' . htmlspecialchars(getLang($desc_key), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="keywords" content="' . htmlspecialchars(getLang($keywords_key), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="geo.region" content="' . htmlspecialchars(getLang('country_code'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="geo.placename" content="' . htmlspecialchars(getLang('city'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="geo.position" content="' . htmlspecialchars(getLang('geo_position'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="ICBM" content="' . htmlspecialchars(getLang('geo_position'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta property="og:title" content="' . htmlspecialchars(getLang('og_title'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta property="og:description" content="' . htmlspecialchars(getLang('og_description'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="twitter:title" content="' . htmlspecialchars(getLang('twitter_title'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<meta name="twitter:description" content="' . htmlspecialchars(getLang('twitter_description'), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}


// Функция для генерации JSON-LD
function generateJsonLd($page = 'index')
{
    $lang = getLangFromFolder();
    $site_url = 'https://equiloom-pro.co';
    $site_name = 'EquiLoomPRO';
    $author_name = 'EquiLoomPRO Team';
    $logo_path = '/assets/images/icon-180.png';
    $dashboard_image = '/assets/images/icon-180.png'; // Единое изображение для всех страниц

    // Фиксированные даты
    $date_published = '2025-08-15T00:00:00+00:00';
    $date_modified = date('c');

    // Определение ключей для заголовка, описания и ключевых слов
    $title_keys = [
        'about' => 'about_title',
        'contact' => 'contact_title',
        'cookie' => 'cookie_title',
        'terms' => 'terms_title',
        'privacy' => 'privacy_title',
        'create-profile' => 'create-profile_title',
    ];
    $desc_keys = [
        'about' => 'about_desc_content',
        'contact' => 'contact_desc_content',
        'cookie' => 'cookie_desc_content',
        'terms' => 'terms_desc_content',
        'privacy' => 'privacy_desc_content',
        'create-profile' => 'create-profile_content',
    ];
    $keywords_keys = [
        'about' => 'about_keywords',
        'contact' => 'contact_keywords',
        'cookie' => 'cookie_keywords',
        'terms' => 'terms_keywords',
        'privacy' => 'privacy_keywords',
        'create-profile' => 'create-profile_keywords',
    ];
    $title_key = 'title';
    $desc_key = 'meta_description';
    $keywords_key = 'meta_keywords';

    // Формирование пути страницы
    $page_path = ($page === 'index') ? '' : $page;
    $lang_path = ($lang === defaultLang()) ? '' : "$lang/";
    $base_url = "$site_url/$lang_path$page_path";
    $base_url = rtrim($base_url, '/') . '/';

    // Схема Organization
    $jsonLd1 = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => "$site_url/#organization",
        'name' => getLang('jsonld_organization_name') . ' - ' . getLang('city'),
        'url' => "$site_url/$lang_path",
        'logo' => [
            '@type' => 'ImageObject',
            'url' => "$site_url$logo_path"
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => getLang('city'),
            'addressCountry' => getLang('country_code'),
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'email' => 'info@spotbrevionpro.app',
            'areaServed' => getLang('country_code'),
            'availableLanguage' => getLang('language_name'),
        ],
        'sameAs' => getLang('social_links') ?: [],
        'brand' => [
            '@type' => 'Brand',
            'name' => getLang('jsonld_organization_name'),
        ],
        'review' => [
            '@type' => 'Review',
            'name' => getLang('jsonld_organization_name') . ' Review',
            'reviewBody' => getLang('jsonld_organization_review_body') ?: 'EquiLoomPRO provides an investing platform with intelligent tools, flexible portfolios, and clear reporting to help clients in London manage and grow their money with confidence.',
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => getLang('jsonld_organization_review_rating') ?: '4.96',
                'bestRating' => '5',
            ],
            'author' => [
                '@type' => 'Person',
                'name' => getLang('jsonld_organization_review_author') ?: 'EquiLoomPRO User',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => getLang('jsonld_organization_name'),
            ],
        ],
    ];

    // Схема WebSite
    $jsonLd2 = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => "$site_url/#website",
        'url' => "$site_url/$lang_path",
        'name' => getLang($title_key),
        'publisher' => ['@id' => "$site_url/#organization"],
        'inLanguage' => getLang('locale'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => "$site_url/$lang_path?s={search_term_string}",
            'query-input' => 'required name=search_term_string',
        ],
    ];

    // Схема WebPage
    $jsonLd3 = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => "$base_url#webpage",
        'url' => $base_url,
        'name' => getLang($title_key),
        'description' => getLang($desc_key),
        'datePublished' => $date_published,
        'dateModified' => $date_modified,
        'about' => ['@id' => "$site_url/#organization"],
        'isPartOf' => ['@id' => "$site_url/#website"],
        'inLanguage' => getLang('locale'),
    ];

    // Схема Article
    $jsonLd4 = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => getLang($title_key),
        'datePublished' => $date_published,
        'dateModified' => $date_modified,
        'author' => [
            '@type' => 'Organization',
            '@id' => "$site_url/#organization",
            'name' => $author_name,
        ],
        'publisher' => ['@id' => "$site_url/#organization"],
        'description' => getLang($desc_key),
        'name' => getLang($title_key),
        '@id' => "$base_url#richSnippet",
        'isPartOf' => ['@id' => "$base_url#webpage"],
        'inLanguage' => getLang('locale'),
        'mainEntityOfPage' => ['@id' => "$base_url#webpage"],
        'image' => [
            '@type' => 'ImageObject',
            'url' => "$site_url$dashboard_image",
            'width' => '1200',
            'height' => '800'
        ],
        'keywords' => getLang($keywords_key) ?: 'about EquiLoomPRO, investing platform, AI investments London',
    ];

    // Схемы для index.php
    if ($page === 'index') {
        // Схема SoftwareApplication
        $jsonLd5 = [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => getLang('jsonld_organization_name') . ' - ' . getLang('city'),
            'image' => "$site_url$logo_path",
            'url' => "$site_url/$lang_path",
            'description' => getLang($desc_key),
            'applicationCategory' => getLang('jsonld_software_categories') ?: 'Investment Platform',
            'screenshot' => "$site_url$dashboard_image",
            'inLanguage' => getLang('locale'),
            'availableLanguage' => getLang('language_name'),
            'operatingSystem' => 'Web-Based, Windows 10, Windows 7, Windows 8, OSX, macOS, iOS, Android 7.1.2, Android 8.1, Android 9.0, Android 10.0, Android 11.0, Android 12.0, Android 13.0',
            'offers' => [
                '@type' => 'Offer',
                'price' => getLang('jsonld_software_price') ?: '152',
                'priceCurrency' => getLang('jsonld_software_price_currency') ?: 'GBP',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => '2025-08-15',
                'areaServed' => getLang('country_code'),
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.96',
                'reviewCount' => '100',
                'bestRating' => '5',
                'worstRating' => '1'
            ]
        ];

        // Схема FinancialService
        $jsonLd7 = [
            '@context' => 'https://schema.org',
            '@type' => 'FinancialService',
            'name' => getLang('jsonld_financialservice_name') ?: 'EquiLoomPRO Investment Services',
            'description' => getLang('jsonld_financialservice_description') ?: 'EquiLoomPRO offers secure cryptocurrency investing services starting from £182, with intelligent tools, flexible portfolios, and FCA-compliant support for UK investors in London and beyond.',
            'url' => getLang('jsonld_financialservice_url') ?: "$site_url/$lang_path",
            'areaServed' => getLang('jsonld_financialservice_areaServed') ?: 'United Kingdom',
            'serviceType' => getLang('jsonld_financialservice_serviceType') ?: 'Investment Platform',
            'provider' => ['@id' => "$site_url/#organization"],
            'hasOfferCatalog' => getLang('jsonld_financialservice_hasOfferCatalog') ?: 'Investment Plans from £152',
            'isPartOf' => ['@id' => "$base_url#webpage"],
        ];

        // Схема FAQPage
        $jsonLd6 = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'isPartOf' => ['@id' => "$base_url#webpage"],
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_1_question') ?: 'What is the minimum deposit to start?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_1_answer') ?: 'You can begin your journey with just £182, which unlocks full access to our investment tools and support.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_2_question') ?: 'Do I need prior investing experience?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_2_answer') ?: 'No. The platform is built for both beginners and experienced investors, with guidance available at every step.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_3_question') ?: 'How quickly can I see results?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_3_answer') ?: 'Outcomes depend on your chosen strategy and market conditions. Our tools help you optimize performance while keeping risks transparent.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_4_question') ?: 'Is my information secure?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_4_answer') ?: 'Yes. We use advanced security measures and comply with UK/EU data protection standards.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_5_question') ?: 'Can I adjust my portfolio anytime?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_5_answer') ?: 'Absolutely. You stay in control and can review or adjust your investments whenever you like.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => getLang('jsonld_faq_6_question') ?: 'Is the service available in the UK?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => getLang('jsonld_faq_6_answer') ?: 'Yes. We support clients in London and across the UK, with experiences tailored to your locale and currency.'
                    ]
                ]
            ]
        ];

        $jsonLds = [$jsonLd1, $jsonLd2, $jsonLd3, $jsonLd4, $jsonLd5, $jsonLd7, $jsonLd6];
    } else {
        $jsonLds = [$jsonLd1, $jsonLd2, $jsonLd3, $jsonLd4]; // Для about.php, terms.php, privacy.php без FAQPage, SoftwareApplication и FinancialService
    }

    foreach ($jsonLds as $index => $jsonLd) {
        $class = $index === 0 ? ' class="rank-math-schema"' : '';
        echo '<script type="application/ld+json"' . $class . '>' . PHP_EOL;
        echo json_encode($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
        echo '</script>' . PHP_EOL;
    }
}
?>