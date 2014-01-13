<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace App\Model\Shipping;

class Factory
{
    private $_address;

    public function __construct(\App\Model\Address $address)
    {
        $this->_address = $address;
    }

    public function getMethods()
    {
        return [
            new Fixed($this->_address),
            new TableRate($this->_address)
        ];
    }
}