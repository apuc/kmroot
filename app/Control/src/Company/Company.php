<?php
namespace Kinomania\Control\Company;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;

/**
 * Class Company
 * @package Kinomania\System\Company
 */
class Company extends DB
{
    const NAME_EXIST = 1;

    /**
     * Company constructor.
     * @param \mysqli $db
     */
    public function __construct(\mysqli $db)
    {
        parent::__construct($db);
        
        $this->id = 0;
    }

    /**
     * @return array
     */
    public function castingAgencyList()
    {
        $list = [];

        $result = $this->db->query("SELECT `id`, `name` FROM `company` WHERE `type` = 'Кастинг-агентство' ORDER BY `name`");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }

        return $list;
    }


    /**
     * Update entity.
     * @return mixed
     */
    public function edit()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');

        $result = $this->db->query("SELECT 1 FROM `company` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item = new Item();
            $db = $this->db;
            $item->initFromPost(function ($val) use ($db) {
                return $db->real_escape_string($val);
            });

            if (empty($item->name())) {
                return false;
            }
            
            $this->db->query("UPDATE `company` SET
                              `type` = '{$item->type()}',
                              `status` = '{$item->status()}',
                              `name` = '{$item->name()}',
                              `short_name` = '{$item->short_name()}',
                              `site` = '{$item->site()}',
                              `phone` = '{$item->phone()}',
                              `fax` = '{$item->fax()}',
                              `text` = '{$item->text()}',
                              `kinometro` = '{$item->kinometro()}'
                              WHERE `id` = {$id} LIMIT 1
            ");

            if (!empty($this->db->error)) {
                return false;
            }

            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('company:' . $id)) {
                $redis->delete('company:' . $id);
            }
            
            return true;
        }

        return false;
    }


    /**
     * Get entity.
     * @param $id
     * @return mixed
     */
    public function getById($id): Item
    {
        $id = intval($id);

        $item = new Item();

        $result = $this->db->query("SELECT * FROM `company` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }
    
    
    /**
     * Add new company.
     * @return mixed
     */
    public function add()
    {
        $this->error = '';
        $post = new PostBag();

        $name = $post->fetchEscape('name', $this->db);

        $length = mb_strlen($name, 'UTF-8');
        if (0 < $length && 256 > $length) {
            $result = $this->db->query("SELECT 1 FROM `company` WHERE `name` = '{$name}' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
            if (1 == $result->num_rows) {
                $this->error = self::NAME_EXIST;
                return false;
            }

            $this->db->query("INSERT INTO `company` SET `s` = 0, `image` = '', `name` = '{$name}',`short_name` = '', `site` = '', `phone` = '', `fax` = '', `text` = '', `kinometro` = ''");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
            $this->id = $this->db->insert_id;

            return true;
        }

        return false;
    }

    /**
     * Get id of added company.
     * @return int
     */
    public function insertId()
    {
        return $this->id;
    }
    

    /**
     * Get json data for DataTable plugin. List of companies.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

        $type = $get->fetchEscape('type', $this->db);

        $search = $get->fetch('search');
        $search = trim($search['value']);

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'id';
                break;
            case 1:
                $order = 'name';
                break;
            default:
                $order = 'id';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        $query = "SELECT `id`, `type`, `status`, `name` FROM `company` WHERE 1 ";
        if (!empty($type)) {
            if ('null' == $type) {
                $type = '';
            }
            $query .= " AND `type` = '{$type}' ";
        } else {
            $query .= "AND `type` IN ('', 'Кастинг-агентство', 'Фонд', 'Производство', 'Прокат', 'Телеканал', 'Сеть кинотеатров')";
        }
        if (!empty($search)) {
            $search = $this->db->real_escape_string($search);
            $query .= " AND `name` LIKE '{$search}%' ";
        }

        /**
         * Total.
         */
        $total = 0;
        $result = $this->db->query(str_replace('`id`, `type`, `status`, `name`', 'COUNT(*) as `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }
        
        $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $item[0] = $row['id'];
            $item[1] = $row['name'];
            $item[2] = $row['type'];
            $item[3] = $row['status'];
            $item[4] = $row['id'];

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




    /**
     * Delete entity.
     * @param $id
     * @return mixed
     */
    public function delete($id = 0)
    {
        $this->error = '';

        $id = intval($id);
        if (0 == $id) {
            $post = new PostBag();
            $id = $post->fetchInt('id');
        }

        $result = $this->db->query("SELECT `s`, `image` FROM `company` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $static = new StaticS();
                $static->delete('company', $row['s'], $id, $row['image']);
            }
            
            $this->db->query("DELETE FROM `film_company_rel` WHERE `companyId` = {$id}");
            $this->db->query("DELETE FROM `person_casting` WHERE `castingId` = {$id}");

            $this->db->query("DELETE FROM `company` WHERE `id` = {$id} LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }

            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('company:' . $id)) {
                $redis->delete('company:' . $id);
            }

            return true;
        }

        return false;
    }
    
    private $id;
}