<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 10/30/13
 * Time: 10:02 PM
 */

require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/ProductCollection.php';

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar'])]);
if(assert($products->getProducts() == [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'new data']), new Product(['sku' => 'new datas'])]);
if(assert($products->getProducts() == [new Product(['sku' => 'new data']), new Product(['sku' => 'new datas'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product([]), new Product([])]);
if(assert($products->getSize() == 2, 'Returns size collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product([])]);
if(assert($products->getSize() == 1, 'Returns size collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->limit(1);
if(assert($products->getSize() == 1, 'Returns size collection which has been initialized')) {
    echo '.';
}
if(assert($products->getProducts() == [new Product(['sku' => 'fuu'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->limit(2);
if(assert($products->getSize() == 2, 'Returns size collection which has been initialized')) {
    echo '.';
}
if(assert($products->getProducts() == [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(0);
if(assert($products->getProducts() == [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(1);
if(assert($products->getProducts() == [new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(2);
if(assert($products->getProducts() == [new Product(['sku' => 'baz'])], 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(1);
if(assert($products->getSize(1) == 2, 'Returns collection which has been initialized')) {
    echo '.';
}

$products = new ProductCollection([new Product(['sku' => 'fuu'])]);
$products->offset(1);
if(assert($products->getSize(1) == 2, 'Returns collection which has been initialized')) {
    echo '.';
}


echo "\n";


