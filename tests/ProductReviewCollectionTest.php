<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/28/13
 */

require_once __DIR__ . '/../src/models/ProductReview.php';
require_once __DIR__ . '/../src/models/ProductReviewCollection.php';
require_once __DIR__ . '/../src/models/Resource/IResourceCollection.php';

class ProductReviewCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testTakesDataFromResource()
    {
        $resource = $this->getMock('IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'KkK']
                ]
            ));

        $collection = new ProductReviewCollection($resource);

        $review = $collection->getReviews();
        $this->assertEquals('KkK', $review[0]->getName());

    }


}
