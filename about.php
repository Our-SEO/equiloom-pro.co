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

  <body style="position: relative" class="body about">
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
        <div class="sw-container pt-6 md:pt-8 pb-6 md:pb-2">
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

        <section class="sw-container mb-18 lg:mb-18">
          <div class="flex flex-col items-center">
            <div class="mb-8 lg:mb-16">
              <h1
                class="text-4xl md:text-5xl font-medium text-center text-white leading-tight [&>span]:opacity-60"
              >
                <?php echo getLang('about__hero_title'); ?>
              </h1>
              <p
                class="text-center text-white/70 text-lg m-auto max-w-3xl mt-4"
              >
                <?php echo getLang('about__hero_text'); ?>
              </p>
            </div>

            <a
              href="<?php echo getHref('login') ?>"
              class="inline-flex justify-center items-center m-auto bg-white transition-all duration-300 hover:shadow-[0_0_20px_5px_rgba(255,255,255,0.3)] hover:scale-105 rounded-xl min-h-12 px-6 font-medium"
            >
              <?php echo getLang('about__hero_btn'); ?>
            </a>
          </div>
        </section>

        <div class="sw-container-wrapper bg-white py-18 lg:py-28 mb-2">
          <section class="sw-container mb-12 lg:mb-28">
            <h2
              class="text-4xl md:text-5xl font-medium leading-tight mb-6 lg:mb-10 [&>span]:text-slate-400 text-center"
            >
              <?php echo getLang('about__how_it_works_title'); ?>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
              <div class="mb-8 lg:mb-0">
                <picture>
                  <img
                    src="/assets/images/how-work.webp"
                    alt="Mobile Interface"
                    class="m-auto w-full max-w-xl"
                    width="636"
                    height="517"
                    loading="lazy"
                  />
                </picture>
              </div>

              <div class="">
                <ul class="pl-4 lg:pl-8">
                  <li class="flex gap-6">
                    <div class="flex flex-col items-center">
                      <div
                        class="bg-slate-800 border-2 border-slate-200 rounded-full w-11 h-11 text-slate-100 flex justify-center items-center font-medium"
                      >
                        01
                      </div>

                      <div
                        class="grow border-l border-l-slate-300 border-dashed my-2"
                      ></div>
                    </div>

                    <div class="mb-12">
                      <h3 class="text-xl font-medium mb-4">
                        <?php echo getLang('about__how_it_works_step1_title'); ?>
                      </h3>
                      <p>
                        <?php echo getLang('about__how_it_works_step1_text'); ?>
                      </p>
                    </div>
                  </li>

                  <li class="flex gap-6">
                    <div class="flex flex-col items-center">
                      <div
                        class="bg-slate-800 border-2 border-slate-200 rounded-full w-11 h-11 text-slate-100 flex justify-center items-center font-medium"
                      >
                        02
                      </div>

                      <div
                        class="grow border-l border-l-slate-300 border-dashed my-2"
                      ></div>
                    </div>

                    <div class="mb-12">
                      <h3 class="text-xl font-medium mb-4">
                        <?php echo getLang('about__how_it_works_step2_title'); ?>
                      </h3>
                      <p>
                        <?php echo getLang('about__how_it_works_step2_text'); ?>
                      </p>
                    </div>
                  </li>

                  <li class="flex gap-6">
                    <div class="flex flex-col items-center">
                      <div
                        class="bg-slate-800 border-2 border-slate-200 rounded-full w-11 h-11 text-slate-100 flex justify-center items-center font-medium"
                      >
                        03
                      </div>
                    </div>

                    <div class="mb-12">
                      <h3 class="text-xl font-medium mb-4">
                        <?php echo getLang('about__how_it_works_step3_title'); ?>
                      </h3>
                      <p>
                        <?php echo getLang('about__how_it_works_step3_text'); ?>
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </section>

          <section class="sw-container mb-18 lg:mb-28">
            <h2
              class="text-4xl md:text-5xl font-medium leading-tight [&>span]:text-slate-400 text-center mb-6 lg:mb-10"
            >
              <?php echo getLang('about__major_advantages_title'); ?>
            </h2>

            <ul
              class="flex flex-col items-center lg:flex-row lg:justify-between gap-2 lg:gap-6"
            >
              <li
                class="flex flex-col items-center rounded-2xl bg-gray-100/80 p-6 max-w-lg lg:w-auto"
              >
                <img
                  src="/assets/images/advantage-1.png"
                  alt="Exchange interface"
                  class="grow w-full mb-4"
                  width="350"
                  height="291"
                  loading="lazy"
                />

                <h3 class="text-2xl text-center font-medium text-gray-950 mb-4">
                  <?php echo getLang('about__advantage_1_title'); ?>
                </h3>
                <p class="text-lg text-center text-gray-500 leading-relaxed">
                  <?php echo getLang('about__advantage_1_text'); ?>
                </p>
              </li>

              <li
                class="flex flex-col items-center rounded-2xl bg-gray-100/80 p-6 max-w-lg lg:w-auto"
              >
                <img
                  src="/assets/images/advantage-2.png"
                  alt="Diagramm"
                  class="grow w-full mb-4"
                  width="350"
                  height="291"
                  loading="lazy"
                />

                <h3 class="text-2xl text-center font-medium text-gray-950 mb-4">
                  <?php echo getLang('about__advantage_2_title'); ?>
                </h3>
                <p class="text-lg text-center text-gray-500 leading-relaxed">
                  <?php echo getLang('about__advantage_2_text'); ?>
                </p>
              </li>

              <li
                class="flex flex-col items-center rounded-2xl bg-gray-100/80 p-6 max-w-lg lg:w-auto"
              >
                <img
                  src="/assets/images/advantage-3.png"
                  alt="Exchange interface"
                  class="grow w-full mb-4"
                  width="350"
                  height="291"
                  loading="lazy"
                />

                <h3 class="text-2xl text-center font-medium text-gray-950 mb-4">
                  <?php echo getLang('about__advantage_3_title'); ?>
                </h3>
                <p class="text-lg text-center text-gray-500 leading-relaxed">
                  <?php echo getLang('about__advantage_3_text'); ?>
                </p>
              </li>
            </ul>
          </section>

          <section class="sw-container">
            <div
              class="relative bg-[linear-gradient(-15deg,#4d70d6_0%,#251f68_25%,#1c0e4e_70%,#4560c0_100%)] md:bg-[url(../../../public/i/v2/pages/about_us/panel-bg.jpg)] bg-top bg-no-repeat bg-[length:100%_100%] py-40 md:py-20 xl:py-32 rounded-3xl overflow-hidden"
            >
              <img
                class="md:hidden absolute top-0 -right-4"
                src="/assets/images/panel-coins-mob.png"
                aira-hidden="true"
                width="300"
              />
              <img
                class="md:hidden absolute bottom-0 -left-4 rotate-180"
                src="/assets/images/panel-coins-mob.png"
                aira-hidden="true"
                width="300"
              />

              <h2
                class="text-4xl text-white md:text-5xl font-medium leading-tight mb-4 lg:mb-6 [&>span]:text-white/60 text-center"
              >
                <?php echo getLang('about__panel_title'); ?>
              </h2>
              <p
                class="sm:text-xl px-4 sm:px-0 text-white/70 text-center max-w-2xl xl:max-w-4xl m-auto"
              >
                <?php echo getLang('about__panel_text'); ?>
              </p>
            </div>
          </section>
        </div>
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
