<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Payment;


use App\Model\Address;

interface IMethod
{

    public function getCode();

    public function isAvailable(Address $address);

    public function getLabel();
}
