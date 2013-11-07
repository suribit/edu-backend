<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */

require_once __DIR__ . '/ElementCollection.php';

class Review extends ElementCollection {

    public function getName() {
        return $this->getValue('name');
    }

    public function getEmail() {
        return $this->getValue('email');
    }

    public function getText() {
        return $this->getValue('text');
    }

    public function getRating() {
        return $this->getValue('rating');
    }

    public function getProduct() {
        return $this->getValue('product');
    }

    public function belongsToProduct($product) {
        return $this->getProduct() == $product;
    }
}
