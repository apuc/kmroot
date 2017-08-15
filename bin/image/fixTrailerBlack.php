<?php
/**
 * Soundtrack images.
 */

/**
 * Settings.
 */
error_reporting(-1);
ini_set('display_errors', 1);
ob_implicit_flush(false);

set_time_limit(99999); // this way
ini_set('max_execution_time', 99999); // or this way
ini_set ('gd.jpeg_ignore_warning', 1);

const ROOT_SRC = '/var/www/kino.mania/kmroot/images/';
const ROOT_DIST = '/var/www/kino.mania/cachefs/data/file/';

const MAX_WIDTH = 1280;
const MAX_HEIGHT = 1280;

const DIR_DIST = 'person_photo/'; // NEW DIR
$source = ROOT_SRC . 'photos_people/'; // FROM

$idList = '';
$fh = fopen(dirname(__FILE__) . '/photo.id.txt', 'rb');
while (!feof($fh)) {
    $idList .= fread($fh, 4096);
}
fclose($fh);
$idList = unserialize($idList);

foreach ($idList as $id) {
    $id = intval($id);
    if (0 < $id) {
        $iName = md5($id);
        $pathTo = ROOT_DIST . DIR_DIST . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.jpeg';
        if (file_exists($pathTo)) {
            if (true === check_if_black($pathTo)) {
                $pathFrom = $source . '/p_' . $id . '.jpg';

                $mime = mime_content_type($pathFrom);
                if ('image/jpeg' == $mime) {
                    $img = @imagecreatefromjpeg($pathFrom);
                } else if ('image/png' == $mime) {
                    $img = @imagecreatefrompng($pathFrom);
                } else if ('image/gif' == $mime) {
                    $img = @imagecreatefromgif($pathFrom);
                } else {
                    continue;
                }

                if (false === $img) {
                    continue;
                }

                $currentWidth = imagesx($img);
                $currentHeight = imagesy($img);

                $width = MAX_WIDTH;
                $height = MAX_HEIGHT;

                if ($currentWidth <= $width && $currentHeight <= $height) {
                    ob_start();
                    imagejpeg($img);
                    $data = ob_get_clean();
                } else {
                    if ($currentHeight > $currentWidth) {
                        $width = floor(($currentWidth / $currentHeight) * $height);
                    } else {
                        $height = floor(($currentHeight / $currentWidth) * $width);
                    }

                    $newImageData = imagecreatetruecolor($width, $height);
                    imagealphablending($newImageData, false);
                    imagesavealpha($newImageData, true);

                    imagecopyresampled($newImageData, $img, 0, 0, 0, 0, $width, $height, $currentWidth, $currentHeight);

                    ob_start();
                    imagejpeg($newImageData);
                    $data = ob_get_clean();
                }

                $iName = md5($id);
                $dirList = str_split($iName);
                $pathTo = ROOT_DIST . DIR_DIST . $dirList[0];
                clearstatcache();
                if (!file_exists($pathTo)) {
                    mkdir($pathTo, 0770);
                }

                $pathTo .= '/' . $dirList[1] . $dirList[2];
                clearstatcache();
                if (!file_exists($pathTo)) {
                    mkdir($pathTo, 0770);
                }
                $pathTo .= '/' . $iName . '.jpeg';

                $fh = fopen($pathTo, 'wb');
                fwrite($fh, $data);
                fclose($fh);
                chmod($pathTo, 0770);

                /**
                 * JPEG optimization.
                 */
                exec('jpegtran -copy none -optimize -progressive -outfile ' . $pathTo . ' ' . $pathTo);
            }
        }
    }
}
function check_if_black($src){

    $img = imagecreatefromjpeg($src);
    list($width_orig, $height_orig)=getimagesize($src);
    for($i=0;$i<20;$i++){
        $rand_width=rand ( 0 , $width_orig -1  );
        $rand_height=rand ( 0 , $height_orig - 1 );
        $rgb = imagecolorat($img, $rand_width, $rand_height);
        if($rgb!=0){
            return false;
        }
    }
    return true;
}