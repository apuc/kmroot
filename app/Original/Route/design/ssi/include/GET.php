<?php
namespace Original\Route_design_ssi_include;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $css = '';
        $html = '';
        $pre_roll = '';
        $pre_roll_link = '';
        $result = $this->mysql()->query("SELECT `path_css`, `includes`, `pre_roll`, `pre_roll_link` FROM `design` WHERE `status` = 'show' ORDER BY `id` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $css = $row['path_css'];
            $html = $row['includes'];
            $pre_roll = $row['pre_roll'];
            $pre_roll_link = $row['pre_roll_link'];
        }
        $this->addData([
            'css' => $css,
            'html' => $html,
            'pre_roll' => $pre_roll,
            'pre_roll_link' => $pre_roll_link,
        ]);
        $this->setTemplate('design/ssi/include.html.php');
    }
}