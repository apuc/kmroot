<?php
namespace Kinomania\System\Common;

use Dspbee\Bundle\Common\Bag\ServerBag;
use Dspbee\Bundle\Database\MySQL;
use Dspbee\Core\Storage;
use \Dspbee\Bundle\Debug\Wrap;

/**
 * Class TRepository
 * @package Kinomania\System\Common
 */
trait TRepository
{
    /**
     * Connection to the MySQL database.
     *
     * @return \mysqli|null
     */
    public function mysql()
    {
        if (null === Storage::get('mysql')) {
            $mysql = new MySQL('127.0.0.1', 'root', '', 'kmmain');
            $mysql->setTimezone();
            Storage::set('mysql', $mysql->connect());
        }
        return Storage::get('mysql');
    }

    /**
     * Connect to the sphinx.
     * 
     * @return \mysqli|null
     */
    public function sphinx()
    {
        if (null === Storage::get('sphinx')) {
            $mysql = new \mysqli('', '', '', '', 9306);
            if (!$mysql->connect_error) {
                Storage::set('sphinx', $mysql);
            }
        }
        return Storage::get('sphinx');
    }
    
    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $text
     * @return bool|int
     */
    public function sendEmail($from, $to, $subject, $text)
    {
        $server = new ServerBag();
        $host = $server->fetch('HOST');

        try {
            if (Wrap::$debugEnabled) {
                $transport = \Swift_MailTransport::newInstance();
            } else {
                $transport = \Swift_SmtpTransport::newInstance('ssl://')
                    ->setUsername('')
                    ->setPassword('');
            }
            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom([$from => $host])
                ->setTo([$to => ''])
                ->setBody($text, 'text/html')
                ->setEncoder(\Swift_Encoding::getBase64Encoding());

            return $mailer->send($message);
        } catch (\Exception $e) {
            return false;
        }
    }
}
