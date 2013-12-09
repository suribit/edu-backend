<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */


namespace App\Model;


class CartElementCollection implements \IteratorAggregate
{
    private $_resource;
    private $_productResource;

    public function __construct(Resource\IResourceCollection $resource, Resource\IResourceEntity $productResource)
    {
        $this->_resource = $resource;
        $this->_productResource = $productResource;
    }

    public function getCartElement()
    {

        return array_map(
            function ($data) {
                $element = new CartElement($data);
                $product = new Product([]);
                $product->load($this->_productResource, $element->getProductId());
                $element->setProduct($product);
                return $element;
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getCartElement());
    }
} 