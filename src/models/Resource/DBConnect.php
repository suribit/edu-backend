<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/28/13
 */
namespace App\Model\Resource;

class DBConnect {
    private $_connect;
    public function __construct($host, $dbName, $userName, $password)
    {
        $this->_connect = new \PDO("mysql:host={$host};dbname={$dbName}", $userName, $password);
    }

    public function getPdo()
    {
        return $this->_connect;
    }
} 