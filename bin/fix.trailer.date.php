<?php
$db_from = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kinomania");
$db_from->query("SET NAMES 'UTF8'");
setTimeZone($db_from);

$db_to = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
$db_to->query("SET NAMES 'UTF8'");
setTimeZone($db_to);

$result = $db_from->query("SELECT `id`, `data` FROM `trailer` ORDER BY `id`");
while ($row = $result->fetch_assoc()) {
    $id = intval($row['id']);
    $date = strtotime($row['data']);
    $db_to->query("UPDATE `trailer` SET `date` = FROM_UNIXTIME('{$date}') WHERE `id` = {$id} LIMIT 1");
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