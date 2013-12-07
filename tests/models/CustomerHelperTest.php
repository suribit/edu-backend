<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/8/13
 */
namespace Test\Model;
use \App\Model\Customer;
use \App\Model\Resource\Session;
use App\Model\CustomerHelper;

class CustomerHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testSavesNewCustomers()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]))
            ->will($this->returnValue(42));

        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Vasia', 'password' => md5('1234555')]));

        $session = $this->getMock('\App\Model\Resource\IResourceSession');
        $session->expects($this->any())
            ->method('setData')
            ->with($this->equalTo('idCustomer', 42));

        $session->expects($this->any())
            ->method('getData')
            ->with($this->equalTo('idCustomer'))
            ->will(($this->returnValue(42)));

        $customer_helper = new CustomerHelper($resource, $session);
        $this->assertEquals('Vasia', $customer_helper->registerCustomer(['name' => 'Vasia', 'password' => '1234555'])->getName());
    }

    public function testLoginCustomers()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]))
            ->will($this->returnValue(42));

        $resource->expects($this->any())
            ->method('check')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]))
            ->will($this->returnValue(42));

        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Vasia', 'password' => md5('1234555')]));

        $session = $this->getMock('\App\Model\Resource\IResourceSession');
        $session->expects($this->any())
            ->method('setData')
            ->with($this->equalTo('idCustomer', 42));

        $session->expects($this->any())
            ->method('getData')
            ->with($this->equalTo('idCustomer'))
            ->will(($this->returnValue(42)));

        $customer_helper = new CustomerHelper($resource, $session);
        $this->assertEquals('Vasia', $customer_helper->loginCustomer(['name' => 'Vasia', 'password' => '1234555'])->getName());
    }

}