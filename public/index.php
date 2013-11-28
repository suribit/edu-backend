<?php
ini_set('display_errors', 0);

require_once __DIR__ . '/../src/models/Router.php';
require_once __DIR__ . '/../src/models/PageNotFoundException.php';
require_once __DIR__ . '/../src/models/Resource/DBConnect.php';

$GLOBALS['db'] = new DBConnect('localhost', 'shop', 'root', '0000');


try
{
    try
    {
        $router = new Router($_GET['page']);
    }
    catch (PageNotFoundException $ex)
    {
        $router = new Router('notFound_show');
    }
    finally
    {
        $controllerName = $router->getController();
        require_once __DIR__ . "/../src/controllers/{$controllerName}.php";

        $controller = new $controllerName;
        $actionName = $router->getAction();

        $controller->$actionName();
    }
}
catch (Exception $ex)
{
    echo 'Error';
}


