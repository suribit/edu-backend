<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     1/5/14
 */
namespace Test\Model\Resource\Table;

use App\Model\Resource\Table\ProductReview;

class ProductReviewTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsProductTableName()
    {
        $table = new ProductReview;
        $this->assertEquals('product_reviews', $table->getName());
    }

    public function testReturnsProductPrimaryKey()
    {
        $table = new ProductReview;
        $this->assertEquals('review_id', $table->getPrimaryKey());
    }
}
