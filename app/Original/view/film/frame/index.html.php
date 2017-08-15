<?php
/**
 * @var int $id
 * @var array $min
 * @var array $list
 * @var array $filmCast
 * @var array $filmCrew
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Frame as Frame;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Кадры фильма <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Кадры фильма «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, кадры"/>
    <?php else: ?>
        <meta name="description" content="Кадры фильма «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, кадры"/>
    <?php endif ?>

    <meta property="og:title" content="Кадры фильма <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/frames" />

    <!-- include section/head.html.php -->

    <style>
        .inner-overlay-caption .text a {
            text-decoration: none;
        }
        .inner-overlay-caption .text a:after {
            content: ",  ";
        }
        .inner-overlay-caption .text a:last-child:after {
            content: "";
        }
    </style>
</head>
<body>
<div class="overlay-photo overlay-posters">
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
                    <!-- <h1 class="pagetitle mini__pagetitle">РЕЗУЛЬТАТЫ ПОИСКА</h1> -->
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
                                                    <a href="/film/<?= $id ?>/frames/<?= $frame[Frame::ID] ?>">
                                                        <img src="//:0"  data-original="<?= $frame[Frame::PREVIEW] ?>" alt="" class="lazy image-cover">
                                                    </a>
                                                    <div class="trailer-caption-hide">
                                                        <input type="hidden" name="href" value="/film/<?= $id ?>/frames/<?= $frame[Frame::ID] ?>" class="hidden-data" />
                                                        <div class="info">
                                                            <?php if ('' == $min[Film::NAME_RU]): ?>
                                                                <p class="title"><?= $min[Film::NAME_ORIGIN] ?></p>
                                                            <?php else: ?>
                                                                <p class="title"><?= $min[Film::NAME_RU] ?></p>
                                                            <?php endif ?>

                                                            <?php if (count($filmCrew)): ?>
                                                                <p class="text name">
                                                                    Режиссер:
                                                                    <?php foreach ($filmCrew as $crewItem): ?>
                                                                        <a href="/people/<?= $crewItem[0] ?>/"><?= $crewItem[1] ?></a>
                                                                    <?php endforeach; ?>
                                                                </p>
                                                            <?php endif ?>
                                                            <?php if (count($filmCast)): ?>
                                                                <p class="text name">
                                                                    В ролях:
                                                                    <?php foreach ($filmCast as $castItem): ?>
                                                                        <a href="/people/<?= $castItem[0] ?>/"><?= $castItem[1] ?></a>
                                                                    <?php endforeach; ?>
                                                                </p>
                                                            <?php endif ?>

                                                            <?php if (count($frame[Frame::CAST])): ?>
                                                                <p class="text name">
                                                                    На кадре:
                                                                    <?php foreach ($frame[Frame::CAST] as $cast): ?>
                                                                        <a href="/people/<?= $cast[0] ?>/"><?= $cast[1] ?></a>
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
                        <br />
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/frames"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fframes/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/frames"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fframes&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fframes/"></a></li>
                                </ul>
                            </div>
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
    <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
    <script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.image-cover-parent').magnificPopup({
                type: 'image'
            });
            $("img.lazy").lazyload({
                effect : "fadeIn"
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

                setTimeout(function(){
                    var t = new Image();
                    t.src = $('.inner-overlay-image img').attr('src');
                    var maxHeight = $(window.top).height() - 250;
                    if (t.height > maxHeight) {
                        var k = t.width / t.height;
                        var width = maxHeight * k;
                        $('.inner-overlay-photo').css('max-width', width + 'px');
                    }
                }, 200);
            });
            $('.inner-overlay-image img').css('max-height', $(window.top).height() - 250 + 'px');

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
                setTimeout(function(){
                    var t = new Image();
                    t.src = $('.inner-overlay-image img').attr('src');
                    var maxHeight = $(window.top).height() - 250;
                    if (t.height > maxHeight) {
                        var k = t.width / t.height;
                        var width = maxHeight * k;
                        $('.inner-overlay-photo').css('max-width', width + 'px');
                    }
                }, 200);

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
                setTimeout(function(){
                    var t = new Image();
                    t.src = $('.inner-overlay-image img').attr('src');
                    var maxHeight = $(window.top).height() - 250;
                    if (t.height > maxHeight) {
                        var k = t.width / t.height;
                        var width = maxHeight * k;
                        $('.inner-overlay-photo').css('max-width', width + 'px');
                    }
                }, 200);

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
