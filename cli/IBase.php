<?php
abstract class IBase
{
    public function __construct(\mysqli $dbf, \mysqli $dbf2, \mysqli $dbt, \mysqli $dbt2)
    {
        $this->db_from = $dbf;
        $this->db_from_2 = $dbf2;
        $this->db_to = $dbt;
        $this->db_to_2 = $dbt2;
    }
    
    abstract public function run();

    /**
     * Delete all special chars and tags.
     * @param $val
     * @return string
     */
    public function clearText($val)
    {
        $val = htmlspecialchars_decode($val);
        $val = html_entity_decode($val);
        $val = str_replace('"', '&quot;', $val);
        $val = trim($val);
        return strip_tags($val);
    }

    /**
     * @param string $text
     * @param bool $removeTags
     * @return string
     */
    public function repairText($text, $removeTags = true)
    {
        $text = str_replace('*amp;', '&', $text);
        $text = str_replace('*quot;', '"', $text);
        $text = str_replace('*gt;', '>', $text);
        $text = str_replace('*lt;', '<', $text);
        $text = htmlspecialchars_decode($text);
        if ($removeTags) {
            $text = html_entity_decode($text);
            $text = strip_tags($text);
            $text = str_replace('"', '&quot;', $text);
        }
        return $this->clearSpaces($text);

    }

    /**
     * Delete multiple spaces.
     * @param string $text
     * @return string
     */
    public function clearSpaces($text)
    {
        return trim(preg_replace('/\s\s+/', ' ', $text));
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

    protected $db_from;
    protected $db_from_2;
    protected $db_to;
    protected $db_to_2;
}

class Country
{
    const RU = [
        "af" => "Афганистан",
        "al" => "Албания",
        "dz" => "Алжир",
        "as" => "американское Самоа",
        "ad" => "Андорра",
        "ao" => "Ангола",
        "ai" => "Ангилья",
        "aq" => "Антарктида",
        "ag" => "Антигуа и Барбуда",
        "ar" => "Аргентина",
        "am" => "Армения",
        "aw" => "Аруба",
        "au" => "Австралия",
        "at" => "Австрия",
        "az" => "Азербайджан",
        "bh" => "Бахрейн",
        "bs" => "Багамские острова",
        "bd" => "Бангладеш",
        "bb" => "Барбадос",
        "by" => "Беларусь",
        "be" => "Бельгия",
        "bz" => "Белиз",
        "bj" => "Бенин",
        "bm" => "Бермудские острова",
        "bt" => "Бутан",
        "bo" => "Боливия",
        "bq" => "Бонайре",
        "ba" => "Босния и Герцеговина",
        "bw" => "Ботсвана",
        "bv" => "Буве",
        "br" => "Бразилия",
        "io" => "Британская территория Индийского океана",
        "vg" => "Британские Виргинские острова",
        "bn" => "Бруней",
        "bg" => "Болгария",
        "bf" => "Буркина-Фасо",
        "bi" => "Бурунди",
        "kh" => "Камбоджа",
        "cm" => "Камерун",
        "ca" => "Канада",
        "cv" => "Кабо-Верде",
        "ky" => "Каймановы острова",
        "cf" => "ЦАР",
        "td" => "Чад",
        "cl" => "Чили",
        "cn" => "Китай",
        "cx" => "Остров Рождества",
        "cc" => "Кокосовые острова",
        "co" => "Колумбия",
        "km" => "Коморы",
        "cg" => "Республика Конго",
        "cd" => "Демократическая Республика Конго",
        "ck" => "Острова Кука",
        "cr" => "Коста-Рика",
        "ci" => "Кот-д’Ивуар",
        "hr" => "Хорватия",
        "cw" => "Кюрасао",
        "cu" => "Куба",
        "cy" => "Кипр",
        "cz" => "Чешская Республика",
        "dk" => "Дания",
        "dj" => "Джибути",
        "dm" => "Доминика",
        "do" => "Доминиканская Республика",
        "tl" => "Восточный Тимор",
        "ec" => "Эквадор",
        "eg" => "Египет",
        "sv" => "Сальвадор",
        "gq" => "Экваториальная Гвинея",
        "er" => "Эритрея",
        "ee" => "Эстония",
        "et" => "Эфиопия",
        "fk" => "Фолклендские острова",
        "fo" => "Фарерские острова",
        "fj" => "Фиджи",
        "fi" => "Финляндия",
        "fr" => "Франция",
        "gf" => "Французская Гвиана",
        "pf" => "Французская Полинезия",
        "tf" => "Французские Южные и Антарктические земли",
        "ga" => "Габон",
        "gm" => "Гамбия",
        "ge" => "Грузия",
        "de" => "Германия",
        "gh" => "Гана",
        "gi" => "Гибралтар",
        "gr" => "Греция",
        "gl" => "Гренландия",
        "gd" => "Гренада",
        "gp" => "Гваделупа",
        "gu" => "Гуам",
        "gt" => "Гватемала",
        "gg" => "Гернси",
        "gn" => "Гвинея",
        "gw" => "Гвинея-Бисау",
        "gy" => "Гайана",
        "ht" => "Гаити",
        "hm" => "Остров Херд и острова Макдональд",
        "va" => "Ватикан",
        "hn" => "Гондурас",
        "hk" => "Гонконг",
        "hu" => "Венгрия",
        "is" => "Исландия",
        "in" => "Индия",
        "id" => "Индонезия",
        "ir" => "Иран",
        "iq" => "Ирак",
        "ie" => "Ирландия",
        "im" => "Остров Мэн",
        "il" => "Израиль",
        "it" => "Италия",
        "jm" => "Ямайка",
        "jp" => "Япония",
        "jo" => "Иордания",
        "kz" => "Казахстан",
        "ke" => "Кения",
        "ki" => "Кирибати",
        "kw" => "Кувейт",
        "kg" => "Кыргызстан",
        "la" => "Лаос",
        "lv" => "Латвия",
        "lb" => "Ливан",
        "ls" => "Лесото",
        "lr" => "Либерия",
        "ly" => "Ливия",
        "li" => "Лихтенштейн",
        "lt" => "Литва",
        "lu" => "Люксембург",
        "mo" => "Макао",
        "mk" => "Македонии",
        "mg" => "Мадагаскар",
        "mw" => "Малави",
        "my" => "Малайзия",
        "mv" => "Мальдивы",
        "ml" => "Мали",
        "mt" => "Мальта",
        "mh" => "Маршалловы острова",
        "mq" => "Мартиника",
        "mr" => "Мавритания",
        "mu" => "Маврикий",
        "yt" => "Майотта",
        "mx" => "Мексика",
        "fm" => "Федеративные Штаты Микронезии",
        "mi" => "Мидуэй",
        "md" => "Молдавия",
        "mc" => "Монако",
        "mn" => "Монголия",
        "me" => "Черногория",
        "ms" => "Монсеррат",
        "ma" => "Марокко",
        "mz" => "Мозамбик",
        "mm" => "Мьянма",
        "na" => "Намибия",
        "nr" => "Науру",
        "np" => "Непал",
        "nl" => "Нидерланды",
        "an" => "Нидерландские Антильские острова",
        "nc" => "Новая Каледония",
        "nz" => "Новая Зеландия",
        "ni" => "Никарагуа",
        "ne" => "Нигер",
        "ng" => "Нигерия",
        "nu" => "Ниуэ",
        "nf" => "Норфолк",
        "kp" => "Северная Корея",
        "mp" => "Северные Марианские острова",
        "no" => "Норвегия",
        "om" => "Оман",
        "pk" => "Пакистан",
        "pw" => "Палау",
        "pa" => "Панама",
        "pg" => "Папуа - Новая Гвинея",
        "py" => "Парагвай",
        "pe" => "Перу",
        "ph" => "Филиппины",
        "pn" => "Острова Питкэрн",
        "pl" => "Польша",
        "pt" => "Португалия",
        "pr" => "Пуэрто-Рико",
        "qa" => "Катар",
        "re" => "Реюньон",
        "ro" => "Румыния",
        "ru" => "Россия",
        "rw" => "Руанда",
        "bl" => "Сен-Бартельми",
        "sh" => "Остров святой Елены",
        "kn" => "Сент-Китс и Невис",
        "lc" => "Санкт-Люсия",
        "mf" => "Сен-Мартен",
        "pm" => "Сен-Пьер и Микелон",
        "st" => "Сан-Томе и Принсипи",
        "vc" => "Святой Винсент и Гренадины",
        "ws" => "Самоа",
        "sm" => "Сан - Марино",
        "sa" => "Саудовская Аравия",
        "sn" => "Сенегал",
        "rs" => "Сербия",
        "sc" => "Сейшельские Острова",
        "sl" => "Сьерра-Леоне",
        "sg" => "Сингапур",
        "sx" => "Синт-Маартен",
        "sk" => "Словакия",
        "si" => "Словения",
        "sb" => "Соломоновы острова",
        "za" => "Южная Африка",
        "gs" => "Южная Георгия и Южные Сандвичевы острова",
        "kr" => "Южная Корея",
        "ss" => "южный Судан",
        "es" => "Испания",
        "lk" => "Шри Ланка",
        "sd" => "Судан",
        "sr" => "Суринама",
        "sj" => "Шпицберген",
        "sz" => "Свазиленд",
        "se" => "Швеция",
        "ch" => "Швейцария",
        "sy" => "Сирия",
        "tw" => "Тайвань",
        "tj" => "Таджикистан",
        "tz" => "Танзания",
        "th" => "Таиланд",
        "tg" => "Того",
        "tk" => "Токелау",
        "to" => "Тонга",
        "tt" => "Тринидад и Тобаго",
        "tn" => "Тунис",
        "tr" => "Турция",
        "tm" => "Туркменистан",
        "tc" => "Острова Теркс и Кайкос",
        "tv" => "Тувалу",
        "ug" => "Уганда",
        "ua" => "Украина",
        "us" => "США",
        "ae" => "Объединенные Арабские Эмираты",
        "uk" => "Великобритания",
        "um" => "Внешние малые острова США",
        "uy" => "Уругвай",
        "uz" => "Узбекистан",
        "vu" => "Вануату",
        "ve" => "Венесуэла",
        "vn" => "Вьетнам",
        "vi" => "Виргинские острова",
        "wf" => "Уоллис и Футуна",
        "eh" => "Западная Сахара",
        "ye" => "Йемен",
        "zm" => "Замбия",
        "zw" => "Зимбабве",
        "zr" => "Заир",
        "cs" => "Чехословакия",
        "su" => "Советский Союз СССР",
        "ia" => "Сиам",
        "yu" => "Югославия",
        "ps" => "Палестина",
        "wd" => "Западная Германия",
        "ed" => "Восточная Германия",
        "nv" => "Северный Вьетнам",
        "so" => "Сомали",
        "fy" => "Союзная Республика Югославия",
        "xk" => "Косово",
        "eo" => "Сербия и Черногория",
        "bu" => "Бирма"
    ];

    const EN = [
        "af" => "afghanistan",
        "al" => "albania",
        "dz" => "algeria",
        "as" => "american samoa",
        "ad" => "andorra",
        "ao" => "angola",
        "ai" => "anguilla",
        "aq" => "antarctica",
        "ag" => "antigua and barbuda",
        "ar" => "argentina",
        "am" => "armenia",
        "aw" => "aruba",
        "au" => "australia",
        "at" => "austria",
        "az" => "azerbaijan",
        "bh" => "bahrain",
        "bs" => "bahamas",
        "bd" => "bangladesh",
        "bb" => "barbados",
        "by" => "belarus",
        "be" => "belgium",
        "bz" => "belize",
        "bj" => "benin",
        "bm" => "bermuda",
        "bt" => "bhutan",
        "bo" => "bolivia",
        "bq" => "bonaire",
        "ba" => "bosnia and herzegovina",
        "bw" => "botswana",
        "bv" => "bouvet",
        "br" => "brazil",
        "io" => "british indian ocean territory",
        "vg" => "british virgin islands",
        "bn" => "brunei",
        "bg" => "bulgaria",
        "bf" => "burkina faso",
        "bi" => "burundi",
        "kh" => "cambodia",
        "cm" => "cameroon",
        "ca" => "canada",
        "cv" => "cape verde",
        "ky" => "cayman islands",
        "cf" => "central african republic",
        "td" => "chad",
        "cl" => "chile",
        "cn" => "china",
        "cx" => "christmas island",
        "cc" => "cocos-keeling islands",
        "co" => "colombia",
        "km" => "comoros",
        "cg" => "republic of the congo",
        "cd" => "democratic republic of the congo",
        "ck" => "cook islands",
        "cr" => "costa rica",
        "ci" => "cote d'ivoire ivory coast",
        "hr" => "croatia",
        "cw" => "curacao",
        "cu" => "cuba",
        "cy" => "cyprus",
        "cz" => "czech republic",
        "dk" => "denmark",
        "dj" => "djibouti",
        "dm" => "dominica",
        "do" => "dominican republic",
        "tl" => "east timor",
        "ec" => "ecuador",
        "eg" => "egypt",
        "sv" => "el salvador",
        "gq" => "equatorial guinea",
        "er" => "eritrea",
        "ee" => "estonia",
        "et" => "ethiopia",
        "fk" => "falkland islands",
        "fo" => "faroe islands",
        "fj" => "fiji",
        "fi" => "finland",
        "fr" => "france",
        "gf" => "french guiana",
        "pf" => "french polynesia",
        "tf" => "french southern and antarctic lands",
        "ga" => "gabon",
        "gm" => "gambia",
        "ge" => "georgia",
        "de" => "germany",
        "gh" => "ghana",
        "gi" => "gibraltar",
        "gr" => "greece",
        "gl" => "greenland",
        "gd" => "grenada",
        "gp" => "guadeloupe",
        "gu" => "guam",
        "gt" => "guatemala",
        "gg" => "guernsey",
        "gn" => "guinea",
        "gw" => "guinea-bissau",
        "gy" => "guyana",
        "ht" => "haiti",
        "hm" => "heard island and mcdonald islands",
        "va" => "holy see (vatican city)",
        "hn" => "honduras",
        "hk" => "hong kong sar china",
        "hu" => "hungary",
        "is" => "iceland",
        "in" => "india",
        "id" => "indonesia",
        "ir" => "iran",
        "iq" => "iraq",
        "ie" => "ireland",
        "im" => "isle of man",
        "il" => "israel",
        "it" => "italy",
        "jm" => "jamaica",
        "jp" => "japan",
        "jo" => "jordan",
        "kz" => "kazakhstan",
        "ke" => "kenya",
        "ki" => "kiribati",
        "kw" => "kuwait",
        "kg" => "kyrgyzstan",
        "la" => "laos",
        "lv" => "latvia",
        "lb" => "lebanon",
        "ls" => "lesotho",
        "lr" => "liberia",
        "ly" => "libya",
        "li" => "liechtenstein",
        "lt" => "lithuania",
        "lu" => "luxembourg",
        "mo" => "macau sar china",
        "mk" => "macedonia",
        "mg" => "madagascar",
        "mw" => "malawi",
        "my" => "malaysia",
        "mv" => "maldives",
        "ml" => "mali",
        "mt" => "malta",
        "mh" => "marshall islands",
        "mq" => "martinique",
        "mr" => "mauritania",
        "mu" => "mauritius",
        "yt" => "mayotte",
        "mx" => "mexico",
        "fm" => "micronesia, federated states of",
        "mi" => "midway island",
        "md" => "moldova",
        "mc" => "monaco",
        "mn" => "mongolia",
        "me" => "montenegro",
        "ms" => "montserrat",
        "ma" => "morocco",
        "mz" => "mozambique",
        "mm" => "myanmar",
        "na" => "namibia",
        "nr" => "nauru",
        "np" => "nepal",
        "nl" => "netherlands",
        "an" => "netherlands antilles",
        "nc" => "new caledonia",
        "nz" => "new zealand",
        "ni" => "nicaragua",
        "ne" => "niger",
        "ng" => "nigeria",
        "nu" => "niue",
        "nf" => "norfolk island",
        "kp" => "north korea",
        "mp" => "northern mariana islands",
        "no" => "norway",
        "om" => "oman",
        "pk" => "pakistan",
        "pw" => "palau",
        "pa" => "panama",
        "pg" => "papua new guinea",
        "py" => "paraguay",
        "pe" => "peru",
        "ph" => "philippines",
        "pn" => "pitcairn islands",
        "pl" => "poland",
        "pt" => "portugal",
        "pr" => "puerto rico",
        "qa" => "qatar",
        "re" => "reunion",
        "ro" => "romania",
        "ru" => "russia",
        "rw" => "rwanda",
        "bl" => "saint barthelemy",
        "sh" => "saint helena",
        "kn" => "saint kitts and nevis",
        "lc" => "saint lucia",
        "mf" => "saint martin",
        "pm" => "saint pierre and miquelon",
        "st" => "saint tome and principe",
        "vc" => "saint vincent and the grenadines",
        "ws" => "samoa",
        "sm" => "san marino",
        "sa" => "saudi arabia",
        "sn" => "senegal",
        "rs" => "serbia",
        "sc" => "seychelles",
        "sl" => "sierra leone",
        "sg" => "singapore",
        "sx" => "sint maarten",
        "sk" => "slovakia",
        "si" => "slovenia",
        "sb" => "solomon islands",
        "za" => "south africa",
        "gs" => "south georgia and the south sandwich islands",
        "kr" => "south korea",
        "ss" => "south sudan",
        "es" => "spain",
        "lk" => "sri lanka",
        "sd" => "sudan",
        "sr" => "suriname",
        "sj" => "svalbard",
        "sz" => "swaziland",
        "se" => "sweden",
        "ch" => "switzerland",
        "sy" => "syria",
        "tw" => "taiwan",
        "tj" => "tajikistan",
        "tz" => "tanzania",
        "th" => "thailand",
        "tg" => "togo",
        "tk" => "tokelau",
        "to" => "tonga",
        "tt" => "trinidad and tobago",
        "tn" => "tunisia",
        "tr" => "turkey",
        "tm" => "turkmenistan",
        "tc" => "turks and caicos islands",
        "tv" => "tuvalu",
        "ug" => "uganda",
        "ua" => "ukraine",
        "us" => "usa united states",
        "ae" => "united arab emirates",
        "uk" => "united kingdom",
        "um" => "united states minor outlying islands",
        "uy" => "uruguay",
        "uz" => "uzbekistan",
        "vu" => "vanuatu",
        "ve" => "venezuela",
        "vn" => "vietnam",
        "vi" => "virgin islands",
        "wf" => "wallis and futuna",
        "eh" => "western sahara",
        "ye" => "yemen",
        "zm" => "zambia",
        "zw" => "zimbabwe",
        "zr" => "zaire",
        "cs" => "czechoslovakia",
        "su" => "ssr soviet union",
        "ia" => "siam",
        "yu" => "yugoslavia",
        "ps" => "palestine",
        "wd" => "west germany",
        "ed" => "east germany",
        "nv" => "north vietnam",
        "so" => "somalia",
        "fy" => "federal republic of yugoslavia",
        "xk" => "kosovo",
        "eo" => "serbia and montenegro",
        "bu" => "burma"
    ];
}

class Genre
{
    const RU = [
        'sh' => 'короткометражный',
        'do' => 'документальный',
        'an' => 'мультфильм',
        'ro' => 'мелодрама',
        'co' => 'комедия',
        'sp' => 'спорт',
        'ne' => 'новости',
        'th' => 'триллер',
        'fa' => 'фэнтези',
        'dr' => 'драма',
        'ho' => 'ужасы',
        'bi' => 'биография',
        'wa' => 'военный',
        'we' => 'вестерн',
        'ad' => 'приключения',
        'cr' => 'криминал',
        'hi' => 'исторический',
        'ac' => 'боевик',
        'my' => 'детектив',
        'sc' => 'фантастика',
        'fm' => 'семейный',
        'mu' => 'музыка',
        'ms' => 'мюзикл',
        'fi' => 'фильм-нуар',
        'ga' => 'телеигра',
        'ta' => 'ток-шоу',
        're' => 'реалити',
        'au' => 'для взрослых (xxx)',
    ];

    const EN = [
        'sh' => 'short',
        'do' => 'documentary',
        'an' => 'animation',
        'ro' => 'romance',
        'co' => 'comedy',
        'sp' => 'sport',
        'ne' => 'news',
        'th' => 'thriller',
        'fa' => 'fantasy',
        'dr' => 'drama',
        'ho' => 'horror',
        'bi' => 'biography',
        'wa' => 'war',
        'we' => 'western',
        'ad' => 'adventure',
        'cr' => 'crime',
        'hi' => 'history',
        'ac' => 'action',
        'my' => 'mystery',
        'sc' => 'sci-fi',
        'fm' => 'family',
        'mu' => 'music',
        'ms' => 'musical',
        'fi' => 'film-noir',
        'ga' => 'game-show',
        'ta' => 'talk-show',
        're' => 'reality-tv',
        'au' => 'adult',
    ];
}