<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */

namespace App\Model\Shipping;

interface IMethod
{

    public function getPrice();

    public function getCode();

    public function getLabel();
}