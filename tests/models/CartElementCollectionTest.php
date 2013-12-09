<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */
namespace Test\Model;
use App\Model\CartElement;
use App\Model;
use App\Model\Resource\IResourceCollection;
use App\Model\Resource\IResourceEntity;
use App\Model\Resource\IResourceSession;

class CartElementCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIteratorAggregateCartElementCollection()
    {


        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue([['cart_id' => 42, 'customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'count' => 1]]));

        $productResource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $productResource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(12))
            ->will($this->returnValue(['product_id' => 12, 'name' => 'Nokla', 'image' => 'http://g-nokia.ru/uploads/posts/2013-05/1368039525_200.jpg', 'price' => 750.0, 'special_price' => 500.00]));

        $cartElementCollection = new \App\Model\CartElementCollection($resource, $productResource);
        $cartElements = $cartElementCollection->getCartElement();

        $this->assertEquals(42, $cartElements[0]->getId());
    }

}