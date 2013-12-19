<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */


namespace App\Model;


class City
    extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getId()
    {
        return $this->_getData('city_id');
    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }

    public function save()
    {
        if ($this->_data != null)
        {
            $this->_data['city_id'] = $this->_resource->save($this->_data);
            return $this->_data['city_id'];
        }
        else
        {
            return -1;
        }
    }
} 