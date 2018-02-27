<?php
/**
 * @var string $static
 * @var array $genre
 * @var $options \Kinomania\System\Options\Options
 * @var array $list
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

    <title><?=$options->get('seo_trailers_title');?></title>
    <meta name="description" content="<?=$options->get('seo_trailers_description');?>"/>
    <meta name="keywords" content="<?=$options->get('seo_trailers_keywords');?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/trailers"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/trailers" />
    <meta property="og:title" content="Трейлеры фильмов" />
    <meta property="og:description" content="Трейлеры фильмов: новые трейлеры к фильмам, мультфильмам, российским и зарубежным сериалам."/>

    <!-- include section/head.html.php -->
</head>

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

<div class="outer">
    <div class="wrap">
        <!-- include section/header.html.php -->
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h1 class="pagetitle trailers-pagetitle">
	                    ТЕСТ ВИДЕО
                    </h1>
                    <div class="content-list">
	                    
	                    <?php foreach ($list as $item => $value):?>
		                    <?php if(!is_array($value)):?>
	                            <?=$item?><br>
	                        <?php else:?>
		                        <?php foreach ($value as $i => $val ):?>
		                            <?=$i?> = <?=$val?><br>
		                        <?php endforeach;?>
	                        <?php endif;?>
	                    <?php endforeach;?>
	                    
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="trailers"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ftrailers/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="trailers"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ftrailers&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ftrailers/"></a></li>
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
</div>
<link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
<script src="<?= $static ?>/app/js/video.ie8.js"></script>
<script src="<?= $static ?>/app/js/video.js"></script>
<script src="<?= $static ?>/app/js/videojs.ads.js"></script>
<script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?= $static ?>/app/js/trailer.js"></script>
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
            if ('series_en' == filter.tab) {
                $('.trailer_content_2').html('');
            } else if ('series_ru' == filter.tab) {
                $('.trailer_content_3').html('');
            } else {
                $('.trailer_content_1').html('');
            }
        }

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
                        html +=  '   <div class="trailer-item clear">  '  +
                            '   	<div class="row-trailer-image">  '  +
                            '   		<div class="image-shadow">  '  +
                            '   			<a href="/film/' + data[key][<?= Trailer::FILM_ID ?>] + '/trailers/' + data[key][<?= Trailer::ID ?>] + '/" data-prev="' + data[key][<?= Trailer::IMAGE ?>] + '" class="parent play_video_main" onclick="upToView('+ data[key][<?= Trailer::FILM_ID?>]+');"><img alt="" src="//:0" data-original="' + data[key][<?= Trailer::IMAGE ?>] + '" class="lazy image-cover">  '  +
                            '   				<i class="trailer__play-icon"></i>  '  +
                            '   			</a>  '  +
                            '   		</div>  '  +
                            '   	</div>  '  +
                            '   	<div class="row-trailer-text">  '  +
                            '   		<div class="trailer-list-title"><a href="/film/' + data[key][<?= Trailer::FILM_ID ?>] + '/trailers/' + data[key][<?= Trailer::ID ?>] + '/">' + data[key][<?= Trailer::FILM_NAME ?>] + '</a> &nbsp; ' + data[key][<?= Trailer::NAME ?>] + '</div>  '  +
                            '   		<div class="trailer-list-add">Добавлен: ' + data[key][<?= Trailer::DATE ?>] + '</div>  '  +
                            '   		<div class="trailer-list-view">  '  +
                            '   			Смотреть онлайн:  '  +
                            '   			<ul class="trailer-list-view-quality trailer-view-quality-display">  ';
                            if ('' == data[key][<?= Trailer::HD_480 ?>]) {
                                html += '<li><span>HD 480</span></li>';
                            } else {
                                html += '<li><a href="' + data[key][<?= Trailer::HD_480 ?>] + '" data-prev="' + data[key][<?= Trailer::IMAGE ?>] + '" class="play_video"><span>HD 480</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_720 ?>]) {
                                html += '<li><span>HD 720</span></li>';
                            } else {
                                html += '<li><a href="' + data[key][<?= Trailer::HD_720 ?>] + '" data-prev="' + data[key][<?= Trailer::IMAGE ?>] + '" class="play_video"><span>HD 720</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_1080 ?>]) {
                                html += '<li><span>HD 1080</span></li>';
                            } else {
                                html += '<li><a href="' + data[key][<?= Trailer::HD_1080 ?>] + '" data-prev="' + data[key][<?= Trailer::IMAGE ?>] + '"class="play_video"><span>HD 1080</span></a></li>';
                            }
                            html += '</ul>  '  +
                            '   		</div>  '  +
                            '   		<div class=" clear">  '  +
                            '   			<div class="trailer-list-download--left">  '  +
                            '   				или  '  +
                            '   				<div class="trailer-list-download"><span class="trailer-list-download__link">скачать</span>  '  +
                            '   					<i class="trailer-list-download__icon"></i>  '  +
                            '   					<div class="row-trailer-list-download">  '  +
                            '   						<div class="row-hover-trailer-list">  '  +
                            '   							<ul class="trailer-list-view-quality ">  ';
                            if ('' == data[key][<?= Trailer::HD_480 ?>]) {
                                html += '<li><span>HD 480</span></li>';
                            } else {
                                html += '<li><a href="/load/n?file=' + data[key][<?= Trailer::HD_480 ?>] + '"><span>HD 480</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_720 ?>]) {
                                html += '<li><span>HD 720</span></li>';
                            } else {
                                html += '<li><a href="/load/n?file=' + data[key][<?= Trailer::HD_720 ?>] + '"><span>HD 720</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_1080 ?>]) {
                                html += '<li><span>HD 1080</span></li>';
                            } else {
                                html += '<li><a href="/load/n?file=' + data[key][<?= Trailer::HD_1080 ?>] + '"><span>HD 1080</span></a></li>';
                            }
                            html += '</ul>  '  +
                            '   						</div>  '  +
                            '   					</div>  '  +
                            '   				</div>  '  +
                            '   			</div>  '  +
                            '   			<div class="section-video">  '  +
                            '   				<div class="trailer-list-download--right">  '  +
                            '   					<span class="button button3" onclick="document.location=\'/film/' + data[key][<?= Trailer::FILM_ID ?>] + '/trailers/' + data[key][<?= Trailer::ID ?>] + '#commentList\'"><i class="item__icon sprite"></i><span class="number">' + data[key][<?= Trailer::COMMENT ?>] + '</span>Комментировать</span>  '  +
                        '   				</div>  '  +
                        '   			</div>  '  +
                        '   		</div>  '  +
                        '   	</div>  '  +
                        '  </div>  ';
                    }
                }
                if (0 == data.length) {
                    html = '<p>&nbsp; &nbsp; &nbsp; Ничего не найдено</p>';
                }

                if ('series_en' == filter.tab) {
                    $('.trailer_content_2').append(html);
                } else if ('series_ru' == filter.tab) {
                    $('.trailer_content_3').append(html);
                } else {
                    $('.trailer_content_1').append(html);
                }

                $("img.lazy[proc!=true]").lazyload({
                    effect : "fadeIn"
                });
                $("img.lazy").attr('proc', 'true');

                $('.play_video').click(function(e){
                    e = e || window.event;
                    var href = $(this).attr('href');
	                var prev = $(this).attr('data-prev');
	                <?php if(isset($player) and ($player) != 'js'):?>
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
                    console.log(oldPlayer);return false;
                    if (null !== oldPlayer) {
                        videojs(oldPlayer).dispose();
                    }

                    $('.my-overlay').removeClass('active');
                    $('.my-overlay .overlay-auth-item').removeClass('active');
                    $('.my-overlay .overlay-trailer-item').removeClass('active');
                });

                $('.play_video_main').click(function(e){
                    e = e || window.event;
	                var href = '//fs.kinomania.ru/media/video/c/ad/cad238d1a08f7e900773636d4f9e53b1.1080.mp4';
	                var prev = $(this).attr('data-prev');
	                <?php if(isset($player) and ($player) != 'js'):?>
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
            'local': [],
            'type': [],
            'year': [],
            'letter': '',
            'tab': 'film',
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

            if ($(this).hasClass('local')) {
                var local = $(this).attr('data-value');
                if(-1 == FILTER.local.indexOf(local)) {
                    FILTER.local.push(local);
                    $(this).addClass('active');
                } else {
                    FILTER.local.splice(FILTER.local.indexOf(local), 1);
                    $(this).removeClass('active');
                }
            }

            if ($(this).hasClass('type')) {
                var type = $(this).attr('data-value');
                if(-1 == FILTER.type.indexOf(type)) {
                    FILTER.type.push(type);
                    $(this).addClass('active');
                } else {
                    FILTER.type.splice(FILTER.type.indexOf(type), 1);
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

        $('.film_type li').click(function(){
            FILTER['page'] = 1;
            var index = $(this).attr('data-type-sliderbutton');
            if (2 == index) {
                FILTER.tab = 'series_en';
            } else if (3 == index) {
                FILTER.tab = 'series_ru';
            } else {
                FILTER.tab = 'film';
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

        $('.play_video').click(function(e){
            e = e || window.event;
            var href = $(this).attr('href');
	        var prev = $(this).attr('data-prev');
	        <?php if(isset($player) and ($player) != 'js'):?>
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
            var href = '//fs.kinomania.ru/media/video/c/ad/cad238d1a08f7e900773636d4f9e53b1.1080.mp4';
	        var prev = $(this).attr('data-prev');
	        <?php if(isset($player) and ($player) != 'js'):?>
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
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
