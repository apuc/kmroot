<?php
$db_from = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kinomania");
$db_from->query("SET NAMES 'UTF8'");
setTimeZone($db_from);


$db_to = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
$db_to->query("SET NAMES 'UTF8'");
setTimeZone($db_to);

$result = $db_from->query("SELECT `id`, `no_main` FROM `trailer`", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $id = intval($row['id']);
    $no_main = intval($row['no_main']);

    if (1 == $no_main) {
        $no_main = 'true';
    } else {
        continue;
        $no_main = 'false';
    }

    $query = "UPDATE `trailer` SET `no_main` = '{$no_main}' WHERE `id` = {$id} LIMIT 1";
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
$result->close();


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