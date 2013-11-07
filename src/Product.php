<?php

require_once __DIR__ . '/ElementCollection.php';

class Product extends ElementCollection
{

    public function getSku()
    {
        return $this->getValue('sku');
    }

    public function getName()
    {
        return $this->getValue('name');
    }

    public function getImage()
    {
        return $this->getValue('image');
    }

    public function getPrice()
    {
        return $this->getValue('price');
    }

    public function getSpecialPrice()
    {
        return $this->getValue('special_price');
    }

    public function isSpecialPriceApplied()
    {
        return (bool) $this->getSpecialPrice();
    }

}
