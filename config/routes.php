<?php
return [
    // MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'authorize' => [
        'controller' => 'main',
        'action' => 'authorize',
    ],
    // AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],

    // UserController
    'user/login' => [
        'controller' => 'user',
        'action' => 'login',
    ],
    'user/registration' => [
        'controller' => 'user',
        'action' => 'registration',
    ],
    'user/emailVerification(.*)' => [
        'controller' => 'user',
        'action' => 'emailVerification',
    ],
    'user/logout' => [
        'controller' => 'user',
        'action' => 'logout',
    ],
    'user/passwordrecovery' => [
    'controller' => 'user',
    'action' => 'passwordrecovery',
        ],
    'user/changepassmail(.*)' => [
        'controller' => 'user',
        'action' => 'changepassmail',
    ],
    'user/login/fb(.*)' => [
        'controller' => 'user',
        'action' => 'fb',
    ],
    'main/privacy' => [
        'controller' => 'main',
        'action' => 'privacy',
    ],
    'user/account(.*)' => [
        'controller' => 'user',
        'action' => 'account',
    ],
    'user/changepass(.*)' => [
        'controller' => 'user',
        'action' => 'changepass',
    ],
    'uploadphoto' => [
        'controller' => 'user',
        'action' => 'uploadphoto',
    ],
    'photo' => [
        'controller' => 'user',
        'action' => 'photo',
    ],
    'likecounter(.*)' => [
    'controller' => 'user',
    'action' => 'likecounter',
    ],
    'new' => [
        'controller' => 'user',
        'action' => 'new',
    ],
    'comments' => [
        'controller' => 'user',
        'action' => 'comments',
    ],
    'deletephoto(.*)' => [
    'controller' => 'user',
    'action' => 'deletephoto',
    ],
    'user/yourphotos' => [
        'controller' => 'user',
        'action' => 'yourphotos',
    ],
];