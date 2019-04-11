<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
//    'modules' => [],
    'language'=>'zh-CN',//英文的home变成中文的首页
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
        ],
        'v2' => [
            'class' => 'backend\modules\v2\Comment',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\AdminUser',
            'enableAutoLogin' => true,
        ],
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'secret',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
