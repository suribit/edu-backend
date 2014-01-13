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

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getCustomers()
    {
        return [];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getCustomers());
    }

    public function checkUser(Customer $customer)
    {
        $id = $this->_resource->check(['name' => $customer->getName(), 'password' => md5($customer->getPassword())]);
        $customer->load($id);
        return $id;
    }
}