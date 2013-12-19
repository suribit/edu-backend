<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace Test\Model;
use \App\Model\RegionCollection;

class RegionCollectionTest
    extends \PHPUnit_Framework_TestCase
{
    public function testTakesDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Taganrog']
                ]
            ));


        $collection = new RegionCollection($resource);

        $region = $collection->getRegions();
        $this->assertEquals('Taganrog', $region[0]->getName());
    }

    public function testIsIterableWithForeachFunction()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Taganrog'],
                    ['name' => 'Rostov-on-Don']
                ]
            ));

        $collection = new RegionCollection($resource);
        $expected = array(0 => 'Taganrog', 1 => 'Rostov-on-Don');
        $iterated = false;
        foreach ($collection as $_key => $_region) {
            $this->assertEquals($expected[$_key], $_region->getName());
            $iterated = true;
        }

        if (!$iterated)
        {
            $this->fail('Iteration did not happen');
        }
    }
}