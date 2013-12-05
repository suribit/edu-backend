<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */
namespace App\Model\Resource\Table;
class Review implements ITable
{
    public function getName()
    {
        return 'review';
    }

    public function getPrimaryKey()
    {
        return 'review_id';
    }
}