<?php
$db_to = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
$db_to->query("SET NAMES 'UTF8'");
setTimeZone($db_to);

$idList = [];

$result = $db_to->query("SELECT `id` FROM `person_photo` WHERE `image` != '' ORDER BY `id`");
while ($row = $result->fetch_assoc()) {
    $idList[] =  $row['id'];
}
$fh = fopen(dirname(__FILE__) . '/photo.id.txt', 'wb');
fwrite($fh, serialize($idList));
fclose($fh);


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