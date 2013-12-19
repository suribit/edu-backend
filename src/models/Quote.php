<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */


namespace App\Model;

use App\Model\Customer;
use App\Model\QuoteItem;
use App\Model\Resource\IResourceSession;
use App\Model\Resource\IResourceEntity;

class Quote
{
    private $_customerId = null;
    private $_sessionId = null;

    public function loadByCustomer(Customer $customer)
    {
        $this->_customerId = $customer->getId();
    }

    public function loadBySession(IResourceSession $session)
    {
        $this->_sessionId = $session->getId();
    }

    public function getCustomerId()
    {
        return $this->_customerId;
    }

    public function getSessionId()
    {
        return $this->_sessionId;
    }

    public function getItemForProduct(Product $product, IResourceEntity $resource)
    {

        if ($this->_customerId != null)
        {
            $item = new QuoteItem(['customer_id' => $this->_customerId, 'product_id' => $product->getId()], $resource);
        }
        else
        {
            $item = new QuoteItem(['session_id' => $this->_sessionId, 'product_id' => $product->getId()], $resource);
        }
        if (($cart_id = $item->check()) != null)
        {
            $item->load($cart_id);
        }
        return $item;
    }
} 