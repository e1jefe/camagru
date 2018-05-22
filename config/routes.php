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
    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
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
];