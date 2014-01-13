<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */

namespace App\Model;

class Address
    extends Entity
{
    private $_city;
    private $_region;

    public function getPostcode()
    {
        return $this->_getData('postcode');
    }

    public function getStreet()
    {
        return $this->_getData('street');
    }

    public function getHouse()
    {
        return $this->_getData('house');
    }

    public function getRoom()
    {
        return $this->_getData('room');
    }

    public function getIdCity()
    {
        return $this->_getData('city_id');
    }

    public function getIdRegion()
    {
        return $this->_getData('region_id');
    }

    public function getId()
    {
        return $this->_getData('address_id');
    }

    public function assignCity(City $city)
    {
        $this->_city = $city;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function assignRegion(Region $region)
    {
        $this->_region = $region;
    }

    public function getRegion()
    {
        return $this->_region;
    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }

    public function save()
    {
        $this->_data['city_id'] = $this->_city->save();
        $this->_data['region_id'] = $this->_region->save();

        return $this->_resource->save($this->_data);
    }
}