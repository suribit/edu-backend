<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace Test\Model;

use App\Model\Address;
use App\Model\City;
use App\Model\Region;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsDataAddress()
    {
        $address = new Address(['house' => 'foo', 'room' => 'bar', 'postcode' => '121341bsedf',
            'street' => '1214141', 'city_id' => 5, 'region_id' => 61, 'address_id' => 1]);

        $this->assertEquals('foo', $address->getHouse());
        $this->assertEquals('bar', $address->getRoom());
        $this->assertEquals('121341bsedf', $address->getPostcode());
        $this->assertEquals('1214141', $address->getStreet());
        $this->assertEquals(5, $address->getIdCity());
        $this->assertEquals(61, $address->getIdRegion());
        $this->assertEquals(1, $address->getId());
    }

    public function testReturnsCity()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Taganrog']));

        $address = new Address(['city_id' => 42]);
        $city = new City([], $resource);
        $city->load($address->getIdCity());
        $address->assignCity($city);
        $this->assertSame($city, $address->getCity());
    }

    public function testReturnsRegion()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Taganrog']));

        $address = new Address(['region_id' => 42]);
        $region = new Region([], $resource);
        $region->load($address->getIdRegion());
        $address->assignRegion($region);
        $this->assertSame($region, $address->getRegion());
    }

    public function testSavesAddress()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['city_id' => 5, 'region_id' => 61]))
            ->will($this->returnValue(42));

        $resourceCity = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resourceCity->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Taganrog']))
            ->will($this->returnValue(5));
        $city = new City(['name' => 'Taganrog'], $resourceCity);

        $resourceRegion = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resourceRegion->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'BlaBla']))
            ->will($this->returnValue(61));
        $region = new Region(['name' => 'BlaBla'], $resourceRegion);

        $address = new Address([], $resource);
        $address->assignCity($city);
        $address->assignRegion($region);

        $this->assertEquals(42, $address->save());
    }
}