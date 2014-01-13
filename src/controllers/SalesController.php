<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace App\Controller;

class SalesController
    extends ActionController
{

    protected function _initQuote()
    {
        $quote   = $this->_di->get('Quote');
        $session = $this->_di->get('Session');

        if ($session->isLoggedIn())
            $quote->loadByCustomer($session->getCustomer());

        $quote->loadBySession($session);

        return $quote;
    }
}
