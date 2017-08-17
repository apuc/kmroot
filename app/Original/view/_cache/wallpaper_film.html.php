<?php
/**
 * @var string $static
 * @var array $genre
 * @var array $popular
 * @var array $list
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Film\Wallpaper as Wallpaper;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_films_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_films_description') ?>"/>
    <meta name="keywords" content="<?= $options->get('seo_films_keywords') ?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/wallpapers/films"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/wallpapers/films" />
    <meta property="og:title" content="Обои для рабочего стола: фильмы" />
    <meta property="og:description" content="Большая коллекция фотографий и обоев с самыми популярными актерами кино и сериалов."/>

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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-wallpapers">
                        <div class="row-list-nav-second">
                            <ul class="list-nav-second clear">
                                <li class="active"><a href="/wallpapers/films/">Фильмы</a></li>
                                <li><a href="/wallpapers/actors/">Актеры</a></li>
                                <li><a href="/wallpapers/actresses/">Актрисы</a></li>
                            </ul>
                        </div>
                    </div>

                    <h1 class="pagetitle soundtracks-pagetitle"><?= $options->get('seo_films_h1') ?></h1>
                    <div class="outer-selection-trailers">
                        <div data-type-openclose-button="open_close" data-type-openclose-class="active" class="button__selection-trailers"><span>Подбор по параметрам</span></div>
                        <div class="selection-trailers">
                            <div class="row-selection-hide" data-type-openclose-element="open_close">
                                <div class="selection-trailers-item clear">
                                    <div class="item ganre">
                                        <div class="selection-trailers__name">Жанр:</div>
                                        <div class="selection-trailers__value">
                                            <ul class="selection-trailers__value-list">
                                                <?php foreach ($genre as $code => $name): ?>
                                                    <li><a href="/" data-value="<?= $code ?>" class="filter genre"><?= $name ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="selection-trailers-item clear">
                                    <div class="item years" data-type="slider" data-type-slider-min="1888" data-type-slider-max="2020">
                                        <div class="selection-trailers__name">Года:</div>
                                        <div class="selection-trailers__value">
                                            <div class="outer-time-bar clear">
                                                <div class="time-bar-years">
                                                    <ul>
                                                        <li>1930</li>
                                                        <li>1970</li>
                                                        <li>2020</li>
                                                    </ul>
                                                </div>
                                                <div class="time-bar-slide">
                                                    <div class="slide-bar-bottom" data-type-slider="bg">
                                                        <div class="slide-bar-top" data-type-slider="fr" style="left: 0px; width: 100px;"></div>
                                                        <div class="slide-bar-controls">
                                                            <div class="slide-bar-controls__item slide-bar-controls__left" data-type-slider="left_controller" style="left: 0px;"></div>
                                                            <div class="slide-bar-controls__item slide-bar-controls__right" data-type-slider="right_controller" style="left: 100px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="outer-time-value clear">
                                                <span>с</span>
                                                <input type="text" id="yearFrom" name="yearFrom" class="time-value-after" data-type-slider="input_left" value="1888">
                                                <span>по</span>
                                                <input type="text" id="yearTo" name="yearTo"  class="time-value-before" data-type-slider="input_right" value="2020">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="selection-trailers-item">
                                <div class="item letters">
                                    <div class="letters-select">
                                        <ul class="tab-list clear">
                                            <li class="active" data-type-slidergroup="lang" data-type-sliderbutton="ru">RU</li>
                                            <li class="default" data-type-slidergroup="lang" data-type-sliderbutton="eng">ENG</li>
                                        </ul>
                                    </div>
                                    <div class="letters-text">
                                        <ul class="letters-text-list active filter" data-type-slidergroup="lang" data-type-sliderelem="ru">
                                            <li>А</li>
                                            <li>Б</li>
                                            <li>В</li>
                                            <li>Г</li>
                                            <li>Д</li>
                                            <li>Е</li>
                                            <li>Ё</li>
                                            <li>Ж</li>
                                            <li>З</li>
                                            <li>И</li>
                                            <li>Й</li>
                                            <li>К</li>
                                            <li>Л</li>
                                            <li>М</li>
                                            <li>Н</li>
                                            <li>О</li>
                                            <li>П</li>
                                            <li>Р</li>
                                            <li>С</li>
                                            <li>Т</li>
                                            <li>У</li>
                                            <li>Ф</li>
                                            <li>Х</li>
                                            <li>Ц</li>
                                            <li>Ч</li>
                                            <li>Ш</li>
                                            <li>Щ</li>
                                            <li>Ъ</li>
                                            <li>Ы</li>
                                            <li>Ь</li>
                                            <li>Э</li>
                                            <li>Ю</li>
                                            <li>Я</li>
                                        </ul>
                                        <ul class="letters-text-list filter" data-type-slidergroup="lang" data-type-sliderelem="eng">
                                            <li>A</li>
                                            <li>B</li>
                                            <li>C</li>
                                            <li>D</li>
                                            <li>E</li>
                                            <li>F</li>
                                            <li>G</li>
                                            <li>H</li>
                                            <li>I</li>
                                            <li>J</li>
                                            <li>K</li>
                                            <li>L</li>
                                            <li>M</li>
                                            <li>N</li>
                                            <li>O</li>
                                            <li>P</li>
                                            <li>Q</li>
                                            <li>R</li>
                                            <li>S</li>
                                            <li>T</li>
                                            <li>U</li>
                                            <li>V</li>
                                            <li>W</li>
                                            <li>X</li>
                                            <li>Y</li>
                                            <li>Z</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-mini-slide row-mini-slide--two row-posters-mini-slide  row-mini-slide--gray popular_block">
                        <div class="mini-slide-title no-hover-slide-title">ПОПУЛЯРНЫЕ</div>
                        <div class="row-wall-tile">
                            <?php foreach ($popular as $item): ?>
                            <div class="wall-tile-item posters--hover">
                                <div class="row-posters__image">
                                    <a href="/film/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/">
                                        <div class="posters__image">
                                            <img alt="" src="//:0" data-original="<?= $item[Wallpaper::IMAGE] ?>" class="lazy parent responsive-image image-prewiew">
                                        </div>
                                    </a>
                                </div>
                                <div class="bx-mini-slider-caption">
                                    <div class="poster-title"><a href="/film/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/"><?= $item[Wallpaper::REL_NAME] ?></a></div>
                                    <div class="poster-title-eng"><?= $item[Wallpaper::REL_NAME_EN] ?></div>
                                    <div class="poster-number"><span class="value"><?= $item[Wallpaper::COUNT] ?></span> шт</div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="scripts-list-item">
                        <div class="content-page__titile">
                            <h2>НОВЫЕ</h2>
                        </div>
                        <div class="row-posters-page row-posters-wall posters--hover">
                            <div class="row row-tile-block">
                                <?php foreach ($list as $item): ?>
                                    <div class="posters-item posters-item-tile">
                                        <div class="row-posters__image">
                                            <a href="/film/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/">
                                                <div class="image-shadow-poster posters__image">
                                                    <img alt="" src="//:0" data-original="<?= $item[Wallpaper::IMAGE] ?>" class="lazy parent responsive-image image-prewiew">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="posters-caption">
                                            <div class="poster-title"><a href="/film/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/"><?= $item[Wallpaper::REL_NAME] ?></a></div>
                                            <div class="poster-title-eng"><?= $item[Wallpaper::REL_NAME_EN] ?></div>
                                            <div class="poster-number"><span class="value"><?= $item[Wallpaper::COUNT] ?></span> шт</div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="wallpapers/films"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Ffilms/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="wallpapers/films"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Ffilms&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Ffilms/"></a></li>
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
<script type="text/javascript">
    function getContent(filter, clearContent) {
        var me = $(this);
        if (me.data('requestRunning')) {
            return;
        }
        me.data('requestRunning', true);

        $('.center-loader').show();
        $('.pagelist-more').hide();

        if (clearContent) {
            $('.row-tile-block').html('');
        }
        $('.row-big-posters').html('');

        $('.popular_block').hide();

        $("img.lazy").attr('proc', 'true');

        $.ajax({
            "type": "post",
            "url": "?handler=search",
            dataType: "json",
            data: 'filter=' + JSON.stringify(filter),
            "success": function (data) {
                var html = '';
                for (var key in data) {
                    if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                        html +=  '   <div class="posters-item posters-item-tile">  '  +
                            '   	<div class="row-posters__image">  '  +
                            '   		<a href="/film/' + data[key][<?= Wallpaper::REL_ID ?>] + '/wallpapers/">  '  +
                            '   			<div class="image-shadow-poster posters__image">  '  +
                            '   				<img alt="" src="//:0" data-original="' + data[key][<?= Wallpaper::IMAGE ?>] + '" class="lazy parent responsive-image image-prewiew">  '  +
                            '   			</div>  '  +
                            '   		</a>  '  +
                            '   	</div>  '  +
                            '   	<div class="posters-caption">  '  +
                            '   		<div class="poster-title"><a href="/film/' + data[key][<?= Wallpaper::REL_ID ?>] + '/wallpapers/">' + data[key][<?= Wallpaper::REL_NAME ?>] + '</a></div>  '  +
                            '   		<div class="poster-title-eng">' + data[key][<?= Wallpaper::REL_NAME_EN ?>] + '</div>  '  +
                            '   		<div class="poster-number"><span class="value">' + data[key][<?= Wallpaper::COUNT ?>] + '</span> шт</div>  '  +
                            '   	</div>  '  +
                            '  </div>  ' ;
                    }
                }
                if (0 == data.length) {
                    html = '<p>&nbsp; &nbsp; &nbsp; Ничего не найдено</p>';
                }

                $('.row-tile-block').append(html);

                $("img.lazy[proc!=true]").lazyload({
                    effect : "fadeIn"
                });
                $("img.lazy").attr('proc', 'true');

                if (24 > data.length) {
                    $('.pagelist-more').hide();
                } else {
                    $('.pagelist-more').show();
                }
            },
            complete: function () {
                me.data('requestRunning', false);
                $('.center-loader').hide();
            },
            error: function () {
                me.data('requestRunning', false);
                $('.center-loader').hide();
            },
            timeout: 30000
        });
    }
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        var filterTimer;
        var doneFilterInterval = 500;
        var FILTER = {
            'genre': [],
            'year': [],
            'letter': '',
            'page': 1
        };

        $('.filter').click(function(e){
            e = e || window.event;
            e.preventDefault();

            FILTER['page'] = 1;

            if ($(this).hasClass('genre')) {
                var genre = $(this).attr('data-value');
                if(-1 == FILTER.genre.indexOf(genre)) {
                    FILTER.genre.push(genre);
                    $(this).addClass('active');
                } else {
                    FILTER.genre.splice(FILTER.genre.indexOf(genre), 1);
                    $(this).removeClass('active');
                }
            }

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function() {
                getContent(FILTER, true);
            }, doneFilterInterval);

            return false;
        });

        $('#yearFrom').change(function(){
            FILTER['page'] = 1;
            FILTER.year[0] = $(this).val();

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function() {
                getContent(FILTER, true, true);
            }, doneFilterInterval);
        });
        $('#yearTo').change(function(){
            FILTER['page'] = 1;
            FILTER.year[1] = $(this).val();

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function() {
                getContent(FILTER, true);
            }, doneFilterInterval);
        });

        $('.letters-text-list li').click(function(){
            FILTER['page'] = 1;
            if (FILTER.letter == $(this).text()) {
                FILTER.letter = '';
            } else {
                FILTER.letter = $(this).text();
            }

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function() {
                getContent(FILTER, true);
            }, doneFilterInterval);
        });

        $('#more').click(function(e){
            e = e || window.event;
            e.preventDefault();
            FILTER['page'] += 1;
            getContent(FILTER, false);
            return false;
        });
    });
</script>
</body>
</html>
