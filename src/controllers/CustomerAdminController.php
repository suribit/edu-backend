<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/14/14
 * Time: 1:04 AM
 */

namespace App\Controller;


class CustomerAdminController
    extends ActionController
{
    public function listAction()
    {
        $this->_isLoggedIn();

        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Customer()]);
        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(3)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $customer = $this->_di->get('Customer');
        $customers = $this->_di->get('CustomerCollection', ['resource' => $resource, 'customerPrototype' => $customer]);

        return $this->_di->get('View', [
            'layout' => 'admin',
            'template' => 'customerAdmin_list',
            'params'   => ['customers' => $customers, 'pages' => $pages]
        ]);

    }

    public function editAction()
    {
        $this->_isLoggedIn();

        if (isset($_POST['edit']))
        {

        }
        else
        {
            if (isset($_GET['customer_id']))
            {
                $customer = $this->_di->get('Customer');
                $customer->load($_GET['customer_id']);

                return $this->_di->get('View', [
                    'layout' => 'admin',
                    'template' => 'customerAdmin_list',
                    'params'   => ['customer' => $customer]
                ]);
            }
            else
            {
                $this->_redirect('customerAdmin_list');
            }
        }
    }

    public function removeAction()
    {
        $this->_isLoggedIn();

        if (isset($_GET['customer_id']))
        {
            $customer = $this->_di->get('Customer');
            $customer->load($_GET['customer_id']);
            $customer->remove($_GET['customer_id']);
        }

        $this->_redirect('customerAdmin_list');
    }

    private function _isLoggedIn()
    {
        if (!$this->_session->adminIsLoggedIn())
            $this->_redirect('admin_login');
    }
}