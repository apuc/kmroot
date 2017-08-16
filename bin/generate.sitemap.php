<?php
set_time_limit(0);

$db = mysqli_connect("127.0.0.1", "root", "", "kmmain");
$db->query("SET NAMES 'UTF8'");
setTimeZone($db);

$db_2 = mysqli_connect("127.0.0.1", "root", "", "kmmain");
$db_2->query("SET NAMES 'UTF8'");
setTimeZone($db_2);

$fileNum = 1;
$count = 0;
$createXml = true;
/**
 * @var \SimpleXMLElement $xml
 */
$xml = null;


/**
 * News.
 */
$result = $db->query("SELECT `id`, `category` FROM `news` ORDER BY `id` DESC");
while ($row = $result->fetch_assoc()) {
    switch ($row['category']) {
        case 'Новости кино':
            $link = '/news/';
            break;
        case 'Зарубежные сериалы':
            $link = '/news/';
            break;
        case 'Российские сериалы':
            $link = '/news/';
            break;
        case 'Арткиномания':
            $link = '/news/';
            break;
        case 'Фестивали и премии':
            $link = '/news/';
            break;
        default:
            $type = 'статье';
            $link = '/article/';
    }

    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru' . $link . $row['id'] . '/');
}


/**
 * Films.
 */
$result = $db->query("SELECT t1.`id`, t2.`poster`, t2.`frame`, t2.`wallpaper`, t2.`trailer`, t2.`soundtrack`, t2.`award` FROM `film` as `t1` LEFT JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId` WHERE t1.`status` = 'show' ORDER BY t1.`id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 4;
    if (0 < $row['poster']) {
        $locCount++;
    }
    if (0 < $row['frame']) {
        $locCount++;
    }
    if (0 < $row['wallpaper']) {
        $locCount++;
    }
    if (0 < $row['trailer']) {
        $locCount++;
    }
    if (0 < $row['soundtrack']) {
        $locCount++;
    }
    if (0 < $row['award']) {
        $locCount++;
    }
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/');

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/reviews/');

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/people/');

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/people/creators/');

    if (0 < $row['poster']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/posters/');
    }
    if (0 < $row['frame']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/frames/');
    }
    if (0 < $row['wallpaper']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/wallpapers/');
    }
    if (0 < $row['trailer']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/trailers/');
    }
    if (0 < $row['soundtrack']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/soundtracks/');
    }
    if (0 < $row['award']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['id'] . '/awards/');
    }
}
$result->close();


/**
 * Persons.
 */
$result = $result = $db->query("SELECT t1.`id`, t2.`photo`, t2.`wallpaper`, t2.`frame`, t2.`news`, t2.`video`, t2.`award` FROM `person` as `t1` LEFT JOIN `person_stat` as `t2` ON t1.`id` = t2.`personId` WHERE t1.`status` = 'show' ORDER BY t1.`id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 2;
    if (0 < $row['photo']) {
        $locCount++;
    }
    if (0 < $row['wallpaper']) {
        $locCount++;
    }
    if (0 < $row['frame']) {
        $locCount++;
    }
    if (0 < $row['news']) {
        $locCount++;
    }
    if (0 < $row['video']) {
        $locCount++;
    }
    if (0 < $row['award']) {
        $locCount++;
    }
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/');

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/reviews/');

    if (0 < $row['photo']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/photos/');
    }
    if (0 < $row['wallpaper']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/wallpapers/');
    }
    if (0 < $row['frame']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/frames/');
    }
    if (0 < $row['news']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/news/');
    }
    if (0 < $row['video']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/trailers/');
    }
    if (0 < $row['award']) {
        $url = $xml->addChild('url');
        $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['id'] . '/awards/');
    }
}
$result->close();


/**
 * Trailers.
 */
$result = $db->query("SELECT `id`, `filmId` FROM `trailer` WHERE `status` = 'show' ORDER BY `id` DESC");
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/trailers/' . $row['id'] . '/');
}


/**
 * Film frames.
 */
$result = $db->query("SELECT `id`, `filmId` FROM `film_frame` ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/frames/' . $row['id'] . '/');
}
$result->close();


/**
 * Film posters.
 */
$result = $db->query("SELECT `id`, `filmId` FROM `film_poster` ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/posters/' . $row['id'] . '/');
}
$result->close();


/**
 * Film reviews.
 */
$result = $db->query("SELECT `id`, `filmId` FROM `film_review` WHERE `status` = 'show' ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/reviews/' . $row['id'] . '/');
}
$result->close();


/**
 * Film scripts.
 */
$result = $db->query("SELECT `id`, `filmId` FROM `film_script` ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/script/' . $row['id'] . '/');
}
$result->close();


/**
 * Person photos.
 */
$result = $db->query("SELECT `id`, `personId` FROM `person_photo` ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['personId'] . '/photos/' . $row['id'] . '/');
}
$result->close();


/**
 * Person reviews.
 */
$result = $db->query("SELECT `id`, `personId` FROM `person_review` WHERE `status` = 'show' ORDER BY `id` DESC", MYSQLI_USE_RESULT);
while ($row = $result->fetch_assoc()) {
    $locCount = 1;
    $count += $locCount;

    if (49000 <= $count) {
        $data = $xml->asXML();
        $data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
        $data = str_replace('<xml>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
        $data = str_replace('</xml>', '</urlset>', $data);
        $fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap/sitemap' . $fileNum . '.xml', 'wb');
        fwrite($fh, $data);
        fclose($fh);
        $fileNum++;
        $createXml = true;
        $count = $locCount;
    }

    if ($createXml) {
        $xml = new \SimpleXMLElement('<xml/>');
        $createXml = false;
    }

    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://www.kinomania.ru/people/' . $row['personId'] . '/reviews/' . $row['id'] . '/');
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