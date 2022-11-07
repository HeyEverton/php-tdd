<?php

namespace CodeTests\Router;

use PHPUnit\Framework\TestCase;
use Code\Router\Router;

class RouterTest extends TestCase
{

    public function testRouterSetOfRoutes()
    {
        $_SERVER['REQUEST_URI'] = '/users';
        $router = new Router();
        $router->addRoute('/users', function () {
            return 'Primeira rota';
        });

        $result = $router->run();
        $this->assertEquals('Primeira rota', $result);
    }

    public function testValidateANoRouteFound()
    {
        $this->expectException('\Exception');
        $this->expectExceptionMessage('Route Not Found');

        $_SERVER['REQUEST_URI'] = '/products';
        $router = new Router();
        $router->run();
    }

    public function testWithAControllerAssociate()
    {
        $_SERVER['REQUEST_URI'] = '/products';
        $router = new Router();
        $router->addRoute('/products', 'ProductController@index');

        $result = $router->run();

        $this->assertEquals('Controller Product', $result);
    }

    public function testAWrongFormatToACallControllerAsASecondParameterOfTheOurRouter()
    {
        $this->expectException('\InvalidArgumentException');
        $this->expectExceptionMessage('Formato de Chamada para Controler Errada.');
        $router = new Router();

        $router->addRoute('/products', 'ProductController');

        $router->run();
    }
}