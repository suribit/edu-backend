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

    public function save()
    {
        if ($this->getPassword() != null)
            $this->_data['password'] = md5($this->_data['password']);

        parent::save();
    }

}
