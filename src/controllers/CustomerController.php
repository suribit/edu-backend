<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/7/13
 */
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\Customer;
use App\Model\Resource\Session;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\CustomerHelper;

class CustomerController
{

    public function loginAction()
    {

        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($resource, (new Session()));

        $customer = null;
        if (isset($_POST['customer']) && ($customer = $customer_helper->loginCustomer($_POST['customer']) != null))
        {
            header('Location: /');
        } else
        {
            $view = 'customer_login';
            require_once __DIR__ . '/../views/layout/base.phtml';
        }
    }

    public function logoutAction()
    {
        $session = new Session();
        $session->Clear();
        header('Location: /');
    }

    public function registerAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBEntity($connection, new CustomerTable);
        $customer_helper = new CustomerHelper($resource, (new Session()));

        $customer = null;
        if (isset($_POST['customer']) && ($customer = $customer_helper->registerCustomer($_POST['customer']) != null))
        {
            header('Location: /?page=customer_login');
        } else
        {
            $view = 'customer_register';
            require_once __DIR__ . '/../views/layout/base.phtml';
        }
    }

    private function _registerCustomer()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBEntity($connection, new CustomerTable);

        $customer = new Customer($_POST['customer']);
        $customer->save($resource);
    }

    public function _loginCustomer()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=shop', 'root', '0000');
        $resource = new DBEntity($connection, new CustomerTable);


        $customer = new Customer($_POST['customer']);
        if ($customer->check($resource))
        {
            $idCustomer = $customer->getId();
            $customer->load($resource, $idCustomer);
            $session = new Session();
            $session->setData('id', $idCustomer);

            return true;
        }
        return false;
    }
}