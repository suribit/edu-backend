<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */
namespace Test\Model;

use App\Model;
use App\Model\Customer;
use App\Model\Product;

class QuoteTest extends \PHPUnit_Framework_TestCase
{
    public function testGetItemForProduct()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('check')
            ->with($this->equalTo(['customer_id' => 5, 'product_id' => 12]))
            ->will($this->returnValue(42));
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['cart_id' => 42, 'customer_id' => 5, 'session_id' => null, 'product_id' => 12, 'qty' => 1]));

        $resourceCustomer = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resourceCustomer->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]))
            ->will($this->returnValue(5));

        $customer = new Customer(['name' => 'Vasia', 'password' => '1234555'], $resourceCustomer);
        $customer->save();

        $resourceProduct = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resourceProduct->expects($this->any())
            ->method('find')
            ->with($this->equalTo(12))
            ->will($this->returnValue(['product_id' => 12, 'name' => 'nokla']));

        $product = new Product([], $resourceProduct);
        $product->load(12);

        $quote = new Model\Quote();
        $quote->loadByCustomer($customer);

        $quoteItem = $quote->getItemForProduct($product, $resource);

        $this->assertEquals(42, $quoteItem->getId());

    }
}