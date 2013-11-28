<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
require_once __DIR__ . '/Resource/IResourceCollection.php';
require_once __DIR__ . '/EntityCollection.php';
require_once __DIR__ . '/Entity.php';
require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/ProductReview.php';

class ProductReviewCollection
    implements IteratorAggregate
{

    private $_resource;

    public function __construct(IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getReviews()
    {
        return array_map(
            function ($data) {
                return new ProductReview($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getAverageRating()
    {
        return $this->_resource->getAverage('rating');
    }

    public function filterByProduct(Product $product)
    {
        $this->_resource->filter('product_id', $product->getId());
    }

    public function getIterator()
    {
        return new ArrayIterator($this->getReviews());
    }
}