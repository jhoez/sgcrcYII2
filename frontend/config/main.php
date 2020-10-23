<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

use kartik\mpdf\Pdf;

return [
    'name'=>'SGCRC',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone'=>'America/Caracas',//para definir bien la hora local
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'admin' => [
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'frontend\models\Usuario',
                    'idField' => 'iduser',
                    'usernameField' => 'username',
                    //'fullnameField' => 'profile.full_name',
                    'extraColumns' => [
                        [
                            'attribute' => 'email',
                            'label' => 'email',
                            'value' => function($model, $key, $index, $column) {
                                return $model->email;
                            },
                        ],
                        [
                            'attribute' => 'password',
                            'label' => 'Contraseña',
                            'value' => function($model, $key, $index, $column) {
                                return $model->password;
                            },
                        ],
                    ],
                    'searchClass' => 'frontend\models\UsuarioSearch'
                ],
            ],
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // por defaults es null, cuando no deseas usar el menú Otros valores opcionales son 'right-menu' and 'top-menu'
            'menus' => [
                'assignment' => [
                    'label' => 'Otorgar permiso'// change label
                ],
                //'route' => null, // disable menu
            ],
            'mainLayout' => '@app/views/layouts/main.php',// utiliza el menu del framework
        ]
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\Usuario',
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
            'maxSourceLines'=>20
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,// Disable r= routes
            'showScriptName' => false,// Disable index.php
            'rules' => [
            ],
        ],
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [//rutas de acceso al publico ejem: controller/action
            'site/*',
            'conteduc/index',
            'conteduc/verlib',
            'prodig/index',
            'prodig/descva',
            'rea/index',
            'admin/*'
            //'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
    'language'=>'es'
];
