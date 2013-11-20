<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
require_once __DIR__ . '/PageNotFoundException.php';

class Router
{
    private $_controller;
    private $_action;

    public function __construct($route)
    {
        if(isset($route) || $route === '')
        {
            $route = strtolower($route);
            $this->_testRoute($route);
            list($this->_controller, $this->_action) = explode('_', $route);
        } else
        {
            $this->_controller = 'product';
            $this->_action = 'list';
        }

    }

    private function _testRoute($route)
    {
        if(preg_match('/[a-zA-Z]{1,}_[a-zA-Z]{1,}/', $route))
        {
            if(file_exists(__DIR__ . '/../controllers/' . ucfirst(explode('_', $route)[0]) . 'Controller.php'))
            {
                require_once __DIR__ . '/../controllers/' . ucfirst(explode('_', $route)[0]) . 'Controller.php';
                $nameClass = ucfirst(explode('_', $route)[0]) . 'Controller';
                $objTemp = new $nameClass;
                if(!method_exists($objTemp,  explode('_', $route)[1] . 'Action'))
                {
                    throw new PageNotFoundException('Will not find a method in a class');
                }
            }
            else
            {
                throw new PageNotFoundException('Controller file is not found');
            }
        }
        else
        {
            throw new PageNotFoundException('Is not the same as the request format');
        }
    }

    public function getController()
    {
        return ucfirst($this->_controller) . 'Controller';
    }

    public function getAction()
    {
        return $this->_action . 'Action';
    }
}