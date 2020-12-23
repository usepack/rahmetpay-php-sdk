<?php
    use RahmetPay\Client; // Подключаем RahmetPay клиент

    $basePath = 'https://gateway.chocodev.kz'; // Указываем ссылку на gateway rahmetpay
    $clientId = '12345678'; // Client Id - выдаётся нами
    $clientSecret = 'd9100eeeef4e123456c15aa88a74481666b09d3d8f02ba40134ebbvvv00b10z1'; // Секретный ключ клиента
    $filialToken = '12345865cccc88e991310c255f92'; // Токен филиала - выдаётся нами

    $rahmetPayClient = new Client($basePath); // Создаём клиент и передаём ссылку на gateway
    $authResponse = $rahmetPayClient->auth($clientId, $clientSecret); // Авторизовываемся

    if ($authResponse['status'] === 'error' || !isset($authResponse['data']['token'])) {
        var_dump('Ошибка авторизации');
        die();
    }

    $bearerToken = $authResponse['data']['token']; // Токен авторизации

    $rahmetPayClient->setBearerToken($bearerToken); // Устанавливаем токен авторизации

    // Создаём массив для создания заказа, подробнее в документации
    $arrayCreate = [
        'merchant_order_id' => 1,
        'amount' => 1,
        'token' => $filialToken,
        'image_size' => 200
    ];

    $createResponse = $rahmetPayClient->create($arrayCreate); // Передаём запрос на создание заказа


    // Создаём массив для проверки статусов заказов, подробнее в документации
    $arrayCheck = [
        'merchant_order_ids' => [12345, 123456, 123445566]
    ];

    $statusResponse = $rahmetPayClient->status($arrayCheck); // Передаём запрос на получение статусов заказов


    // Доступность оплаты
    $availabilityResponse = $rahmetPayClient->availability(); // Передаём запрос на получение статуса доступности оплаты


    // Возврат
    $refundResponse = $rahmetPayClient->refund(100500, 5000); // Указываем merchant_order_id и amount и передаём запрос на  возврат