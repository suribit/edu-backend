<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */


namespace App\Model;

use App\Model\Resource\IResourceEntity;


class QuoteItem extends Entity
{
    private $_product;

    public function addQty($qty)
    {
        if ($qty > 0)
        {
            $this->_data['qty'] = $qty;
        }
        else
        {
            $this->_data = null;
        }

    }

    public function updateQty($qty)
    {
        $this->_data['qty'] += $qty;
        if ($this->_data['qty'] < 0)
        {
            $this->_data = null;
        }
    }

    public function delete()
    {
        $this->_resource->delete($this->getId());
    }

    public function save()
    {
        if ($this->_data != null)
        {
            $this->_data['cart_id'] = $this->_resource->save($this->_data);
            return $this->_data['cart_id'];
        }
        else
        {
            return -1;
        }

    }

    public function check()
    {
        return $this->_resource->check($this->_data);
    }

    public function getProduct()
    {
        return $this->_product;
    }

    public function getProductId()
    {
        return (int) $this->_getData('product_id');

    }

    public function getCustomerId()
    {
        return (int) $this->_getData('customer_id');
    }

    public function getSessionId()
    {
        return $this->_getData('session_id');
    }

    public function getQty()
    {
        return (int) $this->_data['qty'];
    }

    public function getId()
    {
        return (int) $this->_getData('cart_id');
    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }

    public function assignProduct(Product $product)
    {
        $this->_product = $product;
    }
} 