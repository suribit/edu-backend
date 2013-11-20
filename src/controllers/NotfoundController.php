<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/10/13
 */
 class NotFoundController
 {
     public function showAction()
     {
         header("HTTP/1.0 404 Not Found");
         require_once __DIR__ . '/../views/404.phtml';
     }
 }