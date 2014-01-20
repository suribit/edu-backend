<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Controller;



class ProductController
    extends ActionController
{

    public function listAction()
    {
        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Product()]);
        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(3)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $product = $this->_di->get('Product');
        $products = $this->_di->get('ProductCollection', ['resource' => $resource, 'productPrototype' => $product]);

        return $this->_di->get('View', [
            'template' => 'product_list',
            'params'   => ['products' => $products, 'pages' => $pages]
        ]);

    }

    public function viewAction()
    {
        $this->_di->get('Session')->generateToken();

        $product = $this->_di->get('Product');
        $product->load($_GET['id']);

        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\ProductReview()]);


        $productReview = $this->_di->get('ProductReview');
        $reviews = $this->_di->get('ProductReviewCollection', ['resource' => $resource, 'productReviewPrototype' => $productReview]);
        $reviews->filterByProduct($product);

        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(3)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();


        return $this->_di->get('View', [
            'template' => 'product_view',
            'params'   => ['product' => $product, 'reviews' => $reviews, 'pages' => $pages]
        ]);
    }
}