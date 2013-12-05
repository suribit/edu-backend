<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\ProductCollection;
use App\Model\Product;
use App\Model\Resource\Table\Product as ProductTable;

class ProductController
{
    public function listAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBCollection($connection, new ProductTable);
        $products = new ProductCollection($resource);

        $view = 'product_list';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function viewAction()
    {
        $product = new Product([]);

        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBEntity($connection, new ProductTable);
        $product->load($resource, $_GET['id']);

        $view = 'product_view';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }
}