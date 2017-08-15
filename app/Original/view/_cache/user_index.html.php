<?php
/**
 * @var string $login
 * @var string $static
 * @var array $item
 */
use Kinomania\Original\Key\User\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Профиль пользователя <?= $login ?></title>
    <meta name="description" content="Профиль пользователя на сайте KINOMANIA.RU"/>

    <meta property="og:title" content="Профиль пользователя <?= $login ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/user/<?= $login ?>" />
    <meta property="og:description" content="Профиль пользователя на сайте KINOMANIA.RU"/>

    <?php
/**
 * @var string $static
 */
?>
    <?php if (empty($static)): ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
    <meta name="geo_locale" content="RU">
    <link rel="shortcut icon" href="<?= $static ?>/favicon.ico" type="image/png"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<?php if (!empty($static)): ?>
    <link rel="stylesheet" href="<?= $static ?>/app/css/min.css?v=1.0.3">
<?php else: ?>
    <link rel="stylesheet" href="<?= $static ?>/app/libs/bootstrap/css/bootstrap.css?v=1.0.1"/>
    <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/bx/jquery.bxslider.css?v=1.0.1" />
    <link rel="stylesheet" href="<?= $static ?>/app/css/primary.css?v=1.0.1">
    <link rel="stylesheet" href="<?= $static ?>/app/css/main.css?v=1.0.2">
    <link rel="stylesheet" href="<?= $static ?>/app/css/fix.css?v=1.0.2">
<?php endif ?>

    <script src="<?= $static ?>/app/js/jquery/jquery-1.11.3.min.js?v=1.0.1"></script>

    <!--#include virtual="/design/ssi/include" -->
    <style>
        .notifyjs-foo-base {
            opacity: 0.85;
            background: #F5F5F5;
            padding: 5px;
            border-radius: 10px;
            position: relative;
        }

        .notifyjs-foo-base .title {
            margin: 10px 0 0 10px;
            text-align: left;
            position: relative;
            top: -4px;
        }

        .notifyjs-foo-base .buttons {
            font-size: 9px;
            position: absolute;
            top: 2px;
            right: 5px;
        }

        .notifyjs-foo-base button {
            font-size: 9px;
            outline: 0;
            border: 0;
            padding: 5px !important;
            margin: 0 !important;
            width: auto !important;
        }
    </style>
</head>
<body>
  <!--#include virtual="/design/ssi/top" -->
<div class="outer">
    <div class="wrap">
        <?php
/**
 * @var string $static
 * @var string $q
 */
?>
<div class="outer-header">
    <header class="clear">
        <div class="top clear">
            <div class="outer-logo col-xl-3 col-lg-3 col-md-4 col-sm-5 col-xs-8">
                <div class="logo">
                    <a href="/" class="logo__link">
                        <img  src="<?= $static ?>/app/img/design/logo2.png" class="logo__image" alt="Киномания">
                        <span class="slogan">Это мы еще посмотрим!</span>
                    </a>
                </div>
            </div>
            <div class=" search-outer col-xl-6 col-lg-6 col-md-6 col-sm-7 col-xs-5">
                <div class="search">
                    <form method="get" action="/search" id="search_form">
                        <div class="row-search__input">
                            <input name="q" type="text" class="search__input" value="<?= $q ?? ''; ?>" autocomplete="off" placeholder="Поиск">
                            <div class="row-search-result">
                                <div class="search-input-result-content">
                                    <div class="search-loader">
                                        <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                    </div>
                                </div>
                                <div class="search-result_data">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="search__button-outer">
                            <a href="#" class="search__button button button1">Найти</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mobile-nav col-md-1 col-sm-7 col-xs-4">
                <span class="mobile-nav-button"></span>
                <div class="outer-mobile-nav default">
                    <div class="close">
                        <span href="#" class="mobile-nav-button__close">Закрыть</span>
                        <ul class="mobile-nav-list clear">
                            <li><a href="/billboard/">СМОТРЕТЬ</a>
                                <ul class="nav-list-dop">
                                    <!-- <li><a href="/billboard/">АФИША</a></li> -->
                                    <li><a href="/tv/">ТВ</a></li>
                                    <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                                    <li><a href="/article/shorts/">SHORTЫ</a></li>
                                </ul>
                            </li>
                            <li><a href="/news/">ЧИТАТЬ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/news/">НОВОСТИ</a></li>
                                    <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                                    <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                                    <!-- <li><a href="/blog/">БЛОГИ</a></li> -->
                                    <li><a href="/article/press_review/">ПРЕССА</a></li>
                                    <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                                    <!-- <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li> -->
                                    <li><a href="/article/inside/">ИНСАЙД</a></li>
                                    <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                                </ul>
                            </li>
                            <li><a href="/art/">АРТКИНОМАНИЯ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                                    <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                                    <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                                </ul>
                            </li>
                            <li><a href="/trailers/">МЕДИА</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                                    <li><a href="/posters/">ПОСТЕРЫ</a></li>
                                    <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                                    <li><a href="/photos/">ФОТО</a></li>
                                    <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                                    <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                                    <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                                </ul>
                            </li>
                            <li><a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                                    <li><a href="/top/">ПОДБОРКИ</a></li>
                                    <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="autorization-outer col-xl-3 col-lg-3 col-md-7 col-sm-12 col-xs-12">
                <div class="autorization">
                    <ul class="autorization-list authorizationContent">
                        <li><a href="/login/"><span>ВХОД</span></a></li>
                        <li><a href="/registration_/"><span>РЕГИСТРАЦИЯ</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="nav col-xl-12 clear">
            <ul class="nav-list clear">
                <li><a href="/billboard/">СМОТРЕТЬ</a>
                    <ul class="nav-list-dop">
                        <!-- <li><a href="/billboard/">АФИША</a></li> -->
                        <li><a href="/tv/">ТВ</a></li>
                        <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                        <li><a href="/article/shorts/">SHORTЫ</a></li>
                    </ul>
                </li>
                <li><a href="/news/">ЧИТАТЬ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/news/">НОВОСТИ</a></li>
                        <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                        <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                        <!-- <li><a href="/blog/">БЛОГИ</a></li> -->
                        <li><a href="/article/press_review/">ПРЕССА</a></li>
                        <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                        <!-- <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li> -->
                        <li><a href="/article/inside/">ИНСАЙД</a></li>
                        <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                    </ul>
                </li>
                <li><a href="/art/">АРТКИНОМАНИЯ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                        <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                    </ul>
                </li>
                <li><a href="/trailers/">МЕДИА</a>
                    <ul class="nav-list-dop">
                        <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                        <li><a href="/posters/">ПОСТЕРЫ</a></li>
                        <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                        <li><a href="/photos/">ФОТО</a></li>
                        <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                        <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                        <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                    </ul>
                </li>
                <li><a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                        <li><a href="/top/">ПОДБОРКИ</a></li>
                        <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                    </ul>
                </li>
            </ul>
            <div class="tablet-autorization-outer col-xl-3 col-lg-3 col-md-7 col-sm-7 col-xs-5">
                <div class="autorization">
                    <ul class="autorization-list authorizationContent">
                        <li><a href="/login/">ВХОД</a></li>
                        <li><a href="/registration_/">РЕГИСТРАЦИЯ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <div class="head-content">
                <div class="info-user">
                    <h1 class="pagetitle mini__pagetitle login__user" id="login"><?= $login ?></h1>
                    <h2 class="name__page"><?= $item[User::NAME] ?> <?= $item[User::SURNAME] ?></h2>
                </div>
                <div class="nav-content">
                    <?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $login
 * @var array $stat
 * @var bool $authProb
 */
use Kinomania\Original\Key\User\Stat;
?>
<ul class="nav-content-list clear" id="userMenu">
    <div class="mobile__select my-select">
        <span class="result">Профиль</span>
        <ul class="result-list" id="userMenuMobile">
            <li class="nav-content-item <?php if ('user/' . $login == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/">Профиль</a></li>

            <?php if (0 == $stat[Stat::REVIEW]): ?>
                <li class="nav-content-item no-active"><span>Рецензии</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/reviews' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/reviews/">Рецензии <span class="number"><?= $stat[Stat::REVIEW] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::FEEDBACK]): ?>
                <li class="nav-content-item no-active"><span>Отзывы</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/stars' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/stars/">Отзывы <span class="number"><?= $stat[Stat::FEEDBACK] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::COMMENT]): ?>
                <li class="nav-content-item no-active"><span>Комментарии</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/comments' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/comments/">Комментарии <span class="number"><?= $stat[Stat::COMMENT] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::RATE]): ?>
                <li class="nav-content-item no-active"><span>Оценки</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/ratings' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/ratings/">Оценки <span class="number"><?= $stat[Stat::RATE] ?></span></a></li>
            <?php endif ?>

            <?php if ($authProb): ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM] ?></span></a></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM_PUB] ?></span></a></li>
            <?php endif ?>
            <?php if ($authProb): ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON] ?></span></a></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON_PUB] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>

    <li class="nav-content-item <?php if ('user/' . $login == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/">Профиль</a></li>

    <?php if (0 == $stat[Stat::REVIEW]): ?>
        <li class="nav-content-item no-active"><span>Рецензии</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/reviews' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/reviews/">Рецензии <span class="number"><?= $stat[Stat::REVIEW] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::FEEDBACK]): ?>
        <li class="nav-content-item no-active"><span>Отзывы</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/stars' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/stars/">Отзывы <span class="number"><?= $stat[Stat::FEEDBACK] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::COMMENT]): ?>
        <li class="nav-content-item no-active"><span>Комментарии</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/comments' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/comments/">Комментарии <span class="number"><?= $stat[Stat::COMMENT] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::RATE]): ?>
        <li class="nav-content-item no-active"><span>Оценки</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/ratings' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/ratings/">Оценки <span class="number"><?= $stat[Stat::RATE] ?></span></a></li>
    <?php endif ?>

    <?php if ($authProb): ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM] ?></span></a></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM_PUB] ?></span></a></li>
    <?php endif ?>
    <?php if ($authProb): ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON] ?></span></a></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON_PUB] ?></span></a></li>
    <?php endif ?>
</ul>

<?php if ($authProb): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var matches = document.cookie.match(new RegExp("(?:^|; )__user__=([^;]*)"));
            matches = matches ? decodeURIComponent(matches[1]) : undefined;
            if (undefined !== matches) {
                matches = matches.split('.');
                var login = document.location.href;
                login = login.split('/');
                if (4 in login) {
                    login = login[4];
                } else {
                    login = '_';
                }
                if (matches[0] == login) {
                    if (-1 != document.location.href.indexOf(matches[0] + '/settings')) {
                        $('#userMenu').append('<li class="nav-content-item active"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                        $('#userMenuMobile').append('<li class="nav-content-item active"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                    } else {
                        $('#userMenu').append('<li class="nav-content-item"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                        $('#userMenuMobile').append('<li class="nav-content-item"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                    }
                }
            }
        });
    </script>
<?php endif ?>
        
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content profile-section-content section-content content-outercol-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="list-content">
                        <div class="user-head row-profile-item profile-item-chief">
                            <div class="user-head--left">
                                <div class="section-result-item list-preview">
                                    <a href="#login" style="cursor:default;">
                                        <span>
                                          <img class=" image-padding--white" src="<?= $item[User::IMAGE] ?>" alt="">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="user-head--right">
                                <div class="profile-item profile-item-chief">
                                    <div class="profile profile__title">ПРОФИЛЬ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::BIRTHDAY])): ?>
                                            <li class="date__user">Дата рождения: <span class="value"><?= $item[User::BIRTHDAY] ?></span></li>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::REGISTRATION])): ?>
                                            <li class="date-registration">Дата регистрации: <span class="value"><?= $item[User::REGISTRATION] ?></span></li>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::SEX])): ?>
                                            <?php if ('male' == $item[User::SEX]): ?>
                                                <li class="gender">Пол: <span class="value">мужчина</span></li>
                                            <?php else: ?>
                                                <li class="gender">Пол: <span class="value">женщина</span></li>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::CITY])): ?>
                                            <li class="city">Город: <span class="value"><?= $item[User::CITY] ?></span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <div class="profile profile__title">О СЕБЕ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::ABOUT])): ?>
                                            <li><span class="value"><?= $item[User::ABOUT] ?></span></li>
                                        <?php else :?>
                                            <li><span class="value">Информация отсутствует</span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <div class="profile profile__title">ИНТЕРЕСЫ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::INTEREST])): ?>
                                            <li><span class="value"><?= $item[User::INTEREST] ?></span></li>
                                        <?php else :?>
                                            <li><span class="value">Информация отсутствует</span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <?php if ($item[User::IS_SOCIAL]): ?>
                                        <div class="profile profile__title">СОЦСЕТИ</div>
                                        <ul class="profile-value-list profile-value-list__social pagelist-ligin__social-list">
                                            <?php if (!empty($item[User::VK])): ?>
                                                <li class="vk"><a href="//vk.com/<?= $item[User::VK] ?>/" rel="nofollow"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::FB])): ?>
                                                <li class="fb"><a href="//facebook.com/profile.php?id=<?= $item[User::FB] ?>/"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::TWITTER])): ?>
                                                <li class="tw"><a href="//twitter.com/<?= $item[User::TWITTER] ?>/" rel="nofollow"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::MY_MAIL])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::MY_MAIL] ?>/" rel="nofollow"><img src="/app/img/icon-socials/mailru.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::INSTAGRAM])): ?>
                                                <li class="tw"><a href="//instagram.com/<?= $item[User::INSTAGRAM] ?>/" rel="nofollow"><img src="/app/img/icon-socials/instagram.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::TG])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::TG] ?>/" rel="nofollow"><img src="/app/img/icon-socials/telegram.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::GOOGLE_PLUS])): ?>
                                                <li><a href="//plus.google.com/u/0/<?= $item[User::GOOGLE_PLUS] ?>/" rel="nofollow"><img src="/app/img/icon-socials/g-plus.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::LIVE_JOURNAL])): ?>
                                                <li class="tw"><a href="//<?= $item[User::LIVE_JOURNAL] ?>.livejournal.com/" rel="nofollow"><img src="/app/img/icon-socials/lg.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::ICQ])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::ICQ] ?>/" rel="nofollow"><img src="/app/img/icon-socials/icq.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::OK])): ?>
                                                <li class="tw"><a href="//ok.ru/profile/<?= $item[User::OK] ?>/" rel="nofollow"><img src="/app/img/icon-socials/ok.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::SKYPE])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::SKYPE] ?>/" rel="nofollow"><img src="/app/img/icon-socials/skype.png"></a></li>
                                            <?php endif ?>
                                        </ul>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="blog">

                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="comment">

                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="vote">

                        </div>
                        <div class="pagelist-social profile-pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="user/<?= $login ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="user/<?= $login ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>/"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </content>
                <aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside-branding no-mobile">
              <!--#include virtual="/design/ssi/right_top" -->
        </div>
        <div class="aside">
            <div class="inner-aside inner-aside-billboards">
                <div class="aside-item ">
                    <!--#include virtual="/index/ssi/new" -->
                </div>
                <div class="aside-item leaders no-mobile">
                    <!--#include virtual="/index/ssi/boxoffice" -->
                </div>
            </div>
        </div>
        <div class="dop-aside no-mobile">
            <div class=" outer-aside-treilers">
                <div class="dop-aside__treilers">
                    <!--#include virtual="/index/ssi/popular" -->
                </div>
            </div>
            <div class="dop-aside__item outer-dop-aside__banner">
                <div class="dop-aside__banner">
                      <!--#include virtual="/design/ssi/right_bottom" -->
                </div>
            </div>
        </div>
    </div>
</aside>
            </section>
        </div>
    </div>
</div>
<?php
/**
 * @var string $static
 */
?>
<div class="footer">
    <div class="wrap">
        <div class="inner-footer">
            <a href="/casting/" class="footer-sticker button button2">КАСТИНГ-БАЗА</a>
            <div class="copy-paste">ИСПОЛЬЗОВАНИЕ МАТЕРИАЛОВ САЙТА ВОЗМОЖНО ТОЛЬКО С РАЗРЕШЕНИЯ РЕДАКЦИИ. ГИПЕРССЫЛКА НА САЙТ ОБЯЗАТЕЛЬНА</div>
            <div class="mail"><a href="mailto:INFO@KINOMANIA.RU/">INFO@KINOMANIA.RU</a></div>
            <div class="footer-nav">
                <div class="outer-footer-nav-list">
                    <a href="/billboard/">СМОТРЕТЬ</a>
                    <ul class="footer-nav-list">
                        <!--<li><a href="/billboard/">АФИША</a></li>-->
                        <li><a href="/tv/">ТВ</a></li>
                        <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                        <li><a href="/article/shorts/">SHORTЫ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/news/">ЧИТАТЬ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/news/">НОВОСТИ</a></li>
                        <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                        <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                        <li><a href="/blog/">БЛОГИ</a></li>
                        <li><a href="/article/press_review/">ПРЕССА</a></li>
                        <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/art/">АРТКИНОМАНИЯ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                        <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/trailers/">МЕДИА</a>
                    <ul class="footer-nav-list">
                        <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                        <li><a href="/posters/">ПОСТЕРЫ</a></li>
                        <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                        <li><a href="/photos/">ФОТО</a></li>
                        <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                        <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                        <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                        <li><a href="/top/">ПОДБОРКИ</a></li>
                        <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                    </ul>
                </div>
            </div>
            <div class="outer-social clear">
                <ul class="social-list social-list--horizontal">
                    <li class="vk" id="vk_main_share"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2F/"><span class="number"></span></a></li>
                    <li class="fb" id="fb_main_share"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2F&t=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU&src=sp/"><span class="number"></span></a></li>
                    <li class="ok" id="ok_main_share"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2F&st.comments=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span class="number"></span></a></li>
                    <li class="pinterest" id="pt_main_share"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2F&description=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span class="number"></span></a></li>
                </ul>
            </div>
            <div class="copyright">© KINOMANIA.RU, 2000—2017</div>
            <div class="metrica">
                <script type="text/javascript">
                    document.write('<a href="http://www.liveinternet.ru/click" '+
                        'target=_blank><img src="http://counter.yadro.ru/hit?t20.3;r'+
                        escape(document.referrer)+((typeof(screen)=='undefined')?'':
                        ';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
                            screen.colorDepth:screen.pixelDepth))+';u'+escape(document.URL)+
                        ';'+Math.random()+
                        '" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодн\я" '+
                        'border=0 width=88 height=31></a>')
                </script>
            </div>
            <div class="planeta-inform"><a href="http://planeta-inform.tv//"><img alt="planeta inform" src="<?= $static ?>/app/img/icon/pi.png"></a></div>
        </div>
    </div>
</div>

<?php if (!empty($static)): ?>
    <noindex>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-34377221-1']);
            _gaq.push(['_setDomainName', 'kinomania.ru']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter36442360 = new Ya.Metrika({
                            id:36442360,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/36442360" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=n9YDAoQsS3qBs6nctL6/sKpAaXKqQUmWz2JpHbOhtVW5rhWj77lg8BM5v*ca1XNVEO*m9p9V91MVojo7t33gipPfdZYKcFC7OkNTn2ZZigqziiN0VdNuzic/Oypu7aH8tm72z7WYCQ0R9MPyR9F6pCDJnljbiMycdpE1KHtxV6I-';</script>
        

        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '130228840716894');
            fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=130228840716894&ev=PageView&noscript=1"/></noscript>


        <script language="JavaScript" type="text/javascript">
            //<!--
            d=document;var a='';a+=';r='+escape(d.referrer)
            js=10//-->
        </script>
        <script language="JavaScript1.1" type="text/javascript">//<!--
            a+=';j='+navigator.javaEnabled()
            js=11//-->
        </script>
        <script language="JavaScript1.2" type="text/javascript">//<!--
            s=screen;a+=';s='+s.width+'*'+s.height
            a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth)
            js=12//-->
        </script>
        <script language="JavaScript1.3" type="text/javascript">//<!--
            js=13//-->
        </script>
        <script language="JavaScript" type="text/javascript">//<!--
            d.write('<a href="http://top.mail.ru/jump?from=94147"'+
                ' target=_top><img src="http://df.c6.b1.a0.top.list.ru/counter'+
                '?id=94147;t=51;js='+js+a+';rand='+Math.random()+
                '" alt="Рейтинг@Mail.ru"'+' border=0 height=31 width=88/><\/a>')
            //if(11<js)d.write('<'+'!-- ')//-->
        </script>
    </noindex>
<?php endif ?>

<?php
/**
 * @var string $static
 */
?>
<!-- bxSlider Javascript file -->
<script src="<?= $static ?>/app/js/plugins/bx/jquery.bxslider.js?v=1.0.2"></script>
<script type="text/javascript" src="<?= $static ?>/app/js/main.js?v=1.0.2"></script>

<script>
    $(document).ready(function(){
        $('.search__button').click(function(e){
            e = e || window.event;
            e.preventDefault();

            $(this).parent().parent().submit();

            return false;
        });

        var matches = document.cookie.match(new RegExp("(?:^|; )__user__=([^;]*)"));
        matches = matches ? decodeURIComponent(matches[1]) : undefined;
        if (undefined !== matches) {
            matches = matches.split('.');
            $('.authorizationContent').
            html('').
            append('<li><a href="/user/' + matches[0] + '/"><span>' + matches[0] + '</span></a></li>').
            append('<li><a href="/logout"><span>ВЫХОД</span></a></li>');
        }

        /**
         * Social
         */
        var url = '';
        VK = {};
        VK.Share = {};
        if ($('#vk_in_share').length) {
            $('#vk_in_share span').text('0');
            VK.Share.count = function(index, count){
                $('#vk_in_share span').text(count);
            };
            url = $('#vk_in_share').attr('data-url');
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/' + url + '&format=json&callback=?');

            setTimeout(function(){
                VK.Share.count = function (index, count) {
                    $('#vk_main_share span').text(count);
                };
                $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/&format=json&callback=?');
            }, 1000);
        } else {
            VK.Share.count = function (index, count) {
                $('#vk_main_share span').text(count);
            };
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/&format=json&callback=?');
        }

        if ($('#fb_in_share').length) {
            url = $('#fb_in_share').attr('data-url');
            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/' + url + '&callback=?', function(data) {
                if ('undefined' == typeof data.share) {
                    data.share = {};
                    data.share.share_count = 0;
                }
                $('#fb_in_share span').text(data.share.share_count);
            });

            setTimeout(function(){
                $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/&callback=?', function (data) {
                    if ('undefined' == typeof data.share) {
                        data.share = {};
                        data.share.share_count = 0;
                    }
                    $('#fb_main_share span').text(data.share.share_count);
                });
            }, 700);
        } else {
            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/&callback=?', function (data) {
                if ('undefined' == typeof data.share) {
                    data.share = {};
                    data.share.share_count = 0;
                }
                $('#fb_main_share span').text(data.share.share_count);
            });
        }

        ODKL = {};
        ODKL.updateCountOC = function (a, count) {
            $('#ok_main_share span').text(count);
        };
        $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=http://www.kinomania.ru/&callback=?');

        $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=http://www.kinomania.ru/&callback=?', function(data) {
            $('#pt_main_share span').text(data.count);
        });
    });
</script>

  <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    $.notify.addStyle('foo', {
        html:
        "<div>" +
        "<div class='clearfix'>" +
        "<div class='title' data-notify-html='title'/>" +
        "<div class='buttons'>" +
        "<button class='no'>x</button>" +
        "</div>" +
        "</div>" +
        "</div>"
    });
    $(document).on('click', '.notifyjs-foo-base .no', function() {
        $(this).trigger('notify-hide');
    });

    $(document).ready(function(){
        $('.tooltip').click(function(e){
            e = e || window.event;
            e.preventDefault();

            $(this).notify({title: $(this).attr('href')}, {
                position: "top",
                autoHide: false,
                clickToHide: false,
                style: 'foo'
            });

            return false;
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getBlog",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html = '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">БЛОГ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '  <div class="row-profile-item-content">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html += '<div class="profile-post-item">  '  +
                                '     <a href="/article/' + data[k]['id'] + '/" class="profile-post-item__title">' + data[k]['title'] + '</a>  '  +
                                '     <div class="profile-post-item__content">' + data[k]['anons'] + '</div>  '  +
                                '     <div class="profile-post-item__date">  '  +
                                '   	<div class="pagelist-info">  '  +
                                '   	  <span class="date__month">' + data[k]['publish'] + '</span>  '  +
                                '   	  <a href="/article/' + data[k]['id'] + '#commentList/" class="pagelist__comments">' + data[k]['comment'] + '</a>  '  +
                                '   	</div>  '  +
                                '     </div>  '  +
                                '     <div class="">  '  +
                                '   	<a href="/article/' + data[k]['id'] + '/" class="pagelist__link">Подробнее</a>  '  +
                                '     </div>  '  +
                                '  </div>';
                        }
                    }

                    html += '<div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/blog/' + data[0]['authorId'] + '/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '  </div>  ';

                    $('#blog').append(html);
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getComment",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html = '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">КОММЕНТАРИИ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '   <div class="row-profile-item-content">  '  +
                        '  <div class="profile-comments profile-section-item">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html += '<div class="profile-comments__item clear">  '  +
                                '   	<div class="profile-comment-preview profile-comment--left">  '  +
                                '   	  <div class="profile-comment-heading">К ' + data[k]['type'] + '</div>  '  +
                                '   	  <a href="' + data[k]['link'] + '#comment_' + data[k]['id'] + '/"><img src="//:0" data-original="' + data[k]['image'] + '" class="lazy profile-comment-image"></a>  '  +
                                '   	  <div class="profile-comment-title">  '  +
                                '   		<a href="' + data[k]['link'] + '#comment_' + data[k]['id'] + '/">' + data[k]['title'] + '</a>  '  +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '   	<div class="profile-comment-content profile-comment--right">  '  +
                                '   	  <div class="profile-comment-heading">' + data[k]['date'] + '</div>  '  +
                                '   	  <div class="profile-comment-value">  '  +
                                data[k]['text'] +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '    </div>';
                        }
                    }

                    html += '</div>  '  +
                        '   <div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/user/<?= $login ?>/comments/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '   </div>';
                    $('#comment').append(html);

                    $("img.lazy").lazyload({
                        effect : "fadeIn"
                    });
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getVote",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html =  '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">ОЦЕНКИ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '   <div class="row-profile-item-content">  '  +
                        '  <div class="rating-profile profile-section-item">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html +=  '<div class="rating-profile-item">  '  +
                                '   	<div class="section-result-content clear">  '  +
                                '   	  <div class="section-result-item item1  list-preview">  '  +
                                '   		<a href="/film/' + data[k]['id'] + '/">  '  +
                                '   		  <span>  '  +
                                '   			<img class="lazy image-padding--white" src="//:0" data-original="' + data[k]['image'] + '">  '  +
                                '   		  </span>  '  +
                                '   		</a>  '  +
                                '   	  </div>  '  +
                                '   	  <div class="section-result-item item2">  '  +
                                '   		<div class="profile-cinema-heading">' + data[k]['date'] + '</div>  '  +
                                '   		<div class="name"><a href="/film/' + data[k]['id'] + '/">' + data[k]['name_ru'] + '</a></div>  '  +
                                '   		<div class="name__eng">' + data[k]['name_origin'] + '</div>  '  +
                                '   		<div class="star-rating">  '  +
                                '   		  <span class="number">' + data[k]['rate'] + '</span>  '  +
                                '   		  из 10  '  +
                                '   		</div>  '  +
                                '   		<div class="main-raiting">Общий рейтинг фильма: <span class="number">' + data[k]['average'] + '</span></div>  '  +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '    </div>';
                        }
                    }

                    html +=  '</div>  '  +
                        '   <div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/user/<?= $login ?>/ratings/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '  </div>  ';
                    $('#vote').append(html);

                    $("img.lazy").lazyload({
                        effect : "fadeIn"
                    });
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });
    });
</script>
</body>
</html>
