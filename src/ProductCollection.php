<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 10/30/13
 * Time: 10:02 PM
 */

require_once __DIR__ . '/Collection.php';

class ProductCollection extends Collection
{
   public function getProducts() {
        return $this->getData();
    }
}
