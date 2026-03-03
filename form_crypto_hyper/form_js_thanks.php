<?php
include "translate.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$ts = time();
$sig = hash_hmac('sha256', $ts, TRACKER_SECRET);

$csrf = $_SESSION['csrf_token'];
?>

<?php

function getcountrylang($country)
{
    $country = strtolower($country);
    switch ($country) {
        case 'at':
        case 'ch':
            return 'de';
        case 'ar':
        case 'bo':
        case 'cl':
        case 'co':
        case 'ec':
        case 'gt':
        case 'hn':
        case 'mx':
        case 'pe':
        case 'es':
            return 'es';
        case 'nz':
        case 'ph':
        case 'us':
        case 'ng':
        case 'au':
        case 'gh':
        case 'ca':
        case 'ie':
        case 'uk':
        case 'gb':
        case 'sg':
        case 'my':
        case 'th':
            return 'en';
        case 'jp':
            return 'ja';
        case 'br':
        case 'pt':
            return 'pt';

    }
    return $country;
}

$lang = getcountrylang($country);
$label = 0;

if (!isset($language)) {
    $language = $lang;
}

// $hostParent = str_replace(['https:', '//', '/'], '', $_SERVER['HTTP_REFERER']);

$email = true;
$special = (!empty($_GET['special'])) ? trim($_GET['special']) : 0;
?>
<!-- <link rel="preload" href="/form_crypto_hyper/includes/sdk.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/form_crypto_hyper/includes/sdk.css"></noscript> -->
<link class="whitelist" rel="stylesheet" href="/form_crypto_hyper/includes/sdk.css?v=1" type="text/css">

<!-- <link rel="preload" href="/form_crypto_hyper/includes/intgrtr.css?v=1" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/form_crypto_hyper/includes/intgrtr.css?v=1"></noscript> -->
<link class="whitelist" rel="stylesheet" href="/form_crypto_hyper/includes/fonts.css?v=3" type="text/css">
<link class="whitelist" rel="stylesheet" href="/form_crypto_hyper/includes/intgrtr.css?v=4.1" type="text/css">
<link class="whitelist" rel="stylesheet" href="/form_crypto_hyper/includes/btn.css?v=3.1" type="text/css">

<!-- <link rel="preload" href="/form_crypto_hyper/includes/index.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/form_crypto_hyper/includes/index.css"></noscript> -->
<!-- <link rel="stylesheet" href="/form_crypto_hyper/includes/index.css" type="text/css"> -->

<!-- <link rel="preload" href="/form_crypto_hyper/includes/intlTelInput.css?v=3" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/form_crypto_hyper/includes/intlTelInput.css?v=3"></noscript> -->
<link class="whitelist" rel="stylesheet" href="/form_crypto_hyper/includes/intlTelInput.css?v=3"/>
<script class="whitelist" defer src="/form_crypto_hyper/includes/jquery-3.6.0.min.js"></script>
<script class="whitelist" defer src="/form_crypto_hyper/includes/intlTelInput.min.js"></script>
<script defer src="/form_crypto_hyper/includes/jquery.maskedinput.min.js"></script>


<style type="text/css">
    .thank-you-container{width:100%;padding:20px;border-radius:12px;display:none;flex-direction:column;align-items:center;justify-content:center}.checkmark::after{content:'✔';color:green;margin-right:10px}.thank-you-text{font-size:26px!important;color:#000;text-align:center}@media (max-width:600px){.thank-you-container{width:100%;padding:10px}}.generatePassword{width:100%;text-align:center;background:#06bd06;border:none;padding:7px;border-radius:5px;cursor:pointer;color:#fff}.no-citizen,.preparing-data,.preparing-register,.question,.yes-citizen{text-align:center!important}.error-message{color:red;font-size:.8em;position:absolute;bottom:-20px;left:0;visibility:hidden;margin-left:13px}.formi-input{font-size:18px;color:#000;display:block;margin:8px auto!important;padding:15px 8px;border:1px solid #ececec;border-radius:12px;width:90%}.formi-input-group{margin:8px auto}.redirect-button{background-color:green!important}.formi-form-signup .formi-input-phone,.formi-form-signup-3-steps .formi-input-phone{border:none!important}.iti{border:1px solid #ececec!important;border-radius:6px!important}.formi-btn-submit-holder{margin-top:30px}#custom-regbox *{font:18px Arial,sans-serif!important}.rf-alert{display:flex;align-items:flex-start;padding:8px;border-radius:8px}.rf-alert_error{color:#b91c1c;background:#fee2e2}.rf-alert_success{color:#15803d;background:#dcfce7}.rf-alert__icon{opacity:.65}.rf-alert__content{font-size:14px;line-height:20px;padding-left:12px}.rf-alert__content *{font-family:inherit!important;line-height:inherit!important;color:inherit!important}.rf-alert__content>*{margin:0!important;padding:0!important}.rf-alert__content>*+*{margin-top:.35em!important}.rf-alert__content>h1,.rf-alert__content>h2,.rf-alert__content>h3,.rf-alert__content>h4,.rf-alert__content>h5,.rf-alert__content>h6{font-size:100%!important;font-weight:600!important}.rf-alert__content>ol,.rf-alert__content>ul{padding-left:1.5em!important}.rf-form__content>*+*{margin-top:16px}.rf-form__content>:last-child{margin-top:20px}.iti__country-name,.iti__flag-box{margin-right:6px;color:#000}.redirect-button.formi-btn-submit{box-shadow:#06bd06 0 0 0 0;animation:2s infinite pulsing}.no-citizen,.yes-citizen{box-shadow:none;animation:none}.no-citizen{width:50%;height:80px;background-color:#60359b!important;border-radius:6px;color:#fff}.yes-citizen{margin-top:7%!important;width:50%;height:80px;background-color:#fff!important;border:1px solid #60359b!important;border-radius:6px}.country-asking{display:flex;flex-direction:column;align-items:center}.ajax-processing{display:flex;align-items:center;justify-content:center}.dot{width:10px;height:10px;background-color:#000;border-radius:50%;margin:0 5px;opacity:.2;animation:1.5s ease-in-out infinite pulse}.dot:first-child{animation-delay:0s}.dot:nth-child(2){animation-delay:.5s}.dot:nth-child(3){animation-delay:1s}@keyframes pulse{0%,100%{opacity:.2}50%{opacity:1}}.wait-block{margin-top:3%!important}.phone-icon img{width:90px;height:80px;animation:1s infinite ring}@keyframes ring{0%,100%,50%{transform:rotate(0) scale(1)}10%,30%{transform:rotate(20deg) scale(1.1)}20%,40%{transform:rotate(-20deg) scale(1.1)}}.response-success{flex-direction:column;align-items:center}.iti__arrow,.iti__country-list{display:none}
</style>

<script defer>
    function toggleSubmitButton() {
      const form = document.querySelector('._signup_form');
      const button = form.querySelector('.submit-btn');
      button.disabled = !form.checkValidity();
    }
    
    function isMobileOrFixedTypeOk(itiInstance) {
        if (!window.intlTelInputUtils || !itiInstance.getNumberType) return true;
        const t = itiInstance.getNumberType();
        return t === intlTelInputUtils.numberType.MOBILE ||
               t === intlTelInputUtils.numberType.FIXED_LINE ||
               t === intlTelInputUtils.numberType.FIXED_LINE_OR_MOBILE;
    }

    function validateUi(itiInstance, phoneEl) {
        phoneEl.setCustomValidity('');
        const validShape = itiInstance.isValidNumber();
        const mobileOrFixedTypeOk = isMobileOrFixedTypeOk(itiInstance);
        if (!validShape || !mobileOrFixedTypeOk) {
            phoneEl.setCustomValidity('<?= $translate[$language]["No válida"];?>');
        }

        toggleSubmitButton();

        if (!phoneEl.checkValidity()) {
            phoneEl.reportValidity();
        }

    }

    function allowDigits(phone)
    {
        phone.setAttribute('inputmode', 'numeric');
        phone.setAttribute('pattern', '\\d*');

        phone.addEventListener('beforeinput', (e) => {
            if (e.inputType && e.inputType.startsWith('delete')) return;
            if (typeof e.data === 'string' && /\D/.test(e.data)) {
                e.preventDefault();
            }
        });
    }

    function initializePhoneInput(phone) {
        var iti = window.intlTelInput(phone, {
            allowDropdown: true,
            initialCountry: '<?= $phonecode; ?>',
            hiddenInput: "full",
            nationalMode: true,
            autoPlaceholder: 'aggressive',
            formatOnDisplay: true,
            separateDialCode: true,
            geoIpLookup: function (callback) {
                $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    callback(countryCode);
                });
            },
            utilsScript: '/form_crypto_hyper/includes/utils.js?v=1',
        });
        allowDigits(phone);
        phone.addEventListener('input', () => validateUi(iti, phone));
    }

    function asyncBeforeSendActions() {
        return new Promise((resolve, reject) => {
            var dots = $('.ajax-processing');
            $('.preparing-data').fadeIn(500);
            dots.fadeIn(500);
            setTimeout(() => {
                $('.preparing-register').fadeIn(500);
                setTimeout(() => {
                    resolve();
                }, 900);
            }, 1100);
        });
    }


    document.addEventListener('DOMContentLoaded', () => {
        const button = document.querySelector('.submit-btn');
        const form = document.querySelector('._signup_form');
        sendClarityIdentity("<?= $csrf; ?>");


        const delayInSeconds = <?= BUTTON_DELAY; ?>;

        const now = Date.now();
        let startTime = parseInt(localStorage.getItem('startTime'), 10);

        if (!startTime) {
            startTime = now;
            localStorage.setItem('startTime', startTime.toString());
        }

        const elapsed = Math.floor((now - startTime) / 1000);
        const remaining = delayInSeconds - elapsed;

        if (remaining > 0) {
            setTimeout(() => {
                localStorage.removeItem('startTime');
            }, remaining * 1000);
        } else {
            localStorage.removeItem('startTime');
        }

        const sessionStart = now;

        function updateTimeOnPage() {
            const secondsOnPage = Math.floor((Date.now() - sessionStart) / 1000);
            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/?_update_tokens=1&sub_id={subid}&sub_id_23=${secondsOnPage}`,
                true
            );
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send();
        }

        // setInterval(updateTimeOnPage, 10000);

        const number = document.querySelector('input[name="search2"]');
        initializePhoneInput(number);

        button.addEventListener('click', (e) => {
            let fio = $('input[name="fio"]').val();
            let lastName = $('input[name="lastName"]').val();
            let solrka = $('input[name="solrka"]').val();
            let phone = $('input[name="search2"]').val();
            sendClarityEvent('PREsubmitAttempt', {
                'formFirstName': fio,
                'formLastName': lastName,
                'formEmail': solrka,
                'formPhone': phone,
                'trusted': e.isTrusted
            });
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!form.checkValidity()) {
                const errors = Array.from(form.elements)
                    .filter(el => el.willValidate && !el.validity.valid)
                    .map(el => ({ field: el.name, message: el.validationMessage }));

                sendClarityEvent('formSubmitBlocked', {
                    'errors':       JSON.stringify(errors),
                });

                form.reportValidity();
                return;
            }

            let data =  $('._signup_form').serializeArray();

            data.push({name: 'fp_nonce', value: '<?= $ts ?>'});
            data.push({name: 'fp_hash', value: '<?= $sig ?>'});
            data.push({
                name: 'fp_checks',
                value: e.isTrusted ? '1' : '0'
            });
            const formData = $.param(data);

            var phones = document.querySelectorAll('input[name=search2]');

            for (var i = phones.length - 1; i >= 0; i--) {
                var phone = phones[i];
                var iti = window.intlTelInputGlobals.getInstance(phone);
                if (!iti.isValidNumber()) {
                    phone.setCustomValidity('<?= $translate[$language]["No válida"];?>');
                    sendClarityEvent('formSubmitBlockedByPhone', {
                        'message': 'Iti phone validation failed',
                        'phone': phone
                    });
                    return;
                }
                
                phone.setCustomValidity('');
            }

            $('.submit-btn').prop('disabled', true);
            $('.country-asking').css('display', 'flex');

            const fd = new FormData(form);
            const formTags = {};

            for (let [name, value] of fd.entries()) {
                formTags[name] = value;
            }


            sendClarityEvent('submitAttempt', formTags);


            $.ajax({
                type: 'POST',
                url: $('._signup_form').attr('action'),
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.redirect) {
                        sessionStorage.setItem("data", response.redirect);
                        $('.country-asking').hide();
                        sendClarityEvent('redirectLinkReceived', { 'redirectUrl': response.redirect });

                        window.location.href = '/form_crypto_hyper/register-thanks.php?lang=<?= $language ?>&url=' + encodeURIComponent(response.redirect);
                    } else {
                        $('.country-asking').hide();
                        $('._signup_form').show();
                        $('input[name="fio"]').val('');
                        $('input[name="lastName"]').val('');
                        $('input[name="solrka"]').val('');
                        $('input[name="search2"]').val('');
                        $('.rf-alert_error').show();
                        $('.js-rf-alert-error').text(response.message);
                        $('.submit-btn').prop('disabled', false);
                        $('.yes-citizen').prop('disabled', false);
                        $('.no-citizen').prop('disabled', false);
                        sendClarityEvent('noRedirectLinkReceived', { 'message': response.message });

                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    sendClarityEvent('ajaxError', { 'status': textStatus });
                    $('.js-rf-alert-error').text(textStatus + '<?= ' ' . $translate[$language]['Please, try again']; ?>');
                    $('._signup_form').show();
                }
            });
        });
    });

    function startCountdown(duration, redirectUrl) {
        var timer = duration, seconds;
        var countdownInterval = setInterval(function () {
            seconds = parseInt(timer, 10);
            $('#timer-seconds').text(seconds + '...');

            if (--timer < 0) {
                clearInterval(countdownInterval);
                window.location.href = redirectUrl;  // Redirect to the URL
            }
        }, 1000);
    }


    function sendClarityEvent(eventName, tags = {}) {
        if (typeof window.clarity !== 'function') {
            return;
        }
        Object.entries(tags).forEach(([key, val]) => {
            clarity('set', key, String(val));
        });
        clarity('event', eventName);
    }

    function sendClarityIdentity(identity) {
        if (typeof window.clarity !== 'function') {
            return;
        }
        if (identity) {
            clarity('identify', identity);
        }
    }
</script>
<script>
(function(){eval(atob('CihmdW5jdGlvbigpewogICAgZnVuY3Rpb24gZGlzYWJsZUFjdGlvbnMoKXsKICAgICAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdrZXlkb3duJyxmdW5jdGlvbihlKXsKICAgICAgICAgICAgaWYoZS5jdHJsS2V5JiZbJ2MnLCd2JywneCcsJ3UnLCdzJ10uaW5jbHVkZXMoZS5rZXkudG9Mb3dlckNhc2UoKSkpZS5wcmV2ZW50RGVmYXVsdCgpOwogICAgICAgICAgICBpZihlLmN0cmxLZXkmJmUuc2hpZnRLZXkmJlsnaScsJ2onXS5pbmNsdWRlcyhlLmtleS50b0xvd2VyQ2FzZSgpKSllLnByZXZlbnREZWZhdWx0KCk7CiAgICAgICAgICAgIGlmKGUua2V5PT09J0YxMicpZS5wcmV2ZW50RGVmYXVsdCgpOwogICAgICAgIH0pOwogICAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NvbnRleHRtZW51JyxmdW5jdGlvbihlKXtlLnByZXZlbnREZWZhdWx0KCk7fSk7CiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY29weScsZnVuY3Rpb24oZSl7ZS5wcmV2ZW50RGVmYXVsdCgpO30pOwogICAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ3Bhc3RlJyxmdW5jdGlvbihlKXtlLnByZXZlbnREZWZhdWx0KCk7fSk7CiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY3V0JyxmdW5jdGlvbihlKXtlLnByZXZlbnREZWZhdWx0KCk7fSk7CiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignc2VsZWN0c3RhcnQnLGZ1bmN0aW9uKGUpe2UucHJldmVudERlZmF1bHQoKTt9KTsKICAgICAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdkcmFnc3RhcnQnLGZ1bmN0aW9uKGUpe2UucHJldmVudERlZmF1bHQoKTt9KTsKICAgICAgICBkb2N1bWVudC5ib2R5LnN0eWxlLnVzZXJTZWxlY3Q9J25vbmUnOwogICAgfQogICAgZGlzYWJsZUFjdGlvbnMoKTsKfSkoKTsK'));})();
</script>
<div id="custom-regbox">
    <section class="form-section">
        <div>
            <div class="formwrap-outer">
                <div class="formi-form-signup formwrap">
                    <div data-formi-form-signup-3-steps="">
                        <form name="intgrtnFormSignup3Steps" action="/form_crypto_hyper/api.php" target="_parent"
                              class="formi-form-signup-3-steps _signup_form" method="post" autocomplete="off"
                              data-clarity-unmask="true">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                            <input type="hidden" name="subid" value="{subid}">
                            <input type="hidden" name="pixel" value="{sub_id_2}">
                            <input type="hidden" name="lang" value="<?= $language; ?>">
                            <input type="hidden" name="source" value="{traffic_source_name}">
                            <input type="hidden" name="offer" value="<?= $offer; ?>">
                            <input type="hidden" name="sub4" value="{sub_id_8}">
                            <input type="hidden" name="country" value="<?= $country; ?>">
                            <input type="hidden" name="offer_id" value="<?= $offer_id; ?>">
                            <input type="text" name="fp_sid" style="display:none" autocomplete="off" value="">
                            <div class="formi-loader-holder">
                                <div class="formi-loader-text-holder">
                                    <div class="formi-lds-dual-ring"></div>
                                    <div class="formi-loader-text"><?= $translate[$language]['Cargando']; ?>...</div>
                                </div>
                            </div>
                            <div class="formi-steps-holder">
                                <div class="formi-step formi-step-1 formi-active">
                                    <div class="formi-input-holder formi-input-holder-first-name">
                                        <?php if ($label == 1) { ?>
                                            <span style="font-weight: 700; margin-left: 10px;"><?= $translate[$language]['Nombre']; ?> *</span>
                                        <?php } ?>
                                        <input class="formi-input" type="text" name="fio" style="<?= $language == 'ar' ? 'text-align: right; direction: rtl' : '' ?>"
                                               placeholder="<?= $translate[$language]['Nombre']; ?>" value=""
                                               required=""
                                               autocomplete="off">
                                        <div class="formi-input-message-error"><?= $translate[$language]['El nombre es obligatorio']; ?>
                                            .
                                        </div>
                                    </div>

                                    <div class="formi-input-holder formi-input-holder-first-name">
                                        <?php if ($label == 1) { ?>
                                            <span style="font-weight: 700; margin-left: 10px;"><?= $translate[$language]['Apellido']; ?> *</span>
                                        <?php } ?>
                                        <input class="formi-input" type="text" name="lastName" style="<?= $language == 'ar' ? 'text-align: right; direction: rtl' : '' ?>"
                                               placeholder="<?= $translate[$language]['Apellido']; ?>" value=""
                                               required=""
                                               autocomplete="off">
                                        <div class="formi-input-message-error"><?= $translate[$language]['El apellido es obligatorio']; ?>
                                            .
                                        </div>
                                    </div>
                                </div>

                                <div class="formi-step formi-step-2 formi-active">
                                    <div class="formi-input-holder formi-input-holder-first-name">
                                        <?php if ($label == 1) { ?>
                                            <span style="font-weight: 700; margin-left: 10px;"><?= $translate[$language]['Email']; ?> *</span>
                                        <?php } ?>
                                        <input class="formi-input" type="text" name="solrka" style="direction: ltr; text-align: left;"
                                               pattern="^(?!example@email\.com$).+@.+\.[A-Za-z]{2,}$" title="example@email.com"
                                               placeholder="<?= $translate[$language]['Email']; ?>" value="" required=""
                                               autocomplete="off">
                                        <div class="formi-input-message-error"><?= $translate[$language]['El email es obligatorio']; ?>
                                            .
                                        </div>
                                    </div>

                                    <div class="formi-input-holder formi-input-holder-phone formi-invalid">
                                        <?php if ($label == 1) { ?>
                                            <span style="font-weight: 700; margin-left: 10px;"><?= $translate[$language]['Teléfono']; ?> *</span>
                                        <?php } ?>
                                        <div class="formi-input-group" style="display: grid; direction: ltr;text-align: left;">
                                            <input class="formi-input formi-input-area-code formi-input-area-code-flags"
                                                   type="text" name="areaCode" placeholder="Area Code" value="" dir="ltr" 
                                                   data-country-code="">
                                            <input class="formi-input formi-input-phone formi-invalid txt-phone"
                                                   type="text" name="search2" role="presentation" style="text-align: left;" autocomplete="off" dir="ltr" 
                                                   size="1" placeholder="<?= $translate[$language]['Teléfono']; ?>"
                                                   value=""
                                                   required="">
                                        </div>
                                        <div class="formi-input-message-error"><?= $translate[$language]['El teléfono es obligatorio']; ?>
                                            .
                                        </div>
                                    </div>
                                </div>

                                <div class="formi-step formi-step-3  formi-active">
                                    <div class="formi-btn-submit-holder">
                                        <button class="formi-btn-submit submit-btn" style="<?= $color; ?>"
                                                type="submit"><?= ($submit == '') ? $translate[$language]['REGISTRO'] : $submit; ?></button>
                                    </div>
                                </div>

                                <div class="rf-alert rf-alert_error" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="rf-alert__icon" fill="currentColor"
                                         viewBox="0 0 20 20" width="20" height="20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="rf-alert__content js-rf-alert-error"></div>
                                </div>

                                <div class="rf-alert rf-alert_success" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="rf-alert__icon" fill="currentColor"
                                         viewBox="0 0 20 20" width="20" height="20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="rf-alert__content js-rf-alert-success"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="display: none" class="country-asking">
                        <div class="wait-block">
                            <p style="display: none"
                               class="preparing-data"><?= $translate[$language]['Preparing data']; ?></p>
                            <p style="display: none"
                               class="preparing-register"><?= $translate[$language]['Registering in system']; ?></p>
                            <div style="display: none" class="ajax-processing">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
