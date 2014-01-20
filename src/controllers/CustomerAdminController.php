<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/14/14
 * Time: 1:04 AM
 */

namespace App\Controller;

use Zend\Mail;


class CustomerAdminController
    extends ActionController
{
    public function listAction()
    {

        $this->_isLoggedIn();

        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Customer()]);

        $customer = $this->_di->get('Customer');
        $customers = $this->_di->get('CustomerCollection', ['resource' => $resource, 'customerPrototype' => $customer]);
        if (isset($_POST['order_by']) && $this->_session->getData('order_by') != $_POST['order_by'])
            $this->_session->setData('order_by', $_POST['order_by']);
        else if (isset($_POST['order_by']) && $this->_session->getData('order_by') == $_POST['order_by'])
            $this->_session->removed('order_by');

        if (isset($_POST['filter_by']) && isset($_POST['filter_value']))
        {
            $this->_session->setData('filter_by', $_POST['filter_by']);
            $this->_session->setData('filter_value', $_POST['filter_value']);
        }


        if ($this->_session->getData('order_by') != null)
            $customers->orderBy($this->_session->getData('order_by'));

        if ($this->_session->getData('filter_by') != null && $this->_session->getData('filter_value') != null)
            $customers->likeBy($this->_session->getData('filter_by'), $this->_session->getData('filter_value'));

        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(3)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();



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
            $customer = $this->_di->get('Customer');
            $customer->load($_GET['customer_id']);

            $customer->updateDate($_POST['edit']);
            if ($customer->getOpenPassword() != null)
            {
                $mailTo = $customer->getEmail();
                $newPassword = $customer->getOpenPassword();
                echo $mailTo;
                echo $newPassword;
                die;
            }

            $this->_redirect('customerAdmin_list');
        }
        else
        {
            if (isset($_GET['customer_id']))
            {
                $customer = $this->_di->get('Customer');
                $customer->load($_GET['customer_id']);

                return $this->_di->get('View', [
                    'layout' => 'admin',
                    'template' => 'customerAdmin_edit',
                    'params'   => ['customer' => $customer]
                ]);
            }
            else
            {
                $this->_redirect('customerAdmin_list');
            }
        }
    }

    public function addAction()
    {
        $this->_isLoggedIn();

        if (isset($_POST['add']))
        {
            $customer = $this->_di->get('Customer', ['data' => $_POST['add']]);
            $customer->save();

            $this->_redirect('customerAdmin_list');
        }
        else
        {
            return $this->_di->get('View', [
                'layout' => 'admin',
                'template' => 'customerAdmin_add',
                'params'   => []
            ]);
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