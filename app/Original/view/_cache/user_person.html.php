<?php
/**
 * @var string $login
 * @var string $static
 */
use Kinomania\Original\Key\User\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Актёры пользователя <?= $login ?></title>

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
        .list-tile-item {
            min-height: 250px;
        }
        .trash:before {
            background: url(<?= $static ?>/app/img/icon/trash.png) 0 0 no-repeat !important;
        }
    </style>
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
                    <h2 class="name__page"></h2>
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
                        <div class="row-list-tile clear" id="folderContent">
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader-2">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <br />   <br />
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text" style="display: none;"><span class="pagelist-more__text" id="more">Еще</span></span>
                    </div>
                </content>
                <?php
/**
 * @var string $login
 */
?>
<aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside">
            <div class="inner-aside inner-aside-billboards">
                <div class="aside-item">
                    <div class="aside__title" id="collectionTitle">КОЛЛЕКЦИИ <?= $login ?></div>
                    <div class="row-select-folder">
                        <ul class="select-folder-list" id="userFolderList">
                            <div class="center-loader" style="margin-top: 10px;">
                                <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                <br />
                            </div>
                        </ul>
                    </div>
                </div>
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>

<script type="text/javascript">
    (function(e){typeof define=="function"&&define.amd?define(["jquery"],e):typeof module=="object"&&module.exports?module.exports=function(t,n){return n===undefined&&(typeof window!="undefined"?n=require("jquery"):n=require("jquery")(t)),e(n),n}:e(jQuery)})(function(e){function A(t,n,i){typeof i=="string"&&(i={className:i}),this.options=E(w,e.isPlainObject(i)?i:{}),this.loadHTML(),this.wrapper=e(h.html),this.options.clickToHide&&this.wrapper.addClass(r+"-hidable"),this.wrapper.data(r,this),this.arrow=this.wrapper.find("."+r+"-arrow"),this.container=this.wrapper.find("."+r+"-container"),this.container.append(this.userContainer),t&&t.length&&(this.elementType=t.attr("type"),this.originalElement=t,this.elem=N(t),this.elem.data(r,this),this.elem.before(this.wrapper)),this.container.hide(),this.run(n)}var t=[].indexOf||function(e){for(var t=0,n=this.length;t<n;t++)if(t in this&&this[t]===e)return t;return-1},n="notify",r=n+"js",i=n+"!blank",s={t:"top",m:"middle",b:"bottom",l:"left",c:"center",r:"right"},o=["l","c","r"],u=["t","m","b"],a=["t","b","l","r"],f={t:"b",m:null,b:"t",l:"r",c:null,r:"l"},l=function(t){var n;return n=[],e.each(t.split(/\W+/),function(e,t){var r;r=t.toLowerCase().charAt(0);if(s[r])return n.push(r)}),n},c={},h={name:"core",html:'<div class="'+r+'-wrapper">\n	<div class="'+r+'-arrow"></div>\n	<div class="'+r+'-container"></div>\n</div>',css:"."+r+"-corner {\n	position: fixed;\n	margin: 5px;\n	z-index: 1050;\n}\n\n."+r+"-corner ."+r+"-wrapper,\n."+r+"-corner ."+r+"-container {\n	position: relative;\n	display: block;\n	height: inherit;\n	width: inherit;\n	margin: 3px;\n}\n\n."+r+"-wrapper {\n	z-index: 1;\n	position: absolute;\n	display: inline-block;\n	height: 0;\n	width: 0;\n}\n\n."+r+"-container {\n	display: none;\n	z-index: 1;\n	position: absolute;\n}\n\n."+r+"-hidable {\n	cursor: pointer;\n}\n\n[data-notify-text],[data-notify-html] {\n	position: relative;\n}\n\n."+r+"-arrow {\n	position: absolute;\n	z-index: 2;\n	width: 0;\n	height: 0;\n}"},p={"border-radius":["-webkit-","-moz-"]},d=function(e){return c[e]},v=function(e){if(!e)throw"Missing Style name";c[e]&&delete c[e]},m=function(t,i){if(!t)throw"Missing Style name";if(!i)throw"Missing Style definition";if(!i.html)throw"Missing Style HTML";var s=c[t];s&&s.cssElem&&(window.console&&console.warn(n+": overwriting style '"+t+"'"),c[t].cssElem.remove()),i.name=t,c[t]=i;var o="";i.classes&&e.each(i.classes,function(t,n){return o+="."+r+"-"+i.name+"-"+t+" {\n",e.each(n,function(t,n){return p[t]&&e.each(p[t],function(e,r){return o+="	"+r+t+": "+n+";\n"}),o+="	"+t+": "+n+";\n"}),o+="}\n"}),i.css&&(o+="/* styles for "+i.name+" */\n"+i.css),o&&(i.cssElem=g(o),i.cssElem.attr("id","notify-"+i.name));var u={},a=e(i.html);y("html",a,u),y("text",a,u),i.fields=u},g=function(t){var n,r,i;r=x("style"),r.attr("type","text/css"),e("head").append(r);try{r.html(t)}catch(s){r[0].styleSheet.cssText=t}return r},y=function(t,n,r){var s;return t!=="html"&&(t="text"),s="data-notify-"+t,b(n,"["+s+"]").each(function(){var n;n=e(this).attr(s),n||(n=i),r[n]=t})},b=function(e,t){return e.is(t)?e:e.find(t)},w={clickToHide:!0,autoHide:!0,autoHideDelay:5e3,arrowShow:!0,arrowSize:5,breakNewLines:!0,elementPosition:"bottom",globalPosition:"top right",style:"bootstrap",className:"error",showAnimation:"slideDown",showDuration:400,hideAnimation:"slideUp",hideDuration:200,gap:5},E=function(t,n){var r;return r=function(){},r.prototype=t,e.extend(!0,new r,n)},S=function(t){return e.extend(w,t)},x=function(t){return e("<"+t+"></"+t+">")},T={},N=function(t){var n;return t.is("[type=radio]")&&(n=t.parents("form:first").find("[type=radio]").filter(function(n,r){return e(r).attr("name")===t.attr("name")}),t=n.first()),t},C=function(e,t,n){var r,i;if(typeof n=="string")n=parseInt(n,10);else if(typeof n!="number")return;if(isNaN(n))return;return r=s[f[t.charAt(0)]],i=t,e[r]!==undefined&&(t=s[r.charAt(0)],n=-n),e[t]===undefined?e[t]=n:e[t]+=n,null},k=function(e,t,n){if(e==="l"||e==="t")return 0;if(e==="c"||e==="m")return n/2-t/2;if(e==="r"||e==="b")return n-t;throw"Invalid alignment"},L=function(e){return L.e=L.e||x("div"),L.e.text(e).html()};A.prototype.loadHTML=function(){var t;t=this.getStyle(),this.userContainer=e(t.html),this.userFields=t.fields},A.prototype.show=function(e,t){var n,r,i,s,o;r=function(n){return function(){!e&&!n.elem&&n.destroy();if(t)return t()}}(this),o=this.container.parent().parents(":hidden").length>0,i=this.container.add(this.arrow),n=[];if(o&&e)s="show";else if(o&&!e)s="hide";else if(!o&&e)s=this.options.showAnimation,n.push(this.options.showDuration);else{if(!!o||!!e)return r();s=this.options.hideAnimation,n.push(this.options.hideDuration)}return n.push(r),i[s].apply(i,n)},A.prototype.setGlobalPosition=function(){var t=this.getPosition(),n=t[0],i=t[1],o=s[n],u=s[i],a=n+"|"+i,f=T[a];if(!f||!document.body.contains(f[0])){f=T[a]=x("div");var l={};l[o]=0,u==="middle"?l.top="45%":u==="center"?l.left="45%":l[u]=0,f.css(l).addClass(r+"-corner"),e("body").append(f)}return f.prepend(this.wrapper)},A.prototype.setElementPosition=function(){var n,r,i,l,c,h,p,d,v,m,g,y,b,w,E,S,x,T,N,L,A,O,M,_,D,P,H,B,j;H=this.getPosition(),_=H[0],O=H[1],M=H[2],g=this.elem.position(),d=this.elem.outerHeight(),y=this.elem.outerWidth(),v=this.elem.innerHeight(),m=this.elem.innerWidth(),j=this.wrapper.position(),c=this.container.height(),h=this.container.width(),T=s[_],L=f[_],A=s[L],p={},p[A]=_==="b"?d:_==="r"?y:0,C(p,"top",g.top-j.top),C(p,"left",g.left-j.left),B=["top","left"];for(w=0,S=B.length;w<S;w++)D=B[w],N=parseInt(this.elem.css("margin-"+D),10),N&&C(p,D,N);b=Math.max(0,this.options.gap-(this.options.arrowShow?i:0)),C(p,A,b);if(!this.options.arrowShow)this.arrow.hide();else{i=this.options.arrowSize,r=e.extend({},p),n=this.userContainer.css("border-color")||this.userContainer.css("border-top-color")||this.userContainer.css("background-color")||"white";for(E=0,x=a.length;E<x;E++){D=a[E],P=s[D];if(D===L)continue;l=P===T?n:"transparent",r["border-"+P]=i+"px solid "+l}C(p,s[L],i),t.call(a,O)>=0&&C(r,s[O],i*2)}t.call(u,_)>=0?(C(p,"left",k(O,h,y)),r&&C(r,"left",k(O,i,m))):t.call(o,_)>=0&&(C(p,"top",k(O,c,d)),r&&C(r,"top",k(O,i,v))),this.container.is(":visible")&&(p.display="block"),this.container.removeAttr("style").css(p);if(r)return this.arrow.removeAttr("style").css(r)},A.prototype.getPosition=function(){var e,n,r,i,s,f,c,h;h=this.options.position||(this.elem?this.options.elementPosition:this.options.globalPosition),e=l(h),e.length===0&&(e[0]="b");if(n=e[0],t.call(a,n)<0)throw"Must be one of ["+a+"]";if(e.length===1||(r=e[0],t.call(u,r)>=0)&&(i=e[1],t.call(o,i)<0)||(s=e[0],t.call(o,s)>=0)&&(f=e[1],t.call(u,f)<0))e[1]=(c=e[0],t.call(o,c)>=0)?"m":"l";return e.length===2&&(e[2]=e[1]),e},A.prototype.getStyle=function(e){var t;e||(e=this.options.style),e||(e="default"),t=c[e];if(!t)throw"Missing style: "+e;return t},A.prototype.updateClasses=function(){var t,n;return t=["base"],e.isArray(this.options.className)?t=t.concat(this.options.className):this.options.className&&t.push(this.options.className),n=this.getStyle(),t=e.map(t,function(e){return r+"-"+n.name+"-"+e}).join(" "),this.userContainer.attr("class",t)},A.prototype.run=function(t,n){var r,s,o,u,a;e.isPlainObject(n)?e.extend(this.options,n):e.type(n)==="string"&&(this.options.className=n);if(this.container&&!t){this.show(!1);return}if(!this.container&&!t)return;s={},e.isPlainObject(t)?s=t:s[i]=t;for(o in s){r=s[o],u=this.userFields[o];if(!u)continue;u==="text"&&(r=L(r),this.options.breakNewLines&&(r=r.replace(/\n/g,"<br/>"))),a=o===i?"":"="+o,b(this.userContainer,"[data-notify-"+u+a+"]").html(r)}this.updateClasses(),this.elem?this.setElementPosition():this.setGlobalPosition(),this.show(!0),this.options.autoHide&&(clearTimeout(this.autohideTimer),this.autohideTimer=setTimeout(this.show.bind(this,!1),this.options.autoHideDelay))},A.prototype.destroy=function(){this.wrapper.data(r,null),this.wrapper.remove()},e[n]=function(t,r,i){return t&&t.nodeName||t.jquery?e(t)[n](r,i):(i=r,r=t,new A(null,r,i)),t},e.fn[n]=function(t,n){return e(this).each(function(){var i=N(e(this)).data(r);i&&i.destroy();var s=new A(e(this),t,n)}),this},e.extend(e[n],{defaults:S,addStyle:m,removeStyle:v,pluginOptions:w,getStyle:d,insertCSS:g}),m("bootstrap",{html:"<div>\n<span data-notify-text></span>\n</div>",classes:{base:{"font-weight":"bold",padding:"8px 15px 8px 14px","text-shadow":"0 1px 0 rgba(255, 255, 255, 0.5)","background-color":"#fcf8e3",border:"1px solid #fbeed5","border-radius":"4px","white-space":"nowrap","padding-left":"25px","background-repeat":"no-repeat","background-position":"3px 7px"},error:{color:"#B94A48","background-color":"#F2DEDE","border-color":"#EED3D7","background-image":"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"},success:{color:"#468847","background-color":"#DFF0D8","border-color":"#D6E9C6","background-image":"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"},info:{color:"#3A87AD","background-color":"#D9EDF7","border-color":"#BCE8F1","background-image":"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"},warn:{color:"#C09853","background-color":"#FCF8E3","border-color":"#FBEED5","background-image":"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"}}}),e(function(){g(h.css).attr("id","core-notify"),e(document).on("click","."+r+"-hidable",function(t){e(this).trigger("notify-hide")}),e(document).on("notify-hide","."+r+"-wrapper",function(t){var n=e(this).data(r);n&&n.show(!1)})})})
</script>
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

          var myProfile = false;
          window.profile = myProfile;
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
                  myProfile = true;
              }
          }
          $.ajax({
              url: '?handler=folderList',
              type: "POST",
              dataType: "json",
              success: function (data) {
                  var first = true;
                  if (0 == data.length) {
                      $('#folderContent').html('<p style="text-align: center;">Коллекций не существует</p>');
                      $('#collectionTitle').hide();
                      $('.center-loader-2').hide();
                  }

                  for (var key in data) {
                      if (data.hasOwnProperty(key)) {
                          var name = data[key][1];
                          var html = '<li  data-id="' + data[key][0] + '" ';
                          if (first) {
                              html += ' class="superActive" ';
                              if (data[key][0] != window.id) {
                                  window.page = 0;
                              }
                              getContentList(data[key][0]);
                              first = false;
                          }
                          html += '><div class="box-name-folder"><a href="#/" class="selectFolder" data-id="' + data[key][0] + '">' + name + '</a>';
                          if (myProfile) {
                              html += '<div class="folder-setting clear">' +
                                  '<div class="folder-setting-item folder-setting-icon"><i href="#/" title="Настройки"></i></div>' +
                                  '<div class="folder-setting-item folder-setting-remove"><i href="#/" title="Удалить" data-id="' + data[key][0] + '" class="deleteFolder"></i></div>' +
                                  '</div>' +
                                  '</div>' +
                                  '<div class="setting-folder"  data-id="' + data[key][0] + '">' +
                                  '<div class="add-folder">' +
                                  '<div class="add-folder-input">' +
                                  '<i class="add-folder-icon"></i>' +
                                  '<input type="text" name="name" value="' + name + '" class="folderEditName" placeholder="Переименовать папку">' +
                                  '<button class="btn button4 editFolder" style="padding: 2px 7px; display: inline-block;">Save</button>' +
                                  '</div>' +
                                  '<div class="add-folder-select">' +
                                  '<div class="add-folder-select__name">Коллекция видна</div>' +
                                  '<div class="row-add-folder-button clear">';
                              if ('public' == data[key][2]) {
                                  html += '<span class="add-folder-button active" data-type="public">ВСЕМ</span>' +
                                      '<span class="add-folder-button " data-type="private">ТОЛЬКО МНЕ</span>';
                              } else {
                                  html += '<span class="add-folder-button " data-type="public">ВСЕМ</span>' +
                                      '<span class="add-folder-button active" data-type="private">ТОЛЬКО МНЕ</span>';
                              }
                              html += '</div>' +
                                  '<input type="hidden" class="scope" name="scope" value="' + data[key][2] + '" />' +
                                  '</div>' +
                                  '</div>';
                          }
                          html += '</div>' +
                              '</li>';
                          $('#userFolderList').append(html);
                      }
                  }

                  if (myProfile) {
                      $('#userFolderList').append('<li data-id="0" class="ui-state-disabled delDir"><div class="box-name-folder">' +
                          '<a href="#" class="selectFolder trash" data-id="0">Корзина</a>' +
                          '</div></li>');
                      $('#userFolderList').parent().append(' <form method="post" class="add-folder" id="userFolderAdd">' +
                          '<div class="add-folder-input">' +
                          '<i class="add-folder-icon"></i>' +
                          '<input type="text" name="name" id="newFolderName" placeholder="Создать коллекцию">' +
                          '<button class="btn button4" id="addDir" style="padding: 2px 7px; display: inline-block;">+</button>' +
                          '</div>' +
                          '<div class="add-folder-select">' +
                          '<div class="add-folder-select__name">Коллекция видна</div>' +
                          '<div class="row-add-folder-button clear">' +
                          '<span class="add-folder-button" data-type="public">ВСЕМ</span>' +
                          '<span class="add-folder-button active" data-type="private">ТОЛЬКО МНЕ</span>' +
                          '</div>' +
                          '</div>' +
                          '<input type="hidden" class="scope" name="scope" value="private" />' +
                          '</form>');

                      $('.add-folder-button').click(function() {
                          $(this).parents('.row-add-folder-button').find('.add-folder-button').removeClass('active');
                          $(this).addClass('active');
                          $(this).parent().parent().parent().find('.scope').val($(this).attr('data-type'));
                      });
                      $('.folder-setting-icon').click(function() {
                          var elemFolder = $(this).parents('li').find('.setting-folder');
                          if (elemFolder.is('.active')){
                              elemFolder.removeClass('active');
                          } else {
                              $('.setting-folder').removeClass('active');
                              elemFolder.addClass('active');
                          }
                      });
                      createDir();
                      editDir();
                      deleteDir();
                  }
                  registerClick();
              },
              complete: function () {
                  $('.center-loader').hide();
              },
              error: function () {
                  $('.center-loader').hide();
                  $('.center-loader-2').hide();
                  $('.pagelist-more').hide();
              },
              timeout: 5000
          });

          function editDir()
          {
              $('.editFolder').click(function(){
                  var el = this;
                  var parent = $(el).parent().parent().parent();
                  var id = $(parent).attr('data-id');
                  var name = $(parent).find('.folderEditName').val();
                  var scope = $(parent).find('.scope').val();

                  var me = $(this);
                  if (me.data('requestRunning')) {
                      return;
                  }
                  me.data('requestRunning', true);

                  $.ajax({
                      "type": "post",
                      "url": "?handler=editFolder",
                      "data": 'id=' + id + '&name=' + name + '&scope=' + scope,
                      "success": function (data) {
                          if (0 == data) {
                              $('.selectFolder[data-id=' + id + ']').text(name);
                              $(el).parent().parent().parent().parent().find('.selectFolder').notify("Изменения успешно сохранены", {
                                  className: "success",
                                  position: "left",
                                  autoHideDelay: 2400
                              });
                              $('.setting-folder').removeClass('active');
                          } else {
                              if (1 == data) {
                                  $(el).parent().parent().parent().parent().find('.selectFolder').notify("Такая папка уже имеется", {
                                      position: "left",
                                      autoHideDelay: 2400
                                  });
                              } else {
                                  $(el).parent().parent().parent().parent().find('.selectFolder').notify("Не удалось сохранить изменения", {
                                      position: "left",
                                      autoHideDelay: 2400
                                  });
                              }
                          }
                      },
                      complete: function () {
                          me.data('requestRunning', false);
                      },
                      error: function () {
                          me.data('requestRunning', false);
                      },
                      timeout: 5000
                  });
              });
          }

          function deleteDir()
          {
              window.deleteDirEl = '';

              $.notify.addStyle('foo', {
                  html:
                  "<div>" +
                  "<div class='clearfix'>" +
                  "<div class='title' data-notify-html='title'/>" +
                  "<div class='buttons'>" +
                  "<button class='yes btn button1' data-notify-text='button'></button>" +
                  "<button class='no btn button1'>Отмена</button>" +
                  "</div>" +
                  "</div>" +
                  "</div>"
              });

              $(document).on('click', '.notifyjs-foo-base .no', function() {
                  window.deleteDirEl = '';
                  $(this).trigger('notify-hide');
              });
              $(document).on('click', '.notifyjs-foo-base .yes', function() {
                  $(this).trigger('notify-hide');
                  var id = $(window.deleteDirEl).attr('data-id');
                  $(window.deleteDirEl).parent().parent().parent().parent().fadeOut(500, function () { $(this).remove() });
                  $.ajax({
                      "type": "post",
                      "url": "?handler=deleteFolder",
                      "data": 'id=' + id,
                      "success": function (data) {
                          var num = parseInt($('.personNumber').html()) - 1;
                          if (1 > num) {
                              num = '';
                          }
                          $('.personNumber').html(num);
                      },
                      complete: function () {
                      },
                      error: function () {
                      },
                      timeout: 5000
                  });
              });

              $('.deleteFolder').click(function(){
                  window.deleteDirEl = this;
                  $(this).notify({
                      title: 'Удалить папку?',
                      button: 'Удалить'
                  }, {
                      position: 'left',
                      style: 'foo',
                      autoHide: false,
                      clickToHide: false
                  });
              });
          }

          function createDir()
          {
              $('#addDir').click(function(event){
                  event = event || window.event;
                  event.preventDefault();
                  var postData = $('#userFolderAdd').serializeArray();
                  if ('' == $('#newFolderName').val()) {
                      $('#userFolderAdd').notify("Введите название папки", {
                          position: "top",
                          autoHideDelay: 2400
                      });
                  } else {
                      var me = $(this);
                      if (me.data('requestRunning')) {
                          return;
                      }
                      me.data('requestRunning', true);

                      $.ajax({
                          "type": "post",
                          "url": "?handler=addFolder",
                          "data": postData,
                          "success": function (data) {
                              if (0 == data) {
                                  $('#userFolderAdd').notify("Не удалось создать папку", {
                                      position: "top",
                                      autoHideDelay: 2400
                                  });
                              } else {
                                  var html = '<li  data-id="' + data + '" ' +
                                      '><div class="box-name-folder"><a href="#/" class="selectFolder" data-id="' + data + '">' + $('#newFolderName').val() + '</a>' +
                                      '<div class="folder-setting clear">' +
                                      '<div class="folder-setting-item folder-setting-remove"><i href="#/" title="Удалить"  data-id="' + data + '" class="deleteFolder"></i></div>' +
                                      '</div>' +
                                      '</div>' +
                                      '</li>';
                                  $(html).insertBefore('#userFolderList li:last-child');
                                  registerClick();
                                  deleteDir();
                                  var num = parseInt($('.personNumber').html()) + 1;
                                  $('.personNumber').html(num);
                              }
                              $('#newFolderName').val('');
                          },
                          complete: function () {
                              me.data('requestRunning', false);
                          },
                          error: function () {
                              me.data('requestRunning', false);
                          },
                          timeout: 5000
                      });
                  }

                  return false;
              });
          }

          function registerClick()
          {
              if (myProfile) {
                  var Table = $('#userFolderList').sortable({
                      containerSelector: 'ul',
                      itemSelector: 'li:not(:last-child)',
                      placeholder: 'placeholder',
                      stop: function () {
                          var data = Table.sortable("toArray", {attribute: 'data-id', expression: /(.+)/});
                          var jsonString = JSON.stringify(data, null, ' ');

                          $.ajax({
                              url: '?handler=order',
                              type: "POST",
                              data: 'data=' + jsonString,
                              dataType: "json",
                              success: function (data) {

                              }
                          });
                      },
                      tolerance: 6,
                      distance: 10
                  });
              }

              $('.selectFolder').click(function(event){
                  event = event || window.event;
                  event.preventDefault();

                  var id = $(this).attr('data-id');
                  if (0 < id) {
                      $('#userFolderList li').removeClass('superActive');
                      $(this).parent().parent().addClass('superActive');
                      if (id != window.id) {
                          window.page = 0;
                      }
                      if (0 == window.page) {
                          $('#folderContent').html('');
                      }
                      getContentList(id);
                  }
                  return false;
              });
          }

          $('#more').click(function(){
              getContentList(window.id);
          });

          function getContentList(id)
          {
              if (0 < id) {
                  window.id = id;

                  var me = $(this);
                  if (me.data('requestRunning')) {
                      return;
                  }
                  me.data('requestRunning', true);

                  $('.center-loader-2').show();
                  window.page += 1;

                  $.ajax({
                      "type": "post",
                      "url": "?handler=folderContent&page=" + window.page,
                      "data": 'id=' + id,
                      "success": function (data) {
                          data = JSON.parse(data);

                          if (0 == data.length) {
                              if (1 == window.page) {
                                  $('#folderContent').html('<p style="text-align: center;">Коллекция пустая</p>');
                              }
                              $('.pagelist-more').hide();
                          } else {
                              for (var key in data) {
                                  if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                      var item = data[key];
                                      var image = '<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/content/nof.jpg';
                                      if ('' != item[2]) {
                                          var name = md5(item[0]);
                                          image = item[1] + '/image/file/person/' + name.slice(0, 1) + '/' + name.slice(1, 3) + '/' + name + '.88.130.' + item[2];
                                      }
                                      var html = '<div class="list-tile-item" data-id="' + item[5] + '">' +
                                          '<div class="list-tile-preview list-preview">' +
                                          '<a href="/people/' + item[0] + '/">' +
                                          '<span>' +
                                          '<img class="lazy image-padding--white" data-original="' + image + '" src="//:0" width="88" height="130" alt="">' +
                                          '</span>' +
                                          '</a>' +
                                          '</div>' +
                                          '<div class="list-tile-text">' +
                                          '<div class="list-tile-value list-tile-name"><a href="/people/' + item[0] + '/">' + item[4] + ' &nbsp;</a></div>' +
                                          '<div class="list-tile-value list-tile-name-eng"><a href="/people/' + item[0] + '/">' + item[3] + ' &nbsp;</a></div>';
                                      if (0 < item[6]) {
                                          html += '<div class="list-tile-value list-tile-raiting"><span class="value">' + item[6] + '</span><span> из 10</span></div>';
                                      } else {
                                          html += '<div class="list-tile-value list-tile-raiting">&nbsp;</div>';
                                      }
                                      html += '</div>' +
                                          '</div>';
                                      $('#folderContent').append(html);
                                  }
                              }

                              if (myProfile) {
                                  var dropped = false;
                                  var folder = '';
                                  var Table2 = $("#folderContent").sortable({
                                      itemSelector: 'div.list-tile-item',
                                      handle: 'div.list-tile-preview',
                                      forcePlaceholderSize: true,
                                      sort: function(event, ui) {
                                          var $target = $(event.target);
                                          if (!/html|body/i.test($target.offsetParent()[0].tagName)) {
                                              var top = event.pageY - $target.offsetParent().offset().top - (ui.helper.outerHeight(true) / 2);
                                              ui.helper.css({'top' : top + 'px'});
                                          }
                                      },
                                      tolerance: 6,
                                      distance: 10,
                                      stop: function(event, ui) {
                                          if (dropped) {
                                              $.ajax({
                                                  url: '?handler=moveItem',
                                                  type: "POST",
                                                  data: 'folderId=' + $(folder).attr('data-id') + '&id=' + $(ui.item).attr('data-id'),
                                                  dataType: "json",
                                                  success: function (data) {
                                                      if (0 == data) {
                                                          if (0 == $(folder).attr('data-id')) {
                                                              $(folder).notify("Персона удалена", {
                                                                  className: "success",
                                                                  position: "left",
                                                                  autoHideDelay: 2000
                                                              });
                                                          } else {
                                                              $(folder).notify("Персона перенесена", {
                                                                  className: "success",
                                                                  position: "left",
                                                                  autoHideDelay: 2000
                                                              });
                                                          }
                                                          $(ui.item).remove();
                                                      } else if (2 == data) {
                                                          $("img.lazy").lazyload();
                                                          $(folder).notify("Персона уже есть в данной коллекции", {
                                                              className: "info",
                                                              position: "left",
                                                              autoHideDelay: 2000
                                                          });
                                                      } else {
                                                          if (0 == $(folder).attr('data-id')) {
                                                              $(folder).notify("Не удалось удалить", {
                                                                  position: "left",
                                                                  autoHideDelay: 2000
                                                              });
                                                          } else {
                                                              $(folder).notify("Не удалось переместить", {
                                                                  position: "left",
                                                                  autoHideDelay: 2000
                                                              });
                                                          }
                                                      }
                                                  }
                                              });
                                              dropped = false;

                                          } else {
                                              var data = Table2.sortable("toArray", {attribute: 'data-id', expression: /(.+)/});
                                              var jsonString = JSON.stringify(data, null, ' ');

                                              $.ajax({
                                                  url: '?handler=orderItem',
                                                  type: "POST",
                                                  data: 'data=' + jsonString,
                                                  dataType: "json",
                                                  success: function (data) {

                                                  }
                                              });
                                          }
                                      }
                                  });


                                  $("#userFolderList li").droppable({
                                      activeClass: 'active',
                                      hoverClass: 'hovered',
                                      drop: function(event, ui) {
                                          dropped = true;
                                          folder = this;
                                      }
                                  });
                              }

                              $("img.lazy[proc!=true]").lazyload({
                                  effect : "fadeIn"
                              });
                              $("img.lazy").attr('proc', 'true');

                              if (50 > data.length) {
                                  $('.pagelist-more').hide();
                              } else {
                                  $('.pagelist-more').show();
                              }
                          }
                      },
                      complete: function () {
                          me.data('requestRunning', false);
                          $('.center-loader-2').hide();
                      },
                      error: function () {
                          me.data('requestRunning', false);
                          $('.center-loader-2').hide();
                          $('.pagelist-more').hide();
                          if (1 == window.page) {
                              $('#folderContent').html('<p style="text-align: center;">Произошла ошибка при обработке запроса</p>');
                          }
                          window.page -= 1;
                      },
                      timeout: 5000
                  });
              } else {
                  $('.center-loader-2').hide();
              }
          }
      })
  </script>


</body>
</html>