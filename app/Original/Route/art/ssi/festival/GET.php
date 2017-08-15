<?php
namespace Original\Route_art_ssi_festival;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
    {
        header('Cache-Control: public, max-age=600');
        
        $list = [];

        $result = $this->mysql()->query("SELECT `id`, `code`, `name_ru`, `name_en`, `description` FROM `awards` WHERE `type` = 'festival' ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $result2 = $this->mysql()->query("SELECT `from`, `to` FROM `awards_year` WHERE `awardId` = {$row['id']} ORDER BY `year` DESC LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $row['from'] = $this->cutLast($this->formatDate($row2['from']));
                $row['to'] = $this->cutLast($this->formatDate($row2['to']));
            }
            
            $list[] = $row;
        }

        $this->addData([
            'list' => $list,
        ]);

        $this->setTemplate('art/ssi/festival.html.php');
    }

    private function cutLast($input)
    {
        $input = explode('&nbsp;', $input);
        unset($input[count($input) - 1]);
        return implode('&nbsp;', $input);
    }
}