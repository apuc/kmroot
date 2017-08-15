<?php
error_reporting(-1);

require dirname(__FILE__) . '/config.php';
require dirname(__DIR__) . '/vendor/autoload.php';

(new \Dspbee\Core\Application(LC_APP_ROOT))->run(LC_LANGUAGE_LIST, LC_PACKAGE_LIST, LC_ROUTE_CLASS_LIST)->send();