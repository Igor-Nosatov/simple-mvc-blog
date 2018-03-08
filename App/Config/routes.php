<?php

$routes = [
    [
        'url' => '/',
        'action' => 'listPosts',
        'middleware' => '',
        'vars' => []
    ],
    [
        'url' => '/post/[0-9]+',
        'action' => 'post',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/admin',
        'action' => 'adminPanel',
        'middleware' => '\App\Router\Authenticate',
        'vars' => []
    ],
    [
        'url' => '/login',
        'action' => 'login',
        'middleware' => '',
        'vars' => []
    ],
    [
        'url' => '/addComment/[0-9]+',
        'action' => 'addComment',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/authenticate',
        'action' => 'authenticate',
        'middleware' => '',
        'vars' => []
    ],
    [
        'url' => '/addPost',
        'action' => 'addPost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => []
    ],
    [
        'url' => '/updatePost/[0-9]+',
        'action' => 'updatePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/executeUpdatePost/[0-9]+',
        'action' => 'executeUpdatePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/deletePost/[0-9]+',
        'action' => 'deletePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/flagComment/[0-9]+',
        'action' => 'flagComment',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/deleteComment/[0-9]+',
        'action' => 'deleteComment',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/unflagComment/[0-9]+',
        'action' => 'unflagComment',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ],
    [
        'url' => '/writePost',
        'action' => 'writePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => []
    ],
    [
        'url' => '/posts/[0-9]+',
        'action' => 'listPosts',
        'middleware' => '',
        'vars' => [
            'page'
        ]
    ]
];
