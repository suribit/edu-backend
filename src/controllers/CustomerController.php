<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/7/13
 */
namespace App\Controller;


class CustomerController
    extends ActionController
{

    public function loginAction()
    {
        if (!$this->_session->isLoggedIn())
        {
            if (isset($_POST['customer']))
            {

                if ($this->_loginCustomer($_POST['customer']))
                {

                    $this->_redirect('product_list');
                }
                else
                    $this->_redirect('customer_login', ['error_login' => true]);
            }
            return $this->_di->get('View', [
                'template' => 'customer_login',
                'params'   => []
            ]);
        }
        else
        {
            $this->_redirect('product_list');
        }

    }

    public function logoutAction()
    {
        $this->_session->logout();
        $this->_redirect('product_list');
    }

    public function registerAction()
    {
        if (!$this->_session->isLoggedIn())
        {
            if (isset($_POST['customer']))
            {
                if ($this->_registerCustomer())
                    $this->_loginCustomer(['name' => $_POST['customer'], 'password' => $_POST['customer']['password']]);
                $this->_redirect('product_list');
            }
            return $this->_di->get('View', [
                'template' => 'customer_register',
                'params'   => []
            ]);
        }
        else
        {
            $this->_redirect('product_list');
        }

    }

    private function _loginCustomer($data)
    {
        $customerTemp = $this->_di->get('Customer', ['data' => $data]);
        $customers = $this->_di->get('CustomerCollection');


        if (($id = $customers->checkUser($customerTemp)) != null)
        {
            $this->_session->setUserId($id);
            if (($quoteId = $this->_session->getQuoteId()) != null)
            {
                $customerTemp->setQuoteId($quoteId);
                $customerTemp->save();
            }
            return true;
        }
        return false;
    }

    private function _registerCustomer()
    {
        $customer = $this->_di->get('Customer', ['data' => $_POST['customer']]);

        try
        {
            $customer->save();
        } catch (\Exception $ex)
        {
            return false;
        }

        return true;
    }
}