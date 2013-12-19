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
    extends ActionController
{

    public function listAction()
    {
        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Product()]);
        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $products = $this->_di->get('ProductCollection', ['resource' => $resource]);

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

        $reviews = $this->_di->get('ProductReviewCollection');
        $reviews->filterByProduct($product);

        return $this->_di->get('View', [
            'template' => 'product_view',
            'params'   => ['product' => $product, 'reviews' => $reviews]
        ]);
    }
}