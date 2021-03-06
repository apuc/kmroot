<?php
namespace Original\Route_design_ssi_top;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $html = '';
        $result = $this->mysql()->query("SELECT `html_header` FROM `design` WHERE `status` = 'show' ORDER BY `id` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $html = $row['html_header'];
        }
        $this->addData([
            'html' => $html
        ]);
        $this->setTemplate('design/ssi/top.html.php');
    }
}