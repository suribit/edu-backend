<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/8/13
 */


namespace App\Model\Resource;


class Session implements IResourceSession {

    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }

    public function generateToken()
    {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function getToken()
    {
        return isset($_SESSION['token']) ? $_SESSION['token'] : null;
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

    public function Clear()
    {
        session_unset();
    }

    public function validateToken($token)
    {
        $valid = $this->getToken() === $token;
        unset($_SESSION['token']);
        return $valid;
    }
} 