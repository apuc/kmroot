<?php
/**
 * @var int $id
 * @var array $min
 * @var string $static
 * @var array $list
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Photo as Photo;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $min[Person::TITLE] ?> фото актера | Только лучшие фотографии (<?= $stat[\Kinomania\Original\Key\Person\Stat::PHOTO] ?> шт.) | KINOMANIA.RU</title>
    <meta name="description" content="<?= $min[Person::TITLE] ?> фото (все фотографии) на KINOMANIA.RU. Фильмография, биография, обои, факты, новости и многое другое о звёздах мирового кинематографа." />
    <meta name="keywords" content="<?= $min[Person::NAME_RU] ?> <?= $min[Person::NAME_ORIGIN] ?> фото фотографии" />

	<link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/photos"/>

    <meta property="og:title" content="<?= $min[Person::TITLE] ?> фото актера" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/photos" />
    <meta property="og:description" content="<?= $min[Person::TITLE] ?> Только лучшие фотографии"/>

    <!-- include section/head.html.php -->
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
                <!--  Содержимое описания  -->
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
                    <?php if ('' == $min[Person::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_RU] ?></a></h1>
                        <h2 class="name__page"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include person/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-posters">
                        <div class="row">
                            <?php foreach ($list as $item): ?>
                                <div class="posters-item col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row-posters__image">
                                        <div data-type-over-parent=".row" data-type-over-img="<?= $item[Photo::IMAGE] ?>" data-type-over-desc=".desc-in-over" data-type-over-desc-desc="<?= $item[Photo::DESCRIPTION] ?>" class="image-shadow-poster posters__image">
                                            <a href="<?= '/people/' . $id . '/photos/' . $item[Photo::ID] ?>">
                                                <img alt="" data-original="<?= $item[Photo::PREVIEW] ?>" src="//:0" class="lazy parent responsive-image image-prewiew">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="posters-caption">
                                        <span class="posters-caption__screen"><?= $item[Photo::WIDTH] ?>x<?= $item[Photo::HEIGHT] ?></span>,<span class="posters-caption__size"><?= $item[Photo::SIZE] ?> КБ</span>
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
                        <?php if (24 <= $stat[\Kinomania\Original\Key\Person\Stat::PHOTO]): ?>
                            <span class="pagelist-more sprite-before" id="more"><span class="pagelist-more__text">Еще</span></span>
                        <?php endif ?>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/photos"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fphotos/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/photos"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fphotos&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fphotos/"></a></li>
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
<script>
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

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
                                '<div data-type-over-parent=".row" data-type-over-img="' + data[key][1] + '" data-type-over-desc=".desc-in-over" data-type-over-desc-desc="' + data[key][3] + '" class="image-shadow-poster posters__image">' +
                                '<a href="/people/<?= $id ?>/photos/' + data[key][0] + '">' +
                                '<img alt="" src="//:0" data-original="' + data[key][2] + '" class="lazy parent responsive-image image-prewiew">' +
                                '</a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="posters-caption">' +
                                '<span class="posters-caption__screen">' + data[key][4] + 'x' + data[key][5] + '</span>,<span class="posters-caption__size">' + data[key][6] + ' КБ</span>' +
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
        $('.posters__image a').click(function(e){
            e.preventDefault();
        });
        $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px');
    });
</script>
</body>
</html>
