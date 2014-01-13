<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Quote;

use App\Model\Order;
use App\Model\Quote;

interface IConverter
{

    public function toOrder(Quote $quote, Order $order);
}
