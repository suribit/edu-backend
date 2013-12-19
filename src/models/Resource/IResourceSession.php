<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/8/13
 */
 namespace App\Model\Resource;

 interface IResourceSession
 {
     public function __construct();

     public function setData($key, $value);

     public function getData($key);

     public function getId();

     public function Clear();

     public function generateToken();

     public function getToken();

     public function validateToken($token);
 }