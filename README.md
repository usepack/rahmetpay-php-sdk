# RahmetPay PHP Client Library
PHP клиент для работы с RahmetPay API. 

## Документация
Документация по работе с [API RahmetPay](https://rahmetpay.readthedocs.io/en/latest/)

## Пример
Пример скрипта находится в папке [example](https://github.com/usepack/rahmetpay-php-sdk/tree/master/example)

## Требования
PHP 5.6 (и выше) с расширением ext-json

## Установка
### В консоли с помощью Composer

1. Установите менеджер пакетов Composer.
2. В консоли выполните команду
```bash
composer require usepack/rahmetpay-php-sdk
```

### Или в файл composer.json своего проекта
1. Добавьте строку `"usepack/rahmetpay-php-sdk": "^1.0"` в список зависимостей
```
...
    "require": {
        "php": ">=5.6",
        "usepack/rahmetpay-php-sdk": "^1.0"
...
```

### Обновите composer
В консоли перейдите в каталог, где лежит composer.json, и выполните команду:
```bash
composer update
```

## Инструкция по применению

Импортируйте класс клиента
```php
use RahmetPay\Client;
```

Создайте класс в который передадите ссылку на gateway
```php
$basePath = 'https://gateway.chocodev.kz';
$rahmetPayClient = new Client($basePath);
```

Для авторизации необходимо вызвать метод auth.
В качестве параметров необходимо передать Client Id и Client Secret
Подробнее о методе и формате ответа Вы можете посмотреть в [документации метода auth](https://rahmetpay.readthedocs.io/en/latest/auth/)
```php
$rahmetPayClient->auth($clientId, $clientSecret);
```

После успешной авторизации необходимо во все запросы передавать Bearer Token
```php
$rahmetPayClient->setBearerToken($bearerToken);
```

Для создания заказа необходимо вызвать метод create.
В качестве параметра указывается массив (все возможные поля массива и формат ответа Вы можете посмотреть в [документации метода create](https://rahmetpay.readthedocs.io/en/latest/order/))
```php
$rahmetPayClient->create($arrayCreate);
```

Для проверки доступности оплаты необходимо вызвать метод availability.
Подробнее о формате ответа Вы можете посмотреть в [документации метода availability](https://rahmetpay.readthedocs.io/en/latest/availability/)
```php
$rahmetPayClient->availability();
```

Для проверки статуса оплаты заказа необходимо вызвать метод status.
В качестве параметра указывается массив id заказов с ключем merchant_order_ids
Подробнее о методе и формате ответа Вы можете посмотреть в [документации метода status](https://rahmetpay.readthedocs.io/en/latest/status/)
```php
$rahmetPayClient->status($arrayCheck);
```


Для возврата необходимо вызвать метод refund.
В качестве параметров указываются merchant_order_id (id заказа в вашей системе), amount (сумма для возврата), idempotent - UUID-V4
Подробнее о методе и формате ответа Вы можете посмотреть в [документации метода refund](https://rahmetpay.readthedocs.io/en/latest/refund/)
```php
$rahmetPayClient->refund(100500, 5000, $idempotent);
```