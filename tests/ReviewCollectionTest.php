<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */

require_once __DIR__ . '/../src/Review.php';
require_once __DIR__ . '/../src/ReviewCollection.php';
require_once __DIR__ . '/../src/Product.php';


class ReviewCollectionTest extends PHPUnit_Framework_TestCase {
    public function testGetRating() {
        $reviews = new ReviewCollection([new Review(['rating' => 4]), new Review(['rating' => 4])]);
        $this->assertEquals(4, $reviews->getRating());
    }

    public function testGetReviews() {
        $reviews = new ReviewCollection([new Review(['rating' => 4]), new Review(['rating' => 4])]);
        $this->assertEquals([new Review(['rating' => 4]), new Review(['rating' => 4])], $reviews->getReviews());
    }

    public function testGetReviewProduct() {
        $reviews= new ReviewCollection([new Review(['product' => new Product(['sku' => 4587])]), new Review(['product' => new Product(['sku' => 7777])])]);
        $this->assertEquals([new Review(['product' => new Product(['sku' => 7777])])], $reviews->getReviewProduct(new Product(['sku' => 7777])));
    }
} 