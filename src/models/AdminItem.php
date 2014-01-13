<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:12 PM
 */

namespace App\Model;

class AdminItem extends Entity
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

}