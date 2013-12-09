<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */


namespace App\Model;

use App\Model\Resource\IResourceCollection;
use App\Model\Resource\IResourceEntity;
use App\Model\Resource\IResourceSession;
use App\Model\CustomerHelper;

class CartHelper {

    private $_cartElementResource;
    private $_cartElementCollectionResource;
    private $_productResource;
    private $_customerHelper;
    private $_session;

    private $_customerId = null;
    private $_sessionId = null;

    public function __construct(IResourceEntity $cartElementResource, IResourceCollection $cartElementCollectionResource,
                                IResourceEntity $productResource, \App\Model\CustomerHelper $customerHelper, IResourceSession $session)
    {
        $this->_cartElementResource = $cartElementResource;
        $this->_cartElementCollectionResource = $cartElementCollectionResource;

        $this->_productResource = $productResource;
        $this->_customerHelper = $customerHelper;
        $this->_session = $session;


        $customer = $customerHelper->checkCustomer();
        if ($customer != null)
            $this->_customerId = $customer->getId();
        else
            $this->_sessionId = $this->_session->getId();


    }

    public function addProductToCart($idProduct)
    {
        if (isset($this->_customerId))
            $this->_cartElementCollectionResource->filterBy('customer_id', $this->_customerId);
        else
            $this->_cartElementCollectionResource->filterBy('session_id', $this->_sessionId);
        $this->_cartElementCollectionResource->filterBy('product_id', $idProduct);

        $cartElementCollection = new CartElementCollection($this->_cartElementCollectionResource, $this->_productResource);
        $cartElements = $cartElementCollection->getCartElement();

        if (count($cartElements))
        {
            $cartElements[0]->addCount(1);
            $cartElements[0]->save($this->_cartElementResource);
        }
        else
        {
            $e = new CartElement(['customer_id' => $this->_customerId, 'session_id' => $this->_session->getId(), 'product_id' => $idProduct, 'count' => 1]);
            $e->save($this->_cartElementResource);
        }
    }

    public function remove($cartElementId)
    {
        if (isset($this->_customerId))
            $this->_cartElementCollectionResource->filterBy('customer_id', $this->_customerId);
        else
            $this->_cartElementCollectionResource->filterBy('session_id', $this->_sessionId);
        $this->_cartElementCollectionResource->filterBy('cart_id', $cartElementId);

        $cartElementCollection = new CartElementCollection($this->_cartElementCollectionResource, $this->_productResource);
        $cartElements = $cartElementCollection->getCartElement();


        $cartElements[0]->remove($this->_cartElementResource);
    }

    public function addCount($cartElementId, $count = 1)
    {
        if (isset($this->_customerId))
            $this->_cartElementCollectionResource->filterBy('customer_id', $this->_customerId);
        else
            $this->_cartElementCollectionResource->filterBy('session_id', $this->_sessionId);
        $this->_cartElementCollectionResource->filterBy('cart_id', $cartElementId);

        $cartElementCollection = new CartElementCollection($this->_cartElementCollectionResource, $this->_productResource);
        $cartElements = $cartElementCollection->getCartElement();

        $cartElements[0]->addCount($count);
        $cartElements[0]->save($this->_cartElementResource);
    }

    public function minusCount($cartElementId, $count = 1)
    {
        if (isset($this->_customerId))
            $this->_cartElementCollectionResource->filterBy('customer_id', $this->_customerId);
        else
            $this->_cartElementCollectionResource->filterBy('session_id', $this->_sessionId);
        $this->_cartElementCollectionResource->filterBy('cart_id', $cartElementId);

        $cartElementCollection = new CartElementCollection($this->_cartElementCollectionResource, $this->_productResource);
        $cartElements = $cartElementCollection->getCartElement();

        $cartElements[0]->minusCount($count);
        $cartElements[0]->save($this->_cartElementResource);
    }

    public function getList()
    {

        if (isset($this->_customerId))
            $this->_cartElementCollectionResource->filterBy('customer_id', $this->_customerId);
        else
            $this->_cartElementCollectionResource->filterBy('session_id', $this->_sessionId);


        $cartElementCollection = new CartElementCollection($this->_cartElementCollectionResource, $this->_productResource);
        return $cartElementCollection->getCartElement();
    }
} 