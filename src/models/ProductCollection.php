<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;

class ProductCollection
    implements \IteratorAggregate
{
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getProducts()
    {
        return array_map(
            function ($data) {
                return new Product($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getProducts());
    }
}