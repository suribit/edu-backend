<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/16/13
 */
namespace App\Model;

interface ISessionUser
{
    public function setSession(Session $session);
}