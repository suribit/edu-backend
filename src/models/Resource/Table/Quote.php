<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Resource\Table;
class Quote implements ITable
{
    public function getName()
    {
        return 'quotes';
    }

    public function getPrimaryKey()
    {
        return 'quote_id';
    }
}
