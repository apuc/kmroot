<?php
set_time_limit(0);

$count = count(scandir('/var/www/kino.mania/kmroot/html_main/sitemap')) - 2;

$xml = new \SimpleXMLElement('<xml/>');

for ($i = 1; $i <= $count; $i++) {
    $url = $xml->addChild('sitemap');
    $url->addChild('loc', 'http://www.kinomania.ru/sitemap/sitemap' . $i . '.xml');
}

$data = $xml->asXML();
$data = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $data);
$data = str_replace('<xml>', '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $data);
$data = str_replace('</xml>', '</sitemapindex>', $data);
$fh = fopen('/var/www/kino.mania/kmroot/html_main/sitemap.xml', 'wb');
fwrite($fh, $data);
fclose($fh);