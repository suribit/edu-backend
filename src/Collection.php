<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */


class Collection implements Iterator {
    private $_collection;
    private $_limit;
    private $_offset;
    private $_position = 0;

    public function __construct(array $collection) {
        $this->_collection = $collection;
        $this->_limit = $this->getSize();
        $this->_offset = 0;
    }

    public function getData() {
        return array_slice($this->_collection, $this->_offset, $this->_limit);
    }

    public function getAllData() {
        return $this->_collection;
    }

    public function getSize() {
        return count($this->getData());
    }

    public function limit($limit) {
        $this->_limit = $limit;
    }

    public function offset($offset) {
        $this->_offset = $offset;
    }


    public function current() {
        return $this->_collection[$this->_position + $this->_offset];
    }

    public function key() {
        return $this->_position;
    }

    public function next() {
        $this->_position++;
    }
    
    public function rewind() {
        $this->_position = 0;
    }

    public function valid() {
        if($this->_position <= $this->_limit)
            return true;
        else
            return false;
    }
}
