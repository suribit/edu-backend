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
    private $_limit;
    private $_offset;

    public function __construct(array $collection) {
        $this->_collection = $collection;
    }

    public function getProducts() {
        return array_slice($this->_collection, $this->_offset, $this->_limit);
    }

    public function getSize() {
        return count($this->getProducts());
    }

    public function limit($limit) {
        $this->_limit = $limit;
    }

    public function offset($offset) {
        $this->_offset = $offset;
    }
}