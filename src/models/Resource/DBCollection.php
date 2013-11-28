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

    public function __construct(PDO $connection, $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;
    }

    public function fetch()
    {
        return $this->_connection->query("SELECT * FROM {$this->_table}")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}