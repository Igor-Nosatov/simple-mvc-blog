<?php
use App\Router\Authenticate;

return [
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
        'middleware' => Authenticate::class,
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
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/updatePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'updatePost',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/executeUpdatePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'executeUpdatePost',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/deletePost/{id:[0-9]+}',
        'controller' => 'PostController',
        'action' => 'deletePost',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/deleteComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'deleteComment',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/unflagComment/{id:[0-9]+}',
        'controller' => 'CommentController',
        'action' => 'unflagComment',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/writePost',
        'controller' => 'PostController',
        'action' => 'writePost',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/imgUploadTinyMCE',
        'controller' => 'PostController',
        'action' => 'imgUploadTinyMCE',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/changePassword',
        'controller' => 'UserController',
        'action' => 'changePassword',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/executeChangePassword',
        'controller' => 'UserController',
        'action' => 'executeChangePassword',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/logout',
        'controller' => 'UserController',
        'action' => 'logout',
        'middleware' => Authenticate::class,
    ]
];
