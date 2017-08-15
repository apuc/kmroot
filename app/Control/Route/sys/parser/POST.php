<?php
namespace Control\Route_sys_parser;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Parser\Parser;

class POST extends AdminController
{
    public function parse()
    {
        $post = new PostBag();
        
        $local = false;
        if ('true' == $post->fetch('local')) {
            $local = true;
        }
        
        $parser = new Parser($local);
        
        switch ($post->fetch('type')) {
            case 'imdb_film':
                $parser->imdb_film($post->fetch('url'));
                break;
            case 'kt_film':
                $parser->kt_film($post->fetch('url'));
                break;
            case 'kp_film':
                $parser->kp_film($post->fetch('url'));
                break;
            case 'imdb_person':
                $parser->imdb_person($post->fetch('url'));
                break;
            case 'kt_person':
                $parser->kt_person($post->fetch('url'));
                break;
            case 'kp_person':
                $parser->kp_person($post->fetch('url'));
                break;
            case 'kinometro_ru':
                $parser->kinometro_ru($post->fetch('url'));
                break;
            case 'mojo':
                $parser->mojo($post->fetch('url'));
                break;
            case 'tv':
                $parser->tv($post->fetch('url'));
                break;
        }

        $this->addData([
            'url' => $post->fetch('url'),
            'error' => $parser->error(),
            'data' => $parser->data()
        ]);
        $this->setTitle('Отладка парсера / результат');
        $this->setTemplate('sys/parser/result.html.php');
    }
}