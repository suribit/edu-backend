<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/25/13
 */

require_once __DIR__ . '/IResourceCollection.php';

class DBCollection
    implements IResourceCollection
{
    private $_connection;
    private $_table;

    private $_filterColumn;
    private $_filterValue;

    public function __construct(PDO $connection, $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;
    }

    public function fetch()
    {
        $condition = "";
        if (isset($this->_filterColumn))
        {
            $condition = "WHERE {$this->_filterColumn} = {$this->_filterValue}";
        }

        return $this->_connection->query("SELECT * FROM {$this->_table} {$condition}")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filter($column, $value)
    {
        $this->_filterColumn = $column;
        $this->_filterValue = $value;
    }

    public function getAverage($column)
    {
        $condition = "";
        if (isset($this->_filterColumn))
        {
            $condition = "WHERE {$this->_filterColumn} = {$this->_filterValue}";
        }
        return $this->_connection->query("SELECT AVG($column) AS average FROM {$this->_table} {$condition}")->fetch(PDO::FETCH_ASSOC)['average'];
    }
}