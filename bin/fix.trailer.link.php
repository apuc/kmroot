<?php
$db_from = mysqli_connect("127.0.0.1", "root", "", "kinomania");
$db_from->query("SET NAMES 'UTF8'");
setTimeZone($db_from);

$db_from_2 = mysqli_connect("127.0.0.1", "root", "", "kinomania");
$db_from_2->query("SET NAMES 'UTF8'");
setTimeZone($db_from_2);

$db_to = mysqli_connect("127.0.0.1", "root", "", "kmmain");
$db_to->query("SET NAMES 'UTF8'");
setTimeZone($db_to);

$result = $db_from->query("SELECT * FROM `trailer` ORDER BY `id`");
while ($row = $result->fetch_assoc()) {
    $id = intval($row['id']);
    $date = strtotime($row['data']);

    $hd480 = '';
    $hd720 = '';
    $hd1080 = '';
    $source = '';

    $result2 = $db_from_2->query("SELECT * FROM `trailer_link` WHERE `tid` = {$id} ORDER BY `stype` DESC");
    while ($row2 = $result2->fetch_assoc()) {
        if (empty($row2['link'])) {
            continue;
        }

        if (!empty($source)) {
            continue;
        }

        if (false === strpos($row2['link'], 'kinomania.')) {
            if (false !== strpos($row2['link'], 'youtube.') || false !== strpos($row2['link'], 'vimeo.')) {
                $source = $row2['link'];
                continue;
            }
        }

        if (empty($hd1080)) {
            if (13 == $row2['stype'] || 7 == $row2['stype']) {
                $hd1080 = $row2['link'];
            }
            if (10 == $row2['stype'] || 3 == $row2['stype']) {
                $hd1080 = $row2['link'];
            }
        }

        if (empty($hd720)) {
            if (12 == $row2['stype'] || 6 == $row2['stype']) {
                $hd720 = $row2['link'];
            }
            if (9 == $row2['stype'] || 2 == $row2['stype']) {
                $hd720 = $row2['link'];
            }
        }

        if (empty($hd480)) {
            if (11 == $row2['stype'] || 5 == $row2['stype']) {
                $hd480 = $row2['link'];
            }
            if (8 == $row2['stype'] || 1 == $row2['stype']) {
                $hd480 = $row2['link'];
            }
        }
    }

    if (empty($hd480) && empty($hd720) && empty($hd1080)) {
        continue;
    }

    if (false !== stripos($hd480, '/media2.kinomania.ru/')) {
        $hd480 = str_replace('/trailers/', '/trailers/m2_trailers/', $hd480);
    }
    if (false === strpos($hd480, '/trailers/')) {
        $hd480 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd480);
        $hd480 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd480);
    } else {
        $hd480 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/', $hd480);
        $hd480 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/', $hd480);
    }

    $hd480 = $db_to->real_escape_string($hd480);


    if (false !== stripos($hd720, '/media2.kinomania.ru/')) {
        $hd720 = str_replace('/trailers/', '/trailers/m2_trailers/', $hd720);
    }
    if (false === strpos($hd720, '/trailers/')) {
        $hd720 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd720);
        $hd720 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd720);
    } else {
        $hd720 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/', $hd720);
        $hd720 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/', $hd720);
    }

    $hd720 = $db_to->real_escape_string($hd720);


    if (false !== stripos($hd1080, '/media2.kinomania.ru/')) {
        $hd1080 = str_replace('/trailers/', '/trailers/m2_trailers/', $hd1080);
    }
    if (false === strpos($hd1080, '/trailers/')) {
        $hd1080 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd1080);
        $hd1080 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/trailers/', $hd1080);
    } else {
        $hd1080 = str_replace('http://media2.kinomania.ru/', '//fs.kinomania.ru/', $hd1080);
        $hd1080 = str_replace('http://media3.kinomania.ru/', '//fs.kinomania.ru/', $hd1080);
    }

    $hd1080 = $db_to->real_escape_string($hd1080);


    $query = "UPDATE `trailer` SET `date` = FROM_UNIXTIME('{$date}'), `hd480` = '{$hd480}', `hd720` = '{$hd720}', `hd1080` = '{$hd1080}' WHERE `id` = {$id} LIMIT 1";
    $db_to->query($query);
    if (!empty($db_to->error)) {
        echo $query;
        echo "\n<br>";
        echo $db_to->error;
        $result->close();
        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
        fwrite($fh, "{$query}\n{$db_to->error}");
        fclose($fh);
        exit;
    }
}


function setTimeZone(\mysqli $db)
{
    $now = new \DateTime();
    $minutes = $now->getOffset() / 60;
    $sgn = ($minutes < 0 ? -1 : 1);
    $minutes = abs($minutes);
    $hrs = floor($minutes / 60);
    $minutes -= $hrs * 60;
    $offset = sprintf('%+d:%02d', $hrs * $sgn, $minutes);
    $db->query("SET time_zone='{$offset}'");
}