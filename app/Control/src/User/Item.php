<?php
namespace Kinomania\Control\User;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Common\TDate;

/**
 * Class Item
 * @package Kinomania\Countrol\User
 */
class Item
{
    use TDataInit;
    use TDate;

    public function __construct()
    {
        $this->id = 0;
        $this->extension = '';
        $this->login = '';
        $this->email = '';
        $this->password = '';
        $this->status = '';
        $this->name = '';
        $this->surname = '';
        $this->sex = '';
        $this->city = '';
        $this->about = '';
        $this->interest = '';
        $this->hash = '';
        $this->hashChange = '';
        $this->registration = '';
        $this->birthday = '';
        $this->vk = '';
        $this->fb = '';
        $this->ok = '';
        $this->twitter = '';
        $this->googlePlus = '';
        $this->liveJournal = '';
        $this->tg = '';
        $this->myMail = '';
        $this->instagram = '';
        $this->skype = '';
        $this->icq = '';
        $this->count_review = 0;
        $this->count_feedback = 0;
        $this->count_comment = 0;
        $this->count_rate = 0;
        $this->count_film = 0;
        $this->count_people = 0;

    }

    public function id()
    {
        return $this->id;
    }

    public function extension()
    {
        return $this->extension;
    }

    public function login()
    {
        return $this->login;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function status()
    {
        return $this->status;
    }

    public function name()
    {
        return $this->name;
    }

    public function surname()
    {
        return $this->surname;
    }

    public function sex()
    {
        return $this->sex;
    }

    public function city()
    {
        return $this->city;
    }

    public function about()
    {
        return $this->about;
    }

    public function interest()
    {
        return $this->interest;
    }

    public function hash()
    {
        return $this->hash;
    }

    public function hashChange()
    {
        return $this->hashChange;
    }

    public function registration()
    {
        return $this->formatDate($this->registration, true, ' ');
    }

    public function birthday($raw = true)
    {
        if ($raw) {
            return $this->birthday;
        } else {
            $val = explode('-', $this->birthday);
            if (3 > count($val)) {
                return '';
            }
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function vk()
    {
        return $this->vk;
    }

    public function fb()
    {
        return $this->fb;
    }

    public function ok()
    {
        return $this->ok;
    }

    public function twitter()
    {
        return $this->twitter;
    }

    public function googlePlus()
    {
        return $this->googlePlus;
    }

    public function liveJournal()
    {
        return $this->liveJournal;
    }

    public function tg()
    {
        return $this->tg;
    }

    public function myMail()
    {
        return $this->myMail;
    }

    public function instagram()
    {
        return $this->instagram;
    }

    public function skype()
    {
        return $this->skype;
    }

    public function icq()
    {
        return $this->icq;
    }

    public function count_review()
    {
        return $this->count_review;
    }

    public function count_feedback()
    {
        return $this->count_feedback;
    }

    public function count_comment()
    {
        return $this->count_comment;
    }

    public function count_rate()
    {
        return $this->count_rate;
    }

    public function count_film()
    {
        return $this->count_film;
    }

    public function count_people()
    {
        return $this->count_people;
    }

    protected $id;
    protected $extension;
    protected $login;
    protected $email;
    protected $password;
    protected $status;
    protected $name;
    protected $surname;
    protected $sex;
    protected $city;
    protected $about;
    protected $interest;
    protected $hash;
    protected $hashChange;
    protected $registration;
    protected $birthday;
    protected $vk;
    protected $fb;
    protected $ok;
    protected $twitter;
    protected $googlePlus;
    protected $liveJournal;
    protected $tg;
    protected $myMail;
    protected $instagram;
    protected $skype;
    protected $icq;
    protected $count_review;
    protected $count_feedback;
    protected $count_comment;
    protected $count_rate;
    protected $count_film;
    protected $count_people;
}