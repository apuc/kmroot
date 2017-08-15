<?php
namespace Original\Route_design_ssi_right_bottom;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $html = '';
        $result = $this->mysql()->query("SELECT `html_footer` FROM `design` WHERE `status` = 'show' ORDER BY `id` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $html = $row['html_footer'];
        }
        $this->addData([
            'html' => $html
        ]);
        $this->setTemplate('design/ssi/right_bottom.html.php');
    }
}