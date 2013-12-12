<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Controller;


use App\Model\ProductReviewCollection;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\ProductCollection;
use App\Model\Product;
use App\Model\Resource\Paginator as PaginatorAdapter;
use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Resource\Table\Review as ReviewTable;
use Zend\Paginator\Paginator as ZendPaginator;
use App\Model\Customer;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\Resource\Session;
use App\Model\CustomerHelper;


class ProductController
{
    public function listAction()
    {
        $resource = new DBCollection($GLOBALS['PDO'], new ProductTable);
//        $products = new ProductCollection($resource);

        $paginatorAdapter = new PaginatorAdapter($resource);
        $paginator = new ZendPaginator($paginatorAdapter);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
         $pages = $paginator->getPages();
         $products = new ProductCollection($resource);

        $resource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customer_helper = new CustomerHelper($resource, (new Session()));

        $customer_helper->isLoggedIn();
        $customer = $customer_helper->getCustomer();
        $view = 'product_list';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function viewAction()
    {
        $product = new Product([]);

        $resource = new DBEntity($GLOBALS['PDO'], new ProductTable);
        $product->load($resource, $_GET['id']);

        $resourceReview = new DBCollection($GLOBALS['PDO'], new ReviewTable);

        $paginatorAdapter = new PaginatorAdapter($resourceReview);
        $paginator = new ZendPaginator($paginatorAdapter);
        $paginator
            ->setItemCountPerPage(1)
            ->setCurrentPageNumber(isset($_GET['c']) ? $_GET['c'] : 1);
        $pagesComment = $paginator->getPages();
        $resourceReview->filterBy('product_id', $product->getId());
        $reviews = new ProductReviewCollection($resourceReview);

        $resource = new DBEntity($GLOBALS['PDO'], new CustomerTable);
        $customer_helper = new CustomerHelper($resource, (new Session()));

        $customer_helper->isLoggedIn();
        $customer = $customer_helper->getCustomer();
        $view = 'product_view';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }
}