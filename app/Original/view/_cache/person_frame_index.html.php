<?php
/**
 * @var int $id
 * @var array $min
 * @var string $static
 * @var array $list
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Frame as Frame;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $min[Person::TITLE] ?>: кадры из фильмов (<?= $stat[\Kinomania\Original\Key\Person\Stat::FRAME] ?> шт.) | KINOMANIA.RU</title>
    <meta name="description" content="<?= $min[Person::TITLE] ?>: кадры из фильмов на KINOMANIA.RU. Фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа."/>
    <meta name="keywords" content="<?= $min[Person::TITLE] ?> кадры из фильмов кино"/>

	<link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/frames"/>

    <meta property="og:title" content="<?= $min[Person::TITLE] ?> кадры из фильмов" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/frames" />
    <meta property="og:description" content=""/>

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
</head>
<body>
<div class="overlay-photo">
    <div class="overlay-bg"></div>
    <div class="row-inner-overlay">
        <div class="inner-overlay-photo">
            <div class="inner-overlay-image">
                <img src="//:0" alt="">
                <div class="overlay-photo-controls">
                    <div class="close"></div>
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
            <div class="inner-overlay-caption section-video ">
                <!--  Содержимое описания  -->
            </div>
        </div>
    </div>
</div>

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
                    <?php if ('' == $min[Person::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_RU] ?></a></h1>
                        <h2 class="name__page"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <?php
/**
 * @var int $id
 * @var \Dspbee\Core\Request $request
 * @var array $stat
 */
use \Kinomania\Original\Key\Person\Stat;
?>
<ul class="nav-content-list clear nav-content-list-actor">
    <div class="mobile__select my-select">
        <span class="result">КИНО</span>
        <ul class="result-list">
            <li class="nav-content-item default <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="#">Фильмография</a></li>
            <li class="nav-content-item default <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

            <?php if (0 < $stat[Stat::PHOTO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::WALLPAPER]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::FRAME]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::VIDEO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::AWARD]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span>/a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::NEWS]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>
    <li class="nav-content-item <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id ?>/">Фильмография</a></li>
    <li class="nav-content-item <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

    <?php if (0 == $stat[Stat::PHOTO]): ?>
        <li class="nav-content-item no-active"><span>Фото</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span> </a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::WALLPAPER]): ?>
        <li class="nav-content-item no-active"><span>Обои</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::FRAME]): ?>
        <li class="nav-content-item no-active"><span>Кадры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::VIDEO]): ?>
        <li class="nav-content-item no-active"><span>Видео</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::AWARD]): ?>
        <li class="nav-content-item no-active"><span>Награды</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::NEWS]): ?>
        <li class="nav-content-item no-active"><span>Новости</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
    <?php endif ?>
</ul>
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="nav-films clear">
                        <span class="nav-films-title">Выберите тип:</span>
                        <ul class="nav-films-list">
                            <li data-type-filter-button="ALL" class="active"><a>Все</a></li>
                            <?php if ($list['photo_session']): ?>
                                <li data-type-filter-button="photo_session"><a>Промо-кадры</a></li>
                            <?php endif ?>
                            <?php if ($list['film_set']): ?>
                                <li data-type-filter-button="film_set"><a>Со съемочной площадки</a></li>
                            <?php endif ?>
                            <?php if ($list['concept']): ?>
                                <li data-type-filter-button="concept"><a>Концепт</a></li>
                            <?php endif ?>
                            <?php if ($list['screenshot']): ?>
                                <li data-type-filter-button="screenshot"><a>Скриншот</a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <div class="list-content">
                        <div class="trailer-item clear">
                            <div class="row">
                                <?php foreach ($list['list'] as $frame): ?>
                                    <div class="trailer-item-col" data-type-filter="<?= $frame[Frame::TYPE] ?>">
                                        <div class="row-trailer-image-list">
                                            <div class="image-shadow">
                                                <div class="parent" data-type-over-parent=".row" data-type-over-img="<?= $frame[Frame::IMAGE] ?>">
                                                    <a href="/film/<?= $frame[Frame::CAST][0][0] ?>/frames/<?= $frame[Frame::ID] ?>">
                                                        <img src="//:0"  data-original="<?= $frame[Frame::PREVIEW] ?>" alt="" class="lazy image-cover">
                                                    </a>
                                                    <div class="trailer-caption-hide">
                                                        <input type="hidden" name="href" value="/film/<?= $frame[Frame::CAST][0][0] ?>/frames/<?= $frame[Frame::ID] ?>" class="hidden-data" />
                                                        <div class="info">
                                                            <?php if (count($frame[Frame::CAST])): ?>
                                                                <p class="text name">
                                                                    Фильм: 
                                                                    <?php foreach ($frame[Frame::CAST] as $cast): ?>
                                                                        <a href="/film/<?= $cast[0] ?>/"><?= $cast[1] ?></a>
                                                                    <?php endforeach; ?>
                                                                </p>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="download">
                                                            <div class="link__download" onclick="document.location='/load/n?file=<?= $frame[Frame::IMAGE] ?>'"><span>Скачать</span><i class="link__download-icon sprite"></i>
                                                            </div>
                                                        </div>
                                                        <div class="outer-social clear">
                                                            <ul class="social-list social-list--horizontal frame-social">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="image-size-caption"><?= $frame[Frame::WIDTH] ?>x<?= $frame[Frame::HEIGHT] ?>, <?= $frame[Frame::SIZE] ?> КБ</div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/frames"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fframes/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/frames"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fframes&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fframes/"></a></li>
                            </ul>
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
<link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
<script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        $('.image-cover-parent').magnificPopup({
            type: 'image'
        });

        $("[gallery-number]").each(function(i, item){
            var num = $(item).attr('gallery-number');
            $('[gallery-number='+num+'] > a').magnificPopup({
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.'
                }
            });
        });
        $('.popup-gallery-list-trailers').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });

        $('.page-content-head__more a').click(function(){
            $('.read-more-text').css('height', 'initial').toggleClass('read-more-text_hidden');
            $(this).hide();
            return false;
        });


        $('.row-trailer-image-list a').click(function(e){
            e.preventDefault();
        });

        $('.nav-films-list li').click(function(){
            $(window).scrollTop($(window).scrollTop() + 1);
            setTimeout(function(){
                $(window).scrollTop($(window).scrollTop() + 1);
            }, 750);
        });

        $('[data-type-filter-button]').click(function(){
            if ('ALL' == $(this).attr('data-type-filter-button')) {
                $('.overlay-photo-controls .prev').show();
                $('.overlay-photo-controls .next').show();
            } else {
                $('.overlay-photo-controls .prev').hide();
                $('.overlay-photo-controls .next').hide();
            }
        });

        var onceList = [];

        $('.trailer-item a').click(function(){
            var href = 'http://www.kinomania.ru' + $(this).attr('href');
            var frameId = href.split('/');
            frameId = frameId[frameId.length - 1];

            if (-1 == onceList.indexOf(frameId)) {
                onceList.push(frameId);

                var html = '<li class="vk" id="vk_' + frameId + '" data-url="' + href + '"><a href="http://vkontakte.ru/share.php?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="fb" id="fb_' + frameId + '" data-url="' + href + '"><a href="http://www.facebook.com/sharer.php?u=' + encodeURIComponent(href) + '&src=sp/"><span class="number"></span></a></li>' +
                    '<li class="ok" id="ok_' + frameId + '"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="pinterest" id="pt_' + frameId + '"><a href="http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>';
                $(this).parent().find('.frame-social').html(html);


                /**
                 * Social
                 */
                var url = '';
                VK = {};
                VK.Share = {};
                VK.Share.count = function (index, count) {
                    $('#vk_' + frameId + ' span').text(count);
                };
                $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=' + href + '&format=json&callback=?');

                $.getJSON('http://graph.facebook.com/?id=' + href + '&callback=?', function (data) {
                    if ('undefined' == typeof data.share) {
                        data.share = {};
                        data.share.share_count = 0;
                    }
                    $('#fb_' + frameId + ' span').text(data.share.share_count);
                });

                ODKL = {};
                ODKL.updateCountOC = function (a, count) {
                    $('#ok_' + frameId + ' span').text(count);
                };
                $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=' + href + '&callback=?');

                $('#pt_' + frameId + ' span').text(0);
                $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=' + href + '&callback=?', function (data) {
                    $('#pt_' + frameId + ' span').text(data.count);
                });
            }
        });

        $('.prev').click(function(){
            var href = 'http://www.kinomania.ru' + $(this).parent().parent().parent().find('.hidden-data').val();
            var frameId = href.split('/');
            frameId = frameId[frameId.length - 1];

            if (-1 == onceList.indexOf(frameId)) {
                onceList.push(frameId);

                var html = '<li class="vk" id="vk_' + frameId + '" data-url="' + href + '"><a href="http://vkontakte.ru/share.php?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="fb" id="fb_' + frameId + '" data-url="' + href + '"><a href="http://www.facebook.com/sharer.php?u=' + encodeURIComponent(href) + '&src=sp/"><span class="number"></span></a></li>' +
                    '<li class="ok" id="ok_' + frameId + '"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="pinterest" id="pt_' + frameId + '"><a href="http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>';
                $(this).parent().parent().parent().find('.frame-social').html(html);


                /**
                 * Social
                 */
                var url = '';
                VK = {};
                VK.Share = {};
                VK.Share.count = function (index, count) {
                    $('#vk_' + frameId + ' span').text(count);
                };
                $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=' + href + '&format=json&callback=?');

                $.getJSON('http://graph.facebook.com/?id=' + href + '&callback=?', function (data) {
                    if ('undefined' == typeof data.share) {
                        data.share = {};
                        data.share.share_count = 0;
                    }
                    $('#fb_' + frameId + ' span').text(data.share.share_count);
                });

                ODKL = {};
                ODKL.updateCountOC = function (a, count) {
                    $('#ok_' + frameId + ' span').text(count);
                };
                $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=' + href + '&callback=?');

                $('#pt_' + frameId + ' span').text(0);
                $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=' + href + '&callback=?', function (data) {
                    $('#pt_' + frameId + ' span').text(data.count);
                });
            }
        });

        $('.next').click(function(){
            var href = 'http://www.kinomania.ru' + $(this).parent().parent().parent().find('.hidden-data').val();
            var frameId = href.split('/');
            frameId = frameId[frameId.length - 1];

            if (-1 == onceList.indexOf(frameId)) {
                onceList.push(frameId);

                var html = '<li class="vk" id="vk_' + frameId + '" data-url="' + href + '"><a href="http://vkontakte.ru/share.php?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="fb" id="fb_' + frameId + '" data-url="http://www.facebook.com/sharer.php?u=' + href + '"><a href="' + encodeURIComponent(href) + '&src=sp/"><span class="number"></span></a></li>' +
                    '<li class="ok" id="ok_' + frameId + '"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>' +
                    '<li class="pinterest" id="pt_' + frameId + '"><a href="http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(href) + '/"><span class="number"></span></a></li>';
                $(this).parent().parent().parent().find('.frame-social').html(html);


                /**
                 * Social
                 */
                var url = '';
                VK = {};
                VK.Share = {};
                VK.Share.count = function (index, count) {
                    $('#vk_' + frameId + ' span').text(count);
                };
                $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=' + href + '&format=json&callback=?');

                $.getJSON('http://graph.facebook.com/?id=' + href + '&callback=?', function (data) {
                    if ('undefined' == typeof data.share) {
                        data.share = {};
                        data.share.share_count = 0;
                    }
                    $('#fb_' + frameId + ' span').text(data.share.share_count);
                });

                ODKL = {};
                ODKL.updateCountOC = function (a, count) {
                    $('#ok_' + frameId + ' span').text(count);
                };
                $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=' + href + '&callback=?');

                $('#pt_' + frameId + ' span').text(0);
                $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=' + href + '&callback=?', function (data) {
                    $('#pt_' + frameId + ' span').text(data.count);
                });
            }
        });
    });
</script>
</body>
</html>
