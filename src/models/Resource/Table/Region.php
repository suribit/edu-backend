<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/19/13
 */
namespace App\Model\Resource\Table;
class Region implements ITable
{
    public function getName()
    {
        return 'region';
    }

    public function getPrimaryKey()
    {
        return 'region_id';
    }
}