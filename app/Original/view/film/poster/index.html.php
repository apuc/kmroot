<?php
/**
 * @var int $id
 * @var array $min
 * @var array $list
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Frame as Frame;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Постеры фильма <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Постеры фильма «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, постеры"/>
    <?php else: ?>
        <meta name="description" content="Постеры фильма «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, постеры"/>
    <?php endif ?>

	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/posters" />

    <meta property="og:title" content="Постеры фильма <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/posters" />

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
                <img src="" alt="">
                <div class="overlay-photo-controls">
                    <div class="close"></div>
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
            <div class="inner-overlay-caption clear section-video ">

            </div>
        </div>
    </div>
</div>
<div class="desc-in-over">
    <span class="desc"></span><a class="link" target="_blank" href="/">Скачать</a>
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
                    <div class="row-posters">
                        <div class="row">
                            <?php foreach ($list as $frame): ?>
                                <div class="posters-item col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row-posters__image">
                                        <div data-type-over-parent=".row" data-type-over-img="<?= $frame[Frame::IMAGE] ?>" data-type-over-desc=".desc-in-over" data-type-over-desc-desc="<?= $frame[Frame::WIDTH] ?>x<?= $frame[Frame::HEIGHT] ?>" class="image-shadow-poster posters__image">
                                            <a href="/film/<?= $id ?>/posters/<?= $frame[Frame::ID] ?>">
                                                <img src="//:0"  data-original="<?= $frame[Frame::PREVIEW] ?>" alt="" class="lazy parent responsive-image image-prewiew">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="posters-caption">
                                        <span class="posters-caption__screen"><?= $frame[Frame::WIDTH] ?>x<?= $frame[Frame::HEIGHT] ?></span>,<span class="posters-caption__size"><?= $frame[Frame::SIZE] ?> КБ</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <br />   <br />
                        <?php if (24 <= $stat[\Kinomania\Original\Key\Film\Stat::POSTER]): ?>
                            <span class="pagelist-more sprite-before" id="more"><span class="pagelist-more__text">Еще</span></span>
                        <?php endif ?>
                    </div>
                    <div class="list-content">
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/posters"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/posters"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters/"></a></li>
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

            $('.posters__image a').click(function(e){
                e.preventDefault();
            });
            $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px');

            window.page = 1;
            $('#more').click(function(){
                var me = $(this);
                if (me.data('requestRunning')) {
                    return;
                }
                me.data('requestRunning', true);

                $('.center-loader').show();
                $('.pagelist-more').hide();
                window.page += 1;
                var page = window.page;

                $("img.lazy").attr('proc', 'true');

                $.ajax({
                    "type": "post",
                    "url": "?handler=getPhoto&page=" + page,
                    "success": function(data){
                        data = JSON.parse(data);
                        for (var key in data) {
                            if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                $('.row-posters .row').append('<div class="posters-item col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">' +
                                    '<div class="row-posters__image">' +
                                    '<div data-type-over-parent=".row" data-type-over-img="' + data[key][1] + '" data-type-over-desc=".desc-in-over" data-type-over-desc-desc="' + data[key][4] + 'x' + data[key][5] + '" class="image-shadow-poster posters__image">' +
                                    '<a href="/film/<?= $id ?>/posters/' + data[key][0] + '">' +
                                    '<img alt="" src="//:0" data-original="' + data[key][2] + '" class="lazy parent responsive-image image-prewiew">' +
                                    '</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="posters-caption">' +
                                    '<span class="posters-caption__screen">' + data[key][4] + 'x' + data[key][5] + '</span>,<span class="posters-caption__size">' + data[key][5] + ' КБ</span>' +
                                    '</div>' +
                                    '</div>');
                            }
                        }

                        $('.posters__image a').click(function(e){
                            e.preventDefault();
                        });
                        $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px');

                        $("[data-type-over-img]").on('click',function(){
                            obj = this;
                            open_over( obj );
                        });

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
                    complete: function() {
                        me.data('requestRunning', false);
                        $('.center-loader').hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
