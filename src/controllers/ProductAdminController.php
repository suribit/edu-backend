<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:38 PM
 */

namespace App\Controller;


class ProductAdminController
    extends ActionController
{
    public function listAction()
    {
        if ($this->_session->adminIsLoggedIn())
        {
            return $this->_di->get('View', [
                'layout' => 'admin',
                'template' => 'productAdmin_list',
                'params'   => []
            ]);
        }
        else
        {
            $this->_redirect('admin_login');
        }

    }
}