<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */
namespace Test\Model;
use App\Model\CartElement;
use App\Model;

class CartElementTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCartElement()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'count' => 1]))
            ->will($this->returnValue(42));

        $cart_element = new CartElement(['customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'count' => 1]);
        $product = new \App\Model\Product([]);
        $cart_element->setProduct($product);
        $cart_element->save($resource);
        $this->assertEquals(42, $cart_element->getId());
    }

    public function testLoadCartElement()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['cart_id' => 42, 'customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'count' => 1]));

        $cart_element = new CartElement([]);
        $cart_element->load($resource, 42);
        $this->assertEquals(42, $cart_element->getId());
    }
}