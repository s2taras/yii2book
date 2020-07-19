<?php

return [
    'id' => 'crmapp',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'request' => [
            'cookieValidationKey' => 'your secret key here',
//            'enableCookieValidation' => false,
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
];
