<?php
	use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Ошибка 404, страница не найдена</title>

    <meta name="robots" content="noindex">
    <meta name="geo_locale" content="RU">
    <link rel="shortcut icon" href="//fs.kinomania.ru/favicon.ico" type="image/png"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//fs.kinomania.ru/app/libs/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="//fs.kinomania.ru/app/js/plugins/bx/jquery.bxslider.css" />
    <link rel="stylesheet" href="//fs.kinomania.ru/app/css/primary.css">
    <link rel="stylesheet" href="//fs.kinomania.ru/app/css/main.css">
    <link rel="stylesheet" href="//fs.kinomania.ru/app/css/fix.css">

    <script src="//fs.kinomania.ru/app/js/jquery/jquery-1.11.3.min.js"></script>


</head>
<body>

<div class="outer">
    <div class="wrap">
        <div class="outer-header">
            <header class="clear">
                <div class="top clear">
                    <div class="outer-logo col-xl-3 col-lg-3 col-md-4 col-sm-5 col-xs-8">
                        <div class="logo">
                            <a href="/" class="logo__link">
                                <img  src="//fs.kinomania.ru/app/img/design/logo2.png" class="logo__image" alt="Logo Kinomania" title="Logo Kinomania">
                                <span class="slogan">Это мы еще посмотрим!</span>
                            </a>
                        </div>
                    </div>
                    <div class=" search-outer col-xl-6 col-lg-6 col-md-6 col-sm-7 col-xs-5">
                        <div class="search">
                            <form method="get" action="/search" id="search_form">
                                <div class="row-search__input">
                                    <input name="q" type="text" class="search__input" value="" placeholder="Поиск">
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
                                    <a href="#/" class="search__button button button1">Найти</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mobile-nav col-md-1 col-sm-7 col-xs-4">
                        <span class="mobile-nav-button"></span>
                        <div class="outer-mobile-nav default">
                            <div class="close">
                                <span href="#/" class="mobile-nav-button__close">Закрыть</span>
                                <ul class="mobile-nav-list clear">
                                    <li><a href="/billboard/">СМОТРЕТЬ</a>
                                        <ul class="nav-list-dop">
                                            <li><a href="/billboard/">АФИША</a></li>
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
                                            <li><a href="/blog/">БЛОГИ</a></li>
                                            <li><a href="/article/press_review/">ПРЕССА</a></li>
                                            <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                                            <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li>
                                            <li><a href="/article/inside/">ИНСАЙД</a></li>
                                            <li><a href="http://forum.kinomania.ru//">ФОРУМ</a></li>
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
                                <li><a href="/login"><span>ВХОД</span></a></li>
                                <li><a href="/registration_"><span>РЕГИСТРАЦИЯ</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <nav class="nav col-xl-12 clear">
                    <ul class="nav-list clear">
                        <li><a href="/billboard/">СМОТРЕТЬ</a>
                            <ul class="nav-list-dop">
                                <li><a href="/billboard/">АФИША</a></li>
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
                                <li><a href="/blog/">БЛОГИ</a></li>
                                <li><a href="/article/press_review/">ПРЕССА</a></li>
                                <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                                <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li>
                                <li><a href="/article/inside/">ИНСАЙД</a></li>
                                <li><a href="http://forum.kinomania.ru//">ФОРУМ</a></li>
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
                                <li><a href="/login">ВХОД</a></li>
                                <li><a href="/registration_">РЕГИСТРАЦИЯ</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <div class="main-content-other-page clear">
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-casting row-page-two">
                        <div class="page-two-head">
                            <h1 class="pagetitle mini__pagetitle">Ошибка 404, страница не найдена</h1>
                        </div>
	                    <p>
		                    К сожалению, запрашиваемая страница недоступна на KINOMANIA. Возможно, она была перемещена, или вы просто неверно указали адрес страницы.

		                    Для поиска необходимой информации используйте карту сайта или обратитесь в службу поддержки.
		                </p>
                        <br />
	                    <table  class="site-map" cellspacing="0" cellpadding="0" width="100%" border="0">
		                    <tbody>
		                    <tr>
			                    <td class="site-map-cell" colspan="2">
				                    <b>Карта сайта KINOMANIA</b>
			                    </td>
		                    </tr>
		                    <tr>
			                    <td style="margin: 18px 0;
    padding-left: 40px;">
				                    <dl class="site-map-menuError">
					                    <li class="site-map-last"><a href="/">Главная</a></li>
					                    <dt>Смотреть</dt>
					                    <li><a href="/tv/">ТВ</a></li>
					                    <li><a href="/releases/russia/">Скоро в кино</a></li>
					                    <li class="site-map-last"><a href="/article/shorts/">Shortы</a></li>
					                    <dt>Читать</dt>
					                    <li><a href="/news/">Новости</a></li>
					                    <li><a href="/article/interview/">Интервью</a></li>
					                    <li><a href="/reviews/">Рецензии</a></li>
					                    <li><a href="/article/press_review/">Пресса</a></li>
					                    <li><a href="/article/anticipation/">Ожидания</a></li>
					                    <li><a href="/article/inside/">Инсайд</a></li>
					                    <li><a href="/article/reason/">Был бы повод</a></li>
					                    <li><a href="/article/in_ten/">В десятку</a></li>
					                    <li class="site-map-last"><a href="http://forum.kinomania.ru/">Форум</a></li>
					                    <dt>Арткиномания</dt>
					                    <li><a href="/awards/">Фестивали и премии</a></li>
					                    <li><a href="/article/movie_memorial/">Boom!!</a></li>
					                    <li class="site-map-last"><a href="/scripts/">Сценарии</a></li>
					                    <dt>Медиа</dt>
					                    <li><a href="/trailers/">Трейлеры</a></li>
					                    <li><a href="/posters/">Постеры</a></li>
					                    <li><a href="/soundtracks/">Саундтреки</a></li>
					                    <li><a href="/photos/">Фото</a></li>
					                    <li><a href="/wallpapers/films/">Обои (фильмы)</a></li>
					                    <li><a href="/wallpapers/actors/">Обои (актеры)</a></li>
					                    <li class="site-map-last"><a href="/wallpapers/actresses/">Обои (актрисы)</a></li>
					                </dl>
			                    </td>
			                    <td>
				                    <dl class="site-map-menuError">
					                    <dt>Лучшие фильмы</dt>
					                    <li><a href="/top/films/">Рейтинг киномании</a></li>
					                    <li><a href="/top/">Подборки</a></li>
					                    <li class="site-map-last"><a href="/article/boxoffice/">Бокс-офис</a></li>
					                    <dt>Жанры</dt>
					                    <li><a href="/genres/films?genre=ro">Мелодрама</a></li>
					                    <li><a href="/genres/films?genre=co">Комедии</a></li>
					                    <li><a href="/genres/films?genre=th">Триллер</a></li>
					                    <li><a href="/genres/films?genre=fa">Фэнтези</a></li>
					                    <li><a href="/genres/films?genre=dr">Драма</a></li>
					                    <li><a href="/genres/films?genre=ho">Ужасы</a></li>
					                    <li><a href="/genres/films?genre=ad">Приключения</a></li>
					                    <li><a href="/genres/films?genre=ac">Боевик</a></li>
					                    <li><a href="/genres/films?genre=my">Детектив</a></li>
					                    <li class="site-map-last"><a href="/genres/films?genre=sc">Фантастика</a></li>
					                    <dt>Афиша</dt>
					                    <li class="site-map-last"><a href="/billboard/">Кинотеатры</a></li>
				                    </dl>
			                    </td>
		                    </tr>
		                    </tbody></table>
                    </div>
                </content>
            </section>
        </div>
    </div>
</div>
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
                        <li><a href="/billboard/">АФИША</a></li>
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
                        <li><a href="http://forum.kinomania.ru//">ФОРУМ</a></li>
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
            <div class="planeta-inform"><a href="http://planeta-inform.tv//"><img alt="planeta inform" src="//fs.kinomania.ru/app/img/icon/pi.png"></a></div>
        </div>
    </div>
</div>
<!-- bxSlider Javascript file -->
<script src="//fs.kinomania.ru/app/js/plugins/bx/jquery.bxslider.js"></script>
<script type="text/javascript" src="//fs.kinomania.ru/app/js/main.js?v=2"></script>

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
            append('<li><a href="/logout/"><span>ВЫХОД</span></a></li>');
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
                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            html += '<div class="slide">' +
                                '<div class="row-part-filter-slide">';

                            var list = data[key];
                            for (var i in list) {
                                if (list.hasOwnProperty(i)) {
                                    html += '<div class="part-filter-slide">' +
                                        '<div class="row-posters__image">' +
                                        '<a href="/people/' + list[i][0] + '/">' +
                                        '<div class="image-shadow-poster posters__image">' +
                                        '<img alt="" src="' + list[i][1] + '" class="parent responsive-image image-prewiew">' +
                                        '</div>' +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="bx-mini-slider-caption">' +
                                        '<div class="bxslider-part-title"><a href="/people/' + list[i][0] + '/">' + list[i][2] + '</a></div>' +
                                        '</div>' +
                                        '</div>';
                                }
                            }

                            html += '</div></div>'
                        }
                    }

                    $('#maleContent').append(html);

                    var config = {
                        auto: false,
                        minSlides: 1,
                        maxSlides: 1,
                        nextText: '',
                        prevText: '',
                        pager: false
                    };
                    var sliders = new Array();
                    $('.bxslider-part').each(function(i, slider) {
                        sliders[i] = $(slider).bxSlider();
                    });
                    $.each(sliders, function(i, slider) {
                        slider.reloadSlider(config);
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
                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            html += '<div class="slide">' +
                                '<div class="row-part-filter-slide">';

                            var list = data[key];
                            for (var i in list) {
                                if (list.hasOwnProperty(i)) {
                                    html += '<div class="part-filter-slide">' +
                                        '<div class="row-posters__image">' +
                                        '<a href="/people/' + list[i][0] + '/">' +
                                        '<div class="image-shadow-poster posters__image">' +
                                        '<img alt="" src="' + list[i][1] + '" class="parent responsive-image image-prewiew">' +
                                        '</div>' +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="bx-mini-slider-caption">' +
                                        '<div class="bxslider-part-title"><a href="/people/' + list[i][0] + '/">' + list[i][2] + '</a></div>' +
                                        '</div>' +
                                        '</div>';
                                }
                            }

                            html += '</div></div>'
                        }
                    }

                    $('#femaleContent').append(html);

                    var config = {
                        auto: false,
                        minSlides: 1,
                        maxSlides: 1,
                        nextText: '',
                        prevText: '',
                        pager: false
                    };
                    var sliders = new Array();
                    $('.bxslider-part').each(function(i, slider) {
                        sliders[i] = $(slider).bxSlider();
                    });
                    $.each(sliders, function(i, slider) {
                        slider.reloadSlider(config);
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
                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            html += '<div class="slide">' +
                                '<div class="row-part-filter-slide">';

                            var list = data[key];
                            for (var i in list) {
                                if (list.hasOwnProperty(i)) {
                                    html += '<div class="part-filter-slide">' +
                                        '<div class="row-posters__image">' +
                                        '<a href="/people/' + list[i][0] + '/">' +
                                        '<div class="image-shadow-poster posters__image">' +
                                        '<img alt="" src="' + list[i][1] + '" class="parent responsive-image image-prewiew">' +
                                        '</div>' +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="bx-mini-slider-caption">' +
                                        '<div class="bxslider-part-title"><a href="/people/' + list[i][0] + '/">' + list[i][2] + '</a></div>' +
                                        '</div>' +
                                        '</div>';
                                }
                            }

                            html += '</div></div>'
                        }
                    }

                    $('#childContent').append(html);

                    var config = {
                        auto: false,
                        minSlides: 1,
                        maxSlides: 1,
                        nextText: '',
                        prevText: '',
                        pager: false
                    };
                    var sliders = new Array();
                    $('.bxslider-part').each(function(i, slider) {
                        sliders[i] = $(slider).bxSlider();
                    });
                    $.each(sliders, function(i, slider) {
                        slider.reloadSlider(config);
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
<?php BodyScript::getContent();?>
</body>
</html>
