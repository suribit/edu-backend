<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */
namespace App\Model\Resource\Table;
class Product implements ITable
{
    public function getName()
    {
        return 'products';
    }

    public function getPrimaryKey()
    {
        return 'product_id';
    }
}