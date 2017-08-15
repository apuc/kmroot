<?php
namespace Original\Route_film_D_reviews_D;

use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Reviews;

class AJAX extends FilmController
{
    /**
     * Film review.
     */
    public function getReview()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0] && 0 < $numList[1]) {
            $list = (new Reviews())->getReviewById($numList[1]);

            if ([] != $list) {
                $this->setContent(json_encode($list));
            }
        }
    }
}