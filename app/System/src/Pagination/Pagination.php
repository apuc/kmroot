<?php

namespace Kinomania\System\Pagination;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.08.2017
 * Time: 11:23
 */
use Kinomania\System\Buttons\Buttons;
use Kinomania\System\Debug\Debug;
use phpDocumentor\Reflection\Types\Integer;

class Pagination
{
    public $buttons = [];
    public $itemsPerPage = 20;
    public $itemsCount;
    public $currentPage;
    public $pagesCount;
    public $classUl = 'pagList';
    public $classActive = 'pagActive';
    public $arrows = true;
    public $nextBtn = '>';
    public $prevBtn = '<';
    public $homeBtn = '<<';
    public $endBtn = '>>';
    public $arrowsHE = true;
    public $html = '';

    public function __construct($itemsCount, $currentPage, Array $options = [], $toPrint = false)
    {
        /** @var int $pagesCount
         * @var int $itemsCount
         * @var int $itemsPerPage
         */
        $this->pagesCount = ceil($itemsCount / $this->itemsPerPage);
        $this->itemsCount = $itemsCount;
        $this->currentPage = $currentPage;

        if ($this->pagesCount === 1) {
            return;
        }

        $this->setOptions($options);

        if ($toPrint) {
            $this->printPag();
        }

    }

    public function printPag()
    {

        if ($this->currentPage <= 0 || $this->itemsCount <= 0) {
            return false;
        }
        $this->html = '<style>
                           ul.pagList {
                            margin: 0; /* Обнуляем значение отступов */
                            padding: 4px; /* Значение полей */
                           }
                           ul.pagList li {
                            display: inline; /* Отображать как строчный элемент */
                            margin-right: 5px; /* Отступ слева */                      
                            padding: 3px; /* Поля вокруг текста */
                           }
                           ul.pagList li.pagActive a{
                            color: black;
                            text-decoration: none;
                           }
                            </style><ul class="' . $this->classUl . '">';
        if ($this->currentPage > 1) {
            if ($this->arrowsHE) {
                $this->html .= '<li><a href="'.$_SERVER["PATH_INFO"].'?page=1">'.$this->homeBtn.'</a></li>';
            }
            if ($this->arrows) {
                $this->html .= '<li><a href="'.$_SERVER["PATH_INFO"].'">'.$this->prevBtn.'</a></li>';
            }
        }
        for ($i = $this->currentPage - 2; $i <= $this->currentPage + 2; $i++) {
            if($i > 0 && $i <= $this->pagesCount){
                if($i == $this->currentPage){
                    $this->html .= '<li class="'.$this->classActive.'"><a href="'.$_SERVER["PATH_INFO"].'?page='.$i.'">'.$i.'</a></li>';
                }
                else {
                    $this->html .= '<li><a href="'.$_SERVER["PATH_INFO"].'?page='.$i.'">'.$i.'</a></li>';
                }
            }
        }

        if ($this->currentPage < $this->pagesCount) {
            if ($this->arrows) {
                $this->html .= '<li><a href="'.$_SERVER["PATH_INFO"].'?page='.($this->currentPage+$i).'">'.$this->nextBtn.'</a></li>';
            }
            if ($this->arrowsHE) {
                $this->html .= '<li><a href="'.$_SERVER["PATH_INFO"].'?page='.$this->pagesCount.'">'.$this->endBtn.'</a></li>';
            }
        }
        $this->html .= '</ul>';
        echo $this->html;
    }

    public function setOptions($options)
    {
        $this->classUl = $options['classUl'] ?? $this->classUl;
        $this->classActive = $options['classActive'] ?? $this->classActive;
        $this->arrows = $options['arrows'] ?? $this->arrows;
        $this->arrowsHE = $options['arrowsHE'] ?? $this->arrowsHE;
        $this->homeBtn = $options['homeBtn'] ?? $this->homeBtn;
        $this->endBtn = $options['endBtn'] ?? $this->endBtn;
        $this->nextBtn = $options['nextBtn'] ?? $this->nextBtn;
        $this->prevBtn = $options['prevBtn'] ?? $this->prevBtn;
    }

}