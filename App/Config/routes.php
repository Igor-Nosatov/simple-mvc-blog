<?php

$routes = [
    [
        'url' => '/',
        'controller' => 'PostController',
        'action' => 'listPosts',
        'middleware' => '',
    ],
    [
        'url' => '/post/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'post',
        'middleware' => '',
    ],
    [
        'url' => '/posts/{page:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'listPosts',
        'middleware' => '',
    ],
    [
        'url' => '/addComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'addComment',
        'middleware' => '',
    ],
    [
        'url' => '/flagComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'flagComment',
        'middleware' => '',
    ],
    [
        'url' => '/404',
        'controller' => 'PostController',
        'action' => 'notFound',
        'middleware' => '',
    ],
    [
        'url' => '/admin',
        'controller' => 'UserController',
        'action' => 'adminPanel',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/login',
        'controller' => 'UserController',
        'action' => 'login',
        'middleware' => '',
    ],
    [
        'url' => '/authenticate',
        'controller' => 'UserController',
        'action' => 'authenticate',
        'middleware' => '',
    ],
    [
        'url' => '/admin/addPost',
        'controller' => 'PostController',
        'action' => 'addPost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/updatePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'updatePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/executeUpdatePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'executeUpdatePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/deletePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'deletePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/deleteComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'deleteComment',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/unflagComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'unflagComment',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/writePost',
        'controller' => 'PostController',
        'action' => 'writePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/imgUploadTinyMCE',
        'controller' => 'PostController',
        'action' => 'imgUploadTinyMCE',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/changePassword',
        'controller' => 'UserController',
        'action' => 'changePassword',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/executeChangePassword',
        'controller' => 'UserController',
        'action' => 'executeChangePassword',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/logout',
        'controller' => 'UserController',
        'action' => 'logout',
        'middleware' => '\App\Router\Authenticate',
    ]
];
