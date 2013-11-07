<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */

require_once __DIR__ . '/../src/Review.php';
require_once __DIR__ . '/../src/Product.php';

class ReviewTest extends PHPUnit_Framework_TestCase {

    public function testGetName() {
        $review = new Review(['name' => 'Sergei']);
        $this->assertEquals('Sergei', $review->getName());
    }

    public function testGetEmail() {
        $review = new Review(['email' => 'mail@mail.mail']);
        $this->assertEquals('mail@mail.mail', $review->getEmail());
    }

    public function testGetText() {
        $review = new Review(['text' => 'hello world']);
        $this->assertEquals('hello world', $review->getText());
    }

    public function testGetRating() {
        $review = new Review(['rating' => 4]);
        $this->assertEquals(4, $review->getRating());
    }

    public function testGetProduct() {
        $product = new Product(['sku' => 7]);
        $review = new Review(['product' => $product]);
        $this->assertEquals($product, $review->getProduct());
    }

    public function testBelongsToProduct() {
        $product = new Product(['sku' => 7]);
        $review = new Review(['product' => $product]);
        $this->assertEquals(true, $review->belongsToProduct($product));
    }
} 