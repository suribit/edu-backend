<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace Test\Model;
use \App\Model;
use \App\Model\Region;

class RegionTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsNameRegion()
    {
        $region = new Region(['name' => 'Taganrog']);
        $this->assertEquals('Taganrog', $region->getName());

        $region = new Region(['name' => 'Rostov-on-Don']);
        $this->assertEquals('Rostov-on-Don', $region->getName());
    }

    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Taganrog']));

        $region = new Region([], $resource);
        $region->load(42);

        $this->assertEquals('Taganrog', $region->getName());
    }

    public function testSavesRegion()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Taganrog']))
            ->will($this->returnValue(5));

        $item = new Region(['name' => 'Taganrog'], $resource);
        $this->assertEquals(5, $item->save());
    }
}