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
} 