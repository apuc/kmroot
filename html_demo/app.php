<?php
/**
 * Report all PHP errors.
 */
error_reporting(-1);
ini_set('display_errors', 0);
ob_implicit_flush(false);

require dirname(__FILE__) . '/config.php';
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Enable debug mode.
 */
\Dspbee\Bundle\Debug\Wrap::$debugEnabled = true;
\Dspbee\Bundle\Debug\Wrap::register();

try {
    (new \Dspbee\Core\Application(LC_APP_ROOT))->run(LC_LANGUAGE_LIST, LC_PACKAGE_LIST, LC_ROUTE_CLASS_LIST)->send();
} catch (Throwable $e) {
    \Dspbee\Bundle\Debug\Wrap::handleException($e);
}