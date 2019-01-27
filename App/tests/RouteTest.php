<?php
namespace App\Tests;

use App\Router\Route;
use PHPUnit\Framework\TestCase;

final class RouteTest extends TestCase
{
    public function testMatchHomePage() : void
    {
        $params = [
                'url' => '/',
        ];

        $route = new Route($params);
        $this->assertEquals($route->match('/'), true);
    }

    public function testMatchMoreUrlParts() : void
    {
        $params = [
            'url' => '/posts',
        ];

        $route = new Route($params);
        $this->assertEquals($route->match('/post/1'), false);
    }

    public function testMatchLessUrlParts() : void
    {
        $params = [
            'url' => '/post/{id}',
        ];

        $route = new Route($params);
        $this->assertEquals($route->match('/posts'), false);
    }

    public function testMatchWithParam() : void
    {
        $params = [
            'url' => '/post/{id}',
            'constraints' => [
                'id' => '\d+'
            ]
        ];

        $route = new Route($params);
        $this->assertEquals($route->match('/post/12'), true);
    }

    public function testMatchParamWrongRegex() : void
    {
        $params = [
            'url' => '/post/{id}',
            'constraints' => [
                'id' => '\d+'
            ]
        ];

        $route = new Route($params);
        $this->assertEquals($route->match('/post/string'), false);
    }
}
