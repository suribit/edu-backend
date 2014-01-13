<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:56 PM
 */

namespace App\Model;

class AdminHelper
{
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function checkAdmin(AdminItem $adminItem)
    {

        $id = $this->_resource->check(['name' => $adminItem->getName(), 'password' => md5($adminItem->getPassword())]);

        echo $id;


        $adminItem->load($id);
        return $id;
    }
}