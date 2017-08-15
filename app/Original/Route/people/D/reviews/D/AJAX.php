<?php
namespace Original\Route_people_D_reviews_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Person\Reviews;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class AJAX extends FilmController
{
    use TRepository;
    use TDate;

    /**
     * Film review.
     */
    public function getReview()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0] && 0 < $numList[1]) {
            $list = (new Reviews())->getReviewById($numList[0], $numList[1]);

            if ([] != $list) {
                $this->setContent(json_encode($list));
            }
        }
    }
}