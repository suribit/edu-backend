<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;

class ProductReviewCollection
    implements \IteratorAggregate
{
    private $_resource;
    private $_prototype;

    public function __construct(Resource\IResourceCollection $resource, ProductReview $productReviewPrototype)
    {
        $this->_resource = $resource;
        $this->_prototype = $productReviewPrototype;
    }

    public function getReviews()
    {
        return array_map(
            function ($data) {
                $productReview = clone $this->_prototype;
                $productReview->setData($data);
                return $productReview;
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getReviews());
    }

    public function filterByProduct(Product $product)
    {
        $this->_prototype->assignToProduct($product);
        $this->_resource->filterBy('product_id', $product->getId());
    }

    public function getAverageRating()
    {
        return $this->_resource->average('rating');
    }
}