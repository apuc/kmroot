<?php

$db_to = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
$db_to->query("SET NAMES 'UTF8'");
setTimeZone($db_to);

$idList = '';
$fh = fopen(dirname(__FILE__) . '/trailer_id.txt', 'rb');
while (!feof($fh)) {
    $idList .= fread($fh, 4096);
}
fclose($fh);
$idList = unserialize($idList);

foreach ($idList as $id) {
    $id = intval($id);
    if (0 < $id) {
        $db_to->query("UPDATE `trailer` SET `image` = 'jpeg' WHERE `id` = {$id} LIMIT 1");
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