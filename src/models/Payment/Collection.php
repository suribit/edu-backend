<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Payment;

use Traversable;

class Collection implements \IteratorAggregate
{

    private $_methods;

    public function addPayment(IMethod $payment)
    {
        $this->_methods[] = $payment;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->_methods);
    }
}