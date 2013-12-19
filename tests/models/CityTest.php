<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace Test\Model;
use \App\Model;
use \App\Model\City;

class CityTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsNameCity()
    {
        $city = new City(['name' => 'Taganrog']);
        $this->assertEquals('Taganrog', $city->getName());

        $city = new City(['name' => 'Rostov-on-Don']);
        $this->assertEquals('Rostov-on-Don', $city->getName());
    }

    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Taganrog']));

        $city = new City([], $resource);
        $city->load(42);

        $this->assertEquals('Taganrog', $city->getName());
    }

    public function testSavesCity()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Taganrog']))
            ->will($this->returnValue(5));

        $item = new City(['name' => 'Taganrog'], $resource);
        $this->assertEquals(5, $item->save());
    }
}