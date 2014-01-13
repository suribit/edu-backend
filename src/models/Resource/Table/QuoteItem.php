<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Resource\Table;
class QuoteItem implements ITable
{
    public function getName()
    {
        return 'quote_items';
    }

    public function getPrimaryKey()
    {
        return 'item_id';
    }
}
