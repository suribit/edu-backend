<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Model;

class ProductReview extends Entity
{
    private $_product;

    public function getName()
    {
        return $this->_getData('name');
    }

    public function getEmail()
    {
        return $this->_getData('email');
    }

    public function getText()
    {
        return $this->_getData('text_review');
    }

    public function getRating()
    {
        return $this->_getData('rating');
    }

    public function belongsToProduct(Product $product)
    {
        return $product->getId() == $this->_getData('product_id');
    }

    public function assignToProduct(Product $product)
    {
        $this->_data['product_id'] = $product->getId();
        $this->_product = $product;
    }
}