<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
//$en="en";
//if(isset(Yii::$app->session['lang'])) $en=Yii::$app->session['lang'];


return [
    'id' => 'app-frontend',
    'name'=>'Member GSO',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'homeUrl'=>'https://member.gso.co.id/',
    //'homeUrl'=>'http://localhost/member/memberami',
    'controllerNamespace' => 'frontend\controllers',
    //'language' =>  'id-ID',
    //'language' =>  'id-ID',
    //'language' =>  $en,
    'modules' => [
            'gridview' =>  [
                'class' => '\kartik\grid\Module'
                    ],
             'mimin' => [
                    'class' => '\hscstudio\mimin\Module',
                ],              
    ],
    'as access' => [
     'class' => '\hscstudio\mimin\components\AccessControl',
     'allowActions' => [
                            // add wildcard allowed action here!
                            'site/*',
                            'debug/*',
                            'mimin/*', // only in dev mode
                        ],
    ],

    'components' => [
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@app/themes/lte3/views'
             ],
         ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'authManager' => [
                'class' => 'yii\rbac\DbManager', // only support DbManager
            ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'assetManager' => [
        'bundles' => [
            'kartik\form\ActiveFormAsset' => [
                'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
            ],
            ],
        ],
         'i18n' => [
            'translations' => [
                 'app' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        //'basePath' => '@app/messages',
                        //'sourceLanguage' => 'en-US',
                ],
                'yii2-ajaxcrud' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2ajaxcrud/ajaxcrud/messages',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'id',
                ],
            ]
        ],
         'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
             'suffix'=>'.html',
            'rules' => [
               // '<site:\w+>/<indeks:\w+>/<id:\d+>' => '<site>/<indeks>',
               // '<site:\w+>/<indeks:\w+>/<id:\w+>' => '<site>/<indeks>',
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'params' => [
        'adminEmail' => 'members@gso.co.id',
        'supportEmail' => 'members@gso.co.id',
        'senderEmail' => 'members@gso.co.id',
        'senderName' => 'gso.co.id mailer',
        'user.passwordResetTokenExpire' => 3600,
        'user.passwordMinLength' => 8,
            'bsVersion' => '4.x',
            'bsDependencyEnabled' => false,
             'maskMoneyOptions' => [
                        'prefix' => 'Rp. ',
                        'suffix' => ' ',
                        'affixesStay' => false,
                        'thousands' => ',',
                        'decimal' => '.',
                        'precision' => 0, 
                        'allowZero' => false,
                        'allowNegative' => false,
                    ],
    ],
];
