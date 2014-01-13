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
}