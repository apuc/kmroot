<?php
namespace Kinomania\System\Social;

use Kinomania\System\Text\TText;

/**
 * Get user ID's from different social networks.
 * Class Filter
 * @package Kinomania\System\Social
 */
class Filter
{
    use TText;

    /**
     * Filter constructor.
     */
    public function __construct()
    {

    }

    /**
     * Filter liveInternet.
     * @param string $val
     * @return string
     */
    public function li($val)
    {
        $liveInternet = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $liveInternet) {
            $liveInternet = $this->repairText($val);
            if (!empty($liveInternet)) {
                $liveInternet = preg_replace("/[^A-Za-z0-9]/", '', $liveInternet);
            }
        } else {
            $partList = parse_url($liveInternet);
            if (false === $partList) {
                $liveInternet = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'livejournal.')) {
                    $liveInternet = explode('/users/', $liveInternet);
                    $liveInternet = $liveInternet[1] ?? '';
                    $liveInternet = explode('/', $liveInternet);
                    $liveInternet = $liveInternet[0];
                } else {
                    $liveInternet = '';
                }
            }
        }
        $liveInternet = trim($liveInternet, '/');

        return $liveInternet;
    }

    /**
     * Filter liveJournal.
     * @param string $val
     * @return string
     */
    public function lj($val)
    {
        $liveJournal = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $liveJournal) {
            $liveJournal = $this->repairText($val);
            if (!empty($liveJournal)) {
                $liveJournal = preg_replace("/[^A-Za-z0-9]/", '', $liveJournal);
                $liveJournal = explode('.', $liveJournal);
                $liveJournal = $liveJournal[0];
            }
        } else {
            $partList = parse_url($liveJournal);
            if (false === $partList) {
                $liveJournal = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'livejournal.')) {
                    $liveJournal = explode('.', $host);
                    $liveJournal = $liveJournal[0];
                } else {
                    $liveJournal = '';
                }
            }
        }
        $liveJournal = trim($liveJournal, '/');

        return $liveJournal;
    }

    /**
     * Filter googlePlus.
     * @param string $val
     * @return string
     */
    public function gp($val)
    {
        $googlePlus = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $googlePlus) {
            $googlePlus = $this->repairText($val);
            if (!empty($googlePlus)) {
                $googlePlus = preg_replace("/[^0-9]/", '', $googlePlus);
            }
        } else {
            $partList = parse_url($googlePlus);
            if (false === $partList) {
                $googlePlus = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'google.')) {
                    if (false !== strpos($googlePlus, '/u/0/')) {
                        $googlePlus = explode('/u/0/', $googlePlus);
                        $googlePlus = $googlePlus[1] ?? '';
                    } else {
                        $googlePlus = $partList['path'] ?? '';
                        $googlePlus = explode('/', $googlePlus);
                        $googlePlus = $googlePlus[1] ?? $googlePlus[0];
                    }
                    $googlePlus = explode('/', $googlePlus);
                    $googlePlus = $googlePlus[0];
                } else {
                    $googlePlus = '';
                }
            }
        }
        $googlePlus = trim($googlePlus, '/');

        return $googlePlus;
    }

    /**
     * Filter twitter.
     * @param string $val
     * @return string
     */
    public function tw($val)
    {
        $twitter = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $twitter) {
            $twitter = $this->repairText($val);
            if (!empty($twitter)) {
                $twitter = preg_replace("/[^A-Za-z0-9]/", '', $twitter);
            }
        } else {
            $partList = parse_url($twitter);
            if (false === $partList) {
                $twitter = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'twitter.')) {
                    $twitter = $partList['path'] ?? '';
                } else {
                    $twitter = '';
                }
            }
        }
        $twitter = trim($twitter, '/');

        return $twitter;
    }

    /**
     * Filter instagram.
     * @param string $val
     * @return string
     */
    public function instagram($val)
    {
        $twitter = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $twitter) {
            $twitter = $this->repairText($val);
            if (!empty($twitter)) {
                $twitter = preg_replace("/[^A-Za-z0-9]/", '', $twitter);
            }
        } else {
            $partList = parse_url($twitter);
            if (false === $partList) {
                $twitter = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'instagram.')) {
                    $twitter = $partList['path'] ?? '';
                } else {
                    $twitter = '';
                }
            }
        }
        $twitter = trim($twitter, '/');

        return $twitter;
    }

    /**
     * Filter odnoklassniki.
     * @param string $val
     * @return string
     */
    public function ok($val)
    {
        $ok = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $ok) {
            $ok = $this->repairText($val);
            if (!empty($ok)) {
                $ok = preg_replace("/[^A-Za-z0-9]/", '', $ok);
            }
        } else {
            $partList = parse_url($ok);
            if (false === $partList) {
                $ok = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'ok.') || false !== strpos($host, 'odnoklassniki.')) {
                    $ok = $partList['path'] ?? '';
                    if (false !== stripos($ok, '/profile/')) {
                        $ok = explode('/profile/', $ok);
                        $ok = $ok[1] ?? $ok[0];
                        $ok = explode('/', $ok);
                        $ok = $ok[0];
                    } else {
                        $ok = explode('/user/', $ok);
                        $ok = $ok[1] ?? $ok[0];
                        $ok = explode('/', $ok);
                        $ok = $ok[0];
                    }
                } else {
                    $ok = '';
                }
            }
        }
        $ok = trim($ok, '/');

        return $ok;
    }

    /**
     * Filter facebook.
     * @param string $val
     * @return string
     */
    public function fb($val)
    {
        $fb = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $fb) {
            $fb = $this->repairText($val);
            if (!empty($fb)) {
                if (false !== strpos($fb, 'id=')) {
                    $fb = explode('id=', $fb);
                    $fb = $fb[1] ?? '';
                    $fb = explode('&', $fb)[0];
                    $fb = 'id=' . $fb;
                } else {
                    $fb = preg_replace("/[^A-Za-z0-9]/", '', $fb);
                }
            }
        } else {
            $partList = parse_url($fb);
            if (false === $partList) {
                $fb = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'fb.') || false !== strpos($host, 'facebook.')) {
                    $query = $partList['query'] ?? '';
                    if (false !== strpos($query, 'id=')) {
                        $fb = explode('id=', $fb);
                        $fb = $fb[1] ?? '';
                        $fb = explode('&', $fb)[0];
                        $fb = 'id=' . $fb;
                    } else {
                        $fb = $partList['path'] ?? '';
                        $fb = explode('/', $fb);
                        $fb = $fb[1] ?? $fb[0];
                    }
                } else {
                    $fb = '';
                }
            }
        }
        $fb = trim($fb, '/');

        return $fb;
    }

    /**
     * Filter vkontakte.
     * @param string $val
     * @return string
     */
    public function vk($val)
    {
        $vk = filter_var($val, FILTER_VALIDATE_URL);
        if (false === $vk) {
            $vk = $this->repairText($val);
            if (!empty($vk)) {
                if (false !== strpos('id', $vk)) {
                    $vk = explode('?', $vk);
                    $vk = $vk[0];
                } else if (0 != intval($vk)) {
                    $vk = 'id' . $vk;
                } else {
                    $vk = preg_replace("/[^A-Za-z0-9]/", '', $vk);
                }
            }
        } else {
            $partList = parse_url($vk);
            if (false === $partList) {
                $vk = '';
            } else {
                $host = $partList['host'] ?? '';
                if (false !== strpos($host, 'vk.') || false !== strpos($host, 'vkontakte.')) {
                    $query = $partList['query'] ?? '';
                    if (false !== strpos($query, 'id=')) {
                        $vk = explode('id=', $vk);
                        $vk = $vk[1] ?? '';
                        $vk = explode('&', $vk);
                        $vk = 'id' . $vk[0];
                    } else {
                        $vk = $partList['path'] ?? '';
                        $vk = explode('/', $vk);
                        $vk = $vk[1] ?? $vk[0];
                    }
                } else {
                    $vk = '';
                }
            }
        }
        $vk = trim($vk, '/');
        $vk = str_replace('id ', 'id', $vk);

        return $vk;
    }
}