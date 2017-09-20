<?php
$root = dirname(__FILE__);

if (!isset($argv[1])) {
    //$classList = ['KV', 'Award', 'Company', 'Person', 'Film', 'News', 'User', 'Comment', 'Stat', 'Count', 'Weight', 'Admin'];  //Script
    $classList = ['Stat'];  //Script
    foreach ($classList as $class) {
        $db_from = mysqli_connect("127.0.0.1", "root", "", "kinomania");
        $db_from->query("SET NAMES 'UTF8'");
        setTimeZone($db_from);
        $db_from_2 = mysqli_connect("127.0.0.1", "root", "", "kinomania");
        $db_from_2->query("SET NAMES 'UTF8'");
        setTimeZone($db_from_2);

        $db_to = mysqli_connect("127.0.0.1", "root", "", "kmmain2");
        $db_to->query("SET NAMES 'UTF8'");
        setTimeZone($db_to);
        $db_to_2 = mysqli_connect("127.0.0.1", "root", "", "kmmain2");
        $db_to_2->query("SET NAMES 'UTF8'");
        setTimeZone($db_to_2);

        require $root . '/' . $class . '.php';
        (new $class($db_from, $db_from_2, $db_to, $db_to_2))->run();
        $fh = fopen($root . '/proceed.txt', 'ab');
        fwrite($fh, "{$class}\n");
        fclose($fh);

        $db_from->close();
        $db_from_2->close();
        $db_to->close();
        $db_to_2->close();
        sleep(1);
    }
    echo 'Done';
} else {
    $db_from = mysqli_connect("127.0.0.1", "root", "", "kinomania");
    $db_from->query("SET NAMES 'UTF8'");
    setTimeZone($db_from);
    $db_from_2 = mysqli_connect("127.0.0.1", "root", "", "kinomania");
    $db_from_2->query("SET NAMES 'UTF8'");
    setTimeZone($db_from_2);

    $db_to = mysqli_connect("127.0.0.1", "root", "", "kmmain2");
    $db_to->query("SET NAMES 'UTF8'");
    setTimeZone($db_to);
    $db_to_2 = mysqli_connect("127.0.0.1", "root", "", "kmmain2");
    $db_to_2->query("SET NAMES 'UTF8'");
    setTimeZone($db_to_2);

    $class = ucfirst($argv[1]);
    require $root . '/' . $class . '.php';
    (new $class($db_from, $db_from_2, $db_to, $db_to_2))->run();
    echo 'Done' . "\n";
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