<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/25/13
 */

namespace App\Model\Resource;


use Zend\Db\Sql\Select;

class DBCollection
    implements IResourceCollection
{
    private $_connection;
    private $_table;
    private $_bind = [];
    private $_select;
    private $_sql;

    public function __construct(\PDO $connection, Table\ITable $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;

        $driver = new \Zend\Db\Adapter\Driver\Pdo\Pdo($this->_connection);
        $adapter = new \Zend\Db\Adapter\Adapter($driver);

        $this->_sql = new \Zend\Db\Sql\Sql($adapter);
        $this->_select = $this->_sql->select($this->_table->getName());
    }

    public function check($data)
    {
        $stmt = $this->_prepareSql($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC)[$this->_table->getPrimaryKey()];
    }

    public function fetch()
    {
        $results = $this->_executeSelect($this->_select);
        return \Zend\Stdlib\ArrayUtils::iteratorToArray($results);
    }

    public function filterBy($column, $value)
    {
        $this->_select->where("{$column} = :{$column}");
        $this->_bind[$column] = $value;
    }

    public function orderBy($column, $type = 'ASC')
    {
        $this->_select->order("{$column} {$type}");
    }

    public function likeBy($column, $value)
    {
        $this->_select->where("{$column} LIKE :{$column}");
        $this->_bind[$column] = $value;
    }

    public function average($column)
    {
        $result = $this->_executeSelect(
            $this->_select,
            ['avg' => new \Zend\Db\Sql\Predicate\Expression("AVG({$column})")]
        );
        return $result->current()['avg'];
    }

    public function _executeSelect(Select $select, $columns = null)
    {
        if ($columns) {
            $select->columns($columns);
        }

        $statement = $this->_sql->prepareStatementForSqlObject($select);
        $result = $statement->execute($this->_bind);

        return $result;
    }

    private function _prepareBind($fields)
    {
        return array_map(function ($field) {
            return ":{$field}";
        }, $fields);
    }

    protected function _prepareSql($data, $columns = '*')
    {
        $fields = array_keys($data);
        $check = array_map(function ($field) {
            return "{$field} = :{$field}";
        }, $fields);
        $whereList = implode(' AND ', $check);

        $sql = "SELECT {$columns} FROM {$this->_table->getName()} WHERE {$whereList}";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute(array_combine($this->_prepareBind($fields), $data));

        return $stmt;
    }

    public function limit($limit, $offset = 0)
    {
        $this->_select
            ->limit($limit)
            ->offset($offset);
    }

    public function count()
    {
        $select = clone $this->_select;
        $select
            ->reset(Select::LIMIT)
            ->reset(Select::OFFSET);
        $result = $this->_executeSelect(
            $select,
            ['count' => new \Zend\Db\Sql\Predicate\Expression("COUNT(*)")]
        );
        return $result->current()['count'];
    }
}
