<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;

class Customer extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function save()
    {
        $this->_data['password'] = md5($this->_data['password']);
        $id = $this->_resource->save($this->_data);
        $this->_data['customer_id'] = ($id != false) ? $id : null;
    }

    public function check()
    {
        $this->_data['password'] = md5($this->_data['password']);
        $this->_data['customer_id'] = $this->_resource->check($this->_data);
        $this->_data['customer_id'] = isset($this->_data['customer_id']) ? $this->_data['customer_id'] : null;

        return (bool) $this->_data['customer_id'];
    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }

    public function getId()
    {
        return $this->_getData('customer_id');
    }
}
