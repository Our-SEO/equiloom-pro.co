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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="icon" href="/assets/images/favicon.ico" sizes="32x32"/>
    <link rel="icon" href="/assets/images/icon.svg" type="image/svg+xml"/>
    <link rel="apple-touch-icon" href="/assets/images/icon-180.png"/>

    <link href="/assets/css/global-4NUCUX4u.css" rel="stylesheet"/>
</head>

<body style="position: relative" class="body index">
    <span id="v2-overlay" style="
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgb(3, 7, 18);
        z-index: 999;
        transition: opacity 700ms;
        pointer-events: none;
      "></span>
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
            <img src="/assets/images/page-bg-lg.webp" fetchpriority="high" alt="bg"
                 class="absolute top-0 left-0 right-0 -z-1 w-full h-auto" width="750" height="434"/>
        </picture>

        <header id="header" class="fixed top-0 left-0 w-full transition duration-500 text-white z-50">
            <nav class="sw-container flex items-center justify-between h-14 sm:h-19" aria-label="Main navigation">
                <ul class="flex items-center w-full gap-8 font-medium">
                    <li class="mr-12">
                        <a href="<?php echo getHref('') ?>" class="flex items-center min-w-36" aria-label="Main page">
                            <span style="font-weight: bold; font-size: 1.8rem"><?php echo getLang('logo_name'); ?></span>
                        </a>
                    </li>

                    <li class="hidden lg:block">
                        <a href="<?php echo getHref('') ?>"
                           class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"><?php echo getLang('menu_home'); ?></a>
                    </li>
                    <li class="hidden lg:block">
                        <a href="<?php echo getHref('about') ?>"
                           class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"><?php echo getLang('menu_about'); ?></a>
                    </li>
                    <li class="hidden lg:block">
                        <a href="<?php echo getHref('login') ?>"
                           class="hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"><?php echo getLang('menu_contact'); ?></a>
                    </li>

                    <li class="hidden lg:block ml-auto">
                        <a href="<?php echo getHref('login') ?>"
                           class="block ml-4 px-5 py-3 text-sm rounded-lg border border-white/15 bg-white/10 hover:bg-white/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                            <?php echo getLang('menu_login'); ?>
                        </a>
                    </li>
                </ul>

                <button id="header-menu-btn" type="button"
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all duration-300"
                        aria-controls="mobile-menu"
                        aria-expanded="false" aria-label="Open mobile menu">
                    <svg id="burger-icon" class="h-6 w-6 transition-all duration-300" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 transition-all duration-300 opacity-0 absolute" fill="none"
                         stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </nav>
        </header>

        <div id="header-mobile-menu"
             class="mob-menu-bg fixed left-1/2 transform -translate-x-1/2 w-[calc(100vw-8px)] bg-gradient-to-b from-blue-900 to-purple-900 rounded-2xl shadow-2xl opacity-0 invisible scale-95 transition-all duration-300 ease-in-out lg:hidden z-50 overflow-hidden"
             aria-label="Mobile menu">
            <div class="px-3 pt-12 pb-12 overflow-y-auto scrollbar-thin scrollbar-thumb-white/20 scrollbar-track-transparent">
                <ul class="flex flex-col items-center gap-6">
                    <li>
                        <a href="<?php echo getHref('') ?>"
                           class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"><?php echo getLang('menu_home'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo getHref('about') ?>"
                           class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"><?php echo getLang('menu_about'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo getHref('login') ?>"
                           class="block text-white text-xl font-medium hover:text-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50 py-2 px-4"><?php echo getLang('menu_contact'); ?></a>
                    </li>

                    <li class="w-full">
                        <a href="<?php echo getHref('login') ?>"
                           class="block w-full px-5 py-3 rounded-lg border border-white/20 bg-white/10 hover:bg-white/20 text-white text-center font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/50">
                            <?php echo getLang('menu_login'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <link rel="stylesheet" href="/assets/css/header.css"/>

        <main>
            <section class="sw-container pt-12 lg:pt-6">
                <div class="lg:flex lg:gap-12 xl:gap-32 pb-12 lg:pb-24">
                    <div class="lg:mt-8 xl:mt-20 mx-auto text-center">
                        <h1 class="text-5xl lg:text-7xl font-medium mt-0 lg:mt-12 mb-4 sm:mb-6 text-white [&>span]:opacity-60 leading-[1.2]">
                            <?php echo getLang('hero_title'); ?>
                        </h1>
                        <p class="text-lg md:text-xl mb-8 xl:mb-16 m-auto max-w-xl text-white/60 leading-[1.4]">
                            <?php echo getLang('hero_text'); ?>
                        </p>


                        <div class="mb-18 lg:mt-32">
                                <div
                                        class="p-2 border-[#FFFFFF1F] lg:max-w-[600px] max-w-[450px] border rounded-2xl backdrop-blur-2xl bg-[#FFFFFF14] m-auto mb-18 lg:mb-0"
                                >

                                    <div class="bg-white py-8 lg:py-12 px-4 lg:px-10 rounded-xl">

                                        <h2 class="text-gray-950 text-center text-2xl md:text-3xl font-medium mb-6 [&>span]:opacity-60 leading-[1.2]"><?php echo getLang('value_upfront_title'); ?></h2>
                                        <p class="text-gray-600 text-center"><?php echo getLang('value_upfront_text'); ?></p>
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

                        <div class="flex mb-6 pb-2 overflow-auto">
                            <img src="/assets/images/method_google-pay.png" alt="Google Pay" class="m-auto" width="92"
                                 height="34" loading="lazy"/>
                            <img src="/assets/images/method_pay-pal.png" alt="Pay Pal" class="m-auto" width="92"
                                 height="34" loading="lazy"/>
                            <img src="/assets/images/method_motional.png" alt="Motional" class="m-auto" width="92"
                                 height="34" loading="lazy"/>
                            <img src="/assets/images/method_visa.png" alt="VISA" class="m-auto" width="92" height="34"
                                 loading="lazy"/>
                            <img src="/assets/images/method_mastercard.png" alt="Mastercard" class="m-auto" width="92"
                                 height="34" loading="lazy"/>
                        </div>
                    </div>
                </div>
            </section>

            <div class="mb-18 lg:mt-32">
                <section class="sw-container">
                    <h2 class="text-white text-center text-4xl md:text-5xl font-medium mb-6 [&>span]:opacity-60 leading-[1.2]">
                        <?php echo getLang('howto_title'); ?>
                    </h2>

                    <div class="flex flex-wrap justify-center gap-4 mb-8 lg:mb-12 text-gray-300">
                        <div class="inline-flex items-center gap-2 px-4 py-2 border border-[#FFFFFF1F] rounded-full bg-[#FFFFFF14]">
                            <img src="/assets/images/swipe.svg" alt="swipe" class="m-auto" width="18" height="18"
                                 loading="lazy"/>
                            <span class="text-sm text-white"><?php echo getLang('badge_step_by_step_guidance'); ?></span>
                        </div>

                        <div class="inline-flex items-center gap-2 px-4 py-2 border border-[#FFFFFF1F] rounded-full bg-[#FFFFFF14]">
                            <img src="/assets/images/card.svg" alt="card" class="m-auto" width="18" height="18"
                                 loading="lazy"/>
                            <span class="text-sm text-white"><?php echo getLang('badge_easy_credit_card_payments'); ?></span>
                        </div>

                        <div class="inline-flex items-center gap-2 px-4 py-2 border border-[#FFFFFF1F] rounded-full bg-[#FFFFFF14]">
                            <img src="/assets/images/btn.svg" alt="btn" class="m-auto" width="18" height="18"
                                 loading="lazy"/>
                            <span class="text-sm text-white"><?php echo getLang('badge_streamlined_purchase_process'); ?></span>
                        </div>
                    </div>

                    <ol id="sw-how-to-by-slider"
                        class="hide-scroll flex overflow-auto justify-around gap-8 pb-4 lg:pb-0">
                        <li class="text-center min-w-full lg:min-w-auto">
                            <div class="mb-6">
                                <picture>
                                    <img src="/assets/images/step-1--desk.webp" alt="Step 1 illustration"
                                         class="m-auto w-64 min-w-64" width="225" height="327" loading="lazy"/>
                                </picture>
                            </div>
                            <div class="font-light text-slate-400 mb-4">01</div>
                            <h3 class="text-lg lg:text-2xl font-medium text-white mb-4 mx-auto max-w-72">
                                <?php echo getLang('howto_step1_title'); ?>
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mx-auto max-w-72">
                                <?php echo getLang('howto_step1_text'); ?>
                            </p>
                        </li>

                        <li class="text-center min-w-full lg:min-w-auto j-lazy-slide" data-step-number="2">
                            <div class="mb-6">
                                <picture class="hidden lg:block">
                                    <img src="/assets/images/step-2--desk.webp" alt="Step 2 illustration"
                                         class="m-auto w-64 min-w-64" width="225" height="327" loading="lazy"/>
                                </picture>
                                <div class="j-lazy-slide-image block lg:hidden m-auto w-64 min-w-64"
                                     data-step-number="2" style="height: 327px; background: transparent"></div>
                            </div>
                            <div class="font-light text-slate-400 mb-4">02</div>
                            <h3 class="text-lg lg:text-2xl font-medium text-white mb-4 mx-auto max-w-72">
                                <?php echo getLang('howto_step2_title'); ?>
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mx-auto max-w-72">
                                <?php echo getLang('howto_step2_text'); ?>
                            </p>
                        </li>

                        <li class="text-center min-w-full lg:min-w-auto j-lazy-slide" data-step-number="3">
                            <div class="mb-6">
                                <picture class="hidden lg:block">
                                    <img src="/assets/images/step-3--desk.webp" alt="Step 3 illustration"
                                         class="m-auto w-64 min-w-64" width="225" height="327" loading="lazy"/>
                                </picture>
                                <div class="j-lazy-slide-image block lg:hidden m-auto w-64 min-w-64"
                                     data-step-number="3" style="height: 327px; background: transparent"></div>
                            </div>
                            <div class="font-light text-slate-400 mb-4">03</div>
                            <h3 class="text-lg lg:text-2xl font-medium text-white mb-4 mx-auto max-w-72">
                                <?php echo getLang('howto_step3_title'); ?>
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mx-auto max-w-72">
                                <?php echo getLang('howto_step3_text'); ?>
                            </p>
                        </li>
                    </ol>

                    <div class="flex lg:hidden justify-center gap-2">
                        <div class="j-how-to-by-bullet w-6 h-1 rounded-full bg-gradient-to-r from-[#5D5FEF] to-[#48C6EF]"></div>
                        <div class="j-how-to-by-bullet w-6 h-1 rounded-full bg-slate-100/40"></div>
                        <div class="j-how-to-by-bullet w-6 h-1 rounded-full bg-slate-100/40"></div>
                    </div>
                </section>

            </div>

            <div class="sw-container-wrapper bg-white py-12 lg:py-28 mb-2">
                <section class="sw-container">
                    <h2 class="text-4xl md:text-5xl font-medium text-center leading-[1.2] mb-10 [&>span]:text-slate-400">
                        <?php echo getLang('benefits_title'); ?>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6">
                        <div class="flex flex-col gap-2 md:gap-6">
                            <div class="rounded-2xl bg-gray-100/80 max-w-md md:max-w-none m-auto">
                                <picture>
                                    <img src="/assets/images/1.webp" alt="Payment methods" class="m-auto" width="620"
                                         height="372" loading="lazy"/>
                                </picture>

                                <h3 class="text-3xl font-medium text-gray-950 mb-2 text-center">
                                    <?php echo getLang('benefits_card1_title'); ?>
                                </h3>
                                <p class="text-lg text-gray-600 leading-relaxed text-center max-w-md m-auto mb-14">
                                    <?php echo getLang('benefits_card1_text'); ?>
                                </p>
                            </div>

                            <div class="rounded-2xl bg-gray-100/80 grow max-w-md md:max-w-none m-auto">
                                <picture>
                                    <img src="/assets/images/2.png" alt="Dialog with client" class="m-auto" width="620"
                                         height="202" loading="lazy"/>
                                </picture>

                                <h3 class="text-3xl font-medium text-gray-950 mb-2 text-center">
                                    <?php echo getLang('benefits_card2_title'); ?>
                                </h3>
                                <p class="text-lg text-gray-600 leading-relaxed text-center max-w-md m-auto mb-14">
                                    <?php echo getLang('benefits_card2_text'); ?>
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 md:gap-6">
                            <div class="rounded-2xl bg-gray-100/80 max-w-md md:max-w-none m-auto">
                                <picture>
                                    <img src="/assets/images/3.webp" alt="Currency pair" class="m-auto" width="620"
                                         height="211" loading="lazy"/>
                                </picture>

                                <h3 class="text-3xl font-medium text-gray-950 mb-2 text-center">
                                    <?php echo getLang('benefits_card3_title'); ?>
                                </h3>
                                <p class="text-lg text-gray-600 leading-relaxed text-center max-w-md m-auto mb-14">
                                    <?php echo getLang('benefits_card3_text'); ?>
                                </p>
                            </div>

                            <div class="rounded-2xl bg-[linear-gradient(108.26deg,#5D5FEF_13.74%,#48C6EF_97.27%)] md:p-8 grow max-w-md md:max-w-none m-auto">
                                <picture>
                                    <img src="/assets/images/4.webp" alt="Low Fees" class="m-auto" width="555"
                                         height="315" loading="lazy"/>
                                </picture>

                                <h3 class="text-3xl font-medium text-white mb-2 text-center">
                                    <?php echo getLang('benefits_card4_title'); ?>
                                </h3>
                                <p class="text-lg text-white leading-relaxed text-center max-w-md m-auto mb-14">
                                    <?php echo getLang('benefits_card4_text'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="sw-container py-12 lg:py-28">
                    <div class="mt-20 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-30 items-center">
                        <div class="">
                            <div class="relative max-w-xl mx-auto">
                                <picture>
                                    <img src="/assets/images/img_1.webp" alt="Mobile Interface"
                                         class="m-auto max-w-64 sm:max-w-none" width="388" height="756" loading="lazy"/>
                                </picture>
                            </div>
                        </div>

                        <div class="">
                            <h2 class="text-4xl md:text-5xl font-medium leading-tight mb-6 [&>span]:text-slate-400">
                                <?php echo getLang('app_title'); ?>
                            </h2>
                            <p class="text-slate-700 max-w-xl mb-8">
                                <?php echo getLang('app_text'); ?>
                            </p>

                            <div>
                                <div class="flex mb-3">
                                    <img src="/assets/images/btn--black.svg" alt="Button icon" class="mr-2" width="20"
                                         height="20" loading="lazy"/>
                                    <div class="font-medium">
                                        <?php echo getLang('app_feature1_title'); ?>
                                    </div>
                                </div>
                                <p class="text-slate-700 mb-10">
                                    <?php echo getLang('app_feature1_text'); ?>
                                </p>

                                <div class="flex mb-3">
                                    <img src="/assets/images/swipe--black.svg" alt="Swipe icon" class="mr-2" width="20"
                                         height="20" loading="lazy"/>
                                    <div class="font-medium">
                                        <?php echo getLang('app_feature2_title'); ?>
                                    </div>
                                </div>
                                <p class="text-slate-700">
                                    <?php echo getLang('app_feature2_text'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div id="currency-table" class="sw-container-wrapper relative">
                <picture>
                    <img src="/assets/images/bg.jpg" alt="bg" class="absolute top-0 left-0 right-0 -z-1 w-full h-auto"
                         width="750" height="434" loading="lazy"/>
                </picture>

                <section class="sw-container py-12 lg:py-28">
                    <div class="md:flex justify-between items-end mb-4 md:mb-10">
                        <h2 class="text-4xl md:text-5xl font-medium leading-tight text-white [&>span]:opacity-60 mb-8 md:mb-0 mt-6 md:mt-0 pr-10 md:pr-0">
                            <?php echo getLang('top10_title'); ?>
                        </h2>

                        <a href="<?php echo getHref('login') ?>"
                           class="flex gap-2 py-3 md:py-0 transition-all hover:scale-102">
                            <span class="text-white font-medium"><?php echo getLang('top10_all_cryptocurrencies'); ?></span>
                            <img src="/assets/images/arrow-up-right.svg" alt="away" width="18" height="18"
                                 loading="lazy"/>
                        </a>
                    </div>

                    <ul class="divide-y divide-white/10">
                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="NOT" src="/assets/images/NOT.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        NOT
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Notcoin</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Notcoin">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="TONCOIN" src="/assets/images/TONCOIN.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        TON
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Toncoin</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Toncoin">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="BTC" src="/assets/images/BTC.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        BTC
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Bitcoin</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +1.75% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Bitcoin">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="USDT20" src="/assets/images/USDT20.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        USDT
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Tether</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Tether">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="XLM" src="/assets/images/XLM.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        XLM
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Stellar</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +1.25% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Stellar">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="ETH" src="/assets/images/ETH.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        ETH
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">
                                        Ethereum
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +0.87% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Ethereum">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="SOL" src="/assets/images/SOL.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        SOL
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Solana</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +4% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Solana">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="LTC" src="/assets/images/LTC.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        LTC
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">
                                        Litecoin
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +2.6% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Litecoin">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="TRX" src="/assets/images/TRX.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        TRX
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">TRON</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +1.89% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy TRON">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>

                        <li class="flex items-center justify-between py-4 first:border-t last:border-b border-white/10">
                            <div class="flex items-center gap-4 min-w-0">
                                <img alt="XRP" src="/assets/images/XRP.svg" width="44" height="44"
                                     class="rounded-full h-11 w-11 border-2 border-white/20" loading="lazy"/>
                                <div class="sm:flex">
                                    <div class="text-white text-lg md:text-xl font-medium truncate mr-4">
                                        XRP
                                    </div>
                                    <div class="text-white/60 md:text-lg truncate">Ripple</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <span class="text-sm text-[#35CDA7]"> +0.24% </span>

                                <a href="<?php echo getHref('login') ?>"
                                   class="px-5 py-3 rounded-xl border border-[#FFFFFF1F] bg-white/10 hover:bg-white/20 text-white text-sm font-medium transition"
                                   aria-label="Buy Ripple">
                                    <?php echo getLang('btn_buy_now'); ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>

            <div class="sw-container-wrapper bg-white mb-2 py-12 lg:py-20">
                <section class="sw-container mb-16 lg:mb-28">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                        <div>
                            <div class="mb-4">
                                <div class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-full bg-slate-100">
                                    <img src="/assets/images/card--dark.svg" alt="card" class="m-auto" width="18"
                                         height="18" loading="lazy"/>
                                    <span class="text-sm"><?php echo getLang('badge_step_by_step_guidance'); ?></span>
                                </div>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-medium leading-tight mb-6 [&>span]:text-slate-400">
                                <?php echo getLang('safe_title'); ?>
                            </h2>
                            <p class="lg:pr-16">
                                <?php echo getLang('safe_text'); ?>
                            </p>
                        </div>

                        <div>
                            <picture>
                                <img src="/assets/images/img-secure.webp" alt="Cryptocurrency selection interface"
                                     class="m-auto" width="636" height="520" loading="lazy"/>
                            </picture>
                        </div>
                    </div>
                </section>

                <section class="sw-container max-w-3xl">
                    <div class="max-w-3xl m-auto">
                        <h2 class="text-4xl md:text-5xl font-medium leading-tight mb-10 text-center">
                            <?php echo getLang('faq_title'); ?>
                        </h2>

                        <ul class="mb-6 md:mb-10 flex flex-col items-center">
                            <li class="group js-faq-item sw-faq-details inline-block lg:px-0 mt-2 rounded-2xl focus-within:outline-1 focus-within:outline-slate-200 w-full">
                                <details class="peer rounded-t-2xl overflow-hidden bg-slate-100">
                                    <summary
                                            class="p-6 pb-4 flex items-center justify-between cursor-pointer select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                                        <h3 class="md:text-xl font-medium" itemprop="name">
                                            <?php echo getLang('faq_q1'); ?>
                                        </h3>
                                        <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" aria-hidden="true">
                                            <path d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                </details>

                                <div class="bg-slate-100 rounded-b-2xl m-auto pt-3">
                                    <div class="content max-h-0 opacity-0 overflow-auto px-6 peer-not-open:pointer-events-none group-has-[details[open]]:opacity-100 group-not-has-[details[open]]:hide-scroll"
                                         itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="pb-4" itemprop="text">
                                            <?php echo getLang('faq_a1'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="group js-faq-item sw-faq-details inline-block lg:px-0 mt-2 rounded-2xl focus-within:outline-1 focus-within:outline-slate-200 w-full">
                                <details class="peer rounded-t-2xl overflow-hidden bg-slate-100">
                                    <summary
                                            class="p-6 pb-4 flex items-center justify-between cursor-pointer select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                                        <h3 class="md:text-xl font-medium" itemprop="name">
                                            <?php echo getLang('faq_q2'); ?>
                                        </h3>
                                        <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" aria-hidden="true">
                                            <path d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                </details>

                                <div class="bg-slate-100 rounded-b-2xl m-auto pt-3">
                                    <div class="content max-h-0 opacity-0 overflow-auto px-6 peer-not-open:pointer-events-none group-has-[details[open]]:opacity-100 group-not-has-[details[open]]:hide-scroll"
                                         itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="pb-4" itemprop="text">
                                            <?php echo getLang('faq_a2'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="group js-faq-item sw-faq-details inline-block lg:px-0 mt-2 rounded-2xl focus-within:outline-1 focus-within:outline-slate-200 w-full">
                                <details class="peer rounded-t-2xl overflow-hidden bg-slate-100">
                                    <summary
                                            class="p-6 pb-4 flex items-center justify-between cursor-pointer select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                                        <h3 class="md:text-xl font-medium" itemprop="name">
                                            <?php echo getLang('faq_q3'); ?>
                                        </h3>
                                        <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" aria-hidden="true">
                                            <path d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                </details>

                                <div class="bg-slate-100 rounded-b-2xl m-auto pt-3">
                                    <div class="content max-h-0 opacity-0 overflow-auto px-6 peer-not-open:pointer-events-none group-has-[details[open]]:opacity-100 group-not-has-[details[open]]:hide-scroll"
                                         itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="pb-4" itemprop="text">
                                            <?php echo getLang('faq_a3'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="group js-faq-item sw-faq-details inline-block lg:px-0 mt-2 rounded-2xl focus-within:outline-1 focus-within:outline-slate-200 w-full">
                                <details class="peer rounded-t-2xl overflow-hidden bg-slate-100">
                                    <summary
                                            class="p-6 pb-4 flex items-center justify-between cursor-pointer select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                                        <h3 class="md:text-xl font-medium" itemprop="name">
                                            <?php echo getLang('faq_q4'); ?>
                                        </h3>
                                        <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" aria-hidden="true">
                                            <path d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                </details>

                                <div class="bg-slate-100 rounded-b-2xl m-auto pt-3">
                                    <div class="content max-h-0 opacity-0 overflow-auto px-6 peer-not-open:pointer-events-none group-has-[details[open]]:opacity-100 group-not-has-[details[open]]:hide-scroll"
                                         itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="pb-4" itemprop="text">
                                            <?php echo getLang('faq_a4'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="group js-faq-item sw-faq-details inline-block lg:px-0 mt-2 rounded-2xl focus-within:outline-1 focus-within:outline-slate-200 w-full">
                                <details class="peer rounded-t-2xl overflow-hidden bg-slate-100">
                                    <summary
                                            class="p-6 pb-4 flex items-center justify-between cursor-pointer select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300">
                                        <h3 class="md:text-xl font-medium" itemprop="name">
                                            <?php echo getLang('faq_q5'); ?>
                                        </h3>
                                        <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" aria-hidden="true">
                                            <path d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                </details>

                                <div class="bg-slate-100 rounded-b-2xl m-auto pt-3">
                                    <div class="content max-h-0 opacity-0 overflow-auto px-6 peer-not-open:pointer-events-none group-has-[details[open]]:opacity-100 group-not-has-[details[open]]:hide-scroll">
                                        <div class="pb-4" itemprop="text">
                                            <?php echo getLang('faq_a5'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="flex justify-center text-slate-700 text-lg">
                            <div>
                                <?php echo getLang('faq_cta'); ?>
                            </div>
                        </div>
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
                            <a href="<?php echo getHref('privacy') ?>"
                               class="block hover:text-white/50"><?php echo getLang('menu_privacy'); ?></a>
                        </li>

                        <li>
                            <a href="<?php echo getHref('terms') ?>"
                               class="block hover:text-white/50"><?php echo getLang('menu_terms'); ?></a>
                        </li>
                    </ul>

                    <div class="space-y-4">
                        <a href="<?php echo getHref('') ?>"
                           class="block text-white hover:text-white/50 text-sm"><?php echo getLang('menu_home'); ?></a>
                        <a href="<?php echo getHref('about') ?>"
                           class="block text-white hover:text-white/50 text-sm"><?php echo getLang('menu_about'); ?></a>
                        <a href="<?php echo getHref('login') ?>"
                           class="block text-white hover:text-white/50 text-sm"><?php echo getLang('menu_contact'); ?></a>
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
                <span style="font-weight: bold; font-size: 2.7rem"
                      class="mb-6"><?php echo getLang('logo_name'); ?></span>
                <address class="text-sm text-slate-400/80 max-w-4xl mb-8 md:mb-14 leading-normal not-italic">
                    <?php echo getLang('footer__text'); ?>
                </address>

                <p class="text-sm text-slate-400/80">
                    <?php echo getLang('footer__copy'); ?>
                </p>
            </div>
        </div>
    </footer>

    <script src="/assets/js/scroll-indicator-5hQoVmt7.js" type="module"></script>
    <script src="/assets/js/header-rw4LHZmG.js"></script>
    <script src="/assets/js/lang.js"></script>
</body>

</html>