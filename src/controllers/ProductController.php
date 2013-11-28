<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
require_once __DIR__ . '/../models/ProductCollection.php';
require_once __DIR__ . '/../models/Resource/DBCollection.php';
require_once __DIR__ . '/../models/Resource/DBEntity.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function listAction()
    {

        $connection = new PDO('mysql:host=localhost;dbname=student', 'root', '0000');
        $resource = new DBCollection($connection, 'products');
        $products = new ProductCollection($resource);

        require_once __DIR__ . '/../views/header.phtml';
        require_once __DIR__ . '/../views/product_list.phtml';
        require_once __DIR__ . '/../views/footer.phtml';

    }

    public function viewAction()
    {
        $product = new Product([]);

        $connection = new PDO('mysql:host=localhost;dbname=student', 'root', '0000');
        $resource = new DBEntity($connection, 'products', 'product_id');
        $product->load($resource, $_GET['id']);

        require_once __DIR__ . '/../views/header.phtml';
        require_once __DIR__ . '/../views/product_view.phtml';
        require_once __DIR__ . '/../views/footer.phtml';

    }
}