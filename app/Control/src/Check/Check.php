<?php
namespace Kinomania\Control\Check;

use Kinomania\Control\Check\PHP\Module;

/**
 * Class Check
 * @package Kinomania\Control\Check
 */
class Check
{
    /**
     * Check constructor.
     * @param string $root
     * @throws \ErrorException
     */
    public function __construct($root)
    {
        $this->root = $root;
        if (!file_exists($root)) {
            throw new \ErrorException('Root path not exist');
        }

        $this->php = new Module();
    }

    /**
     * @return Module
     */
    public function php(): Module
    {
        return $this->php;
    }

    /**
     * @param string $path
     * @throws \ErrorException
     * @return string
     */
    public function pathRights($path)
    {
        try {
            $path = $this->root . '/' . $path;
            
            if (!file_exists($path)) {
                throw new \ErrorException('Root path not exist');
            }

            $perms = fileperms($path);

            switch ($perms & 0xF000) {
                case 0xC000: // сокет
                    $info = 's';
                    break;
                case 0xA000: // символическая ссылка
                    $info = 'l';
                    break;
                case 0x8000: // обычный
                    $info = 'r';
                    break;
                case 0x6000: // файл блочного устройства
                    $info = 'b';
                    break;
                case 0x4000: // каталог
                    $info = 'd';
                    break;
                case 0x2000: // файл символьного устройства
                    $info = 'c';
                    break;
                case 0x1000: // FIFO канал
                    $info = 'p';
                    break;
                default: // неизвестный
                    $info = 'u';
            }
            $info .= ' ';

            // Владелец
            $info .= (($perms & 0x0100) ? 'r' : '-');
            $info .= (($perms & 0x0080) ? 'w' : '-');
            $info .= (($perms & 0x0040) ?
                (($perms & 0x0800) ? 's' : 'x' ) :
                (($perms & 0x0800) ? 'S' : '-'));
            $info .= ' ';

            // Группа
            $info .= (($perms & 0x0020) ? 'r' : '-');
            $info .= (($perms & 0x0010) ? 'w' : '-');
            $info .= (($perms & 0x0008) ?
                (($perms & 0x0400) ? 's' : 'x' ) :
                (($perms & 0x0400) ? 'S' : '-'));
            $info .= ' ';

            // Мир
            $info .= (($perms & 0x0004) ? 'r' : '-');
            $info .= (($perms & 0x0002) ? 'w' : '-');
            $info .= (($perms & 0x0001) ?
                (($perms & 0x0200) ? 't' : 'x' ) :
                (($perms & 0x0200) ? 'T' : '-'));
            
            return $info;
        } catch (\ErrorException $e) {
            return '';
        }
    }

    private $root;
    private $php;
}