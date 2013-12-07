<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/8/13
 */
 namespace App\Model\Resource;

 interface IResourceSession
 {
     public function setData($key, $value);

     public function getData($key);

     public function getId();

     public function Clear();
 }