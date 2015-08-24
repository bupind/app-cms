<?php
use common\models\Option;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);

/* Time Zone */
$application->timeZone = Option::get('time_zone');

/* Date Time */
$application->formatter->dateFormat = 'php:' . Option::get('date_format');
$application->formatter->timeFormat = 'php:' . Option::get('time_format');
$application->formatter->datetimeFormat = 'php:' . Option::get('date_format') . ' ' . Option::get('time_format');

/* Theme Config */
$themeConfigFile = Yii::getAlias('@frontend/themes/') . Option::get('theme') . '/config/main.php';

if(is_file($themeConfigFile)){
    $themeConfig = require($themeConfigFile);
    if(isset($themeConfig['backend'])){
        $application->params = \yii\helpers\ArrayHelper::merge($application->params, $themeConfig['backend']);
    }
}

$application->run();