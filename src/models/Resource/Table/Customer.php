<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/7/13
 */
namespace App\Model\Resource\Table;
class Customer implements ITable
{
    public function getName()
    {
        return 'customers';
    }

    public function getPrimaryKey()
    {
        return 'customer_id';
    }
}