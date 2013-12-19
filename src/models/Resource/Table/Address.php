<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace App\Model\Resource\Table;
class Address implements ITable
{
    public function getName()
    {
        return 'address';
    }

    public function getPrimaryKey()
    {
        return 'address_id';
    }
}
