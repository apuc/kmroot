<?php
namespace Kinomania\Control\Film;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Parser\Film\ImdbFilm;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Text\TText;

class Release extends DB
{
    use TRepository;
    use TText;
    use TDate;

    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';
        $post = new PostBag();

        $filmId = $post->fetchInt('filmId');
        $premiere_ru = $post->fetchEscape('premiere_ru', $this->db);

        $this->db->query("UPDATE `film` SET `premiere_ru` = '{$premiere_ru}' WHERE `id` = {$filmId} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * Get json data for DataTable plugin. List of companies.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

        $from = $get->fetch('from');
        $date = $get->fetch('date');

        $from = $this->db->real_escape_string($from);
        $date = $this->db->real_escape_string($date);

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'premiere_ru';
                break;
            default:
                $order = 'premiere_ru';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];
        $direction = 'ASC';

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year`, `premiere_ru` FROM `film` WHERE 1 ";
        if (!empty($date)) {
            $query .= " AND `premiere_ru` = '{$date}'";
        } else {
            $query .= " AND `premiere_ru` >= '{$from}'";
        }

        /**
         * Total.
         */
        $total = 0;
        $result = $this->db->query(str_replace('`id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year`, `premiere_ru`', 'COUNT(*) as `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            if (0 == $row['year']) {
                $row['year'] = '';
            }
            $item[0] = $row['id'];
            $item[1] = '';
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $path = str_split($iName);
                $item[1] = Server::STATIC[$row['s']] . '/image' . Path::FILM . $path[0] . '/' . $path[1] . $path[2] . '/' . $iName . '.88.130.' . $row['image'];
            } else {
                $item[1] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            $item[2] = $row['year'];
            $item[3] = $row['name_ru'] . '<br />' . $row['name_origin'];
            $item[4] = $row['status'];
            $item[5] = $row['premiere_ru'];

            $data[] = $item;
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];

        return json_encode($data);
    }
}