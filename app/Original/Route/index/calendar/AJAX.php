<?php
namespace Original\Route_index_calendar;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class AJAX extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $post = new PostBag();

        $list = [];

        $date = $post->fetch('date');
        $month = explode('-', $date);
        $day = $month[2];
        $month = $month[1];
        $date = $this->formatDate($date);
        $date = explode('&nbsp;', $date);
        $date = $date[0] . ' ' . $date[1];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, `birthday`
                                        FROM (SELECT `id` FROM `person` WHERE `status` = 'show' AND `day` = {$day} AND `month` = {$month} ORDER BY `weight` DESC LIMIT 12) as `t`
                                        JOIN `person` as `t1` ON t1.`id` = t.`id`
                                        ORDER BY t1.`weight` DESC LIMIT 12");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.90.119.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            $list[] = [
                'id' => $row['id'],
                'birthday' => $this->formatDate($row['birthday']),
                'image' => $image,
                'name' => $name,
                'date' => $date
            ];
        }

        $this->setContent(json_encode($list));
    }
}