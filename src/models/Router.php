<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
class Router
{
    private $_controller;
    private $_action;

    public function __construct($route)
    {
        if(isset($route))
        {
            $route = strtolower($route);
            if($this->_testRoute($route))
            {
                list($this->_controller, $this->_action) = explode('_', $route);
            }
            else
            {
                $this->_controller = 'notFound';
                $this->_action = 'show';
            }
        } else
        {
            $this->_controller = 'product';
            $this->_action = 'list';
        }

    }

    private function _testRoute($route)
    {
        if(!isset($route))
            return false;

        if(preg_match('/[a-zA-Z]{1,}_[a-zA-Z]{1,}/', $route))
        {
            if(file_exists(__DIR__ . '/../controllers/' . ucfirst(explode('_', $route)[0]) . 'Controller.php'))
            {
                require_once __DIR__ . '/../controllers/' . ucfirst(explode('_', $route)[0]) . 'Controller.php';
                $nameClass = ucfirst(explode('_', $route)[0]) . 'Controller';
                $objTemp = new $nameClass;
                if(method_exists($objTemp,  explode('_', $route)[1] . 'Action'))
                {
                    return true;
                }
            }
        }
        return false;
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