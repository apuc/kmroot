<?php
namespace Kinomania\Control\Film\Company;

use Kinomania\System\Base\DB;

class Company extends DB
{
    public function getCompanyList($filmId)
    {
        $list = [];
        
        $result = $this->db->query("SELECT t1.`type`, t2.`name` FROM `film_company_rel` as `t1` JOIN `company` as `t2` ON t1.`companyId` = t2.`id` WHERE t1.`filmId` = {$filmId} ORDER BY t1.`id`");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
         
        return $list;
    }
}