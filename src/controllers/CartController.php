<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */


namespace App\Controller;

use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Resource\Session;

use App\Model\CartHelper;
use App\Model\Resource\Table\Cart as CartTable;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\CustomerHelper;


class CartController {

    public function listAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $cartCollectionResource = new DBCollection($connection, new CartTable);


        $cartElementResource = new DBEntity($connection, new CartTable);
        $productResource = new DBEntity($connection, new ProductTable);
        $session = new Session();
        $customerResource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($customerResource, $session);

        $cart = new CartHelper($cartElementResource, $cartCollectionResource, $productResource, $customer_helper, $session);


        $elements = $cart->getList();
        $customer = $customer_helper->checkCustomer();

        $view = 'cart_list';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function removeAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $cartCollectionResource = new DBCollection($connection, new CartTable);

        $cartElementResource = new DBEntity($connection, new CartTable);
        $productResource = new DBEntity($connection, new ProductTable);
        $session = new Session();
        $customerResource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($customerResource, $session);
        $cart = new CartHelper($cartElementResource, $cartCollectionResource, $productResource, $customer_helper, $session);

        $cart->remove($_GET['cart_element_id']);
        header('Location: /?page=cart_list');
    }

    public function addAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $cartCollectionResource = new DBCollection($connection, new CartTable);

        $cartElementResource = new DBEntity($connection, new CartTable);
        $productResource = new DBEntity($connection, new ProductTable);
        $session = new Session();
        $customerResource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($customerResource, $session);
        $cart = new CartHelper($cartElementResource, $cartCollectionResource, $productResource, $customer_helper, $session);

        $cart->addProductToCart($_GET['product_id']);
        header('Location: /?page=cart_list');
    }

    public function addCountAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $cartCollectionResource = new DBCollection($connection, new CartTable);

        $cartElementResource = new DBEntity($connection, new CartTable);
        $productResource = new DBEntity($connection, new ProductTable);
        $session = new Session();
        $customerResource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($customerResource, $session);
        $cart = new CartHelper($cartElementResource, $cartCollectionResource, $productResource, $customer_helper, $session);

        $cart->addCount($_GET['cart_element_id']);
        header('Location: /?page=cart_list');
    }

    public function minusCountAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $cartCollectionResource = new DBCollection($connection, new CartTable);

        $cartElementResource = new DBEntity($connection, new CartTable);
        $productResource = new DBEntity($connection, new ProductTable);
        $session = new Session();
        $customerResource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($customerResource, $session);
        $cart = new CartHelper($cartElementResource, $cartCollectionResource, $productResource, $customer_helper, $session);

        $cart->minusCount($_GET['cart_element_id']);
        header('Location: /?page=cart_list');
    }
} 