<?php
namespace Original\Route_location;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

/**
 * Created by PhpStorm.
 * User: perff
 * Date: 15.09.2017
 * Time: 10:26
 */
class AJAX extends DefaultController
{
    use TRepository;

    public function get()
    {
        $post = new PostBag();
        $cities =[];
        $query = $post->fetch('q');
        $result = $this->mysql()->query("SELECT t1.`name` as `city`, t2.`name` as `region`, t1.id as `city_id` 
                          FROM `geobase_city` AS t1
                          LEFT JOIN `geobase_region` AS t2 ON t1.`region_id` = t2.`id`
                          WHERE t1.`name` LIKE '%".$query."%' LIMIT 10");

        while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
        }

        $this->setContent(json_encode($cities));
    }

    public function set()
    {
        $cities = [];
        $post = new PostBag();

        $result = $this->mysql()->query("SELECT t1.`name` as `city`, t2.`name` as `region`, t1.id as `city_id` 
                          FROM `geobase_city` AS t1
                          LEFT JOIN `geobase_region` AS t2 ON t1.`region_id` = t2.`id`
                          WHERE t1.`id`=".$post->fetch('city_id')." LIMIT 1");

        while ($row = $result->fetch_assoc()) {
            $cities = $row;
        }

        if(!empty($cities)){
            if(setcookie('city', serialize($cities), time() + strtotime("+2 month"), '/')){
                $this->setContent($cities['city']);
            }
        }else $this->setContent(false);
    }
}