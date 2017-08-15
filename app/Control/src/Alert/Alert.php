<?php
/**
 * @license MIT
 * @author Igor Sorokin <dspbee@pivasic.com>
 */
namespace Dspbee\Control\Alert;

/**
 * Save message to the cookie.
 *
 * Class Alert
 * @package Dspbee\System\Alert
 */
abstract class Alert
{
    /**
     * Alert constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        if (!headers_sent()) {
            setcookie('__alert__', $message . '|' . $this->color, time() + 3600 * 24 * 30, '/');
        }
    }

    protected $color;
}