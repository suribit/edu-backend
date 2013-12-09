<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */


namespace App\Model;

use App\Model\Resource\IResourceEntity;
use App\Model;

class CartElement extends Entity {

    public function addCount($count)
    {
        $this->_data['count'] += $count;
    }

    public function minusCount($count)
    {
        $this->_data['count'] -= ($count < $this->_data['count']) ? $count : 0;
    }

    public function getCount()
    {
        return $this->_data['count'];
    }

    public function setProduct(Product $product)
    {
        $this->_data['product'] = $product;
    }

    public function getProduct()
    {
        return $this->_data['product'];
    }
    
    public function getProductId()
    {
        return $this->_getData('product_id');
    }

    public function getCustomerId()
    {
        return $this->_getData('customer_id');
    }

    public function getSessionId()
    {
        return $this->_getData('session_id');
    }

    public function getId()
    {
        return $this->_getData('cart_id');
    }

    public function save(IResourceEntity $resource)
    {
        $dataTemp = $this->_data;
        unset($dataTemp['product']);
        $id = $resource->save($dataTemp);
        $this->_data['cart_id'] = ($id != false) ? $id : null;
    }

    public function remove(IResourceEntity $resource)
    {
        $resource->remove($this->getId());
    }

    public function load(IResourceEntity $resource, $id)
    {
        $this->_data = $resource->find($id);
    }
} 