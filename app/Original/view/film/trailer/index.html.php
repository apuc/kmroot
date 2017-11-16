<?php
/**
 * @var int $id
 * @var array $min
 * @var array $list
 * @var string $static
 * @var $player
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Trailer as Trailer;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ('' == $min[Film::NAME_RU]): ?>
        <title>Трейлеры к фильму <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="Трейлеры и полная информация о фильме «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер"/>

        <meta property="og:title" content="Трейлеры к фильму <?= $min[Film::NAME_ORIGIN] ?>" />
        <meta property="og:description" content="Трейлеры и полная информация о фильме <?= $min[Film::NAME_ORIGIN] ?>."/>
    <?php else: ?>
        <title>Трейлеры к фильму <?= $min[Film::NAME_RU] ?> | <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="Трейлеры и полная информация о фильме «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер"/>

        <meta property="og:title" content="Трейлеры к фильму <?= $min[Film::NAME_RU] ?>" />
        <meta property="og:description" content="Трейлеры и полная информация о фильме <?= $min[Film::NAME_RU] ?>."/>
    <?php endif ?>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/trailers" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/trailers"/>
    <!-- include section/head.html.php -->
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
        <!-- include section/header.html.php -->
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <div class="head-content">
                <div class="info-user">
                    <?php if ('' == $min[Film::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_ORIGIN] ?></a></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_RU] ?></a></h1>
                        <h2 class="name__page"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_ORIGIN] ?></a></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include film/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-pagelist header-search header-pagelist--black">
                        <div class="inner-header-pagelist">
                            <div class="pagelist-title-black ">Видео <span class="number--opacity"><?= $stat[\Kinomania\Original\Key\Film\Stat::TRAILER] ?></span></div>
                            <div class="section-video section-black-video">
                                <div class="outer-trailer-item">
                                    <div class="">
                                        <div class="trailer-list-item">
                                            <div class="video-prewiew video_top" onclick="upToView(<?= $list[0][Trailer::FILM_ID] ?>)" data-prev="<?= $list[0][Trailer::IMAGE] ?>">
                                                <img alt="" src="<?= $list[0][Trailer::IMAGE] ?>" class="responsive-image video-prewiew__item">
                                            </div>
                                            <div class="head-desc clear">
                                                <div class="trailer__title">
                                                    <p class="title"><a href="/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>/"><?= $list[0][Trailer::NAME] ?></a></p>
                                                    <p class="create__trailer-date">Добавлен: <?= $list[0][Trailer::DATE] ?></p>
                                                </div>

                                                <div class="item item2">
                                                    <a href="/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>#commentList">
                                                    <span class="button button3">
                                                        <i class="item__icon sprite"></i>
                                                        <?php if (0 < $list[0][Trailer::COMMENT]): ?>
                                                            <span class="number"><?= $list[0][Trailer::COMMENT] ?></span>
                                                        <?php endif ?>
                                                        Комментировать
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="download download-trailer">
                                    <div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
                                        <div class="outer-dop-download">
                                            <div class="dop-download">
                                                <?php if ('' != $list[0][Trailer::HD_480]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_480] ?>">Низкое</a>
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_480] ?>">HD 480</a>
                                                    </div>
                                                <?php endif ?>
                                                <?php if ('' != $list[0][Trailer::HD_720]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_720] ?>">Среднее</a>
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_720] ?>">HD 720</a>
                                                    </div>
                                                <?php endif ?>
                                                <?php if ('' != $list[0][Trailer::HD_1080]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_1080] ?>">Высокое</a>
                                                        <a href="/load/n?file=<?= $list[0][Trailer::HD_1080] ?>">HD 1080</a>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="outer-social clear">
                                    <ul class="social-list social-list--horizontal">
                                        <li class="vk" id="vk_item_share"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list[0][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list[0][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                        <li class="fb" id="fb_item_share"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list[0][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list[0][Trailer::ID] ?>&src=sp/"><span class="number"></span></a></li>
                                        <li class="ok" id="ok_item_share"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list[0][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list[0][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                        <li class="pinterest" id="pt_item_share"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list[0][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list[0][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="list-content">
                        <?php $count = count($list); ?>
                        <?php for ($i = 1; $i < $count; $i++): ?>
                            <?php if (!isset($list[$i])) { break; } ?>
                            <div class="trailer-item clear">
                                <div class="row-trailer-image">
                                    <div class="image-shadow">
                                        <a href="/film/<?= $list[$i][Trailer::FILM_ID] ?>/trailers/<?= $list[$i][Trailer::ID] ?>/" class="parent play_video_main" onclick="upToView(<?= $list[$i][Trailer::FILM_ID] ?>)" data-prev="<?= $list[$i][Trailer::IMAGE] ?>"><img alt="" src="//:0" data-original="<?= $list[$i][Trailer::IMAGE] ?>" class="lazy image-cover">
                                            <i class="trailer__play-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row-trailer-text">
                                    <div class="trailer-list-title"><a href="/film/<?= $list[$i][Trailer::FILM_ID] ?>/trailers/<?= $list[$i][Trailer::ID] ?>/"><?= $list[$i][Trailer::NAME] ?></a></div>
                                    <div class="trailer-list-add">Добавлен: <?= $list[$i][Trailer::DATE] ?></div>
                                    <div class="trailer-list-view">
                                        Смотреть онлайн:
                                        <ul class="trailer-list-view-quality trailer-view-quality-display">
                                            <?php if (empty($list[$i][Trailer::HD_480])): ?>
                                                <li><span>HD 480</span></li>
                                            <?php else: ?>
                                                <li><a href="<?= $list[$i][Trailer::HD_480] ?>" onclick="upToView(<?= $list[$i][Trailer::FILM_ID] ?>)" class="play_video"><span>HD 480</span></a></li>
                                            <?php endif ?>

                                            <?php if (empty($list[$i][Trailer::HD_720])): ?>
                                                <li><span>HD 720</span></li>
                                            <?php else: ?>
                                                <li><a href="<?= $list[$i][Trailer::HD_720] ?>" onclick="upToView(<?= $list[$i][Trailer::FILM_ID] ?>)" class="play_video"><span>HD 720</span></a></li>
                                            <?php endif ?>

                                            <?php if (empty($list[$i][Trailer::HD_1080])): ?>
                                                <li><span>HD 1080</span></li>
                                            <?php else: ?>
                                                <li><a href="<?= $list[$i][Trailer::HD_1080] ?>" onclick="upToView(<?= $list[$i][Trailer::FILM_ID] ?>)" class="play_video"><span>HD 1080</span></a></li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <div class=" clear">
                                        <div class="trailer-list-download--left">
                                            или
                                            <div class="trailer-list-download"><span class="trailer-list-download__link">скачать</span>
                                                <i class="trailer-list-download__icon"></i>
                                                <div class="row-trailer-list-download">
                                                    <div class="row-hover-trailer-list">
                                                        <ul class="trailer-list-view-quality ">
                                                            <?php if (empty($list[$i][Trailer::HD_480])): ?>
                                                                <li><span>HD 480</span></li>
                                                            <?php else: ?>
                                                                <li><a href="/load/n?file=<?= $list[$i][Trailer::HD_480] ?>"><span>HD 480</span></a></li>
                                                            <?php endif ?>

                                                            <?php if (empty($list[$i][Trailer::HD_720])): ?>
                                                                <li><span>HD 720</span></li>
                                                            <?php else: ?>
                                                                <li><a href="/load/n?file=<?= $list[$i][Trailer::HD_720] ?>"><span>HD 720</span></a></li>
                                                            <?php endif ?>

                                                            <?php if (empty($list[$i][Trailer::HD_1080])): ?>
                                                                <li><span>HD 1080</span></li>
                                                            <?php else: ?>
                                                                <li><a href="/load/n?file=<?= $list[$i][Trailer::HD_1080] ?>"><span>HD 1080</span></a></li>
                                                            <?php endif ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-video">
                                            <div class="trailer-list-download--right">
                                                <span class="button button3" onclick="document.location='/film/<?= $list[$i][Trailer::FILM_ID] ?>/trailers/<?= $list[$i][Trailer::ID] ?>#commentList'"><i class="item__icon sprite"></i><span class="number"><?= $list[$i][Trailer::COMMENT] ?></span>Комментировать</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <br />
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/trailers"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/trailers"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers/"></a></li>
                            </ul>
                        </div>
                    </div>
                </content>
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
	<div id="playVideo" onclick="closeVideo()">
		<div id="player">
			<div class="video"></div>
		</div>
	</div>
    <!-- include section/scripts.html.php -->
<link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
<script src="<?= $static ?>/app/js/video.ie8.js"></script>
<script src="<?= $static ?>/app/js/video.js"></script>
<script src="<?= $static ?>/app/js/videojs.ads.js"></script>
<script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?= $static ?>/app/js/film.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        $('.play_video').click(function(e){
            e = e || window.event;
            var href = $(this).attr('href');
	        var prev = $(this).attr('data-prev');
	        <?php if($player != 'js'):?>
	            startVideo(href, prev);
	            return false;
	        <?php endif;?>

            if ('' != href) {
                if (-1 !== href.indexOf('.mp4')) {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/mp4\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                } else {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/flv\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                }
                var width = 800;
                if (800 >= $(window).width()) {
                    width = $(window).width();
                }
                var player = videojs('trailer_video', {
                    "controls": true,
                    "autoplay": true,
                    "preload": "auto",
                    "width": width
                }, function () {
                    this.play();
                });
                if ('' !== window.__pre_roll__) {
                    player.preroll({
                        src: window.__pre_roll__,
                        href: window.__pre_roll_link__,
                        target: '_blank ',
                        lang: {
                            'skip':'Пропустить',
                            'skip in': 'Пропустить через ',
                            'advertisement': 'Реклама',
                            'video start in': 'Видео начнется через: '
                        }
                    });
                    player.one('adstart', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'View'])
                        }
                    });
                    player.one('adskip', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Skip'])
                        }
                    });
                    $(document).on('click', 'a.preroll-blocker', function(){
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Click'])
                        }
                    });
                }
            }
            $('.my-overlay').addClass('active');
            $('.my-overlay .overlay-trailer-item').addClass('active');

            e.preventDefault();
            return false;
        });

        $('.my-overlay-bg').click(function(event) {
            var oldPlayer = document.getElementById('trailer_video');
            if (null !== oldPlayer) {
                videojs(oldPlayer).dispose();
            }

            $('.my-overlay').removeClass('active');
            $('.my-overlay .overlay-auth-item').removeClass('active');
            $('.my-overlay .overlay-trailer-item').removeClass('active');
        });

        $('.play_video_main').click(function(e){
            e = e || window.event;
            var href = $(this).parent().parent().parent().find('.trailer-list-view-quality').find('a:last').attr('href');
	        var prev = $(this).attr('data-prev');
	        <?php if($player != 'js'):?>
	            startVideo(href, prev);
	            return false;
	        <?php endif;?>
            
            if ('' != href) {
                href = href.split('file=');
                href = href[1];
                if (-1 !== href.indexOf('.mp4')) {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/mp4\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                } else {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/flv\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                }
                var width = 800;
                if (800 >= $(window).width()) {
                    width = $(window).width();
                }
                var player = videojs('trailer_video', {
                    "controls": true,
                    "autoplay": true,
                    "preload": "auto",
                    "width": width
                }, function () {
                    this.play();
                });
                if ('' !== window.__pre_roll__) {
                    player.preroll({
                        src: window.__pre_roll__,
                        href: window.__pre_roll_link__,
                        target: '_blank ',
                        lang: {
                            'skip':'Пропустить',
                            'skip in': 'Пропустить через ',
                            'advertisement': 'Реклама',
                            'video start in': 'Видео начнется через: '
                        }
                    });
                    player.one('adstart', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'View'])
                        }
                    });
                    player.one('adskip', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Skip'])
                        }
                    });
                    $(document).on('click', 'a.preroll-blocker', function(){
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Click'])
                        }
                    });
                }
            }
            $('.my-overlay').addClass('active');
            $('.my-overlay .overlay-trailer-item').addClass('active');

            e.preventDefault();
            return false;
        });

        $('.video_top').click(function(){
            var href = $(this).parent().parent().parent().parent().find('.dop-download').find('a:last').attr('href');
//	        var href2 = href.split('=')[1];
            var prev = $(this).attr('data-prev');
			<?php if($player != 'js'):?>
	            startVideo(href, prev);
	            return false;
			<?php endif;?>
            
            if ('' != href) {
                href = href.split('file=');
                href = href[1];
                if (-1 !== href.indexOf('.mp4')) {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/mp4\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                } else {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/flv\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                }
                var width = 800;
                if (800 >= $(window).width()) {
                    width = $(window).width();
                }
                var player = videojs('trailer_video', {
                    "controls": true,
                    "autoplay": true,
                    "preload": "auto",
                    "width": width
                }, function () {
                    this.play();
                });
                if ('' !== window.__pre_roll__) {
                    player.preroll({
                        src: window.__pre_roll__,
                        href: window.__pre_roll_link__,
                        target: '_blank ',
                        lang: {
                            'skip':'Пропустить',
                            'skip in': 'Пропустить через ',
                            'advertisement': 'Реклама',
                            'video start in': 'Видео начнется через: '
                        }
                    });
                    player.one('adstart', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'View'])
                        }
                    });
                    player.one('adskip', function() {
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Skip'])
                        }
                    });
                    $(document).on('click', 'a.preroll-blocker', function(){
                        if('undefined' != typeof _gaq) {
                            _gaq.push(['_trackEvent', 'Trailer', 'Click'])
                        }
                    });
                }
            }
            $('.my-overlay').addClass('active');
            $('.my-overlay .overlay-trailer-item').addClass('active');
        });

        setTimeout(function() {
            /**
             * Social
             */
            var url = '';
            VK = {};
            VK.Share = {};
            VK.Share.count = function (index, count) {
                $('#vk_item_share span').text(count);
            };
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>&format=json&callback=?');

            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>&callback=?', function (data) {
                if ('undefined' == typeof data.share) {
                    data.share = {};
                    data.share.share_count = 0;
                }
                $('#fb_item_share span').text(data.share.share_count);
            });

            ODKL = {};
            ODKL.updateCountOC = function (a, count) {
                $('#ok_item_share span').text(count);
            };
            $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=http://www.kinomania.ru/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>&callback=?');

            $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=http://www.kinomania.ru/film/<?= $list[0][Trailer::FILM_ID] ?>/trailers/<?= $list[0][Trailer::ID] ?>&callback=?', function (data) {
                $('#pt_item_share span').text(data.count);
            });
        }, 1500);
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
