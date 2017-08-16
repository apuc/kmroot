<?php
/**
 * @var string $static
 * @var array $genre
 * @var array $popular
 * @var array $list
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\Film\Wallpaper as Wallpaper;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_actresses_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_actresses_description') ?>"/>
    <meta name="keywords" content="<?= $options->get('seo_actresses_keywords') ?>"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/wallpapers/actresses" />
    <meta property="og:title" content="Обои для рабочего стола: актрисы" />
    <meta property="og:description" content="Большая коллекция фотографий и обоев с самыми популярными актерами кино и сериалов."/>

    <!-- include section/head.html.php -->
</head>
<body>
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
                    <div class="row-wallpapers">
                        <div class="row-list-nav-second">
                            <ul class="list-nav-second clear">
                                <li ><a href="/wallpapers/films/">Фильмы</a></li>
                                <li><a href="/wallpapers/actors/">Актеры</a></li>
                                <li class="active"><a href="/wallpapers/actresses/">Актрисы</a></li>
                            </ul>
                        </div>
                    </div>

                    <h1 class="pagetitle soundtracks-pagetitle"><?= $options->get('seo_actresses_h1') ?></h1>
                    <div class="outer-selection-trailers">
                        <div data-type-openclose-button="open_close" data-type-openclose-class="active" class="button__selection-trailers"><span>Подбор по параметрам</span></div>
                        <div class="selection-trailers">
                            <div class="row-selection-hide" data-type-openclose-element="open_close">
                                <div class="selection-trailers-item clear">
                                    <div class="item ganre">
                                        <div class="selection-trailers__value">
                                            <ul class="selection-trailers__value-list">
                                                <li><a href="#" data-value="ru" class="filter origin">российские</a></li>
                                                <li><a href="#" data-value="foreign" class="filter origin">иностранные</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="selection-trailers-item clear">
                                    <div class="item years" data-type="slider" data-type-slider-min="0" data-type-slider-max="100">
                                        <div class="selection-trailers__name">Возраст:</div>
                                        <div class="selection-trailers__value">
                                            <div class="outer-time-bar clear">
                                                <div class="time-bar-years">
                                                    <ul>
                                                        <li>0</li>
                                                        <li></li>
                                                        <li>100</li>
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
                                                <input type="text" id="yearFrom" name="yearFrom" class="time-value-after" data-type-slider="input_left" value="0">
                                                <span>по</span>
                                                <input type="text" id="yearTo" name="yearTo"  class="time-value-before" data-type-slider="input_right" value="100">
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
                                        <a href="/people/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/">
                                            <div class="posters__image">
                                                <img alt="" src="//:0" data-original="<?= $item[Wallpaper::IMAGE] ?>" class="lazy parent responsive-image image-prewiew">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="bx-mini-slider-caption">
                                        <div class="poster-title"><a href="/people/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/"><?= $item[Wallpaper::REL_NAME] ?></a></div>
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
                                            <a href="/people/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/">
                                                <div class="image-shadow-poster posters__image">
                                                    <img alt="" src="//:0" data-original="<?= $item[Wallpaper::IMAGE] ?>" class="lazy parent responsive-image image-prewiew">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="posters-caption">
                                            <div class="poster-title"><a href="/people/<?= $item[Wallpaper::REL_ID] ?>/wallpapers/"><?= $item[Wallpaper::REL_NAME] ?></a></div>
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
                                <li class="vk" id="vk_in_share" data-url="wallpapers/actresses"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Factresses/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="wallpapers/actresses"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Factresses&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fwallpapers%2Factresses/"></a></li>
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
                            '   		<a href="/people/' + data[key][<?= Wallpaper::REL_ID ?>] + '/wallpapers/">  '  +
                            '   			<div class="image-shadow-poster posters__image">  '  +
                            '   				<img alt="" src="//:0" data-original="' + data[key][<?= Wallpaper::IMAGE ?>] + '" class="lazy parent responsive-image image-prewiew">  '  +
                            '   			</div>  '  +
                            '   		</a>  '  +
                            '   	</div>  '  +
                            '   	<div class="posters-caption">  '  +
                            '   		<div class="poster-title"><a href="/people/' + data[key][<?= Wallpaper::REL_ID ?>] + '/wallpapers/">' + data[key][<?= Wallpaper::REL_NAME ?>] + '</a></div>  '  +
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
            'origin': [],
            'year': [],
            'letter': '',
            'page': 1
        };

        $('.filter').click(function(e){
            e = e || window.event;
            e.preventDefault();

            FILTER['page'] = 1;
            
            if ($(this).hasClass('origin')) {
                var origin = $(this).attr('data-value');
                if(-1 == FILTER.origin.indexOf(origin)) {
                    FILTER.origin.push(origin);
                    $(this).addClass('active');
                } else {
                    FILTER.origin.splice(FILTER.origin.indexOf(origin), 1);
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
