<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace App\Model\Resource\Table;
class City implements ITable
{
    public function getName()
    {
        return 'city';
    }

    public function getPrimaryKey()
    {
        return 'city_id';
    }
}
