<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 1:37 PM
 */

namespace App\Model;

class CustomerCollection
    implements \IteratorAggregate
{
    private $_resource;
    private $_prototype;
    private $_orderBy = '';
    private $_filterBy = '';
    private $_filterByValue = '';

    public function __construct(Resource\IResourceCollection $resource, Customer $customerPrototype)
    {
        $this->_resource = $resource;
        $this->_prototype = $customerPrototype;
    }

    public function getCustomers()
    {
        return array_map(
            function ($data) {
                $customer = clone $this->_prototype;
                $customer->setData($data);
                return $customer;
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getCustomers());
    }

    public function checkUser(Customer $customer)
    {
        $id = $this->_resource->check(['name' => $customer->getName(), 'password' => $customer->getPassword()]);
        $customer->load($id);
        return $id;
    }

    public function orderBy($column)
    {
        $this->_orderBy = $column;
        $this->_resource->orderBy($column, 'DESC');
    }

    public function getNameOrder()
    {
        return $this->_orderBy;
    }

    public function likeBy($column, $value)
    {
        $this->_filterBy = $column;
        $this->_filterByValue = $value;
        if ($this->_filterByValue != '')
            $this->_resource->likeBy($column, $value.'%');
    }

    public function getLikeBy()
    {
        return ['name' => $this->_filterBy, 'value' => $this->_filterByValue];
    }
}