<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/12/13
 */
namespace App\Model;

class QuoteItem
    extends Entity
{
    private $_product;

    public function getProductId()
    {
        return $this->_data['product_id'];
    }

    public function belongsToProduct(Product $product)
    {
        return $this->getProductId() == $product->getId();
    }

    public function assignToProduct(Product $product)
    {
        $this->_data['product_id'] = $product->getId();
        $this->_product = $product;
    }

    public function getProduct()
    {
        return $this->_product;
    }

    public function getQty()
    {
        return $this->_data['qty'];
    }

    public function remove()
    {
        $this->_resource->delete($this->getId());
    }

    public function updateQty($alterQty)
    {
        if ($this->_data['qty'] + $alterQty > 0)
        {
            $this->_data['qty'] += $alterQty;
            $this->save();
        }
        else if ($this->_data['qty'] + $alterQty == 0)
            $this->remove();
    }

    public function addQty($qty)
    {
        $this->_data['qty'] = $this->_getData('qty') + $qty;
    }

    public function assignToQuote($quote)
    {
        $this->_data['quote_id'] = $quote->getId();
    }
}