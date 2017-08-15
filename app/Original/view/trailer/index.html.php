<?php
/**
 * @var string $static
 * @var array $genre
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Trailer as Trailer;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Трейлеры фильмов | KINOMANIA.RU</title>
    <meta name="description" content="Трейлеры фильмов: новые трейлеры к фильмам, мультфильмам, российским и зарубежным сериалам. KINOMANIA.RU – все о мире кино и жизни актеров."/>
    <meta name="keywords" content="трейлер, trailer, тизер, скачивание, онлайн"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/trailers" />
    <meta property="og:title" content="Трейлеры фильмов" />
    <meta property="og:description" content="Трейлеры фильмов: новые трейлеры к фильмам, мультфильмам, российским и зарубежным сериалам."/>

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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h1 class="pagetitle trailers-pagetitle">Трейлеры</h1>
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
                                                    <li><a href="#" data-value="<?= $code ?>" class="filter genre"><?= $name ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item language">
                                        <div class="selection-trailers__name">Язык:</div>
                                        <div class="selection-trailers__value">
                                            <ul class="selection-trailers__value-list">
                                                <li><a href="#" data-value="no" class="filter local">оригинальный</a></li>
                                                <li><a href="#" data-value="yes" class="filter local">локализованный</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item type">
                                        <div class="selection-trailers__name">Тип:</div>
                                        <div class="selection-trailers__value">
                                            <ul class="selection-trailers__value-list">
                                                <li><a href="#" data-value="трейлер" class="filter type">трейлер</a></li>
                                                <li><a href="#" data-value="тизер" class="filter type">тизер</a></li>
                                                <li><a href="#" data-value="телеролик" class="filter type">телеролик</a></li>
                                                <li><a href="#" data-value="эпизод" class="filter type">эпизод</a></li>
                                                <li><a href="#" data-value="репортаж" class="filter type">репортаж</a></li>
                                                <li><a href="#" data-value="клип" class="filter type">клип</a></li>
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
                    <div class="content-list">
                        <div class="content-page__titile">
                            <h1>НОВЫЕ ТРЕЙЛЕРЫ</h1>
                        </div>
                        <ul class="tab-list film_type clear">
                            <li class="active" data-type="ru" data-type-slidergroup="new_trailers" data-type-sliderbutton="1">ФИЛЬМЫ</li>
                            <li class="default" data-type="eng" data-type-slidergroup="new_trailers" data-type-sliderbutton="2">ЗАРУБЕЖНЫЕ СЕРИАЛЫ</li>
                            <li class="default" data-type="eng" data-type-slidergroup="new_trailers" data-type-sliderbutton="3">РОССИЙСКИЕ СЕРИАЛЫ</li>
                        </ul>
                        <div class="result-list-content active trailer_content_1" data-type-slidergroup="new_trailers" data-type-sliderelem="1">
                            <?php $count = count($list); ?>
                            <?php for ($i = 0; $i < $count; $i++): ?>
                                <?php if (!isset($list[$i])) { break; } ?>
                                <div class="trailer-item clear">
                                    <div class="row-trailer-image">
                                        <div class="image-shadow">
                                            <a href="/film/<?= $list[$i][Trailer::FILM_ID] ?>/trailers/<?= $list[$i][Trailer::ID] ?>/" class="parent play_video_main"><img alt="" src="//:0" data-original="<?= $list[$i][Trailer::IMAGE] ?>" class="lazy image-cover">
                                                <i class="trailer__play-icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row-trailer-text">
                                        <div class="trailer-list-title"><a href="/film/<?= $list[$i][Trailer::FILM_ID] ?>/trailers/<?= $list[$i][Trailer::ID] ?>/"><?= $list[$i][Trailer::FILM_NAME] ?></a> &nbsp; <?= $list[$i][Trailer::NAME] ?></div>
                                        <div class="trailer-list-add">Добавлен: <?= $list[$i][Trailer::DATE] ?></div>
                                        <div class="trailer-list-view">
                                            Смотреть онлайн:
                                            <ul class="trailer-list-view-quality trailer-view-quality-display">
                                                <?php if (empty($list[$i][Trailer::HD_480])): ?>
                                                    <li><span>HD 480</span></li>
                                                <?php else: ?>
                                                    <li><a href="<?= $list[$i][Trailer::HD_480] ?>" class="play_video"><span>HD 480</span></a></li>
                                                <?php endif ?>

                                                <?php if (empty($list[$i][Trailer::HD_720])): ?>
                                                    <li><span>HD 720</span></li>
                                                <?php else: ?>
                                                    <li><a href="<?= $list[$i][Trailer::HD_720] ?>" class="play_video"><span>HD 720</span></a></li>
                                                <?php endif ?>

                                                <?php if (empty($list[$i][Trailer::HD_1080])): ?>
                                                    <li><span>HD 1080</span></li>
                                                <?php else: ?>
                                                    <li><a href="<?= $list[$i][Trailer::HD_1080] ?>" class="play_video"><span>HD 1080</span></a></li>
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
                        <div class="result-list-content active trailer_content_2" data-type-slidergroup="new_trailers" data-type-sliderelem="2">

                        </div>
                        <div class="result-list-content active trailer_content_3" data-type-slidergroup="new_trailers" data-type-sliderelem="3">

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
    <!-- include section/scripts.html.php -->
<link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
<script src="<?= $static ?>/app/js/video.ie8.js"></script>
<script src="<?= $static ?>/app/js/video.js"></script>
<script src="<?= $static ?>/app/js/videojs.ads.js"></script>
<script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
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
                            '   			<a href="/film/' + data[key][<?= Trailer::FILM_ID ?>] + '/trailers/' + data[key][<?= Trailer::ID ?>] + '/" class="parent play_video_main"><img alt="" src="//:0" data-original="' + data[key][<?= Trailer::IMAGE ?>] + '" class="lazy image-cover">  '  +
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
                                html += '<li><a href="' + data[key][<?= Trailer::HD_480 ?>] + '" class="play_video"><span>HD 480</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_720 ?>]) {
                                html += '<li><span>HD 720</span></li>';
                            } else {
                                html += '<li><a href="' + data[key][<?= Trailer::HD_720 ?>] + '" class="play_video"><span>HD 720</span></a></li>';
                            }
                            if ('' == data[key][<?= Trailer::HD_1080 ?>]) {
                                html += '<li><span>HD 1080</span></li>';
                            } else {
                                html += '<li><a href="' + data[key][<?= Trailer::HD_1080 ?>] + '" class="play_video"><span>HD 1080</span></a></li>';
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
</body>
</html>
