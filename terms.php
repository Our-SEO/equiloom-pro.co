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

  <body style="position: relative" class="body">
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
          <div class="mb-2 md:mb-0">
            <ol
              class="flex items-center gap-2 text-slate-400 text-sm font-medium"
            >
              <li class="hover:text-white">
                <a itemprop="item" href="<?php echo getHref('') ?>">
                  <span itemprop="name"
                    ><?php echo getLang('menu_home') ?></span
                  >
                </a>
                <meta itemprop="position" content="1" />
              </li>

              <img
                src="/assets/images/caret-down--gray.svg"
                aria-hidden="true"
                width="16"
                height="16"
                loading="lazy"
              />

              <li class="text-white">
                <span itemprop="name"><?php echo getLang('menu_terms') ?></span>
                <meta itemprop="position" content="2" />
              </li>
            </ol>
          </div>
        </div>

        <section class="sw-container">
          <ul
            class="flex overflow-x-auto md:justify-center gap-3 mb-6 md:mb-14 pb-2"
          >
            <li>
              <a
                class="block text-sm font-medium px-4 py-2 whitespace-nowrap rounded-lg border border-white/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 text-white bg-white/10 hover:bg-white/20"
                href="<?php echo getHref('privacy') ?>"
              >
                <?php echo getLang('menu_privacy') ?>
              </a>
            </li>

            <li>
              <a
                class="block text-sm font-medium px-4 py-2 whitespace-nowrap rounded-lg border border-white/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 text-gray-950 bg-white"
                href="javascript:void(0);"
              >
                <?php echo getLang('menu_terms') ?>
              </a>
            </li>
          </ul>

          <div class="mb-8 lg:mb-16">
            <h1
              class="text-4xl md:text-5xl font-medium text-center text-white leading-tight [&>span]:opacity-60"
            >
              <?php echo getLang('menu_terms') ?>
            </h1>
            <p class="text-center text-white/70 text-lg m-auto max-w-3xl mt-4">
              <?php echo getLang('terms__subtitle') ?>
            </p>
          </div>
        </section>

        <div class="sw-container-wrapper bg-white mb-2">
          <section class="sw-container py-12 md:py-24">
            <div
              class="[&_h3]:text-2xl md:[&_h3]:text-3xl [&_h3]:font-medium [&_h3]:my-4 md:[&_h3]:my-8 [&_h4]:text-xl md:[&_h4]:text-2xl [&_h4]:font-medium [&_h4]:mb-4 md:[&_h4]:mb-5 [&_p]:text-slate-800 [&_p]:mb-4 [&_p]:text-sm md:[&_p]:text-base [&_p]:leading-normal [&_ul]:list-disc [&_ul]:pl-4 [&_ul]:text-slate-800 [&_ul]:mb-4 [&_a]:underline [&_strong]:font-medium lg:px-24"
            >
              <h3><?php echo getLang('terms__title_1_general_terms'); ?></h3>
              <p><?php echo getLang('terms__text_1_general_terms'); ?></p>

              <h3><?php echo getLang('terms__title_2_definitions'); ?></h3>
              <p><?php echo getLang('terms__def_creator'); ?></p>
              <p><?php echo getLang('terms__def_nft'); ?></p>
              <p><?php echo getLang('terms__def_nft_checkout'); ?></p>
              <p><?php echo getLang('terms__def_partner'); ?></p>
              <p><?php echo getLang('terms__def_payment_processors'); ?></p>
              <p><?php echo getLang('terms__def_switchere'); ?></p>

              <b><?php echo getLang('terms__label_services'); ?></b>
              <ul>
                <li><?php echo getLang('terms__services_listitem_1'); ?></li>
                <br />
                <li><?php echo getLang('terms__services_listitem_2'); ?></li>
              </ul>

              <p><?php echo getLang('terms__def_user'); ?></p>
              <p><?php echo getLang('terms__def_widget'); ?></p>
              <p><?php echo getLang('terms__def_royalties'); ?></p>

              <h3><?php echo getLang('terms__title_3_acceptance'); ?></h3>
              <p><?php echo getLang('terms__text_3_acceptance_1'); ?></p>
              <p><?php echo getLang('terms__text_3_acceptance_2'); ?></p>
              <ul>
                <li><?php echo getLang('terms__risk_listitem_1'); ?></li>
                <li><?php echo getLang('terms__risk_listitem_2'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_3_acceptance_3'); ?></p>
              <p><?php echo getLang('terms__text_3_acceptance_4'); ?></p>
              <p><?php echo getLang('terms__text_3_acceptance_5'); ?></p>
              <p><?php echo getLang('terms__text_3_acceptance_6'); ?></p>
              <p><?php echo getLang('terms__text_3_acceptance_7'); ?></p>

              <h3><?php echo getLang('terms__title_4_eligibility'); ?></h3>
              <p><?php echo getLang('terms__text_4_eligibility_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__eligibility_listitem_1'); ?></li>
                <li><?php echo getLang('terms__eligibility_listitem_2'); ?></li>
                <li><?php echo getLang('terms__eligibility_listitem_3'); ?></li>
                <li><?php echo getLang('terms__eligibility_listitem_4'); ?></li>
                <li><?php echo getLang('terms__eligibility_listitem_5'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_4_eligibility_2'); ?></p>
              <p><?php echo getLang('terms__text_4_eligibility_3'); ?></p>

              <h3><?php echo getLang('terms__title_5_registration'); ?></h3>
              <p><?php echo getLang('terms__text_5_registration_1'); ?></p>
              <ul>
                <li>
                  <?php echo getLang('terms__registration_listitem_1'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__registration_listitem_2'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__registration_listitem_3'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__registration_listitem_4'); ?>
                </li>
              </ul>

              <h3><?php echo getLang('terms__title_6_use_of_services'); ?></h3>
              <p><?php echo getLang('terms__text_6_use_of_services_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__prohibited_listitem_1'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_2'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_3'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_4'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_5'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_6'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_7'); ?></li>
                <li><?php echo getLang('terms__prohibited_listitem_8'); ?></li>
              </ul>
              <br />
              <p><?php echo getLang('terms__text_6_use_of_services_2'); ?></p>

              <h3><?php echo getLang('terms__title_7_transactions'); ?></h3>
              <p><?php echo getLang('terms__text_7_transactions_1'); ?></p>
              <p><?php echo getLang('terms__text_7_transactions_2'); ?></p>
              <p><?php echo getLang('terms__text_7_transactions_3'); ?></p>
              <ul>
                <li>
                  <?php echo getLang('terms__transactions_listitem_1'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__transactions_listitem_2'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__transactions_listitem_3'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__transactions_listitem_4'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__transactions_listitem_5'); ?>
                </li>
                <li>
                  <?php echo getLang('terms__transactions_listitem_6'); ?>
                </li>
              </ul>
              <p><?php echo getLang('terms__text_7_transactions_4'); ?></p>

              <h3><?php echo getLang('terms__title_8_risk_disclosure'); ?></h3>
              <p><?php echo getLang('terms__text_8_risk_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__risk_nft_listitem_1'); ?></li>
                <li><?php echo getLang('terms__risk_nft_listitem_2'); ?></li>
                <li><?php echo getLang('terms__risk_nft_listitem_3'); ?></li>
                <li><?php echo getLang('terms__risk_nft_listitem_4'); ?></li>
                <li><?php echo getLang('terms__risk_nft_listitem_5'); ?></li>
                <li><?php echo getLang('terms__risk_nft_listitem_6'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_8_risk_2'); ?></p>

              <h3><?php echo getLang('terms__title_9_royalties'); ?></h3>
              <p><?php echo getLang('terms__text_9_royalties_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__royalties_listitem_1'); ?></li>
                <li><?php echo getLang('terms__royalties_listitem_2'); ?></li>
                <li><?php echo getLang('terms__royalties_listitem_3'); ?></li>
                <li><?php echo getLang('terms__royalties_listitem_4'); ?></li>
                <li><?php echo getLang('terms__royalties_listitem_5'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_9_royalties_2'); ?></p>

              <h3><?php echo getLang('terms__title_10_fees_taxes'); ?></h3>
              <p><?php echo getLang('terms__text_10_fees_1'); ?></p>
              <p><?php echo getLang('terms__text_10_fees_2'); ?></p>
              <p><?php echo getLang('terms__text_10_fees_3'); ?></p>
              <ul>
                <li><?php echo getLang('terms__fees_listitem_1'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_2'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_3'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_4'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_5'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_6'); ?></li>
                <li><?php echo getLang('terms__fees_listitem_7'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_10_fees_4'); ?></p>

              <h3><?php echo getLang('terms__title_11_compliance'); ?></h3>
              <p><?php echo getLang('terms__text_11_compliance_1'); ?></p>
              <p><?php echo getLang('terms__text_11_compliance_2'); ?></p>

              <h3><?php echo getLang('terms__title_12_ip_rights'); ?></h3>
              <p><?php echo getLang('terms__text_12_ip_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__ip_listitem_1'); ?></li>
                <li><?php echo getLang('terms__ip_listitem_2'); ?></li>
                <li><?php echo getLang('terms__ip_listitem_3'); ?></li>
                <li><?php echo getLang('terms__ip_listitem_4'); ?></li>
                <li><?php echo getLang('terms__ip_listitem_5'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_12_ip_2'); ?></p>
              <ul>
                <li><?php echo getLang('terms__ip_warrant_listitem_1'); ?></li>
                <li><?php echo getLang('terms__ip_warrant_listitem_2'); ?></li>
                <li><?php echo getLang('terms__ip_warrant_listitem_3'); ?></li>
                <li><?php echo getLang('terms__ip_warrant_listitem_4'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_12_ip_3'); ?></p>
              <p><?php echo getLang('terms__text_12_ip_4'); ?></p>
              <p><?php echo getLang('terms__text_12_ip_5'); ?></p>
              <p><?php echo getLang('terms__text_12_ip_6'); ?></p>

              <h3><?php echo getLang('terms__title_13_privacy'); ?></h3>
              <p><?php echo getLang('terms__text_13_privacy_1'); ?></p>

              <h3><?php echo getLang('terms__title_14_limitation'); ?></h3>
              <p><?php echo getLang('terms__text_14_limitation_1'); ?></p>
              <ul>
                <li><?php echo getLang('terms__limitation_listitem_1'); ?></li>
                <li><?php echo getLang('terms__limitation_listitem_2'); ?></li>
                <li><?php echo getLang('terms__limitation_listitem_3'); ?></li>
                <li><?php echo getLang('terms__limitation_listitem_4'); ?></li>
                <li><?php echo getLang('terms__limitation_listitem_5'); ?></li>
                <li><?php echo getLang('terms__limitation_listitem_6'); ?></li>
              </ul>
              <p><?php echo getLang('terms__text_14_limitation_2'); ?></p>

              <h3><?php echo getLang('terms__title_15_indemnification'); ?></h3>
              <p><?php echo getLang('terms__text_15_indemnification_1'); ?></p>

              <h3><?php echo getLang('terms__title_16_termination'); ?></h3>
              <p><?php echo getLang('terms__text_16_termination_1'); ?></p>

              <h3><?php echo getLang('terms__title_17_governing_law'); ?></h3>
              <p><?php echo getLang('terms__text_17_governing_law_1'); ?></p>

              <h3><?php echo getLang('terms__title_18_data_protection'); ?></h3>
              <p><?php echo getLang('terms__text_18_data_protection_1'); ?></p>

              <h3><?php echo getLang('terms__title_19_force_majeure'); ?></h3>
              <p><?php echo getLang('terms__text_19_force_majeure_1'); ?></p>

              <h3><?php echo getLang('terms__title_20_severability'); ?></h3>
              <p><?php echo getLang('terms__text_20_severability_1'); ?></p>

              <h3>
                <?php echo getLang('terms__title_21_contact_information'); ?>
              </h3>
              <p>
                <?php echo getLang('terms__text_21_contact_information_1'); ?>
                <a href="<?php echo getHref('login') ?>"
                  ><span class="__cf_email__"
                    ><?php echo getLang('terms__contact_us'); ?></span
                  ></a
                >.
              </p>

              <h3>
                <?php echo getLang('terms__title_22_entire_agreement'); ?>
              </h3>
              <p><?php echo getLang('terms__text_22_entire_agreement_1'); ?></p>
              <p><?php echo getLang('terms__text_22_entire_agreement_2'); ?></p>
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
