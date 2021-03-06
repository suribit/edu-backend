<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model;

use App\Model\Resource\DBEntity;


class Session
{
    private $_customerResource;
    private $_adminItemResource;

    public function __construct(DBEntity $customerResource, DBEntity $adminItemResource)
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        $this->_customerResource = $customerResource;
        $this->_adminItemResource = $adminItemResource;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function adminIsLoggedIn()
    {
        return isset($_SESSION['admin_id']);
    }

    public function getAdminItem()
    {
        if (!($this->adminIsLoggedIn()))
            return null;

        $admin = new AdminItem([], $this->_adminItemResource);
        $admin->load($this->getUserId());

        return $admin;
    }

    public function getCustomer()
    {
        if (!($this->isLoggedIn()))
            return null;

        $customer = new Customer([], $this->_customerResource);
        $customer->load($this->getUserId());

        return $customer;
    }

    public function generateToken()
    {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function getToken()
    {
        return isset($_SESSION['token']) ? $_SESSION['token'] : null;
    }

    public function validateToken($token)
    {
        $valid = $this->getToken() === $token;
        unset($_SESSION['token']);
        return $valid;
    }

    public function getQuoteId()
    {
        return isset($_SESSION['quote_id']) ? $_SESSION['quote_id'] : null;
    }

    public function setQuoteId($id)
    {
        $_SESSION['quote_id'] = $id;
    }

    public function setUserId($id)
    {
        $_SESSION['user_id'] = $id;
    }

    public function setAdminId($id)
    {
        $_SESSION['admin_id'] = $id;
    }

    public function getUserId()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function getAdminId()
    {
        return isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;
    }

    public function setData($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getData($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function getId()
    {
        return session_id();
    }

    public function logout()
    {
        $_SESSION['user_id'] = null;
    }

    public function logoutAdmin()
    {
        $_SESSION['admin_id'] = null;
    }

    public function Clear()
    {
        session_unset();
    }

    public function removed($key)
    {
        unset($_SESSION[$key]);
    }
}
