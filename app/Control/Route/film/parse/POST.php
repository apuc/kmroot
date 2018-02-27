<?php
namespace Control\Route_film_parse;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Boxoffice\Boxoffice;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Parse\Parse;
use Kinomania\System\Debug\Debug;

class POST extends AdminController
{
    public function parse()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
        } else {
            $parse = new Parse($this->mysql());

            $post = new PostBag();
            if($_POST['id'][0] == '0'){
            	$id = $_POST['id'];
            }else{
	            $id = $post->fetchInt('id');
            }
            $type = $post->fetch('type');

            $source = $parse->source($item->id(), $type);
            $parsed = $parse->parsed($id, $type);

            $this->addData([
                'item' => $item,
                'parserType' => $type,
                'source' => $source,
                'parsed' => $parsed
            ]);
            $this->setTitle('Парсинг');
            $this->setTemplate('film/parse/result.html.php');
        }
    }
    
    public function edit()
    {
    	
        $parse = new Parse($this->mysql());
        if ($parse->save()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($parse->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect($this->request->makeUrl('film/edit?id=' . (new PostBag())->fetchInt('id')));
    }
}