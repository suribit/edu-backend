<?php
/**
 * Created by PhpStorm.
 * User: wss-world
 * Date: 1/13/14
 * Time: 11:13 PM
 */

namespace App\Model\Resource\Table;
class Admin implements ITable
{
    public function getName()
    {
        return 'admins';
    }

    public function getPrimaryKey()
    {
        return 'admin_id';
    }
}