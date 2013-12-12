<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/28/13
 */

namespace App\Model\Resource;

class DBEntity
    implements IResourceEntity
{
    private $_connection;
    private $_table;

    public function __construct(\PDO $connection, Table\ITable $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;
    }

    public function check($data)
    {
        $stmt = $this->_prepareSql($data/*, $this->_table->getPrimaryKey()*/);
        return $stmt->fetch(\PDO::FETCH_ASSOC)[$this->_table->getPrimaryKey()];
    }

    public function delete($id)
    {
        $smtm = $this->_connection->prepare(
            "DELETE FROM {$this->_table->getName()} WHERE {$this->_table->getPrimaryKey()} = :id"
        );
        $smtm->bindValue(':id', $id);
        $smtm->execute();
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

    public function find($id = null, $data = null)
    {
        if ($id != null)
        {
            $stmt = $this->_connection->prepare(
                "SELECT * FROM {$this->_table->getName()} WHERE {$this->_table->getPrimaryKey()} = :id"
            );
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            $stmt = $this->_prepareSql($data);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

    }

    public function save($data)
    {
        $fields = array_keys($data);
        if ($this->_itemExists($data)) {
            $stmt = $this->_updateItem($fields);
        } else {
            $stmt = $this->_insertItem($fields);
        }

        if(!$stmt->execute(array_combine($this->_prepareBind($fields), $data)))
            return false;
        return $this->_connection->lastInsertId($this->_table->getPrimaryKey());
    }

    private function _prepareBind($fields)
    {
        return array_map(function ($field) {
            return ":{$field}";
        }, $fields);
    }


    private function _itemExists($data)
    {
        if (isset($data[$this->_table->getPrimaryKey()])) {
            $id = $this->find($data[$this->_table->getPrimaryKey()]);

            return (bool) $id;
        }
    }


    private function _updateItem($fields)
    {
        $update = array_map(function ($field) {
            return "{$field} = :{$field}";
        }, $fields);

        $updateList = implode(',', $update);
        $condition  = "{$this->_table->getPrimaryKey()} = :{$this->_table->getPrimaryKey()}";
        $stmt       = $this->_connection->prepare(
            "UPDATE {$this->_table->getName()} SET {$updateList} WHERE {$condition}"
        );

        return $stmt;
    }

    private function _insertItem($fields)
    {
        $fieldsList = implode(',', $fields);
        $bindsList  = implode(',', $this->_prepareBind($fields));

        $stmt = $this->_connection->prepare(
            "INSERT INTO {$this->_table->getName()} ({$fieldsList}) VALUES ({$bindsList})"
        );

        return $stmt;
    }
}