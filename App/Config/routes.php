<?php

$routes = [
    [
        'url' => '/',
        'action' => 'listPosts',
        'middleware' => '',
    ],
    [
        'url' => '/post/{id:[0-9]+}',
        'action' => 'post',
        'middleware' => '',
    ],
    [
        'url' => '/posts/{page:[0-9]+}',
        'action' => 'listPosts',
        'middleware' => '',
    ],
    [
        'url' => '/addComment/{id:[0-9]+}',
        'action' => 'addComment',
        'middleware' => '',
    ],
    [
        'url' => '/flagComment/{id:[0-9]+}',
        'action' => 'flagComment',
        'middleware' => '',
    ],
    [
        'url' => '/404',
        'action' => 'notFound',
        'middleware' => '',
    ],
    [
        'url' => '/admin',
        'action' => 'adminPanel',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/login',
        'action' => 'login',
        'middleware' => '',
    ],
    [
        'url' => '/authenticate',
        'action' => 'authenticate',
        'middleware' => '',
    ],
    [
        'url' => '/admin/addPost',
        'action' => 'addPost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/updatePost/{id:[0-9]+}',
        'action' => 'updatePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/executeUpdatePost/{id:[0-9]+}',
        'action' => 'executeUpdatePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/deletePost/{id:[0-9]+}',
        'action' => 'deletePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/deleteComment/{id:[0-9]+}',
        'action' => 'deleteComment',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/unflagComment/{id:[0-9]+}',
        'action' => 'unflagComment',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/writePost',
        'action' => 'writePost',
        'middleware' => '\App\Router\Authenticate',
    ],
    [
        'url' => '/admin/imgUploadTinyMCE',
        'action' => 'imgUploadTinyMCE',
        'middleware' => '\App\Router\Authenticate',
    ]
];
