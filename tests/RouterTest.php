<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
require_once __DIR__ . '/../src/models/Router.php';
require_once __DIR__ . '/../src/models/PageNotFoundException.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsControllerNameMatchedByRoute()
    {
        $router = new Router('product_list');
        $this->assertEquals(
            'ProductController', $router->getController()
        );
    }

    public function testReturnsActionNameMatchedByRoute()
    {
        $router = new Router('product_list');
        $this->assertEquals('listAction',$router->getAction());
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage Is not the same as the request format
     */
    public function testReturnsPageNotFoundNotSureTheFormat()
    {
        $router = new Router('ssss');
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage Controller file is not found
     */
    public function testReturnsPageNotFoundClassFileNotFound()
    {
        $router = new Router('sss_ss');
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage Will not find a method in a class
     */
    public function testReturnsPageNotFoundClassMethodNotFound()
    {
        $router = new Router('product_blablbla');
    }
}