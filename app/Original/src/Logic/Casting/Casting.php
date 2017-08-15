<?php
namespace Kinomania\Original\Logic\Casting;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Key\Casting\Company;
use Kinomania\Original\Key\Casting\Person;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Casting
 * @package Kinomania\Original\Company
 */
class Casting
{
    use TRepository;
    use TDate;

    public function mainData()
    {
        $list = [
            'male' => [],
            'female' => [],
            'child' => [],
            'company' => [],
            'promo' => [],
        ];

        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'male' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list['male'][$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'female' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list['female'][$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        $date = date('Y-m-d', strtotime('-18 year'));
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `birthday` >= '{$date}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list['child'][$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        $result = $this->mysql()->query("SELECT `id`, `short_name` FROM `company` WHERE `type` = 'Кастинг-агентство'");
        while ($row = $result->fetch_assoc()) {
            $male = 0;
            $result2 = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `person_casting` WHERE `sex` = 'male' AND `castingId` = {$row['id']}");
            if ($row2 = $result2->fetch_assoc()) {
                $male = $row2['count'];
            }

            $female = 0;
            $result2 = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `person_casting` WHERE `sex` = 'female' AND  `castingId` = {$row['id']}");
            if ($row2 = $result2->fetch_assoc()) {
                $female = $row2['count'];
            }
            
            $list['company'][] = [
                Company::ID => $row['id'],
                Company::NAME => $row['short_name'],
                Company::MALE => $male,
                Company::FEMALE => $female,
            ];
        }

        $result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'casting_promo' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $id = unserialize($row['list']);
            $id = intval($id[0]);
            
            if (0 < $id) {
                $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM `person` as `t2` WHERE `id` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
                    if ('' != $row['image']) {
                        $imageName = md5($row['id']);
                        $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.241.322.' . $row['image'];
                    }

                    $name = $row['name_ru'];
                    if (empty($name)) {
                        $name = $row['name_origin'];
                    }

                    $list['promo'][] = [
                        Person::ID => $row['id'],
                        Person::IMAGE => $image,
                        Person::NAME => $name,
                    ];
                }
            }
        }

        return $list;
    }

    public function getMale($date)
    {
        $list = [];

        $from = 0;
        $to = 0;
        switch ($date) {
            case 10:
                $from = date('Y-m-d', strtotime('-10 years'));
                break;
            case 20:
                $from = date('Y-m-d', strtotime('-20 years'));
                $to = date('Y-m-d', strtotime('-10 years'));
                break;
            case 30:
                $from = date('Y-m-d', strtotime('-30 years'));
                $to = date('Y-m-d', strtotime('-20 years'));
                break;
            case 40:
                $from = date('Y-m-d', strtotime('-40 years'));
                $to = date('Y-m-d', strtotime('-30 years'));
                break;
            case 50:
                $from = date('Y-m-d', strtotime('-50 years'));
                $to = date('Y-m-d', strtotime('-40 years'));
                break;
            case 60:
                $to = date('Y-m-d', strtotime('-60 years'));
                break;
        }
        $to = $this->mysql()->real_escape_string($to);
        $from = $this->mysql()->real_escape_string($from);

        if (0 == $from && 0 == $to) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'male' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } elseif (0 == $from) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'male' AND `birthday` <= '{$to}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } elseif (0 == $to) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'male' AND `birthday` >= '{$from}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'male' AND `birthday` >= '{$from}' AND `birthday` <= '{$to}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        }

        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list[$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        return $list;
    }

    public function getFemale($date)
    {
        $list = [];

        $from = 0;
        $to = 0;
        switch ($date) {
            case 10:
                $from = date('Y-m-d', strtotime('-10 years'));
                break;
            case 20:
                $from = date('Y-m-d', strtotime('-20 years'));
                $to = date('Y-m-d', strtotime('-10 years'));
                break;
            case 30:
                $from = date('Y-m-d', strtotime('-30 years'));
                $to = date('Y-m-d', strtotime('-20 years'));
                break;
            case 40:
                $from = date('Y-m-d', strtotime('-40 years'));
                $to = date('Y-m-d', strtotime('-30 years'));
                break;
            case 50:
                $from = date('Y-m-d', strtotime('-50 years'));
                $to = date('Y-m-d', strtotime('-40 years'));
                break;
            case 60:
                $to = date('Y-m-d', strtotime('-60 years'));
                break;
        }
        $to = $this->mysql()->real_escape_string($to);
        $from = $this->mysql()->real_escape_string($from);

        if (0 == $from && 0 == $to) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'female' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } elseif (0 == $from) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'female' AND `birthday` <= '{$to}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } elseif (0 == $to) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'female' AND `birthday` >= '{$from}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `sex` = 'female' AND `birthday` >= '{$from}' AND `birthday` <= '{$to}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        }

        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list[$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        return $list;
    }

    public function getChild($sex)
    {
        $list = [];

        $date = date('Y-m-d', strtotime('-18 year'));
        if ('male' == $sex) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `birthday` >= '{$date}' AND `sex` = 'male' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } elseif ('female' == $sex) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `birthday` >= '{$date}' AND `sex` = 'female' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE `birthday` >= '{$date}' ORDER BY `personWeight` DESC LIMIT 36) as `t` 
                                          JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                                          WHERE t2.`status` = 'show' LIMIT 24
                                        ");
        }

        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $index = intval(floor($cnt / 6));
            $cnt++;
            $list[$index][] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        return $list;
    }

    public function getCompany()
    {
        $list = [];

        $result = $this->mysql()->query("SELECT `id`, `short_name` FROM `company` WHERE `type` = 'Кастинг-агентство' ORDER BY `short_name`");
        while ($row = $result->fetch_assoc()) {
            $list[] = [
                Company::ID => $row['id'],
                Company::NAME => $row['short_name']
            ];
        }

        return $list;
    }

    public function search()
    {
        $list = [];
        $get = new GetBag();

        $query = "SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`  FROM
                                          (SELECT `personId` FROM `person_casting` WHERE 1 ";
        if ('true' == $get->fetch('male') && 'false' == $get->fetch('female')) {
            $query .= " AND `sex` = 'male' ";
        } elseif ('false' == $get->fetch('male') && 'true' == $get->fetch('female')) {
            $query .= " AND `sex` = 'female' ";
        }
        $hair = $get->fetchEscape('hair', $this->mysql());
        if (!empty($hair)) {
            $query .= " AND `color_hair` = '{$hair}' ";
        }
        $eyes = $get->fetchEscape('eyes', $this->mysql());
        if (!empty($eyes)) {
            $query .= " AND `color_eyes` = '{$eyes}' ";
        }
        $age_from = $get->fetchInt('age_from');
        if (0 < $age_from) {
            $date = date('Y-m-d', strtotime('-' . $age_from . ' years'));
            $query .= " AND `birthday` <= '{$date}' ";
        }
        $age_to = $get->fetchInt('age_to');
        if (0 < $age_to) {
            $date = date('Y-m-d', strtotime('-' . $age_to . ' years'));
            $query .= " AND `birthday` >= '{$date}' ";
        }
        $height_from = $get->fetchInt('height_from');
        if (0 < $height_from) {
            $query .= " AND `height_from` >= {$height_from} ";
        }
        $height_to = $get->fetchInt('height_to');
        if (0 < $height_to) {
            $query .= " AND `height_to` <= {$height_to} ";
        }
        $weight_from = $get->fetchInt('weight_from');
        if (0 < $weight_from) {
            $query .= " AND `weight_from` >= {$weight_from} ";
        }
        $weight_to = $get->fetchInt('weight_to');
        if (0 < $weight_to) {
            $query .= " AND `weight_to` <= {$weight_to} ";
        }
        $company = explode(',', $get->fetch('company'));
        foreach ($company as $k => $v) {
            $v = intval($v);
            if (0 < $v) {
                $company[$k] = $v;
            } else {
                unset($company[$k]);
            }
        }
        $company = implode(',', $company);
        if (!empty($company)) {
            $query .= " AND `castingId` IN ({$company}) ";
        }

        $query .= "ORDER BY `personWeight` DESC) as `t` ";

        $ethnic = $get->fetchEscape('ethnic', $this->mysql());
        if (!empty($ethnic)) {
            $idList = [];
            $ethnic = explode(',', $ethnic);
            $ethnic = implode("','", $ethnic);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'ethnic' AND `value` IN ('{$ethnic}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_ethnic` as `ethnic` ON ethnic.`personId` = t.`personId` AND ethnic.`keyId` = {$idList} ";
            }
        }
        $sport = $get->fetchEscape('sport', $this->mysql());
        if (!empty($sport)) {
            $idList = [];
            $sport = explode(',', $sport);
            $sport = implode("','", $sport);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sport' AND `value` IN ('{$sport}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_sport` as `sport` ON sport.`personId` = t.`personId` AND sport.`keyId` = {$idList} ";
            }
        }
        $language = $get->fetchEscape('language', $this->mysql());
        if (!empty($language)) {
            $idList = [];
            $language = explode(',', $language);
            $language = implode("','", $language);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'language' AND `value` IN ('{$language}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_language` as `language` ON language.`personId` = t.`personId` AND language.`keyId` = {$idList} ";
            }
        }
        $music_instrument = $get->fetchEscape('music_instrument', $this->mysql());
        if (!empty($music_instrument)) {
            $idList = [];
            $music_instrument = explode(',', $music_instrument);
            $music_instrument = implode("','", $music_instrument);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'music_instrument' AND `value` IN ('{$music_instrument}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_music_instrument` as `music_instrument` ON music_instrument.`personId` = t.`personId` AND music_instrument.`keyId` = {$idList} ";
            }
        }
        $dance = $get->fetchEscape('dance', $this->mysql());
        if (!empty($dance)) {
            $idList = [];
            $dance = explode(',', $dance);
            $dance = implode("','", $dance);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'dance' AND `value` IN ('{$dance}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_dance` as `dance` ON dance.`personId` = t.`personId` AND dance.`keyId` = {$idList} ";
            }
        }
        $sing = $get->fetchEscape('sing', $this->mysql());
        if (!empty($sing)) {
            $idList = [];
            $sing = explode(',', $sing);
            $sing = implode("','", $sing);
            $result = $this->mysql()->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sing' AND `value` IN ('{$sing}')");
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }
            if (count($idList)) {
                $idList = implode(',', $idList);
                $query .= "JOIN `person_casting_sing` as `sing` ON sing.`personId` = t.`personId` AND sing.`keyId` = {$idList} ";
            }
        }
        $photo = $get->fetch('photo');
        $video = $get->fetch('video');
        if ('true' == $photo || 'true' == $video) {
            $query .= "JOIN `person_stat` as `t3` ON t.`personId` = t3.`personId` ";
            if ('true' == $photo) {
                $query .= " AND t3.`photo` > 0 ";
            }
            if ('true' == $video) {
                $query .= " AND t3.`video` > 0 ";
            }
        }
        $offset = ($get->fetchInt('page', 1) - 1) * 24;
        $query .= "JOIN `person` as `t2` ON t.`personId` = t2.`id` 
                   WHERE t2.`status` = 'show' LIMIT {$offset}, 24
                   ";
        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.203.268.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            
            $list[] = [
                Person::ID => $row['id'],
                Person::IMAGE => $image,
                Person::NAME => $name,
            ];
        }

        return $list;
    }
}