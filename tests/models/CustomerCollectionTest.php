<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/7/13
 */
namespace Test\Model;
use \App\Model\Customer;
use \App\Model\CustomerCollection;

class CustomerCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testTakesDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasya', 'password' => '12345']
                ]
            ));

        $collection = new CustomerCollection($resource, new Customer());

        $customers = $collection->getCustomers();
        $this->assertEquals('Vasya', $customers[0]->getName());
    }

    public function testIsIterableWithForeachFunction()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasya', 'password' => '12345'],
                    ['name' => 'Li', 'password' => '54321']
                ]
            ));

        $collection = new CustomerCollection($resource, new Customer());
        $expected = array(0 => 'Vasya', 1 => 'Li');
        $iterated = false;
        foreach ($collection as $_key => $_customer) {
            $this->assertEquals($expected[$_key], $_customer->getName());
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }
}
