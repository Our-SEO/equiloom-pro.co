<?php
require_once 'env.php';
require_once "functions.php";
header('Content-Type: application/javascript');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
} else {
    header('Access-Control-Allow-Origin: *');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit();
}

if (!empty($_POST)) {
    ## bot check start
//    if (!empty($checkBotAndReturnData = checkBot($_POST))) {
//        if (IS_DEBUG === 'yes') {
//            echo json_encode(['status' => 'ok', 'message' => 'Bot check not passed', 'data' => $checkBotAndReturnData]);
//            exit();
//        }
//        echo json_encode(
//            ['status' => 'ok',
//                'redirect' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/form_crypto_hyper/thanks.html'
//            ]);
//        exit();
//    };
    ## bot check end

    $fio = !empty($_POST['fio']) ? $_POST['fio'] : '';
    $phone = !empty($_POST['search2']) ? $_POST['search2'] : '';

    $source = (!empty($_POST['source'])) ? trim($_POST['source']) : '';

    $medium = (!empty($_POST['medium'])) ? trim($_POST['medium']) : '';
    $adset_name = (!empty($_POST['adset_name'])) ? trim($_POST['adset_name']) : '';

    $smart = (!empty($_POST['smart'])) ? trim($_POST['smart']) : 0;

    $offerName = (!empty($_POST['offer'])) ? trim($_POST['offer']) : 'ImmediateConnect';

    $callback = $_POST['callback'];

    // Получаем все данные из формы
    $formData = $_POST;

    // Удаляем параметр callback из данных формы
    unset($formData['callback']);

    $base64 = base64_encode(json_encode($formData));

    $respone = $formData;
    $clickId = $_POST["subid"];

    // шлем запрос

    $phone = str_replace([' ', '(', ')', '-'], '', $respone['search2']);
    $phone = str_replace('O', '0', $phone);

    $area_code = $respone['areaCode'];

    if (empty($area_code)) {
        $area_code = getCodeByCountry($respone['country']);
    }

    if ($respone['country'] == 'ru') {
        $area_code = '8';
        $phone = str_replace($area_code, '', $phone);
        $area_code = '+7';
    }

    if ($respone['country'] == 'jp') {
        if ($phone[0] == 0 && strlen($phone) > 10) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'ch') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'ph') {
        if ($phone[0] == 0 && strlen($phone) > 10) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'my') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'br') {
        if ($phone[0] == 0 && strlen($phone) > 11) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'co') {
        if ($phone[0] == 0 && strlen($phone) > 10) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'au') {
        if ($phone[0] == 0 && strlen($phone) > 11) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'th') {
        if ($phone[0] == 0 && strlen($phone) > 11) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'in') {
        if ($phone[0] == 0 && strlen($phone) > 12) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'fr') {
        if ($phone[0] == 0 && strlen($phone) > 11) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'uy') {
        if ($phone[0] == 0 && strlen($phone) > 11) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'fi') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'se') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'nl') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($respone['country'] == 'ae') {
        if ($phone[0] == 0 && strlen($phone) > 9) {
            $phone = substr($phone, 1);
        }
    }

    if ($area_code == '+') {
        $area_code = getCodeByCountry($respone['country']);
    }

    $respone['solrka'] = str_replace(' ', '', $respone['solrka']);

    $doCodes = ['809', '829', '849'];
    if ($respone['country'] === 'do' && !in_array(substr($phone, 0, 3), $doCodes)) {
        $error = 'el código no corresponde a República Dominicana';
    }
    $caCodes = [
        '204','226','236','249','250','289','306','343','365','367',
        '403','416','418','431','437','438','450','506','514','519',
        '548','579','581','587','604','613','639','647','672','705',
        '709','742','778','782','807','819','825','867','873','902',
        '905'
    ];
    if ($respone['country'] === 'ca' && !in_array(substr($phone, 0, 3), $caCodes)) {
        $error = 'l’indicatif ne correspond pas au Canada. \ The area code does not belong to Canada.';
    }
    if ($error) {
        header('Content-Type: application/json');
        echo json_encode(['message' => $error]);

        exit;
    }

    $return = sendNewLeadGrid($respone['fio'], $respone['lastName'], $respone['solrka'], $area_code, $phone, $clickId, $respone['country'],
        $offerName, $respone);
    
    if (!empty($return['data']) && !empty($return['data']['errorMessage'])) {
        $result['message'] = $return['data']['errorMessage'];
    }

    if (!empty($return['error'])) {
        $result['message'] = $return['error'];
    }

    if (!empty($return['errors'])) {
        $result['message'] = json_encode($return['errors']);
    }

    if (!empty($return['auto_login_url'])) {
        $result['redirect'] = $return['auto_login_url'];
    }

    if (!empty($return['redirectUrl'])) {
        $result['redirect'] = $return['redirectUrl'];
    }

    if (!empty($return['extras']) && !empty($return['extras']['redirect']) && !empty($return['extras']['redirect']['url'])) {
        $result['redirect'] = $return['extras']['redirect']['url'];
    }

    //Записываем лог в CRM
    // saveLogs($respone, $return, 'em6', $clickId, get_client_ip(), $result['message'], $offerName, '');

    header('Content-Type: application/json');
    echo json_encode($result);

    exit;
}


