<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;

class Customer extends Entity
{
    public function __construct(array $data = [], Resource\IResourceEntity $resource = null)
    {
        if (isset($data['password']))
            $data['password'] = md5($data['password']);

        parent::__construct($data, $resource);
    }

    public function setData($data)
    {
        if ($data['password'] != null)
            $data['password'] = md5($data['password']);

        parent::setData($data);
    }
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getPassword()
    {
        return $this->_getData('password');
    }

    public function getEmail()
    {
        return $this->_getData('email');
    }

    public function setQuoteId($id)
    {
        $this->_data['quote_id'] = $id;
    }

    public function getQuoteId()
    {
        return $this->_getData('quote_id');
    }

    public function remove()
    {
        $this->_resource->delete($this->getId());
    }

}
