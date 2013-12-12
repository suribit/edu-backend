<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */


namespace App\Model;

use App\Model\Quote;
use App\Model\Product;
use App\Model\QuoteItem;
use App\Model\Resource\IResourceEntity;


class QuoteItemCollection
    implements \IteratorAggregate
{
    private $_resource;
    private $_productResource;

    public function __construct(Resource\IResourceCollection $resource, Resource\IResourceEntity $productResource)
    {
        $this->_resource = $resource;
        $this->_productResource = $productResource;
    }

    public function filterByQuote(Quote $quote)
    {
        if ($quote->getCustomerId() != null)
        {
            $this->_resource->filterBy('customer_id', $quote->getCustomerId());
        }
        else
        {
            $this->_resource->filterBy('session_id', $quote->getSessionId());
        }
    }

//    public function assignProducts(Product $product, IResourceEntity $productResource)
//    {
//        $prototype = $product;
//
//
//
//        foreach ($this as &$_item)
//        {
//            $product = clone $prototype;
//            $product->load($productResource, $_item->getProductId());
//            $_item->assignProduct($product);
//            var_dump($_item);
//
//        }
//        echo '<br>';
//        foreach ($this as $_item)
//        {
//
//            var_dump($_item);
//
//        }
//        die;
//    }

    public function getQuotes()
    {
         return array_map(
            function ($data) {
                $element = new QuoteItem($data);
                $product = new Product([]);
                $product->load($this->_productResource, $element->getProductId());
                $element->assignProduct($product);
                return $element;
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getQuotes());
    }
}
