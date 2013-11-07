<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/7/13
 */

require_once __DIR__ . '/Collection.php';

class ReviewCollection extends Collection {

    public function getReviews() {
        return $this->getData();
    }

    public function getRating() {
        $reviews = $this->getAllData();
        $reviewsCount = count($reviews);

        $sumRatting = 0;

        foreach ($reviews as $review) {
            $sumRatting = $sumRatting + $review->getRating();
        }

        $rating = $sumRatting / $reviewsCount;
        return $rating;
    }

    public function getReviewProduct($product){
        $result = array();
        $reviews = $this->getReviews();

        foreach($reviews as $review) {
            if($review->belongsToProduct($product)) {
                $result[] = $review;
            }
        }

        return $result;
    }
}
