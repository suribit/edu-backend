<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */

namespace App\Controller;

class CartController
    extends SalesController
{
    public function addProductAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->addQty(1);
        $quoteItem->save();

        $this->_redirect('cart_list');
    }

    public function listAction()
    {
        $quote = $this->_initQuote();
        $items = $quote->getItems();
        $items->assignProducts($this->_di->get('Product'));

        return $this->_di->get('View', [
            'template' => 'cart_list',
            'params'   => ['items' => $items]
        ]);
    }

    public function updateAction()
    {
        if (isset($_POST['product_id']) && isset($_POST['qty']))
        {
            $quoteItem = $this->_initQuoteItem();
            $quoteItem->updateQty($_POST['qty']);
        }
        $this->_redirect('cart_list');
    }

    public function removeAction()
    {
        if (isset($_POST['product_id']))
        {
            $quoteItem = $this->_initQuoteItem();
            $quoteItem->remove();
        }
        $this->_redirect('cart_list');
    }

    private function _initQuoteItem()
    {
        $quote = $this->_initQuote();

        $product = $this->_di->get('Product');
        $product->load($_POST['product_id']);

        $item = $quote->getItems()->forProduct($product);
        return $item;
    }

}