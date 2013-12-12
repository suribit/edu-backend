<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */

namespace App\Controller;

use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Resource\Session;

use App\Model\Quote;
use App\Model\QuoteItem;
use App\Model\Product;
use App\Model\QuoteItemCollection;
use App\Model\Resource\Table\Cart as CartTable;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\CustomerHelper;

class CartController {

    public function listAction()
    {
        $session = new Session();
        $customerResource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customerHelper = new CustomerHelper($customerResource, $session);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        $quote = $this->_initQuote($customerHelper, $session);

        $cartCollectionResource = new DBCollection($GLOBALS['PDO'], new CartTable);
        $productResource = new DBEntity($GLOBALS['PDO'], new ProductTable);
        $quoteItems = new QuoteItemCollection($cartCollectionResource, $productResource);
        $quoteItems->filterByQuote($quote);

        $view = 'cart_list';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function removeAction()
    {
        $session = new Session();
        $customerResource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customerHelper = new CustomerHelper($customerResource, $session);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        $quoteResource = new DBEntity($GLOBALS['PDO'], new CartTable);

        $quoteItem = $this->_initQuoteItem($customerHelper, $session);
        $quoteItem->delete($quoteResource);

        header('Location: /?page=cart_list');
    }

    public function addAction()
    {
        $session = new Session();
        $customerResource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customerHelper = new CustomerHelper($customerResource, $session);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        $quoteResource = new DBEntity($GLOBALS['PDO'], new CartTable);

        $quoteItem = $this->_initQuoteItem($customerHelper, $session);

        $quoteItem->addQty(empty($_POST['qty']) ? -1 : $_POST['qty']);

        $quoteItem->save($quoteResource);

        header('Location: /?page=cart_list');
    }

    public function updateAction()
    {
        $session = new Session();
        $customerResource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customerHelper = new CustomerHelper($customerResource, $session);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        $quoteResource = new DBEntity($GLOBALS['PDO'], new CartTable);

        $quoteItem = $this->_initQuoteItem($customerHelper, $session);
        $quoteItem->updateQty($_POST['qty']);
        $quoteItem->save($quoteResource);

        header('Location: /?page=cart_list');
    }

    private function _initQuoteItem($customer, $session)
    {
        $quote = $this->_initQuote($customer, $session);

        $product = new Product([]);
        $productResource = new DBEntity($GLOBALS['PDO'], new ProductTable);
        $product->load($productResource, $_POST['product_id']);

        $quoteResource = new DBEntity($GLOBALS['PDO'], new CartTable);
        $quoteItem = $quote->getItemForProduct($product, $quoteResource);
        return $quoteItem;
    }

    private function _initQuote($customerHelper, $session)
    {
        $quote = new Quote();
        if ($customerHelper->isLoggedIn()) {
            $quote->loadByCustomer($customerHelper->getCustomer());
            return $quote;
        } else {
            $quote->loadBySession($session);
            return $quote;
        }
    }
} 