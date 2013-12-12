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
use App\Model\Quote;

class QuoteItemCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIsIterateWithForeach()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['customer_id' => 43, 'product_id' => 58],
                    ['customer_id' => 43, 'product_id' => 60]
                ]
            ));
        $resource->expects($this->any())
            ->method('filterBy')
            ->will($this->onConsecutiveCalls(58, 60));

        $resourceCustomer = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resourceCustomer->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]))
            ->will($this->returnValue(43));

        $customer = new Customer(['name' => 'Vasia', 'password' => '1234555']);
        $customer->save($resourceCustomer);

        $quote = new Quote();
        $quote->loadByCustomer($customer);


        $product = new Product([]);
        $product->load($resource, 42);


        $collection = new Model\QuoteItemCollection($resource);
        $collection->filterByQuote($quote);

        $expected = array(0 => 58, 1 => 60);

        $iterated = false;
        foreach ($collection as $_key => $_item) {
            $this->assertEquals($expected[$_key], $_item->getProductId());
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }
}