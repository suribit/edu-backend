<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Quote;

use App\Model\Quote;

interface ICollector
{

    public function collect(Quote $quote);

}
