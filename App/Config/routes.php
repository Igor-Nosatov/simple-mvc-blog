<?php
use App\Router\Authenticate;

return [
    [
        'url' => '/',
        'controller' => 'PostController',
        'action' => 'listPosts',
    ],
    [
        'url' => '/post/{id}',
        'controller' => 'PostController',
        'action' => 'post',
        'constraints' => ['id' => '\d+'],
    ],
    [
        'url' => '/posts/{page}',
        'controller' => 'PostController',
        'action' => 'listPosts',
        'constraints' => ['page' => '\d+'],
    ],
    [
        'url' => '/addComment/{id}',
        'controller' => 'CommentController',
        'action' => 'addComment',
        'constraints' => ['id' => '\d+'],
    ],
    [
        'url' => '/flagComment/{id}',
        'controller' => 'CommentController',
        'action' => 'flagComment',
        'constraints' => ['id' => '\d+'],
    ],
    [
        'url' => '/404',
        'controller' => 'PostController',
        'action' => 'notFound',
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
    ],
    [
        'url' => '/authenticate',
        'controller' => 'UserController',
        'action' => 'authenticate',
    ],
    [
        'url' => '/admin/addPost',
        'controller' => 'PostController',
        'action' => 'addPost',
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/updatePost/{id}',
        'controller' => 'PostController',
        'action' => 'updatePost',
        'constraints' => ['id' => '\d+'],
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/executeUpdatePost/{id}',
        'controller' => 'PostController',
        'action' => 'executeUpdatePost',
        'constraints' => ['id' => '\d+'],
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/deletePost/{id}',
        'controller' => 'PostController',
        'action' => 'deletePost',
        'constraints' => ['id' => '\d+'],
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/deleteComment/{id}',
        'controller' => 'CommentController',
        'action' => 'deleteComment',
        'constraints' => ['id' => '\d+'],
        'middleware' => Authenticate::class,
    ],
    [
        'url' => '/admin/unflagComment/{id}',
        'controller' => 'CommentController',
        'action' => 'unflagComment',
        'constraints' => ['id' => '\d+'],
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
