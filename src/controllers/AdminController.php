<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:01 PM
 */

namespace App\Controller;


class AdminController
    extends ActionController
{
    public function loginAction()
    {
        if (!$this->_session->adminIsLoggedIn())
        {
            if (isset($_POST['admin']))
            {
                if ($this->_loginAdmin($_POST['admin']))
                    $this->_redirect('productAdmin_list');
                else
                    $this->_redirect('admin_login', ['error_login' => true]);
            }
            return $this->_di->get('View', [
                'layout' => 'admin',
                'template' => 'admin_login',
                'params'   => []
            ]);
        }
        else
        {
            $this->_redirect('productAdmin_list');
        }
    }

    public function logoutAction()
    {
        if ($this->_session->adminIsLoggedIn())
        {
            $this->_session->logoutAdmin();
            $this->_redirect('admin_login');
        }
        else
        {
            $this->_redirect('product_list');
        }
    }

    private function _loginAdmin($data)
    {
        $adminTemp = $this->_di->get('AdminItem', ['data' => $data]);
        $adminHelper = $this->_di->get('AdminHelper');

        echo $adminTemp->getName();
        echo $adminTemp->getPassword();


        if (($id = $adminHelper->checkAdmin($adminTemp)) != null)
        {
            $this->_session->setAdminId($id);
            return true;
        }

        return false;
    }
}