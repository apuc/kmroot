<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\Original\Key\Person\Wallpaper;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Wallpapers
 * @package Kinomania\Original\Film
 */
class Wallpapers
{
    use TRepository;
    use TDate;
    
    public function get($filmId)
    {
        $list = [];

        $filmId = intval($filmId);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `width`, `height`
                                            FROM `film_wallpaper` JOIN (SELECT `id` FROM `film_wallpaper` WHERE `filmId` = {$filmId} ORDER BY `id` DESC) as `t` USING (`id`)");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                $preview = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.280.190.' . $row['image'];

                $r_1600x1200 = '';
                if (1600 <= $row['width'] && 1200 <= $row['height']) {
                    $r_1600x1200 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1600.1200.' . $row['image'];
                }

                $r_1280x960 = '';
                if (1280 <= $row['width'] && 960 <= $row['height']) {
                    $r_1280x960 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.960.' . $row['image'];
                }

                $r_1024x768 = '';
                if (1024 <= $row['width'] && 768 <= $row['height']) {
                    $r_1024x768 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1024.768.' . $row['image'];
                }

                $r_800x600 = '';
                if (800 <= $row['width'] && 600 <= $row['height']) {
                    $r_800x600 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.800.600.' . $row['image'];
                }

                $r_1920x1200 = '';
                if (1920 <= $row['width'] && 1200 <= $row['height']) {
                    $r_1920x1200 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1920.1200.' . $row['image'];
                }

                $r_1680x1050 = '';
                if (1680 <= $row['width'] && 1050 <= $row['height']) {
                    $r_1680x1050 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1680.1050.' . $row['image'];
                }

                $r_1440x900 = '';
                if (1440 <= $row['width'] && 900 <= $row['height']) {
                    $r_1440x900 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1440.900.' . $row['image'];
                }

                $r_1280x800 = '';
                if (1280 <= $row['width'] && 800 <= $row['height']) {
                    $r_1280x800 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.800.' . $row['image'];
                }

                $r_960x600 = '';
                if (960 <= $row['width'] && 600 <= $row['height']) {
                    $r_960x600 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.960.600.' . $row['image'];
                }

                $r_1920x1080 = '';
                if (1920 <= $row['width'] && 1080 <= $row['height']) {
                    $r_1920x1080 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1920.1080.' . $row['image'];
                }

                $r_1366x768 = '';
                if (1366 <= $row['width'] && 768 <= $row['height']) {
                    $r_1366x768 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1366.768.' . $row['image'];
                }

                $r_1280x1024 = '';
                if (1280 <= $row['width'] && 1024 <= $row['height']) {
                    $r_1280x1024  = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.1024.' . $row['image'];
                }

                $list[] = [
                    Wallpaper::ID => $row['id'],
                    Wallpaper::PREVIEW => $preview,
                    Wallpaper::WIDTH => $row['width'],
                    Wallpaper::HEIGHT => $row['height'],
                    Wallpaper::R_1600x1200 => $r_1600x1200,
                    Wallpaper::R_1280x960 => $r_1280x960,
                    Wallpaper::R_1024x768 => $r_1024x768,
                    Wallpaper::R_800x600 => $r_800x600,
                    Wallpaper::R_1920x1200 => $r_1920x1200,
                    Wallpaper::R_1680x1050 => $r_1680x1050,
                    Wallpaper::R_1440x900 => $r_1440x900,
                    Wallpaper::R_1280x800 => $r_1280x800,
                    Wallpaper::R_960x600 => $r_960x600,
                    Wallpaper::R_1920x1080 => $r_1920x1080,
                    Wallpaper::R_1366x768 => $r_1366x768,
                    Wallpaper::R_1280x1024 => $r_1280x1024,
                    Wallpaper::IMAGE => $image,
                ];
            }
        }
        
        return $list;
    }
    public function getById($filmId, $wallpaperId)
    {
        $list = [];

        $filmId = intval($filmId);
        $wallpaperId = intval($wallpaperId);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `width`, `height`
                                            FROM `film_wallpaper` WHERE `id` = {$wallpaperId} AND `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $imageName = md5($row['id']);

            $r_1600x1200 = '';
            if (1600 <= $row['width'] && 1200 <= $row['height']) {
                $r_1600x1200 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1600.1200.' . $row['image'];
            }

            $r_1280x960 = '';
            if (1280 <= $row['width'] && 960 <= $row['height']) {
                $r_1280x960 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.960.' . $row['image'];
            }

            $r_1024x768 = '';
            if (1024 <= $row['width'] && 768 <= $row['height']) {
                $r_1024x768 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1024.768.' . $row['image'];
            }

            $r_800x600 = '';
            if (800 <= $row['width'] && 600 <= $row['height']) {
                $r_800x600 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.800.600.' . $row['image'];
            }

            $r_1920x1200 = '';
            if (1920 <= $row['width'] && 1200 <= $row['height']) {
                $r_1920x1200 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1920.1200.' . $row['image'];
            }

            $r_1680x1050 = '';
            if (1680 <= $row['width'] && 1050 <= $row['height']) {
                $r_1680x1050 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1680.1050.' . $row['image'];
            }

            $r_1440x900 = '';
            if (1440 <= $row['width'] && 900 <= $row['height']) {
                $r_1440x900 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1440.900.' . $row['image'];
            }

            $r_1280x800 = '';
            if (1280 <= $row['width'] && 800 <= $row['height']) {
                $r_1280x800 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.800.' . $row['image'];
            }

            $r_960x600 = '';
            if (960 <= $row['width'] && 600 <= $row['height']) {
                $r_960x600 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.960.600.' . $row['image'];
            }

            $r_1920x1080 = '';
            if (1920 <= $row['width'] && 1080 <= $row['height']) {
                $r_1920x1080 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1920.1080.' . $row['image'];
            }

            $r_1366x768 = '';
            if (1366 <= $row['width'] && 768 <= $row['height']) {
                $r_1366x768 = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1366.768.' . $row['image'];
            }

            $r_1280x1024 = '';
            if (1280 <= $row['width'] && 1024 <= $row['height']) {
                $r_1280x1024  = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.1280.1024.' . $row['image'];
            }

            if ('' != $r_800x600) {
                $cast = [];
                $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                        FROM `film_wallpaper_person` as `t1`
                                                        LEFT JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                        WHERE t1.`wallpaperId` = {$row['id']} ORDER BY t1.`id`
                                                      ");
                while ($row2 = $result2->fetch_assoc()) {
                    $name = $row2['name_ru'];
                    if (empty($name)) {
                        $name = $row2['name_origin'];
                    }
                    $cast[] = [$row2['id'], $name];
                }

                $list['item'] = [
                    Wallpaper::ID => $row['id'],
                    Wallpaper::R_1600x1200 => $r_1600x1200,
                    Wallpaper::R_1280x960 => $r_1280x960,
                    Wallpaper::R_1024x768 => $r_1024x768,
                    Wallpaper::R_800x600 => $r_800x600,
                    Wallpaper::R_1920x1200 => $r_1920x1200,
                    Wallpaper::R_1680x1050 => $r_1680x1050,
                    Wallpaper::R_1440x900 => $r_1440x900,
                    Wallpaper::R_1280x800 => $r_1280x800,
                    Wallpaper::R_960x600 => $r_960x600,
                    Wallpaper::R_1920x1080 => $r_1920x1080,
                    Wallpaper::R_1366x768 => $r_1366x768,
                    Wallpaper::R_1280x1024 => $r_1280x1024,
                    Wallpaper::IMAGE => '',
                    Wallpaper::PREVIEW => $cast,
                ];
            }
        }

        return $list;
    }
}
