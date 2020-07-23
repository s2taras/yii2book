<?php

return [
    'id' => 'crmapp',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'view' => [
            'renderers' => [
                'md' => [
                    'class' => 'app\utilities\MarkdownRenderer',
                ]
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'your secret key here',
//            'enableCookieValidation' => false,
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'assetManager' => [
            // setup asset converter for *.less files :
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color'],
                ],
            ],
            // override bundles to use local project files :
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                    'css' => [
                        'css/bootstrap.less'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
                'yii\bootstrap\BootstrapThemeAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
            ],
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'],
        ],
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
];
