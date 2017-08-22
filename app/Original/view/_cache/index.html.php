<?php
/**
 * @var $options Kinomania\System\Options\Options
 *
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $options->get('seo_main_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_main_description') ?>" />
    <link rel="image_src" href="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
    <meta name="keywords" content="<?= $options->get('seo_main_keywords') ?>" />

	<link rel="canonical" href="http://www.kinomania.ru"/>

    <meta property="og:title" content="Новинки кино | KINOMANIA.RU" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/" />
    <meta property="og:description" content="Самая интересная и актуальная информация о новинках мирового кинопроката и свежие новости из мира кино на сайте KINOMANIA.RU. Подробные сведения об актёрах и режиссёрах, саундтреки, постеры к фильмам и многое другое."/>

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
<div class="my-overlay">
    <div class="my-overlay-item overlay-trailer-item">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay video-overlay">
            <div class="inner-my-overlay">
                <div class="war-content">

                </div>
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
	                                <li><a href="/article/reason/">БЫЛ БЫ ПОВОД</a></li>
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
	                    <li><a href="/article/reason/">БЫЛ БЫ ПОВОД</a></li>
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
        <div class="main-content clear">
            <!-- В ЦЕНТРЕ ВНИМАНИЯ -->
            <section class="outer-section clear section-news">
                <!--#include virtual="/index/ssi/center" -->
            </section>

            <!-- Новости Кино -->
            <section class="outer-section outer-shadow outer-news">
                <div class="parent-news">
                    <div class=" clear ">
                        <div class="section-content col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="parent-sticker clear">
                                <!--#include virtual="/index/ssi/news" -->
                                <div class="sticker">
                                    <div class="sticker-item">НОВОСТИ КИНО</div>
                                </div>
                            </div>
                        </div>
                        <div class=" section-gray-poster col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="section-gray">
                                <div class="section-gray__item">
                                      <!--#include virtual="/design/ssi/right_top" -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Трейлеры -->
            <section class="outer-section section-black outer-vert clear ">
                <!--#include virtual="/index/ssi/trailer" -->
            </section>
            <!-- Контент -->
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <!-- Зарубежные сериалы -->
                    <section class="inner-content outer-content-item parent-sticker">
                        <!--#include virtual="/index/ssi/series/foreign" -->
                    </section>

                    <!-- Желтый блок -->
                    <!--#include virtual="/index/ssi/yellow" -->

                    <!-- Российские сериалы -->
                    <section class="inner-content outer-content-item parent-sticker">
                        <!--#include virtual="/index/ssi/series/ru" -->
                    </section>
                    <!--#include virtual="/index/ssi/calendar" -->
                </content>
                <!-- Сайдбар -->
                <aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="section-gray layout outer-aside">
                        <div class="aside">
                            <div class="inner-aside">
                                <div class="aside-item no-mobile">
                                    <!--#include virtual="/index/ssi/new" -->
                                </div>
                                <div class="aside-item leaders">
                                    <!--#include virtual="/index/ssi/boxoffice" -->
                                </div>
                            </div>
                        </div>
                        <div class="dop-aside no-mobile">
                            <div class="dop-aside__item">
                                <div class="dop-aside__banner">
                                      <!--#include virtual="/design/ssi/right_bottom" -->
                                </div>
                            </div>
                            <div class="dop-aside__item">
                                <div class="dop-aside__poster">
                                    <div class="aside__title">ПОСТЕР ДНЯ</div>
                                    <!--#include virtual="/index/ssi/poster" -->
                                </div>
                            </div>
                            <div class="dop-aside__item">
                                <div class="section-social clear">
                                    <ul class="aside-social">
                                        <li class="aside-social__item active" data-type-sliderGroup="social" data-type-sliderButton="vk"><i class="social__icon social__icon-vk"></i><span>В контакте </span></li>
                                        <li class="aside-social__item default" data-type-sliderGroup="social" data-type-sliderButton="fb"><i class="social__icon social__icon-fb"></i><span>Facebook </span></li>
                                    </ul>
                                </div>
                                <div class="dop-aside__item-content">
                                    <div class="outer-content-social">
                                        <div class="content-social content-social-vk active" data-type-sliderElem="vk" data-type-sliderGroup="social">
                                            <div id="vk_groups"></div>
                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    setTimeout(function(){
                                                        if (undefined !== VK && undefined !== VK.Widgets) {
                                                            VK.Widgets.Group("vk_groups", {
                                                                mode: 0,
                                                                width: "250",
                                                                height: "300",
                                                                color1: 'FFFFFF',
                                                                color2: '2B587A',
                                                                color3: '5B7FA6'
                                                            }, 41464224);
                                                        }
                                                    }, 1500);
                                                });
                                            </script>
                                        </div>
                                        <div class="content-social content-social-fb default" data-type-sliderElem="fb" data-type-sliderGroup="social">
                                            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FKinomaniaru%2F106629932735181%3Fref%3Dstream%26hc_location%3Dstream&width=250&height=290&show_faces=true&colorscheme=light&stream=false&show_border=false&header=true&appId=306029476182010" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
                                        </div>
                                    </div>
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


<!-- Magnific Popup core JS file -->
<script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    function sliderNavigation(){
        var w = window.innerWidth;
        if (w < 768) {
            topp = Math.round($(".section-news img").height()*0.85)-24;
        } else {
            topp = Math.round($(".section-news img").height()*0.85)-14;
        }
        $(".bx-default-pager").css('top',topp+"px");
    }

    function sliderNavigationButton(){
        var w = window.innerWidth;
        if (w < 320) {
            topp = Math.round($(".section-news img").height()*0.85)-40;
        }else if (w < 544) {
            topp = Math.round($(".section-news img").height()*0.85)-40;
        }else if (w < 768) {
            topp = Math.round($(".section-news img").height()*0.85)-100;
        }else if (w < 992) {
            topp = Math.round($(".section-news img").height()*0.85)-100;
        } else {
            topp = Math.round($(".section-news img").height()*0.85)-114;
        }
        $(".section-news .bx-controls-direction a").css('top',topp+"px");
    }

    function sliderTrailers(section, type, trailer) {
        toggleClass('default',"[data-type-trailersSection]");
        toggleClass('default',"[data-type-trailersSectionButton]");
        toggleClass('default',"[data-type-trailersType]");
        toggleClass('default',"[data-type-trailersTypeButton]");
        toggleClass('default',"[data-type-trailersTrailer]");
        toggleClass('default',"[data-type-trailersTrailerButton]");

        if(!section){
            section = $("[data-type-trailersSection]:first").attr('data-type-trailersSection');
        }
        if(!type){
            type = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType]:first").attr('data-type-trailersType');
        }
        if(!trailer){
            trailer = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType = "+type+"]").children("[data-type-trailersTrailer]:first").attr('data-type-trailersTrailer');
        }

        toggleClass('active',"[data-type-trailersSectionButton = "+section+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersTypeButton = "+type+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailerButton = "+trailer+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailer = "+trailer+"]");
    }


    $(window).load(function() {
        sliderNavigation();
        sliderNavigationButton();
    });

    $(document).ready(function() {
        $('#calendar_birthday').datetimepicker({
            format: "YYYY-MM-DD",
            locale: "ru"
        });
        window.hide_calendar = false;
        $('#calendar_birthday').on("dp.change",function (e) {
            if (window.hide_calendar) {
                window.hide_calendar = false;
                $('.outer-calendar').hide();
                
                var me = $(this);
                if (me.data('requestRunning')) {
                    return;
                }
                me.data('requestRunning', true);
                $('.content-item-dop-date').html('Обработка');

                $('.content-item-dop-section .happy-carousel').html('');
                $.ajax({
                    "type": "post",
                    "async": "true",
                    "url": "/index/calendar",
                    "data": "date=" + $('#calendar_birthday').val(),
                    "success": function(data){
                        data = JSON.parse(data);
                        console.log(data.length);
                        if (0 < data.length) {
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    $('.content-item-dop-section .happy-carousel').append('<div class="item">  '  +
                                        '                       <div class="row-item-image image-shadow">  '  +
                                        '                           <a href="/people/' + data[key]['id'] +  '/"><img alt="" src="' + data[key]['image'] +  '" class="item-image image-prewiew"></a>  '  +
                                        '                       </div>  '  +
                                        '                       <div class="item-text">  '  +
                                        '                           <div class="item-text-title">  '  +
                                        '                               <a href="/people/' + data[key]['id'] +  '/">' + data[key]['name'] +  '</a>  '  +
                                        '                           </div>  '  +
                                        '                           <div class="item-text-date">  '  +
                                        '                               <span>' + data[key]['birthday'] +  '</span>  '  +
                                        '                           </div>  '  +
                                        '     '  +
                                        '                       </div>  '  +
                                        '                  </div>  ' );
                                    $('.content-item-dop-date').html(data[key]['date']);
                                }
                            }
                            var currentSlide = window.mySlider.getCurrentSlide();

                            w = window.innerWidth;

                            if (w <= 992) {
                                window.mySlider.reloadSlider({
                                    startSlide: currentSlide,
                                    slideWidth: 0,
                                    maxSlides: 2,
                                    minSlides: 2,
                                    infiniteLoop: true,
                                    slideMargin: 70,
                                    pager: false
                                });
                            } else {
                                window.mySlider.reloadSlider({
                                    startSlide: currentSlide,
                                    slideWidth: 300,
                                    maxSlides: 2,
                                    minSlides: 2,
                                    infiniteLoop: true,
                                    slideMargin: 70,
                                    pager: false
                                });
                            }
                        }
                    },
                    complete: function() {
                        me.data('requestRunning', false);
                    },
                    error: function(){
                        me.data('requestRunning', false);
                    },
                    timeout: 12000
                });
            }
        });
        $('.content-item-dop-date').click(function() {
            $('.outer-calendar').show();
            $('#calendar_birthday').datetimepicker("show");
            window.hide_calendar = true;
        });


        <!-- bxSlider Init -->
        $('.slider-load').css('display', 'block');
        $('.bxslider').bxSlider({
            auto: false,
            onSliderLoad: function(){
                $(".bxslider").css("visibility", "visible");
            }
        });
        w = window.innerWidth;

        if (w <= 992) {
            window.mySlider = $('.happy-carousel').bxSlider({
                slideWidth: 0,
                maxSlides: 2,
                minSlides: 2,
                infiniteLoop: true,
                slideMargin: 70,
                pager: false
            });
        } else {
            window.mySlider = $('.happy-carousel').bxSlider({
                slideWidth: 300,
                maxSlides: 2,
                minSlides: 2,
                infiniteLoop: true,
                slideMargin: 70,
                pager: false
            });
        }

        $("img.lazy").lazyload({
            effect : "fadeIn"
        });


        // ====Слайдер для меню трейлеров
        // == Секции Пк версия
        $("[data-type-trailersSectionButton]").on('click', function () {
            section = $(this).attr('data-type-trailersSectionButton');
            sliderTrailers(section);
            // меняет содержимое селектора для моб. версии
            html_r = $(this).html();
            $(".mobile__select .result").html(html_r);
            $(".mobile__select .result-list").css('display', 'none');
        });
        // == Тип ПК версия
        $("[data-type-trailersTypeButton]").on('click', function () {
            type = $(this).attr('data-type-trailersTypeButton');
            section = $(this).parents("[data-type-trailersSection]").attr('data-type-trailersSection');
            sliderTrailers(section, type);
        });
        // == Трейлеры ПК версия
        $("[data-type-trailersTrailerButton]").mouseover(function () {
            trailer = $(this).attr('data-type-trailersTrailerButton');
            type = $(this).parents("[data-type-trailersType]").attr('data-type-trailersType');
            section = $(this).parents("[data-type-trailersType]").parents("[data-type-trailersSection]").attr('data-type-trailersSection');
            sliderTrailers(section, type, trailer);
        });
    });
</script>

<script src="http://userapi.com/js/api/share.js?3" async="async" type="text/javascript"></script>
<script src="http://vkontakte.ru/js/api/openapi.js?20" async="async" type="text/javascript"></script>
</body>
</html>
