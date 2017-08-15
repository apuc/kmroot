<?php
namespace Control\Route_film_video_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $video = new Video($this->mysql());
        $item = $video->getTrailer($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
        } else {
            $result = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `film` WHERE `id` = {$item->filmId()} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $encode = false;
                if (!empty($item->hd480()) || !empty($item->hd720()) || !empty($item->hd1080())) {
                    if (600 >= strtotime('now') - strtotime($item->date())) {
                        $encode = true;
                    }
                }
                $this->addData([
                    'item' => $item,
                    'encode' => $encode,
                    'typeList' => $video->getTypeList(),
                    'name_origin' => $row['name_origin'],
                    'name_ru' => $row['name_ru'],
                ]);
                $this->setTitle('Редактировать трейлер');
                $this->setTemplate('film/video/edit.html.php');
            }
        }
    }
}