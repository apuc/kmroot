<?php
namespace Original\Route_index_ssi_boxoffice;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=1200');
        
        $list = [
            'russia' => [
                'date' => '',
                'image' => '',
                'id' => '',
                'name' => '',
                'gross' => '',
                'list' => []
            ],
            'cis' => [
                'date' => '',
                'image' => '',
                'id' => '',
                'name' => '',
                'gross' => '',
                'list' => []
            ],
            'usa' => [
                'date' => '',
                'image' => '',
                'id' => '',
                'name' => '',
                'gross' => '',
                'list' => []
            ],
        ];

        /**
         * Russia.
         */
        $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'russia' ORDER BY `date_from` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $date_from = $row['date_from'];

            $result = $this->mysql()->query("SELECT t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t1.`date_from`, t1.`date_to`, t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'russia' AND t1.`date_from` = '{$date_from}' ORDER BY t1.`position` LIMIT 1
                                              ");
            if ($row = $result->fetch_assoc()) {
                $date = $this->formatDate($row['date_from']) . ' — ' . $this->formatDate($row['date_to']);
                $year = date('Y');
                $date = str_replace($year, '', $date);
                $date = str_replace($year - 1, '', $date);

                $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.171.247.' . $row['image'];
                }

                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $list['russia']['date'] = $date;
                $list['russia']['image'] = $image;
                $list['russia']['id'] = $row['filmId'];
                $list['russia']['name'] = $name;
                $list['russia']['gross'] = $gross;
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'russia' AND t1.`date_from` = '{$date_from}' AND t1.`position` > 1 ORDER BY t1.`position` LIMIT 4
                                              ");
            while ($row = $result->fetch_assoc()) {
                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $item = [$row['position'], $row['filmId'], $name, $gross];
                $list['russia']['list'][] = $item;
            }
        }

        /**
         * CIS.
         */
        $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'cis' ORDER BY `date_from` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $date_from = $row['date_from'];

            $result = $this->mysql()->query("SELECT t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t1.`date_from`, t1.`date_to`, t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'cis' AND t1.`date_from` = '{$date_from}' ORDER BY t1.`position` LIMIT 1
                                              ");
            if ($row = $result->fetch_assoc()) {
                $date = $this->formatDate($row['date_from']) . ' — ' . $this->formatDate($row['date_to']);
                $year = date('Y');
                $date = str_replace($year, '', $date);
                $date = str_replace($year - 1, '', $date);

                $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.171.247.' . $row['image'];
                }

                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $list['cis']['date'] = $date;
                $list['cis']['image'] = $image;
                $list['cis']['id'] = $row['filmId'];
                $list['cis']['name'] = $name;
                $list['cis']['gross'] = $gross;
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'cis' AND t1.`date_from` = '{$date_from}' AND t1.`position` > 1 ORDER BY t1.`position` LIMIT 4
                                              ");
            while ($row = $result->fetch_assoc()) {
                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $item = [$row['position'], $row['filmId'], $name, $gross];
                $list['cis']['list'][] = $item;
            }
        }

        /**
         * USA.
         */
        $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'usa' ORDER BY `date_from` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $date_from = $row['date_from'];

            $result = $this->mysql()->query("SELECT t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t1.`date_from`, t1.`date_to`, t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'usa' AND t1.`date_from` = '{$date_from}' ORDER BY t1.`position` LIMIT 1
                                              ");
            if ($row = $result->fetch_assoc()) {
                $date = $this->formatDate($row['date_from']) . ' — ' . $this->formatDate($row['date_to']);
                $year = date('Y');
                $date = str_replace($year, '', $date);
                $date = str_replace($year - 1, '', $date);

                $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.171.247.' . $row['image'];
                }

                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $list['usa']['date'] = $date;
                $list['usa']['image'] = $image;
                $list['usa']['id'] = $row['filmId'];
                $list['usa']['name'] = $name;
                $list['usa']['gross'] = $gross;
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`gross`, t1.`gross_rub`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru` 
                                              FROM `film_boxoffice`  as `t1` 
                                              LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id` 
                                              WHERE t1.`type` = 'usa' AND t1.`date_from` = '{$date_from}' AND t1.`position` > 1 ORDER BY t1.`position` LIMIT 4
                                              ");
            while ($row = $result->fetch_assoc()) {
                if (0 < $row['filmId']) {
                    $name = $row['film_ru'];
                    if (empty($name)) {
                        $name = $row['film_origin'];
                    }
                    $row['filmId'] = '/film/' . $row['filmId'];
                } else {
                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }
                    $row['filmId'] = '#';
                }

                if (0 < $row['gross_rub']) {
                    $gross = number_format(round($row['gross_rub'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн руб.' . '</span>';
                } else {
                    $gross = '$' . number_format(round($row['gross'] / 1000000, 2), 2, ',', ' ') . '<span>' . ' млн' . '</span>';
                }

                $item = [$row['position'], $row['filmId'], $name, $gross];
                $list['usa']['list'][] = $item;
            }
        }

        $this->addData([
            'list' => $list
        ]);
        $this->setTemplate('index/ssi/boxoffice.html.php');
    }
}