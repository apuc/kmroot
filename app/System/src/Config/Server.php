<?php
namespace Kinomania\System\Config;

/**
 * Class Server
 * @package Kinomania\Sysytem\Config
 */
class Server
{
    const STATIC_CURRENT = 0;
    const STATIC = [ // list of servers
        '//fs.kinomania.ru',
    ];

    const MEDIA_CURRENT = 0;
    const MEDIA = [ // list of servers
        '//fs.kinomania.ru',
        '//',
        '//',
        '//',
        '//',
        '//media3.kinomania.ru',
    ];

    const MAIN = '//kinomania.ru/';
    const DEMO = '//fe.kinomania.ru/';
}