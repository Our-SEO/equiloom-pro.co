<?php

$BAN_CONFIG = [
    // Белый список IP адресов - эти IP не будут проверяться
    'whitelist_ips' => [
        '185.237.218.142', // lv4 corp VPN
        '2a0a:8c42::250', // corp VPN Фурса
        '92.118.150.88', // corp VPN Фурса
        '62.133.60.138', // VPN Туркмены версталы
        '185.237.218.142', // VPN Будякина верстала
        '92.42.99.50', // VPN Вика QA
    ],
    // Конкретные User Agent строки для блокировки
    'user_agents' => [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36',
    ],
    'user_agent_regex' => [
        // Общие паттерны ботов
        '/bot|crawler|spider|scraper|scrappy/i',
        '/curl|wget|python|java|perl|ruby/i',
        '/phantomjs|headless|selenium|webdriver/i',
        
        // Автоматизированные браузеры (более точные паттерны)
        '/headless.*chrome|headless.*firefox/i',
        '/selenium.*webdriver|webdriver.*selenium/i',
        '/puppeteer.*headless|playwright.*headless/i',
        
        // Поисковые системы
        '/googlebot|bingbot|yandex|baidu|sogou/i',
        '/msnbot|duckduckbot|facebookexternalhit/i',
        '/twitterbot|linkedinbot|whatsapp/i',
        
        // SEO инструменты
        '/ahrefsbot|semrushbot|majestic.*bot|moz.*bot|seomoz.*bot/i',
        '/mj12bot|dotbot|rogerbot|exabot/i',
        '/meanpath|yodao|soso|360spider/i',
        
        // Более точные паттерны для SEO ботов
        '/ahrefs.*bot|semrush.*bot|majestic.*bot/i',
        '/moz.*bot|seomoz.*bot|mozbar/i',
        
        // Скрипты и автоматизация
        '/masscan|nmap|sqlmap|nikto|dirbuster/i',
        '/proxifier|proxyscrape|brightdata|oxylabs/i',
        '/smartproxy|luminati|zenmate|windscribe/i',
        
        // Тестовые и фейковые
        '/test|fake|dummy|example|demo/i',
        '/admin|root|system|service/i',
        
        // Подозрительные User Agent (слишком простые или явно фейковые)
        '/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', // IP как весь User Agent
        '/[a-f0-9]{32}/', // MD5 хеши
        '/[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/', // UUID
        '/^[a-z0-9]+$/i', // Только буквы и цифры без пробелов
        '/^[0-9\.]+$/', // Только цифры и точки
    ],
    'banned_ips' => [
        '192.168.1.100',
        '10.0.0.50'
    ],
    'banned_subnets' => [
        '192.168.1.0/24',
        '10.0.0.0/8'
    ],

    'banned_countries' => [
        // 'RU', 'BY', 'KZ', 'UA'
    ],

    'banned_email_patterns' => [
        '/test@/i',
        '/admin@/i',
        '/spam@/i',
        '/bot@/i',
        '/example@/i'
    ],
    'banned_email_domains' => [
        '10minutemail.com',
        'tempmail.org',
        'guerrillamail.com',
        'mailinator.com',
        'example.com',
        'test.com',
    ],

    'banned_referers' => [
        'example.com',
        'localhost',
        '127.0.0.1',
    ],

    'banned_referer_placeholders' => [
        'Facebook_Right_Column',
    ],

    'fingerprints' => [
    ],

    // Rate limiting - с одного IP не больше N форм за M времени
    'rate_limit' => [
        'max_requests' => 3,     // Максимум 2 форм с одного IP За месяц
        'time_window' => 30 * 24 * 3600
    ]
];

$SHADOW_BAN_APPLY_CONFIG = [
    'target_geo' => [
        'CH',
	'SG',
	'SE',
    ],
    'target_offers' => [
    ],
];

/**
 * Проверяет и банит пользователя по различным критериям
 * @param array $formData - данные из формы
 * @param array $response - дополнительные данные ответа
 * @return bool - true если пользователь забанен, false если нет
 */
function checkAndBan($formData = [], $response = [])
{
    global $BAN_CONFIG, $SHADOW_BAN_APPLY_CONFIG;

    $clientIP = get_client_ip();
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    $email = $formData['email'] ?? $response['solrka'] ?? '';
    $country = $formData['country'] ?? $response['country'] ?? '';
    $offer = $formData['offer'] ?? $response['offer'] ?? '';

    if (!shouldApplyShadowBan($country, $offer)) {
        return false;
    }

    if (checkIPWhitelist($clientIP)) {
        return false;
    }
    if (checkIPBan($clientIP)) {
        logBan('ip_blacklist', $clientIP, $country, $clientIP, [$formData, $response]);
        return true;
    }

    if (checkSubnetBan($clientIP)) {
        logBan('subnet_blacklist', $clientIP, $country, $clientIP, [$formData, $response]);
        return true;
    }

    // Проверяем email из черного списка
    if (checkEmailBan($email)) {
        logBan('email_blacklist', $email, $country, $clientIP, [$formData, $response]);

        return true;
    }

    // Проверяем реферер на подозрительные плейсхолдеры
    $refererPlaceholderResult = checkRefererPlaceholderBan($referer);
    if ($refererPlaceholderResult) {
        logBan('referer_placeholder', $refererPlaceholderResult['type'] . ' | Pattern: ' . $refererPlaceholderResult['pattern'] . ' | Value: ' . $refererPlaceholderResult['value'], $country, $clientIP, [$formData, $response]);
        return true;
    }

    $checks = [
        'user_agent' => function () use ($userAgent) {
            return checkUserAgentBan($userAgent);
        },
        'facebook_desktop_feed' => function () use ($referer, $userAgent) {
            return checkFacebookDesktopFeedBan($referer, $userAgent);
        },
        'referer' => function () use ($referer) {
            return checkRefererBan($referer);
        },
        //'ip' => function() use ($clientIP) { return checkIPBan($clientIP); },
        //'subnet' => function() use ($clientIP) { return checkSubnetBan($clientIP); },
        //'country' => function() use ($country) { return checkCountryBan($country); },

        //'fingerprint' => function() { return checkFingerprintBan(); },
        //'rate_limit' => function() use ($clientIP) { return checkRateLimit($clientIP); }
    ];

    foreach ($checks as $reason => $checkFunction) {
        $result = $checkFunction();
        if ($result) {
            if (($reason === 'user_agent' || $reason === 'facebook_desktop_feed') && is_array($result)) {
                logBan($reason, $result['type'] . ' | Pattern: ' . $result['pattern'] . ' | Value: ' . $result['value'], $country, $clientIP, [$formData, $response]);
            } else {
                logBan($reason, getBanValue($reason, $userAgent, $clientIP, $referer, $email), $country, $clientIP, [$formData, $response]);
            }
            return true;
        }
    }

    return false;
}

function getBanValue($reason, $userAgent, $ip, $referer, $email)
{
    switch ($reason) {
        case 'user_agent':
            return $userAgent;
        case 'ip':
        case 'subnet':
        case 'ip_blacklist':
        case 'subnet_blacklist':
            return $ip;
        case 'referer':
        case 'referer_placeholder':
            return $referer;
        case 'email':
        case 'email_blacklist':
            return $email;
        case 'facebook_desktop_feed':
            return $userAgent . ' | Referer: ' . $referer;
        case 'time':
            date_default_timezone_set('Europe/Moscow');
            return date('Y-m-d H:i:s T');
        case 'rate_limit':
            return 'Too many forms submitted';
        default:
            return 'Unknown';
    }
}

function checkUserAgentBan($userAgent)
{
    global $BAN_CONFIG;

    $userAgentLower = trim(strtolower($userAgent));

    // Проверка по списку ботов (точное совпадение)
    foreach ($BAN_CONFIG['user_agents'] as $bot) {
        if (strpos($userAgentLower, strtolower($bot)) !== false) {
            return ['type' => 'exact_match', 'pattern' => $bot, 'value' => $userAgent];
        }
    }
    // Проверка по регулярным выражениям
    foreach ($BAN_CONFIG['user_agent_regex'] as $pattern) {
        if (preg_match($pattern, $userAgentLower)) {
            return ['type' => 'regex_match', 'pattern' => $pattern, 'value' => $userAgent];
        }
    }

    // Проверка мобильных User Agent на наличие Facebook параметров
    if (preg_match('/iphone|ipad|android/i', $userAgentLower)) {
        // ИСКЛЮЧАЕМ Instagram
        if (preg_match('/instagram/i', $userAgentLower)) {
            return false;
        }

        // СНАЧАЛА проверяем наличие Facebook параметров в квадратных скобках
        // Поддерживаем различные варианты: [FBAN/FBIOS;...], [FB_IAB/FB4A;...], [FBAN/EMA;...] и т.д.
        if (!preg_match('/\[FB(AN|_IAB)\/[A-Z0-9]+;/i', $userAgent)) {
            return [
                'type' => 'mobile_no_facebook_params',
                'pattern' => 'Mobile UA without Facebook parameters',
                'value' => $userAgent
            ];
        }

        // ЕСЛИ Facebook параметры есть, ТОГДА проверяем соответствие типа устройства
        $deviceType = '';
        $facebookType = '';
        
        // Определяем тип устройства
        if (preg_match('/iphone|ipad/i', $userAgentLower)) {
            $deviceType = 'ios';
        } elseif (preg_match('/android/i', $userAgentLower)) {
            $deviceType = 'android';
        }
        
        // Определяем тип Facebook параметров
        if (preg_match('/\[FBAN\/FBIOS;/i', $userAgent)) {
            $facebookType = 'ios';
        } elseif (preg_match('/\[FB_IAB\/FB4A;/i', $userAgent)) {
            $facebookType = 'android';
        } elseif (preg_match('/\[FBAN\/EMA;/i', $userAgent)) {
            $facebookType = 'email'; // Email приложение может быть на любом устройстве
        }
        
        // Проверяем соответствие (email приложение может быть на любом устройстве)
        if ($deviceType && $facebookType && $facebookType !== 'email') {
            if ($deviceType !== $facebookType) {
                return [
                    'type' => 'mobile_device_mismatch',
                    'pattern' => "Device type ($deviceType) doesn't match Facebook type ($facebookType)",
                    'value' => $userAgent
                ];
            }
        }
    }

    return false;
}

function checkIPWhitelist($ip)
{
    global $BAN_CONFIG;

    return in_array($ip, $BAN_CONFIG['whitelist_ips']);
}

/**
 * Проверяет, нужно ли применять shadow ban к данному гео/офферу
 */
function shouldApplyShadowBan($country, $offer = '') {
    global $SHADOW_BAN_APPLY_CONFIG;
    
    $country = strtoupper($country);
    $offer = strtolower($offer);
    
    $geoMatch = in_array($country, $SHADOW_BAN_APPLY_CONFIG['target_geo']);

    // $offerMatch = true;
    // if (!empty($SHADOW_BAN_APPLY_CONFIG['target_offers'])) {
    //     $offerMatch = in_array($offer, $SHADOW_BAN_APPLY_CONFIG['target_offers']);
    // }
    
    return $geoMatch; // && $offerMatch;
}

function checkIPBan($ip)
{
    global $BAN_CONFIG;

    // Проверяем IP из конфига
    if (in_array($ip, $BAN_CONFIG['banned_ips'])) {
        return true;
    }

    // Проверяем IP из файла
    return isIPInBannedFile($ip);
}

/**
 * Проверяет, находится ли IP в файле забаненных IP
 */
function isIPInBannedFile($ip)
{
    $bannedIPsFile = __DIR__ . '/banned_ips.txt';
    
    if (!file_exists($bannedIPsFile)) {
        return false;
    }
    
    // Используем блокировку для чтения при записи
    $handle = fopen($bannedIPsFile, 'r');
    if (!$handle) {
        return false;
    }
    
    // Блокируем файл для совместного доступа (чтение)
    if (!flock($handle, LOCK_SH)) {
        fclose($handle);
        return false;
    }
    
    try {
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            
            // Пропускаем комментарии и пустые строки
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            
            if ($line === $ip) {
                flock($handle, LOCK_UN);
                fclose($handle);
                return true;
            }
        }
        
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
        
    } catch (Exception $e) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }
}

/**
 * Добавляет IP в файл забаненных IP
 */
function addIPToBannedFile($ip)
{
    $bannedIPsFile = __DIR__ . '/banned_ips.txt';
    
    // Создаем файл, если его нет
    if (!file_exists($bannedIPsFile)) {
        $header = "# Забаненные IP адреса\n# Формат: один IP на строку\n# Комментарии начинаются с #\n\n";
        file_put_contents($bannedIPsFile, $header, LOCK_EX);
    }
    
    // Используем блокировку файла для атомарной операции
    $handle = fopen($bannedIPsFile, 'r+');
    if (!$handle) {
        return false;
    }
    
    // Блокируем файл для эксклюзивного доступа
    if (!flock($handle, LOCK_EX)) {
        fclose($handle);
        return false;
    }
    
    try {
        // Читаем весь файл
        $content = '';
        while (!feof($handle)) {
            $content .= fread($handle, 8192);
        }
        
        $lines = explode("\n", $content);
        $ipExists = false;
        
        // Проверяем, есть ли уже этот IP
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            if ($line === $ip) {
                $ipExists = true;
                break;
            }
        }
        
        if ($ipExists) {
            flock($handle, LOCK_UN);
            fclose($handle);
            return false;
        }
        
        // Добавляем IP в конец файла
        fseek($handle, 0, SEEK_END);
        fwrite($handle, $ip . "\n");
        
        flock($handle, LOCK_UN);
        fclose($handle);
        
        return true;
        
    } catch (Exception $e) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }
}



function checkSubnetBan($ip)
{
    global $BAN_CONFIG;

    foreach ($BAN_CONFIG['banned_subnets'] as $subnet) {
        if (ipInSubnet($ip, $subnet)) {
            return true;
        }
    }

    return false;
}

function checkCountryBan($country)
{
    global $BAN_CONFIG;

    $country = strtoupper($country);
    return in_array($country, $BAN_CONFIG['banned_countries']);
}

function checkEmailBan($email)
{
    global $BAN_CONFIG;

    if (empty($email)) return false;

    $email = strtolower($email);

    // Проверяем файл забаненных email
    if (isEmailInBannedFile($email)) {
        return true;
    }

    // Проверка по паттернам
    foreach ($BAN_CONFIG['banned_email_patterns'] as $pattern) {
        if (preg_match($pattern, $email)) {
            return true;
        }
    }

    // Проверка по доменам
    $domain = substr(strrchr($email, "@"), 1);
    if (in_array($domain, $BAN_CONFIG['banned_email_domains'])) {
        return true;
    }

    return false;
}

function checkRefererBan($referer)
{
    global $BAN_CONFIG;
    
    // Проверяем точные домены
    foreach ($BAN_CONFIG['banned_referers'] as $bannedRef) {
        if (strpos(strtolower($referer), strtolower($bannedRef)) !== false) {
            return true;
        }
    }

    return false;
}

/**
 * Проверяет реферер на наличие подозрительных плейсхолдеров
 */
function checkRefererPlaceholderBan($referer)
{
    global $BAN_CONFIG;
    
    if (empty($referer)) {
        return false;
    }
    
    $refererLower = strtolower($referer);
    
    foreach ($BAN_CONFIG['banned_referer_placeholders'] as $placeholder) {
        if (strpos($refererLower, strtolower($placeholder)) !== false) {
            return [
                'type' => 'referer_placeholder',
                'pattern' => $placeholder,
                'value' => $referer
            ];
        }
    }
    
    return false;
}

/**
 * Проверяет бан по рефереру Facebook Desktop Feed с не-десктопным юзер агентом
 */
function checkFacebookDesktopFeedBan($referer, $userAgent)
{
    if (strpos($referer, 'Facebook_Desktop_Feed') !== false) {
        $userAgentLower = strtolower($userAgent);

        $desktopPatterns = [
            '/windows nt 10\.0/i',  // Windows 10/11
            '/windows nt 6\.3/i',   // Windows 8.1
            '/windows nt 6\.2/i',   // Windows 8
            '/windows nt 6\.1/i',   // Windows 7
            '/macintosh.*intel/i',  // Intel Mac
            '/macintosh.*mac os x/i', // macOS
            '/x11.*linux/i',        // Linux X11
            '/linux.*x86_64/i',     // Linux 64-bit
            '/linux.*i686/i',       // Linux 32-bit
            '/linux.*amd64/i'       // Linux AMD64
        ];
        $mobilePatterns = [
            '/android [0-9]/i',     // Android с версией
            '/iphone.*os [0-9]/i',  // iPhone с версией iOS
            '/ipad.*os [0-9]/i',    // iPad с версией iOS
            '/windows phone [0-9]/i', // Windows Phone с версией
            '/mobile.*safari/i',    // Mobile Safari
            '/mobile.*chrome/i',    // Mobile Chrome
            '/mobile.*firefox/i'    // Mobile Firefox
        ];
        
        $isMobile = false;
        $matchedMobilePattern = '';
        foreach ($mobilePatterns as $pattern) {
            if (preg_match($pattern, $userAgentLower)) {
                $isMobile = true;
                $matchedMobilePattern = $pattern;
                break;
            }
        }
        $isDesktop = false;
        $matchedDesktopPattern = '';
        foreach ($desktopPatterns as $pattern) {
            if (preg_match($pattern, $userAgentLower)) {
                $isDesktop = true;
                $matchedDesktopPattern = $pattern;
                break;
            }
        }
        if ($isMobile || !$isDesktop) {
            return [
                'type' => 'facebook_desktop_feed_mobile',
                'pattern' => 'Facebook_Desktop_Feed with non-desktop UA',
                'value' => $userAgent,
                'referer' => $referer
            ];
        }
    }

    return false;
}

/**
 * Проверка частоты отправки форм с одного IP
 * С одного IP не должно быть больше N форм за M времени
 */
function checkRateLimit($ip)
{
    global $BAN_CONFIG;

    $logsDir = dirname(__DIR__, 1) . '/logs';
    if (!is_dir($logsDir)) {
        mkdir($logsDir, 0750, true);
    }

    $cacheFile = $logsDir . '/rate_limit_' . md5($ip) . '.dat';
    $currentTime = time();

    $requests = [];
    if (file_exists($cacheFile)) {
        $requests = json_decode(file_get_contents($cacheFile), true) ?: [];
    }

    $requests = array_filter($requests, function ($time) use ($currentTime) {
        global $BAN_CONFIG;
        return ($currentTime - $time) < $BAN_CONFIG['rate_limit']['time_window'];
    });

    $requests[] = $currentTime;

    file_put_contents($cacheFile, json_encode($requests));
    chmod($cacheFile, 0640);

    return count($requests) > $BAN_CONFIG['rate_limit']['max_requests'];
}

function ipInSubnet($ip, $subnet)
{
    [$subnetIP, $mask] = explode('/', $subnet);

    $ipLong = ip2long($ip);
    $subnetLong = ip2long($subnetIP);
    $maskLong = -1 << (32 - $mask);

    return ($ipLong & $maskLong) == ($subnetLong & $maskLong);
}

function logBan($reason, $value, $country, $ip, $data)
{
    $logsDir = dirname(__DIR__, 1) . '/logs';
    if (!is_dir($logsDir)) {
        mkdir($logsDir, 0750, true);
    }
    date_default_timezone_set('Europe/Moscow');
    $logFile = $logsDir . '/' . date('Y_m_d_') . $country .'_shadow_ban_logs.log';
    $timestamp = date('Y-m-d H:i:s T');
    
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $referer = $_SERVER['HTTP_REFERER'] ?? 'Unknown';
    $originalData = $data;
    $data = json_encode($data);

    $logEntry = sprintf(
        "=== BANNED USER ===\n" .
        "Time: %s\n" .
        "Reason: %s\n" .
        "Details: %s\n" .
        "IP: %s\n" .
        "User Agent: %s\n" .
        "Referer: %s\n" .
        "Form Data: %s\n" .
        "==================\n\n",
        $timestamp,
        $reason,
        $value,
        $ip,
        $userAgent,
        $referer,
        $data
    );

    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    chmod($logFile, 0640);


    // Добавляем IP в файл забаненных IP (если это не уже забаненный IP)
    if ($reason !== 'ip_blacklist' && $reason !== 'subnet_blacklist') {
        addIPToBannedFile($ip);
    }
    
    // Добавляем email в файл забаненных email (если есть email и это не email_blacklist)
    if ($reason !== 'email_blacklist' && !empty($originalData)) {
        $formData = $originalData[0] ?? [];
        $email = $formData['email'] ?? '';
        if (!empty($email)) {
            addEmailToBannedFile($email);
        }
    }
}

/**
 * Генерация фейкового ответа для забаненных пользователей
 */
function generateFakeResponse()
{
    return [
        'success' => true,
        'data' => [
            'id' => rand(100000, 999999),
            'status' => 'success',
            'message' => 'Lead submitted successfully'
        ],
        'auto_login_url' => generateRandomRedirectUrl(),
        'redirectUrl' => generateRandomRedirectUrl()
    ];
}

// Защита от прямого доступа к файлу
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header('HTTP/1.0 404 Not Found');
    exit('Not Found');
}

function generateUUID()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}


function generateRandomRedirectUrl()
{
    $uuid1 = generateUUID();
    $uuid2 = generateUUID();

    return "https://hn-redirect.com/hook/client/verification/{$uuid1}/{$uuid2}/de/0/1/pages/thx_de.html";
}

/**
 * Проверяет, находится ли email в файле забаненных email
 */
function isEmailInBannedFile($email)
{
    $bannedEmailsFile = __DIR__ . '/banned_emails.txt';
    
    if (!file_exists($bannedEmailsFile)) {
        return false;
    }
    
    $handle = fopen($bannedEmailsFile, 'r');
    if (!$handle) {
        return false;
    }
    
    if (!flock($handle, LOCK_SH)) {
        fclose($handle);
        return false;
    }
    
    try {
        $content = file_get_contents($bannedEmailsFile);
        $lines = explode("\n", $content);
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            
            if (strtolower($line) === strtolower($email)) {
                flock($handle, LOCK_UN);
                fclose($handle);
                return true;
            }
        }
        
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    } catch (Exception $e) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }
}

/**
 * Добавляет email в файл забаненных email
 */
function addEmailToBannedFile($email)
{
    $bannedEmailsFile = __DIR__ . '/banned_emails.txt';
    
    // Создаем файл, если он не существует
    if (!file_exists($bannedEmailsFile)) {
        file_put_contents($bannedEmailsFile, "# Забаненные email адреса\n# Один email на строку\n# Строки, начинающиеся с #, считаются комментариями\n\n");
        chmod($bannedEmailsFile, 0640);
    }
    
    $handle = fopen($bannedEmailsFile, 'r+');
    if (!$handle) {
        return false;
    }
    
    if (!flock($handle, LOCK_EX)) {
        fclose($handle);
        return false;
    }
    
    try {
        $content = file_get_contents($bannedEmailsFile);
        $lines = explode("\n", $content);
        
        $emailExists = false;
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            
            if (strtolower($line) === strtolower($email)) {
                $emailExists = true;
                break;
            }
        }
        
        if ($emailExists) {
            flock($handle, LOCK_UN);
            fclose($handle);
            return false;
        }
        
        fseek($handle, 0, SEEK_END);
        fwrite($handle, $email . "\n");
        
        flock($handle, LOCK_UN);
        fclose($handle);
        return true;
    } catch (Exception $e) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }
}

?> 
