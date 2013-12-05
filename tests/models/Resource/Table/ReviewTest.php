<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */
namespace Test\Model\Resource\Table;

use App\Model\Resource\Table\Review;

class ReviewTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsReviewTableName()
    {
        $table = new Review;
        $this->assertEquals('review', $table->getName());
    }

    public function testReturnsReviewPrimaryKey()
    {
        $table = new Review;
        $this->assertEquals('review_id', $table->getPrimaryKey());
    }
}