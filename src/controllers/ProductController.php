<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Controller;


use App\Model\Resource\DBEntity;
use App\Model\Product;
use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\CustomerHelper;


class ProductController
{

    private $_di;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;
    }

    public function listAction()
    {
        $resourceCollection = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Product()]);

        $paginator = $this->_di->get('Paginator', ['collection' => $resourceCollection]);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $products = $this->_di->get('ProductCollection', ['resource' => $resourceCollection]);
        $resourceCustomer = $this->_di->get('ResourceEntity', ['table' => new \App\Model\Resource\Table\Customer()]);
        $customerHelper = $this->_di->get('CustomerHelper', ['resource' => $resourceCustomer]);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        return $this->_di->get('View', [
            'template' => 'product_list',
            'params'   => ['products' => $products, 'pages' => $pages],
            'customer' => $customer
        ]);
    }

    public function viewAction()
    {
        $product = $this->_di->get('Product', ['data' => [], 'table' => new \App\Model\Resource\Table\Product()]);

        $product->load($_GET['id']);

//        $resourceReview = $this->_di->get('ProductReviewCollection', ['table' => new \App\Model\Resource\Table\ProductReviewCollection()]);
//
//
//        $paginator = $this->_di->get('Paginator', ['collection' => $resourceReview]);
//        $paginator
//            ->setItemCountPerPage(1)
//            ->setCurrentPageNumber(isset($_GET['c']) ? $_GET['c'] : 1);
//        $pagesComment = $paginator->getPages();
//
//        $resourceReview->filterBy('product_id', $product->getId());
//        $reviews = $this->_di->get('ProductReview');

        $resourceCustomer = $this->_di->get('ResourceEntity', ['table' => new \App\Model\Resource\Table\Customer()]);
        $customerHelper = $this->_di->get('CustomerHelper', ['resource' => $resourceCustomer]);
        $customerHelper->isLoggedIn();
        $customer = $customerHelper->getCustomer();

        $view = 'product_view';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }
}