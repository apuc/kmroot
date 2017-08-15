<?php
/**
 * Report all PHP errors.
 */
error_reporting(-1);
ini_set('display_errors', 0);
ob_implicit_flush(false);

require dirname(__FILE__) . '/config.php';
require dirname(__DIR__) . '/vendor/autoload.php';

(new \Dspbee\Core\Application(LC_APP_ROOT));
class Run {
    use \Kinomania\System\Common\TRepository;
    
    public function __construct()
    {
        $tv = new Kinomania\Control\Tv\Tv($this->mysql());
        $tv->parse();
    }
}
new Run();