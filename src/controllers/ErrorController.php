<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
namespace App\Controller;

class ErrorController
{
    public function notFoundAction()
    {
        require_once __DIR__ . '/../views/error_notfound.phtml';
    }
}