<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */

require_once __DIR__ . '/vendor/autoload.php';
$loader = new \Zend\Loader\StandardAutoloader;

$loader->registerNamespace(
    'App\Model',
    __DIR__ . '/src/models'
);
$loader->registerNamespace(
    'App\Controller',
    __DIR__ . '/src/controllers'
);
$loader->register();