<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/9/13
 */
namespace App\Model\Resource\Table;
class Cart implements ITable
{
    public function getName()
    {
        return 'cart';
    }

    public function getPrimaryKey()
    {
        return 'cart_id';
    }
}
