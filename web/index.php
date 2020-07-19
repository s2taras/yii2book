<?php
define('YII_DEBUG', true);

// Include framework Yii2
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
// Get configs
$config = require(__DIR__ . '/../config/web.php');
// Create and run app
(new yii\web\Application($config))->run();
