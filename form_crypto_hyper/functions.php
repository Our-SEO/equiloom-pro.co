<?php
require_once '/features/shadow_ban.php';

session_start();
function get_client_ip()
{
    $ipaddress = '';
    if (!empty($_GET['ip'])) {
        return $_GET['ip'];
    }
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    if (strripos($ipaddress, ',') !== false) {
        $ipaddress = explode(',', $ipaddress)[0];
    }

    return $ipaddress;
}

function generatePassword($length = 5)
{
    $possibleChars =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz0123456789";
    $password = 'Aa1';
    for ($i = 0; $i < $length; $i++) {
        $rand = rand(0, strlen($possibleChars) - 1);
        $password .= substr($possibleChars, $rand, 1);
    }
    $password .= rand(1, 1000);
    return $password;
}

function getCodeByCountry($country)
{
    $codes = [
        'es' => '+34',
        'uk' => '+44',
        'gb' => '+44',
        'au' => '+61',
        'nz' => '+64',
        'ca' => '+1',
        'it' => '+39',
        'cl' => '+56',
        'ar' => '+54',
        'mx' => '+52',
        'co' => '+57',
        'pe' => '+51',
        'ec' => '+593',
        'cr' => '+506',
        'do' => '+1',
        've' => '+58',
        'gt' => '+502',
        'sv' => '+503',
        'de' => '+49',
        'at' => '+43',
        'ch' => '+41',
        'be' => '+32',
        'nl' => '+31',
        'dk' => '+45',
        'no' => '+47',
        'se' => '+46',
        'fi' => '+358',
        'is' => '+354',
        'ie' => '+353',
        'ru' => '+7',
        'ua' => '+380',
        'fr' => '+33',
        'pt' => '+351',
        'pl' => '+48',
        'cz' => '+420',
        'sk' => '+421',
        'hu' => '+36',
        'ro' => '+40',
        'bg' => '+359',
        'gr' => '+30',
        'jp' => '+81',
        'ph' => '+63',
        'in' => '+91',
        'qa' => '+974',
        'ae' => '+971',
        'br' => '+55',
        'my' => '+60',
        'th' => '+66',
        'uy' => '+598',
        'pa' => '+507',
        'vn' => '+84',
        'kr' => '+82',
        'kw' => '+965',
        'bd' => '+880',
        'id' => '+62',
    ];

    if (isset($codes[$country])) {
        return $codes[$country];
    }

    return '';
}

function sendNewHyperOne($first_name, $last_name, $email, $area_code, $phone, $clickId, $country, $offer_id = '', $response = [])
{
    if ($country == 'uk')
        $country = 'gb';

    if (checkAndBan(['email' => $email, 'country' => $country, 'offer' => $offer_id], $response)) {
        sleep(rand(0, 13)); // время - деньги

        return generateFakeResponse();
    }

    include __DIR__ . '/config.php';

    $bx = 'BX-VQJKS9HZP8K6G';

    $baer = 'SEO';
    if (!empty($affs[$baer])) {
        $af = $affs[$baer];
    } else {
        $af = $affs['CMN'];
    }

    $data = [
        'affc' => $af['affc'],
        'bxc' => $bx,
        'vtc' => 'VT-HP8XSRMKVS6E7',
        'profile' => [
            'firstName' => $first_name,
            'lastName' => $last_name,
            'email' => $email,
            'password' => generatePassword(),
            'phone' => $area_code . $phone
        ],
        'ip' => get_client_ip(),
        'funnel' => $offer_id,
        'geo' => strtoupper($country),
        'lang' => strtoupper(urldecode($response['lang'])),
        'landingLang' => strtoupper(urldecode($response['lang'])),
        'subId' => $clickId,
        'subId_b' => $baer,
        'subId_a' => 'SEO',
        'landingURL' => 'https://google.com'
    ];


    $file = __DIR__ . '/' . trim($_SERVER['HTTP_HOST']) . '_hyperone_logs.log';

    @file_put_contents($file, print_r($data, true) . "\n\n" . print_r($response, true), FILE_APPEND);
    chmod($file, 0640);

    $url = 'https://c2r.hn-crm.com/api/external/integration/lead';
    $ch = curl_init();
    $headers = array();
    $headers[] = 'X-Api-Key: ' . $af['api_key'];
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $return = curl_exec($ch);

    curl_close($ch);
    $array = json_decode($return, true);


    $file = __DIR__ . '/' . trim($_SERVER['HTTP_HOST']) . '_hyperone_response.log';

    @file_put_contents($file, print_r($array, true), FILE_APPEND);
    chmod($file, 0640);

    return $array;
}

function sendNewLeadGrid($first_name, $last_name, $email, $area_code, $phone, $clickId, $country, $offer_id = '', $response = [])
{
    require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/config.php';

    if ($country == 'uk')
        $country = 'gb';


//    if (checkAndBan(['email' => $email, 'country' => $country, 'offer' => $offer_id], $response)) {
//        sleep(rand(0, 13)); // время - деньги
//
//        return generateFakeResponse();
//    }

    // if ($country == 'jp') {
    //     $phone = $respone['full'];
    // }

    $baer = 'TEST';
    if (!empty($affsLg[$baer])) {
        $af = $affsLg[$baer];
    }

    $data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => generatePassword(6),
        'email' => $email,
        'phone' => $phone,
        'area_code' => $area_code,
        'hitid' => $clickId,
        'country' => strtoupper($country),
        'funnel' => $offer_id,
        'affid' => $af ?? 6,
        'aff_sub2' => $baer ?? 'SEO',
        'aff_sub3' => strtoupper(urldecode($response['lang'])),
        'aff_sub4' => 'SEO',
        'aff_sub9' => 'switch',
        'aff_sub10' => 'SEO-62',
        'source' => 'Facebook',
        '_ip' => get_client_ip(),
        'language' => strtoupper(urldecode($response['lang']))
    ];

    $file = __DIR__ . '/' . trim($_SERVER['HTTP_HOST']) . '_leadgrid_logs.log';

    @file_put_contents($file, print_r($data, true) . "\n\n" . print_r($response, true), FILE_APPEND);
    chmod($file, 0640);


    $url = 'https://ardsapi.net/leads';
    $ch = curl_init();
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $return = curl_exec($ch);
    curl_close($ch);

    $file = __DIR__ . '/' . trim($_SERVER['HTTP_HOST']) . '_leadgrid_response.log';

    @file_put_contents($file, print_r($return, true), FILE_APPEND);
    chmod($file, 0640);

    return json_decode($return, true);
}

function saveLogs($respone, $return, $pp, $clickid, $ip, $answer, $offer_id, $iframeSrc)
{

    $respone['iframe'] = $iframeSrc;
    $data = [
        'tracker_click_id' => $respone['subid'],
        'pp_click_id' => $clickid,
        'click_ip' => $ip,
        'advertiser' => $pp,
        'country' => strtoupper($respone['country']),
        'data_request' => json_encode($respone),
        'data_response' => json_encode($return),
        'status' => 'click',
        'offer_id' => $offer_id,
        'source' => $respone['source'],
        'answer' => ($answer == 'Wait') ? '' : $answer,
    ];
    $url = 'https://api-hex.space/api/set-crypto-logs?api_key=1e3a6af5f371ab3056ed1645abebb607b52b9e5f';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $return = curl_exec($ch);
    curl_close($ch);
}

function checkBot($postData): array
{
    $errors = [];
    #### CSRF token - fake post data
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = [
            'csrf_token' => [
                'error' => 'CSRF token mismatch',
                'session' => $_SESSION['csrf_token'],
                'post' => $_POST['csrf_token'],

            ],
        ];
    }

    #### fp_checks field - clickjacking
    /*
     * based on js code  data.push({
     *   name:  'fp_checks',
     *   value: ((event.originalEvent||event).isTrusted ? '1':'0')
     * });
     */
    if (empty($postData['fp_checks']) || $postData['fp_checks'] !== '1') {

        $errors[] = [
            'fp_checks' => [
                'error' => 'fp_checks field filled',
                'value' => $postData['fp_checks'] ?? '--EMPTY--',
            ],
        ];
    }
    #### honeypot field - only filled by bots
    if (!empty($postData['fp_sid'])) {
        $errors[] = [
            'honeypot' => [
                'error' => 'Honeypot field filled',
                'fp_sid' => $postData['fp_sid'],
            ],
        ];
    }

    #### signature field - fake post data
    $ts = (int) ($postData['fp_nonce'] ?? 0);
    $sig = $postData['fp_hash'] ?? '';
    $time = time();
    if (
        hash_hmac('sha256', $ts, TRACKER_SECRET) !== $sig
        || $time - $ts < BUTTON_DELAY // проверить $dealy из старой формы с сервака, возможно 60 сек
    ) {
        $errors[] = [
            'signature' => [
                'error' => 'Signature mismatch',
                'ts' => $ts,
                'sig' => $sig,
                'expected' => hash_hmac('sha256', $ts, TRACKER_SECRET),
                'expected_ts' => $time - $ts,
            ],
        ];
    }

    #### http-only cookie field
    $cookie = $_COOKIE['formSid'] ?? '';
    if (empty($cookie)) {
        $errors[] = [
            'cookie' => [
                'error' => 'Cookie not set or empty or set wrong',
                'sid' => '',
                'expected' => '32 hex chars',
            ],
        ];
    }

    list($sid, $sig) = explode('|', $cookie, 2);

    if (!preg_match('/^[0-9a-f]{32}$/', $sid)) {
        $errors[] = [
            'cookie' => [
                'error' => 'SID not set or empty or set wrong',
                'sid' => $sid,
                'expected' => '32 hex chars',
            ],
        ];
    }
    if (!hash_equals(hash_hmac('sha256', $sid, TRACKER_SECRET), $sig)) {
        $errors[] = [
            'cookie' => [
                'error' => 'SID signature mismatch',
                'sid' => $sid,
                'sig' => $sig,
                'expected' =>
                    hash_hmac('sha256', $sid, TRACKER_SECRET),
            ],
        ];

    }

    $log = [
        'cookie_check' => [
            'cookie' => $cookie,
            'sid' => $sid,
            'sig' => $sig,
            'expected' =>
                hash_hmac('sha256', $sid, TRACKER_SECRET),
        ],
        'rawPost' => $postData,
        'errors' => $errors,
    ];

    $hash = md5(json_encode($log));
    date_default_timezone_set('Europe/Moscow');
    $logData = [
        $_SERVER['HTTP_HOST'] => [
            'time' => date('Y-m-d H:i:s T'),
            'ip' => get_client_ip(),
            'UA' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'referer' => $_SERVER['HTTP_REFERER'] ?? '',
            'hash' => $hash,
            'data' => $log,
        ]
    ];

    $dataToWrite = json_encode($logData, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    $file = __DIR__ . '/' . date('Y-m-d') . '.log';

    @file_put_contents($file, $dataToWrite, FILE_APPEND);

    chmod($file, 0640);

    return $errors;
}

function getClientCountryIso2($ip = null)
{
    $token = '8da953432cb0d9';
    if ($ip === null) {
        $ip = get_client_ip();
    }
    $url = "https://ipinfo.io/{$ip}?token={$token}";

    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);
    return $data['country'] ?? null;
}
