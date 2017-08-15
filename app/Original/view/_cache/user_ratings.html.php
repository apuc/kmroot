<?php
/**
 * @var string $login
 * @var string $static
 * @var array $list
 * @var array $min
 */
use Kinomania\Original\Key\User\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Оценки пользователя <?= $login ?></title>

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
                    <h2 class="name__page"><?= $min[User::NAME] ?> <?= $min[User::SURNAME] ?></h2>
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

                    <div class="list-content list-content-tile">
                        <div class="row-profile-raiting-content">
                            <div class="rating-profile">
                                <div class="rating-profile-item">
                                    <?php foreach ($list as $item): ?>
                                        <div class="rating-profile-item">
                                            <div class="section-result-content clear">
                                                <div class="section-result-item item1  list-preview">
                                                    <a href="/film/<?= $item[0] ?>/">
                                                <span>
                                                  <img class="lazy image-padding--white" data-original="<?= $item[1] ?>" src="//:0" width="88" height="130" alt="">
                                                </span>
                                                    </a>
                                                </div>
                                                <div class="section-result-item item2">
                                                    <div class="profile-cinema-heading"><?= $item[5] ?></div>
                                                    <?php if (empty($item[3])): ?>
                                                        <div class="name"><a href="/film/<?= $item[0] ?>/"><?= $item[2] ?></a></div>
                                                    <?php else: ?>
                                                        <div class="name"><a href="/film/<?= $item[0] ?>/"><?= $item[3] ?></a></div>
                                                        <div class="name__eng"><?= $item[2] ?></div>
                                                    <?php endif ?>

                                                    <div class="star-rating">
                                                        <span class="number"><?= $item[4] ?></span>
                                                        из 10
                                                    </div>
                                                    <div class="main-raiting">Общий рейтинг фильма: <span class="number">
                                                        <?php if (10 > $item[7]): ?>
                                                            _
                                                        <?php else: ?>
                                                            <?= $item[6] ?>
                                                        <?php endif ?>
                                                    </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="outer-pagelist-more">
                        <?php if (11 < count($list)): ?>
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                        <?php endif ?>
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
    var md5 = new function(){
        var l='length',
            h=[
                '0123456789abcdef',0x0F,0x80,0xFFFF,
                0x67452301,0xEFCDAB89,0x98BADCFE,0x10325476
            ],
            x=[
                [0,1,[7,12,17,22]],
                [1,5,[5, 9,14,20]],
                [5,3,[4,11,16,23]],
                [0,7,[6,10,15,21]]
            ],
            A=function(x,y,z){
                return(((x>>16)+(y>>16)+((z=(x&h[3])+(y&h[3]))>>16))<<16)|(z&h[3])
            },
            B=function(s){
                var n=((s[l]+8)>>6)+1,b=new Array(1+n*16).join('0').split('');
                for(var i=0;i<s[l];i++)b[i>>2]|=s.charCodeAt(i)<<((i%4)*8);
                return(b[i>>2]|=h[2]<<((i%4)*8),b[n*16-2]=s[l]*8,b)
            },
            R=function(n,c){return(n<<c)|(n>>>(32-c))},
            C=function(q,a,b,x,s,t){return A(R(A(A(a,q),A(x,t)),s),b)},
            F=function(a,b,c,d,x,s,t){return C((b&c)|((~b)&d),a,b,x,s,t)},
            G=function(a,b,c,d,x,s,t){return C((b&d)|(c&(~d)),a,b,x,s,t)},
            H=function(a,b,c,d,x,s,t){return C(b^c^d,a,b,x,s,t)},
            I=function(a,b,c,d,x,s,t){return C(c^(b|(~d)),a,b,x,s,t)},
            _=[F,G,H,I],
            S=(function(){
                with(Math)for(var i=0,a=[],x=pow(2,32);i<64;a[i]=floor(abs(sin(++i))*x));
                return a
            })(),
            X=function (n){
                for(var j=0,s='';j<4;j++)
                    s+=h[0].charAt((n>>(j*8+4))&h[1])+h[0].charAt((n>>(j*8))&h[1]);
                return s
            };
        return function(s){
            var $=B(''+s),a=[0,1,2,3],b=[0,3,2,1],v=[h[4],h[5],h[6],h[7]];
            for(var i,j,k,N=0,J=0,o=[].concat(v);N<$[l];N+=16,o=[].concat(v),J=0){
                for(i=0;i<4;i++)
                    for(j=0;j<4;j++)
                        for(k=0;k<4;k++,a.unshift(a.pop()))
                            v[b[k]]=_[i](
                                v[a[0]],
                                v[a[1]],
                                v[a[2]],
                                v[a[3]],
                                $[N+(((j*4+k)*x[i][1]+x[i][0])%16)],
                                x[i][2][k],
                                S[J++]
                            );
                for(i=0;i<4;i++)
                    v[i]=A(v[i],o[i]);
            };return X(v[0])+X(v[1])+X(v[2])+X(v[3]);
        }};

    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
        $("img.lazy").attr('proc', 'true');

        window.page = 1;
        $('#more').click(function(){
            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);

            $('.center-loader').show();
            $('.pagelist-more').hide();
            window.page += 1;
            var page = window.page;

            $.ajax({
                "type": "post",
                "url": "?handler=more&page=" + page,
                "success": function(data){
                    data = JSON.parse(data);

                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            var item = data[key];
                            var image = '<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/content/nof.jpg';
                            if ('' != item[2]) {
                                var name = md5(item[0]);
                                image = item[1] + '/image/file/film/' + name.slice(0, 1) + '/' + name.slice(1, 3) + '/' + name + '.88.130.' + item[2];
                            }

                            var html = '<div class="rating-profile-item">' +
                                '<div class="section-result-content clear">' +
                                '<div class="section-result-item item1  list-preview">' +
                                '<a href="/film/' + item[0] + '/">' +
                                '<span>' +
                                '<img class="lazy image-padding--white" data-original="' + image + '" src="//:0" width="88" height="130" alt="">' +
                                '</span>' +
                                '</a>' +
                                '</div>' +
                                '<div class="section-result-item item2">' +
                                '<div class="profile-cinema-heading">' + item[6] + '</div>';
                                if ('' == item[4]) {
                                    html += '<div class="name"><a href="/film/' + item[0] + '/">' + item[3] + '</a></div>';
                                } else {
                                    html += '<div class="name"><a href="/film/' + item[0] + '/">' + item[4] + '</a></div>' +
                                    '<div class="name__eng">' + item[3] + '</div>';
                                }

                                html += '<div class="star-rating">' +
                                '<span class="number">' + item[5] + '</span>' +
                                ' из 10' +
                                '</div>' +
                                '<div class="main-raiting">Общий рейтинг фильма: <span class="number">';
                                if (10 > item[8]) {
                                    html += '_';
                                } else {
                                    html += item[7];
                                }
                                html += '</span></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('.rating-profile').append(html);

                            $("img.lazy[proc!=true]").lazyload({
                                effect : "fadeIn"
                            });
                            $("img.lazy").attr('proc', 'true');
                        }
                    }

                    if (12 > data.length) {
                        $('.pagelist-more').hide();
                    } else {
                        $('.pagelist-more').show();
                    }
                },
                complete: function() {
                    me.data('requestRunning', false);
                    $('.center-loader').hide();
                }
            });
        });
    })
</script>


</body>
</html>