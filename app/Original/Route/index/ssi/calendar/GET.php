<?php
namespace Original\Route_index_ssi_calendar;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=20000');

        $list = [];

        $date = date('Y-m-d', strtotime('now'));
        $month = explode('-', $date);
        $day = $month[2];
        $month = $month[1];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru` , t1.`birthday`
                                        FROM (SELECT `id` FROM `person` WHERE `status` = 'show' AND MONTH(`birthday`) = '{$month}' AND DAY(`birthday`) = '{$day}' ORDER BY `weight` DESC LIMIT 12) as `t`
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
                'name' => $name
            ];
        }

        $date = $this->formatDate($date);
        $current = explode('&nbsp;', $date);
        $current = $current[0] . ' ' . $current[1];
        
        $this->addData([
            'list' => $list,
            'date' => $date,
            'current' => $current,
        ]);
        $this->setTemplate('index/ssi/calendar.html.php');
    }
}