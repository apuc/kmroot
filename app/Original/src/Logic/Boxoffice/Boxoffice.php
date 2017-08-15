<?php
namespace Kinomania\Original\Logic\Boxoffice;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Boxoffice
 * @package Kinomania\Original\Boxoffice
 */
class Boxoffice
{
    use TRepository;
    use TDate;
    
    /**
     * @param string $date
     * @return array
     */
    public function usa($date = '')
    {
        $list = [
            'date_from' => '',
            'date_to' => '',
            'table' => [],
            'total_rub' => 0,
            'total_usd' => 0,
            'total_views' => 0,
            'prev' => '',
            'next' => '',
            'course' => 0
        ];

        if (!empty($date)) {
            $date = $this->mysql()->real_escape_string($date);
            $result = $this->mysql()->query("SELECT `date_to` FROM `film_boxoffice` WHERE `type` = 'usa' AND `date_from` = '{$date}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'usa' AND `date_from` < '{$date}' ORDER BY `id` DESC LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['prev'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'usa' AND `date_from` > '{$date}' ORDER BY `id` LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['next'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`,
                                        t1.`date_from`, t1.`date_to`,
                                        t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                        FROM `film_boxoffice` as `t1`
                                        LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                        WHERE t1.`type` = 'usa' AND t1.`date_from` = '{$date}' ORDER BY `position`
                                        ");
                while ($row = $result->fetch_assoc()) {
                    $list['date_from'] = $row['date_from'];
                    $list['date_to'] = $row['date_to'];

                    $list['total_usd'] += $row['gross'];
                    $list['total_rub'] += $row['gross_rub'];
                    $list['total_views'] += $row['views'];

                    $item = [];
                    $item['company'] = $row['company_name'];
                    $item['companyId'] = 0;

                    if (0 < $row['filmId']) {
                        $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                              WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                              ");
                        if ($row2 = $result2->fetch_assoc()) {
                            $item['company'] = $row2['short_name'];
                            $item['companyId'] = $row2['id'];
                        }
                    }

                    $item['position'] = $row['position'];
                    $item['previous'] = $row['previous'];
                    $item['filmId'] = $row['filmId'];
                    if (0 < $row['filmId']) {
                        $item['name_ru'] = $row['film_ru'];
                        $item['name_origin'] = $row['film_origin'];
                    } else {
                        $item['name_ru'] = $row['name_ru'];
                        $item['name_origin'] = $row['name_origin'];
                    }
                    $item['week'] = $row['week'];
                    $item['copy'] = $row['copy'];

                    if (0 < $row['gross']) {
                        $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                    } else {
                        $item['gross'] = '';
                    }
                    if (0 < $row['gross_total']) {
                        $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                    } else {
                        $item['gross_total'] = '';
                    }

                    if (0 < $row['gross_rub']) {
                        $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_rub'] = '';
                    }
                    if (0 < $row['gross_total_rub']) {
                        $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_total_rub'] = '';
                    }

                    if (0 < $row['views']) {
                        $item['views'] = number_format($row['views'], 0, '.', ' ');
                    } else {
                        $item['views'] = '';
                    }
                    if (0 < $row['views_total']) {
                        $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                    } else {
                        $item['views_total'] = '';
                    }

                    if (0 < $row['budget']) {
                        $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                    } else {
                        $item['budget'] = '';
                    }


                    $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                    if (0 < $row['filmId'] && '' != $row['image']) {
                        $imageName = md5($row['filmId']);
                        $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                    }

                    $list['table'][] = $item;
                }

                if (0 == $list['total_usd']) {
                    $list['total_usd'] = '';
                } else {
                    $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
                }
                if (0 == $list['total_rub']) {
                    $list['total_rub'] = '';
                } else {
                    $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
                }
                if (0 == $list['total_views']) {
                    $list['total_views'] = '';
                } else {
                    $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
                }

                $list['date_from'] = $this->formatDate($list['date_from']);
                $list['date_to'] = $this->formatDate($list['date_to']);
            }

            
        } else {
            $result = $this->mysql()->query("SELECT `date_from`, `date_to` FROM `film_boxoffice` WHERE `type` = 'usa' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $list['date_from'] = $row['date_from'];
                $list['date_to'] = $row['date_to'];
            }

            $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'usa' AND `date_from` < '{$list['date_from']}' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $date = explode('-', $row['date_from']);
                $list['prev'] = $date[2] . '_' . $date[1] . '_' . $date[0];
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`,
                                            t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                            FROM `film_boxoffice` as `t1`
                                            LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                            WHERE t1.`type` = 'usa' AND t1.`date_from` = '{$list['date_from']}' ORDER BY `position`
                                            ");
            while ($row = $result->fetch_assoc()) {
                $list['total_usd'] += $row['gross'];
                $list['total_rub'] += $row['gross_rub'];
                $list['total_views'] += $row['views'];

                $item = [];
                $item['company'] = $row['company_name'];
                $item['companyId'] = 0;

                if (0 < $row['filmId']) {
                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                                  WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                                  ");
                    if ($row2 = $result2->fetch_assoc()) {
                        $item['company'] = $row2['short_name'];
                        $item['companyId'] = $row2['id'];
                    }
                }

                $item['position'] = $row['position'];
                $item['previous'] = $row['previous'];
                $item['filmId'] = $row['filmId'];
                if (0 < $row['filmId']) {
                    $item['name_ru'] = $row['film_ru'];
                    $item['name_origin'] = $row['film_origin'];
                } else {
                    $item['name_ru'] = $row['name_ru'];
                    $item['name_origin'] = $row['name_origin'];
                }
                $item['week'] = $row['week'];
                $item['copy'] = $row['copy'];

                if (0 < $row['gross']) {
                    $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                } else {
                    $item['gross'] = '';
                }
                if (0 < $row['gross_total']) {
                    $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                } else {
                    $item['gross_total'] = '';
                }

                if (0 < $row['gross_rub']) {
                    $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                } else {
                    $item['gross_rub'] = '';
                }
                if (0 < $row['gross_total_rub']) {
                    $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                } else {
                    $item['gross_total_rub'] = '';
                }

                if (0 < $row['views']) {
                    $item['views'] = number_format($row['views'], 0, '.', ' ');
                } else {
                    $item['views'] = '';
                }
                if (0 < $row['views_total']) {
                    $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                } else {
                    $item['views_total'] = '';
                }

                if (0 < $row['budget']) {
                    $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                } else {
                    $item['budget'] = '';
                }



                $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                }

                $list['table'][] = $item;
            }

            if (0 == $list['total_usd']) {
                $list['total_usd'] = '';
            } else {
                $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
            }
            if (0 == $list['total_rub']) {
                $list['total_rub'] = '';
            } else {
                $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
            }
            if (0 == $list['total_views']) {
                $list['total_views'] = '';
            } else {
                $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
            }

            $list['date_from'] = $this->formatDate($list['date_from']);
            $list['date_to'] = $this->formatDate($list['date_to']);
        }
        
        return $list;
    }
    
    /**
     * @param string $date
     * @return array
     */
    public function russia($date = '')
    {
        $list = [
            'date_from' => '',
            'date_to' => '',
            'table' => [],
            'total_rub' => 0,
            'total_usd' => 0,
            'total_views' => 0,
            'prev' => '',
            'next' => '',
            'course' => 0
        ];

        if (!empty($date)) {
            $date = $this->mysql()->real_escape_string($date);
            $result = $this->mysql()->query("SELECT `date_to` FROM `film_boxoffice` WHERE `type` = 'russia' AND `date_from` = '{$date}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'russia' AND `date_from` < '{$date}' ORDER BY `id` DESC LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['prev'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'russia' AND `date_from` > '{$date}' ORDER BY `id` LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['next'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`, t1.`course`,
                                        t1.`date_from`, t1.`date_to`,
                                        t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                        FROM `film_boxoffice` as `t1`
                                        LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                        WHERE t1.`type` = 'russia' AND t1.`date_from` = '{$date}' ORDER BY `position`
                                        ");
                while ($row = $result->fetch_assoc()) {
                    $list['date_from'] = $row['date_from'];
                    $list['date_to'] = $row['date_to'];

                    if (0 == $list['course']) {
                        $list['course'] = $row['course'];
                    }
                    $list['total_usd'] += $row['gross'];
                    $list['total_rub'] += $row['gross_rub'];
                    $list['total_views'] += $row['views'];

                    $item = [];
                    $item['company'] = $row['company_name'];
                    $item['companyId'] = 0;

                    if (0 < $row['filmId']) {
                        $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                              WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                              ");
                        if ($row2 = $result2->fetch_assoc()) {
                            $item['company'] = $row2['short_name'];
                            $item['companyId'] = $row2['id'];
                        }
                    }

                    $item['position'] = $row['position'];
                    $item['previous'] = $row['previous'];
                    $item['filmId'] = $row['filmId'];
                    if (0 < $row['filmId']) {
                        $item['name_ru'] = $row['film_ru'];
                        $item['name_origin'] = $row['film_origin'];
                    } else {
                        $item['name_ru'] = $row['name_ru'];
                        $item['name_origin'] = $row['name_origin'];
                    }
                    $item['week'] = $row['week'];
                    $item['copy'] = $row['copy'];

                    if (0 < $row['gross']) {
                        $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                    } else {
                        $item['gross'] = '';
                    }
                    if (0 < $row['gross_total']) {
                        $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                    } else {
                        $item['gross_total'] = '';
                    }

                    if (0 < $row['gross_rub']) {
                        $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_rub'] = '';
                    }
                    if (0 < $row['gross_total_rub']) {
                        $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_total_rub'] = '';
                    }

                    if (0 < $row['views']) {
                        $item['views'] = number_format($row['views'], 0, '.', ' ');
                    } else {
                        $item['views'] = '';
                    }
                    if (0 < $row['views_total']) {
                        $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                    } else {
                        $item['views_total'] = '';
                    }

                    if (0 < $row['budget']) {
                        $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                    } else {
                        $item['budget'] = '';
                    }


                    $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                    if (0 < $row['filmId'] && '' != $row['image']) {
                        $imageName = md5($row['filmId']);
                        $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                    }

                    $list['table'][] = $item;
                }

                if (0 == $list['total_usd']) {
                    $list['total_usd'] = '';
                } else {
                    $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
                }
                if (0 == $list['total_rub']) {
                    $list['total_rub'] = '';
                } else {
                    $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
                }
                if (0 == $list['total_views']) {
                    $list['total_views'] = '';
                } else {
                    $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
                }

                $list['date_from'] = $this->formatDate($list['date_from']);
                $list['date_to'] = $this->formatDate($list['date_to']);
            }

            
        } else {
            $result = $this->mysql()->query("SELECT `date_from`, `date_to` FROM `film_boxoffice` WHERE `type` = 'russia' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $list['date_from'] = $row['date_from'];
                $list['date_to'] = $row['date_to'];
            }

            $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'russia' AND `date_from` < '{$list['date_from']}' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $date = explode('-', $row['date_from']);
                $list['prev'] = $date[2] . '_' . $date[1] . '_' . $date[0];
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`, t1.`course`, 
                                            t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                            FROM `film_boxoffice` as `t1`
                                            LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                            WHERE t1.`type` = 'russia' AND t1.`date_from` = '{$list['date_from']}' ORDER BY `position`
                                            ");
            while ($row = $result->fetch_assoc()) {
                if (0 == $list['course']) {
                    $list['course'] = $row['course'];
                }
                $list['total_usd'] += $row['gross'];
                $list['total_rub'] += $row['gross_rub'];
                $list['total_views'] += $row['views'];

                $item = [];
                $item['company'] = $row['company_name'];
                $item['companyId'] = 0;

                if (0 < $row['filmId']) {
                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                                  WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                                  ");
                    if ($row2 = $result2->fetch_assoc()) {
                        $item['company'] = $row2['short_name'];
                        $item['companyId'] = $row2['id'];
                    }
                }

                $item['position'] = $row['position'];
                $item['previous'] = $row['previous'];
                $item['filmId'] = $row['filmId'];
                if (0 < $row['filmId']) {
                    $item['name_ru'] = $row['film_ru'];
                    $item['name_origin'] = $row['film_origin'];
                } else {
                    $item['name_ru'] = $row['name_ru'];
                    $item['name_origin'] = $row['name_origin'];
                }
                $item['week'] = $row['week'];
                $item['copy'] = $row['copy'];

                if (0 < $row['gross']) {
                    $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                } else {
                    $item['gross'] = '';
                }
                if (0 < $row['gross_total']) {
                    $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                } else {
                    $item['gross_total'] = '';
                }

                if (0 < $row['gross_rub']) {
                    $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                } else {
                    $item['gross_rub'] = '';
                }
                if (0 < $row['gross_total_rub']) {
                    $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                } else {
                    $item['gross_total_rub'] = '';
                }

                if (0 < $row['views']) {
                    $item['views'] = number_format($row['views'], 0, '.', ' ');
                } else {
                    $item['views'] = '';
                }
                if (0 < $row['views_total']) {
                    $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                } else {
                    $item['views_total'] = '';
                }

                if (0 < $row['budget']) {
                    $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                } else {
                    $item['budget'] = '';
                }


                $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                }

                $list['table'][] = $item;
            }

            if (0 == $list['total_usd']) {
                $list['total_usd'] = '';
            } else {
                $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
            }
            if (0 == $list['total_rub']) {
                $list['total_rub'] = '';
            } else {
                $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
            }
            if (0 == $list['total_views']) {
                $list['total_views'] = '';
            } else {
                $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
            }

            $list['date_from'] = $this->formatDate($list['date_from']);
            $list['date_to'] = $this->formatDate($list['date_to']);
        }
        
        return $list;
    }

    /**
     * @param string $date
     * @return array
     */
    public function cis($date = '')
    {
        $list = [
            'date_from' => '',
            'date_to' => '',
            'table' => [],
            'total_rub' => 0,
            'total_usd' => 0,
            'total_views' => 0,
            'prev' => '',
            'next' => '',
            'course' => 0
        ];

        if (!empty($date)) {
            $date = $this->mysql()->real_escape_string($date);
            $result = $this->mysql()->query("SELECT `date_to` FROM `film_boxoffice` WHERE `type` = 'cis' AND `date_from` = '{$date}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'cis' AND `date_from` < '{$date}' ORDER BY `id` DESC LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['prev'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'cis' AND `date_from` > '{$date}' ORDER BY `id` LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $temp = explode('-', $row['date_from']);
                    $list['next'] = $temp[2] . '_' . $temp[1] . '_' . $temp[0];
                }

                $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`, t1.`course`,
                                        t1.`date_from`, t1.`date_to`,
                                        t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                        FROM `film_boxoffice` as `t1`
                                        LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                        WHERE t1.`type` = 'cis' AND t1.`date_from` = '{$date}' ORDER BY `position`
                                        ");
                while ($row = $result->fetch_assoc()) {
                    $list['date_from'] = $row['date_from'];
                    $list['date_to'] = $row['date_to'];

                    if (0 == $list['course']) {
                        $list['course'] = $row['course'];
                    }
                    $list['total_usd'] += $row['gross'];
                    $list['total_rub'] += $row['gross_rub'];
                    $list['total_views'] += $row['views'];

                    $item = [];
                    $item['company'] = $row['company_name'];
                    $item['companyId'] = 0;

                    if (0 < $row['filmId']) {
                        $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                              WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                              ");
                        if ($row2 = $result2->fetch_assoc()) {
                            $item['company'] = $row2['short_name'];
                            $item['companyId'] = $row2['id'];
                        }
                    }

                    $item['position'] = $row['position'];
                    $item['previous'] = $row['previous'];
                    $item['filmId'] = $row['filmId'];
                    if (0 < $row['filmId']) {
                        $item['name_ru'] = $row['film_ru'];
                        $item['name_origin'] = $row['film_origin'];
                    } else {
                        $item['name_ru'] = $row['name_ru'];
                        $item['name_origin'] = $row['name_origin'];
                    }
                    $item['week'] = $row['week'];
                    $item['copy'] = $row['copy'];

                    if (0 < $row['gross']) {
                        $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                    } else {
                        $item['gross'] = '';
                    }
                    if (0 < $row['gross_total']) {
                        $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                    } else {
                        $item['gross_total'] = '';
                    }

                    if (0 < $row['gross_rub']) {
                        $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_rub'] = '';
                    }
                    if (0 < $row['gross_total_rub']) {
                        $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                    } else {
                        $item['gross_total_rub'] = '';
                    }

                    if (0 < $row['views']) {
                        $item['views'] = number_format($row['views'], 0, '.', ' ');
                    } else {
                        $item['views'] = '';
                    }
                    if (0 < $row['views_total']) {
                        $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                    } else {
                        $item['views_total'] = '';
                    }

                    if (0 < $row['budget']) {
                        $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                    } else {
                        $item['budget'] = '';
                    }



                    $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                    if (0 < $row['filmId'] && '' != $row['image']) {
                        $imageName = md5($row['filmId']);
                        $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                    }

                    $list['table'][] = $item;
                }

                if (0 == $list['total_usd']) {
                    $list['total_usd'] = '';
                } else {
                    $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
                }
                if (0 == $list['total_rub']) {
                    $list['total_rub'] = '';
                } else {
                    $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
                }
                if (0 == $list['total_views']) {
                    $list['total_views'] = '';
                } else {
                    $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
                }

                $list['date_from'] = $this->formatDate($list['date_from']);
                $list['date_to'] = $this->formatDate($list['date_to']);
            }
            
            
        } else {
            $result = $this->mysql()->query("SELECT `date_from`, `date_to` FROM `film_boxoffice` WHERE `type` = 'cis' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $list['date_from'] = $row['date_from'];
                $list['date_to'] = $row['date_to'];
            }

            $result = $this->mysql()->query("SELECT `date_from` FROM `film_boxoffice` WHERE `type` = 'cis' AND `date_from` < '{$list['date_from']}' ORDER BY `id` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $date = explode('-', $row['date_from']);
                $list['prev'] = $date[2] . '_' . $date[1] . '_' . $date[0];
            }

            $result = $this->mysql()->query("SELECT t1.`position`, t1.`previous`, t1.`filmId`, t1.`name_origin`, t1.`name_ru`, t1.`company_name`, t1.`week`, t1.`copy`, t1.`gross`, t1.`gross_total`, t1.`gross_rub`, t1.`gross_total_rub`, t1.`views`, t1.`views_total`, t1.`course`, 
                                            t2.`s`, t2.`image`, t2.`name_origin` as `film_origin`, t2.`name_ru` as `film_ru`, t2.`budget`
                                            FROM `film_boxoffice` as `t1`
                                            LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                            WHERE t1.`type` = 'cis' AND t1.`date_from` = '{$list['date_from']}' ORDER BY `position`
                                            ");
            while ($row = $result->fetch_assoc()) {
                if (0 == $list['course']) {
                    $list['course'] = $row['course'];
                }
                $list['total_usd'] += $row['gross'];
                $list['total_rub'] += $row['gross_rub'];
                $list['total_views'] += $row['views'];

                $item = [];
                $item['company'] = $row['company_name'];
                $item['companyId'] = 0;

                if (0 < $row['filmId']) {
                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`short_name` FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                                  WHERE t2.`filmId` = {$row['filmId']} AND t2.`type` = 'Прокат' LIMIT 1
                                                  ");
                    if ($row2 = $result2->fetch_assoc()) {
                        $item['company'] = $row2['short_name'];
                        $item['companyId'] = $row2['id'];
                    }
                }

                $item['position'] = $row['position'];
                $item['previous'] = $row['previous'];
                $item['filmId'] = $row['filmId'];
                if (0 < $row['filmId']) {
                    $item['name_ru'] = $row['film_ru'];
                    $item['name_origin'] = $row['film_origin'];
                } else {
                    $item['name_ru'] = $row['name_ru'];
                    $item['name_origin'] = $row['name_origin'];
                }
                $item['week'] = $row['week'];
                $item['copy'] = $row['copy'];

                if (0 < $row['gross']) {
                    $item['gross'] = '$' . number_format($row['gross'], 0, '.', ' ');
                } else {
                    $item['gross'] = '';
                }
                if (0 < $row['gross_total']) {
                    $item['gross_total'] = '$' . number_format($row['gross_total'], 0, '.', ' ');
                } else {
                    $item['gross_total'] = '';
                }

                if (0 < $row['gross_rub']) {
                    $item['gross_rub'] = number_format($row['gross_rub'], 0, '.', ' ');
                } else {
                    $item['gross_rub'] = '';
                }
                if (0 < $row['gross_total_rub']) {
                    $item['gross_total_rub'] = number_format($row['gross_total_rub'], 0, '.', ' ');
                } else {
                    $item['gross_total_rub'] = '';
                }

                if (0 < $row['views']) {
                    $item['views'] = number_format($row['views'], 0, '.', ' ');
                } else {
                    $item['views'] = '';
                }
                if (0 < $row['views_total']) {
                    $item['views_total'] = number_format($row['views_total'], 0, '.', ' ');
                } else {
                    $item['views_total'] = '';
                }

                if (0 < $row['budget']) {
                    $item['budget'] = '$' . number_format($row['budget'], 0, '.', ' ') . ' млн';
                } else {
                    $item['budget'] = '';
                }


                $item['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                if (0 < $row['filmId'] && '' != $row['image']) {
                    $imageName = md5($row['filmId']);
                    $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                }

                $list['table'][] = $item;
            }

            if (0 == $list['total_usd']) {
                $list['total_usd'] = '';
            } else {
                $list['total_usd'] = '$' . number_format($list['total_usd'], 0, '.', ' ');
            }
            if (0 == $list['total_rub']) {
                $list['total_rub'] = '';
            } else {
                $list['total_rub'] = number_format($list['total_rub'], 0, '.', ' ');
            }
            if (0 == $list['total_views']) {
                $list['total_views'] = '';
            } else {
                $list['total_views'] = number_format($list['total_views'], 0, '.', ' ');
            }

            $list['date_from'] = $this->formatDate($list['date_from']);
            $list['date_to'] = $this->formatDate($list['date_to']);
        }
        
        return $list;
    }
}