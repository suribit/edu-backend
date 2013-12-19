<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/7/13
 */
namespace Test\Model;
use \App\Model\Customer;

class CustomerTest extends \PHPUnit_Framework_TestCase
{

    public function testUserVerification()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('check')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('123456789')]))
            ->will($this->returnValue(11));

        $customer = new Customer(['name' => 'Vasia', 'password' => '123456789'], $resource);
        $customer->check();
        $this->assertEquals(11, $customer->getId());
    }

    public function testUserVerificationReturnBool()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('check')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('123456789')]))
            ->will($this->returnValue(11));

        $customer = new Customer(['name' => 'Vasia', 'password' => '123456789'], $resource);
        $this->assertEquals(true, $customer->check());
        $this->assertEquals(11, $customer->getId());
    }
    
    public function testSavesDataInResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234555')]));

        $customer = new Customer(['name' => 'Vasia', 'password' => '1234555'], $resource);
        $customer->save();
    }

    public function testGetsIdFromResourceAfterSave()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Vasia', 'password' => md5('1234')]))
            ->will($this->returnValue(42));

        $customer = new Customer(['name' => 'Vasia', 'password' => '1234'], $resource);
        $customer->save();
        $this->assertEquals(42, $customer->getId());
    }

    public function testReturnsIdWhichHasBeenInitialized()
    {
        $customer = new Customer(['customer_id' => 1]);
        $this->assertEquals(1, $customer->getId());

        $customer = new Customer(['customer_id' => 2]);
        $this->assertEquals(2, $customer->getId());
    }
}