<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/28/13
 */

namespace Test\Model;
use App\Model\ProductReview;
use \App\Model\ProductReviewCollection;
use \App\Model\Product;

class ProductReviewCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testTakesDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasia']
                ]
            ));

        $productReview = new ProductReview([]);
        $collection = new ProductReviewCollection($resource, $productReview);

        $reviews = $collection->getReviews();
        $this->assertEquals('Vasia', $reviews[0]->getName());
    }

    public function testIsIterableWithForeachFunction()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasia'],
                    ['name' => 'Petia']
                ]
            ));

        $productReview = new ProductReview([]);
        $collection = new ProductReviewCollection($resource, $productReview);
        $expected = array(0 => 'Vasia', 1 => 'Petia');
        $iterated = false;
        foreach ($collection as $_key => $_productReview) {
            $this->assertEquals($expected[$_key], $_productReview->getName());
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }

    /**
     * @dataProvider getProductIds
     */
    public function testFiltersCollectionByProduct($productId)
    {
        $productResource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $productResource->expects($this->any())
            ->method('getPrimaryKeyField')
            ->will($this->returnValue('product_id'));
        $product = new Product(['product_id' => $productId], $productResource);

        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('filterBy')
            ->with($this->equalTo('product_id'), $this->equalTo($productId));

        $productReview = new ProductReview([]);
        $collection = new ProductReviewCollection($resource, $productReview);

        $collection->filterByProduct($product);
    }

    public function getProductIds()
    {
        return [[1], [2]];
    }

    public function testCalculatesAverageRating()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('average')
            ->with($this->equalTo('rating'));

        $productReview = new ProductReview([]);
        $collection = new ProductReviewCollection($resource, $productReview);
        $collection->getAverageRating();
    }

}