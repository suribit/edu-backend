<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Quote;

use App\Model\Order;
use App\Model\Quote;

class Converter
{
    private $_converterFactory;

    public function __construct(\App\Model\Quote\ConverterFactory $converterFactory)
    {
        $this->_converterFactory = $converterFactory;
    }

    public function toOrder(Quote $quote, Order $order)
    {
        foreach ($this->_converterFactory->getConverters() as $converter) {
            $converter->toOrder($quote, $order);
        }
    }
}