<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace App\Model\Resource\Table;
class ProductReview implements ITable
{
    public function getName()
    {
        return 'product_reviews';
    }

    public function getPrimaryKey()
    {
        return 'review_id';
    }
}
