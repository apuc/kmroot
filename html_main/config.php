<?php
/**
 * Path to the app directory.
 */
define('LC_APP_ROOT', dirname(__DIR__) . '/app/');

/**
 * Array of the language codes. First item is default language.
 */
define('LC_LANGUAGE_LIST', []);

/**
 * Array of the packages.
 */
define('LC_PACKAGE_LIST', []);

/**
 * Custom route class for the package.
 */
define('LC_ROUTE_CLASS_LIST', [
    'Original' => 'CustomRoute'
]);


define("FREQ_THRESHOLD", 40);
define("SUGGEST_DEBUG", 0);
define("LENGTH_THRESHOLD", 2);
define("LEVENSHTEIN_THRESHOLD", 2);
define("TOP_COUNT", 1);
define("SPHINX_20", false);