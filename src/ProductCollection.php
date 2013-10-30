<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 10/30/13
 * Time: 10:02 PM
 */

class ProductCollection
{
    private $_collection;
    private $_count;
    private $_limit;
    private $_offset;

    public function __construct(array $collection) {
        $this->_collection = $collection;
        $this->_count = count($this->_collection);
        $this->_limit = $this->_count;
        $this->_offset = 0;
    }

    public function getProducts() {
        return array_slice($this->_collection, $this->_offset, $this->_limit);
    }

    public function getSize() {
        return $this->_limit;
    }

    public function limit($limit) {
        if ($limit >= 0) {
            $this->_limit = $limit;
        } else {
            $this->_limit = $this->_count;
        }
    }

    public function offset($offset) {
        if ($offset <= $this->_count && $offset >= 0) {
            $this->_offset = $offset;
        } else {
            $this->_offset = 0;
        }
    }
}