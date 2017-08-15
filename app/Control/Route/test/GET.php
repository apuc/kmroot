<?php
namespace Control\Route_test;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        echo 'Дарья Егорова ';
        $search = 'Дарья Егорова ';
        iconv(mb_detect_encoding($search, mb_detect_order(), true), "UTF-8", $search);
        $search = preg_replace('/[^0-9a-zA-ZА-Яа-яёЁ_ -]+/u', '', $search);
        $search = $this->sphinx()->real_escape_string($search);
        $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        if (!empty($this->sphinx()->error)) {
            return 0;
        }
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            if (0 < $rowData['id']) {
                $idList[] = $rowData['id'];
            }
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }

        if (0 == count($idList)) {
            return 0;
        }

        $idList = implode(',', $idList);
        print_r($idList);
        exit;
    }

    public function city()
    {
        echo '<h1>Request:</h1>';
        $request = 'http://api.kassa.rambler.ru/v2/eed094a6-b7cc-4529-b858-a60f26a57f6f/json/cities';
        echo $request . "\n\n<br><br>";

        $data = file_get_contents($request);
        echo '<h1>Response:</h1>';
        echo '<pre>';
        print_r(json_decode($data));
        echo '</pre>';

        $this->setContent('');
    }

    public function place()
    {
        echo '<h1>Request:</h1>';
        $request = 'http://api.kassa.rambler.ru/v2/eed094a6-b7cc-4529-b8­58-a60f26a57f6f/json/Place/list';
        echo $request . "\n\n<br><br>";

        $data = file_get_contents($request);
        echo '<h1>Response:</h1>';
        echo '<pre>';
        print_r(json_decode($data));
        echo '</pre>';

        $this->setContent('');
    }

    public function schedule()
    {
        ini_set('memory_limit', '-1');
        echo '<h1>Request:</h1>';
        $request = 'http://api.kassa.rambler.ru/v2/eed094a6-b7cc-4529-b858-a60f26a57f6f/json/Place/schedule?cityID=2&dateFrom=2017-03-29&dateTo=2017-03-30';
        echo $request . "\n\n<br><br>";

        $data = file_get_contents($request);
        echo '<h1>Response:</h1>';
        echo '<pre>';
        print_r(json_decode($data));
        echo '</pre>';

        $this->setContent('');
    }

    public function object()
    {
        ini_set('memory_limit', '-1');
        echo '<h1>Request:</h1>';
        $request = 'http://api.kassa.rambler.ru/v2/eed094a6-b7cc-4529-b858-a60f26a57f6f/json/Movie/object?objectID=' . (new GetBag())->fetch('id');
        echo $request . "\n\n<br><br>";

        $data = file_get_contents($request);
        echo '<h1>Response:</h1>';
        echo '<pre>';
        print_r(json_decode($data));
        echo '</pre>';

        $this->setContent('');
    }

    public function fullFile()
    {
        echo '<h1>Request:</h1>';
        $request = 'http://api.kassa.rambler.ru/v2/eed094a6-b7cc-4529-b858-a60f26a57f6f/xml/movie/export/full';
        echo $request . "\n\n<br><br>";

        $data = file_get_contents($request);
        echo '<h1>Response:</h1>';
        echo '<pre>';
        print_r(json_decode($data));
        echo '</pre>';

        $this->setContent('');
    }
}