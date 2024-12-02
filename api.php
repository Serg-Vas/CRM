<?php
function addLead($data) {
    $url = 'https://crm.belmar.pro/api/v1/addlead';
    $token = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';

    $payload = [
        "firstName" => $data['firstName'],
        "lastName" => $data['lastName'],
        "phone" => $data['phone'],
        "email" => $data['email'],
        "countryCode" => 'GB',
        "box_id" => 28,
        "offer_id" => 5,
        "landingUrl" => $_SERVER['HTTP_HOST'],
        "ip" => "192.168.0.102",
        "password" => "qwerty12",
        "language" => "en"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "token: $token",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($httpCode !== 200) {
        return ['success' => false, 'message' => "Ошибка HTTP $httpCode", 'error' => $curlError];
    }

    $decodedResponse = json_decode($response, true);
    if (isset($decodedResponse['status']) && $decodedResponse['status'] === "false") {
        return ['success' => false, 'message' => $decodedResponse['error']];
    }

    return ['success' => true, 'message' => 'Лид успешно добавлен!', 'data' => $decodedResponse];
}


function getStatuses($date_from, $date_to, $page = 0, $limit = 100) {
    $url = 'https://crm.belmar.pro/api/v1/getstatuses';
    $token = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';

    $payload = [
        "date_from" => $date_from,
        "date_to" => $date_to,
        "page" => $page,
        "limit" => $limit
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "token: $token",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($httpCode !== 200) {
        return ['success' => false, 'message' => "Ошибка HTTP $httpCode", 'error' => $curlError];
    }

    $decodedResponse = json_decode($response, true);
    if (isset($decodedResponse['status']) && $decodedResponse['status'] === "false") {
        return ['success' => false, 'message' => $decodedResponse['error']];
    }

    return ['success' => true, 'data' => $decodedResponse];
}


function sendRequest($url, $params) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    $response = curl_exec($ch);
    curl_close($ch);
// Отладка
echo "HTTP Code: $httpCode<br>";
echo "cURL Error: $curlError<br>";
echo "Response: $response<br>";
exit;

if ($httpCode !== 200) {
    return ['success' => false, 'message' => "Ошибка HTTP $httpCode"];
}
    return json_decode($response, true);
}
?>
