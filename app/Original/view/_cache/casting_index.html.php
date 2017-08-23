<?php
/**
 * @var array $list
 */
use Kinomania\Original\Key\Casting\Person as Person;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Кастинг-база KINOMANIA.RU | Расширенный поиск, фото, видео</title>
    <meta name="description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>
    <meta name="keywords" content="Кастинг, кастинг-база, актерская база, поиск по актерам, кастинг агентства, видео актеров"/>

	<link rel="canonical" href="http://www.kinomania.ru/casting"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/casting" />
    <meta property="og:title" content="Кастинг-база" />
    <meta property="og:description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>

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
                <content class="page-section-content section-content content-outer col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-casting row-page-two">
                        <div class="page-two-head">
                            <h1 class="pagetitle mini__pagetitle">Кастинг-база</h1>
                            <div class="link-big">CASTING.KINOMANIA.RU</div>
                            <ul class="list-casting">
                                <li><span class="list-casting-value" data-type="actors">7 961 </span> <span class="list-casting-name">актеров</span></li>
                                <li><span class="list-casting-value" data-type="actress">6 552 </span> <span class="list-casting-name">актрис</span></li>
                                <li><span class="list-casting-value" data-type="photo">53 307</span> <span class="list-casting-name">фото</span></li>
                                <li><span class="list-casting-value" data-type="video">11 326</span> <span class="list-casting-name">видео</span></li>
                            </ul>
                            <div class="list-casting__button">
                                <a href="/casting/search/" class="button button3">Поиск актеров по параметрам</a>
                            </div>
                        </div>
                        <section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew art-yellow parent-whom">
                            <div class="section-mini-prewiew section-mini-prewiew--yellow">
                                <div class="row-whom clear">
                                    <div class="whom-item">
                                        <div class="whom-item__name">Пользователям</div>
                                        <div class="whom-item__caption">Расширенный поиск, тысячи фото и видео материалов</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                    <div class="whom-item">
                                        <div class="whom-item__name">Агентствам</div>
                                        <div class="whom-item__caption">Продвижение актеров, размещение доп.материалов</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                    <div class="whom-item">
                                        <div class="whom-item__name">Актерам</div>
                                        <div class="whom-item__caption">Размещение<br>информации о себе в базе</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row-part-filter">
                            <div class="part-filter-title">АКТЕРЫ</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По возрасту</li>
                                        <li class="male active" data-value="0"><a href="/"><span>Все</span></a></li>
                                        <li class="male" data-value="10"><a href="/"><span>до 10</span></a></li>
                                        <li class="male" data-value="20"><a href="/"><span>от 10 до 20</span></a></li>
                                        <li class="male" data-value="30"><a href="/"><span>от 20 до 30</span></a></li>
                                        <li class="male" data-value="40"><a href="/"><span>от 30 до 40</span></a></li>
                                        <li class="male" data-value="50"><a href="/"><span>от 40 до 50</span></a></li>
                                        <li class="male" data-value="60"><a href="/"><span>от 60</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="maleContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['male'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-part-filter">
                            <div class="part-filter-title">АКТРИСЫ</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По возрасту</li>
                                        <li class="female active" data-value="0"><a href="/"><span>Все</span></a></li>
                                        <li class="female" data-value="10"><a href="/"><span>до 10</span></a></li>
                                        <li class="female" data-value="20"><a href="/"><span>от 10 до 20</span></a></li>
                                        <li class="female" data-value="30"><a href="/"><span>от 20 до 30</span></a></li>
                                        <li class="female" data-value="40"><a href="/"><span>от 30 до 40</span></a></li>
                                        <li class="female" data-value="50"><a href="/"><span>от 40 до 50</span></a></li>
                                        <li class="female" data-value="60"><a href="/"><span>от 60</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="femaleContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['female'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-part-filter">
                            <div class="part-filter-title">Дети</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По полу</li>
                                        <li class="child active" data-value=""><a href="/"><span>Все</span></a></li>
                                        <li class="child" data-value="male"><a href="/"><span>мальчики</span></a></li>
                                        <li class="child" data-value="female"><a href="/"><span>девочки</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="childContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['child'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagelist-social style-pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="casting"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fcasting/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="casting"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fcasting&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fcasting/"></a></li>
                            </ul>
                        </div>
                    </div>
                </content>
                <?php
/**
 * @var array $list
 */
use Kinomania\Original\Key\Casting\Company as Company;
?>
<aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside-branding no-mobile">
              <!--#include virtual="/design/ssi/right_top" -->
        </div>

        <div class="aside-item aside-item-agency">
            <div class="aside__title">АКТЕРСКИЕ АГЕНТСТВА</div>
            <div class="row-table-aside">
                <?php foreach ($list['company'] as $item): ?>
                    <div class="table-aside-item">
                        <div class="table-aside-inner-item table-aside-name"><a href="/company/<?= $item[Company::ID] ?>/"><?= $item[Company::NAME] ?></a></div>
                        <div class="table-aside-inner-item table-aside-value"><?= $item[Company::MALE] ?></div>
                        <div class="table-aside-inner-item table-aside-value2"><?= $item[Company::FEMALE] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (count($list['promo'])): ?>
            <div class="aside no-mobile">
                <div class="inner-aside">
                    <div class="aside-item ">
                        <div class="aside__title">Промо</div>
                        <div class="row-posters__image">
                            <a href="/people/<?= $list['promo'][0][Person::ID] ?>/">
                                <div class="image-shadow-poster posters__image">
                                    <img alt="" src="<?= $list['promo'][0][Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                </div>
                            </a>
                        </div>
                        <div class="bxslider-part-title"><a href="/people/<?= $list['promo'][0][Person::ID] ?>/"><?= $list['promo'][0][Person::NAME] ?></a></div>
                    </div>
                </div>
            </div>
        <?php endif ?>

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

  <script type="text/javascript">
      $(document).ready(function(){
          $('.male').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var date = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.male').removeClass('active');
              $(this).addClass('active');

              $('#maleContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getMale&date=" + date,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#maleContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });


          $('.female').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var date = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.female').removeClass('active');
              $(this).addClass('active');

              $('#femaleContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getFemale&date=" + date,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#femaleContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });
          
          $('.child').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var sex = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.child').removeClass('active');
              $(this).addClass('active');

              $('#childContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getChild&sex=" + sex,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#childContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });
          
      });
  </script>
</body>
</html>
