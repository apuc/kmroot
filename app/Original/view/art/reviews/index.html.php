<?php
/**
 * @var array $list
 * @var string $static
 */
use Kinomania\Original\Key\News\Preview as News;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KINOMANIA.RU :: Рецензии АртКиноМания</title>
    <meta name="description" content="Рецензии АртКиноМания"/>
    <meta name="keywords" content="рецензия, рецензия на фильм, отзыв"/>

	<link rel="canonical" href="http://www.kinomania.ru/art/reviews"/>

    <meta property="og:title" content="Рецензии АртКиноМания" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/art/reviews" />
    <meta property="og:description" content="Рецензии АртКиноМания"/>

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
            <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row-news-list">
                    <h1 class="pagetitle">Рецензии АртКиноМания</h1>
                    <div class="description">

                    </div>
                    <div class="outer-pagelist-item clear">
                        <?php foreach ($list as $item): ?>
                            <section class="pagelist-item clear">
                                <div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class=" image-shadow ">
                                        <a href="/article/<?= $item[News::ID] ?>/"><img width="263" height="261" alt="" src="//:0" data-original="<?= $item[News::IMAGE] ?>" class="lazy image-prewiew"></a>
                                    </div>
                                </div>
                                <div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <?php if (empty($item[News::NAME_RU])): ?>
                                        <div class="pagelist-item-title reviews-pagelist-item-title">
                                            <a href="/film/<?= $item[News::FILM_ID] ?>">
                                                <?= $item[News::NAME_ORIGIN] ?>
                                            </a>
                                        </div>
                                        <div class="reviews-pagelist-dop-title">
                                            <span></span>
                                        </div>
                                    <?php else :?>
                                        <div class="pagelist-item-title reviews-pagelist-item-title">
                                            <a href="/film/<?= $item[News::FILM_ID] ?>">
                                                <?= $item[News::NAME_RU] ?>
                                            </a>
                                        </div>
                                        <div class="reviews-pagelist-dop-title">
                                            <span><?= $item[News::NAME_ORIGIN] ?></span>
                                        </div>
                                    <?php endif ?>

                                    <ul class="reviews-list">
                                        <li class="city">
                                            <?= $item[News::COUNTRY] ?>
                                            <?php if (!empty($item[News::YEAR])): ?>
                                                <?= $item[News::YEAR] ?>
                                            <?php endif ?>
                                        </li>
                                        <?php if (count($item[News::DIRECTOR])): ?>
                                            <li class="producer">Режиссер: <span class="producer__result">
                                                <?php foreach ($item[News::DIRECTOR] as $person): ?>
                                                    <a href="/people/<?= $person[0] ?>/"><?= $person[1] ?></a>
                                                <?php endforeach; ?>
                                            </span></li>
                                        <?php endif ?>
                                        <?php if (count($item[News::CAST])): ?>
                                            <li class="role">В ролях: <span class="producer__result">
                                                <?php foreach ($item[News::CAST] as $person): ?>
                                                    <a href="/people/<?= $person[0] ?>/"><?= $person[1] ?></a>
                                                <?php endforeach; ?>
                                            </span></li>
                                        <?php endif ?>
                                    </ul>
                                    <div class="pagelist-info">
                                        <?php if (!empty($item[News::LOGIN])): ?>
                                            <span class="pagelist__author"><a href="/user/<?= $item[News::LOGIN] ?>/"><?= $item[News::NAME] ?></a></span>,
                                        <?php endif; ?>
                                        <span class="date__month"><?= $item[News::PUBLISH] ?></span>
                                        <?php if (!empty($item[News::COMMENT])): ?>
                                            <a href="/article/<?= $item[News::ID] ?>#commentList/" class="pagelist__comments"><?= $item[News::COMMENT] ?></a>
                                        <?php endif ?>
                                    </div>
                                    <a href="/article/<?= $item[News::ID] ?>/" class="pagelist__link">Подробнее</a>
                                </div>
                            </section>
                        <?php endforeach; ?>
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
                            <li class="vk" id="vk_in_share" data-url="art/reviews"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fart%2Freviews/"><span class="number"></span></a></li>
                            <li class="fb" id="fb_in_share" data-url="art/reviews"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fart%2Freviews&t=%D0%A0%D0%B5%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D0%B8+%D0%90%D1%80%D1%82%D0%9A%D0%B8%D0%BD%D0%BE%D0%9C%D0%B0%D0%BD%D0%B8%D1%8F&src=sp/"><span class="number"></span></a></li>
                            <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=%D0%A0%D0%B5%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D0%B8+%D0%90%D1%80%D1%82%D0%9A%D0%B8%D0%BD%D0%BE%D0%9C%D0%B0%D0%BD%D0%B8%D1%8F&url=http%3A%2F%2Fkinomania.ru%2Fart%2Freviews/"></a></li>
                        </ul>
                    </div>
                </div>
            </content>
            <section class="outer-section clear outer-content">
                <!-- Контент -->

                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
    <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
    <script type="text/javascript">
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
                    "url": "?handler=get&page=" + page,
                    "success": function(data){
                        data = JSON.parse(data);

                        for (var key in data) {
                            if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                var html = '<section class="pagelist-item clear">' +
                                    '<div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                    '<div class=" image-shadow ">' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/"><img width="263" height="261" alt="" src="//:0" data-original="' + data[key][<?= News::IMAGE ?>] + '" class="lazy image-prewiew"></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">';
                                if ('' == data[key][<?= News::NAME_RU ?>]) {
                                    html += '<div class="pagelist-item-title reviews-pagelist-item-title">' +
                                        '<a href="/film/' + data[key][<?= News::FILM_ID ?>] + '">' +
                                        data[key][<?= News::NAME_ORIGIN ?>] +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="reviews-pagelist-dop-title">' +
                                        '<span></span>' +
                                        '</div>';
                                } else {
                                    html += '<div class="pagelist-item-title reviews-pagelist-item-title">' +
                                        '<a href="/film/' + data[key][<?= News::FILM_ID ?>] + '">' +
                                        data[key][<?= News::NAME_RU ?>] +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="reviews-pagelist-dop-title">' +
                                        '<span>' + data[key][<?= News::NAME_ORIGIN ?>] + '</span>' +
                                        '</div>';
                                }
                                html += '<ul class="reviews-list">' +
                                    '<li class="city">' +
                                    data[key][<?= News::COUNTRY ?>];
                                if ('' != data[key][<?= News::YEAR ?>]) {
                                    html += data[key][<?= News::YEAR ?>];
                                }
                                html += '</li>';
                                if (0 < data[key][<?= News::DIRECTOR ?>].length) {
                                    html += '<li class="producer">Режиссер: <span class="producer__result">';
                                    for (var k in data[key][<?= News::DIRECTOR ?>]) {
                                        if (data[key][<?= News::DIRECTOR ?>].hasOwnProperty(k)) {
                                            html += '<a href="/people/' + data[key][<?= News::DIRECTOR ?>][k][0] + '/">' + data[key][<?= News::DIRECTOR ?>][k][1] + '</a>';
                                        }
                                    }
                                    html += '</span></li>';
                                }
                                if (0 < data[key][<?= News::CAST ?>].length) {
                                    html += '<li class="role">В ролях: <span class="producer__result">';
                                    for (var kk in data[key][<?= News::CAST ?>]) {
                                        if (data[key][<?= News::CAST ?>].hasOwnProperty(kk)) {
                                            html += '<a href="/people/' + data[key][<?= News::CAST ?>][kk][0] + '/">' + data[key][<?= News::CAST ?>][kk][1] + '</a>';
                                        }
                                    }
                                    html += '</span></li>';
                                }
                                html += '</ul>' +
                                    '<div class="pagelist-info">';
                                if ('' != data[key][<?= News::LOGIN ?>]) {
                                    html += '<span class="pagelist__author"><a href="/user/' + data[key][<?= News::LOGIN ?>] + '/">' + data[key][<?= News::NAME ?>] + '</a></span>, ';
                                }
                                html += '<span class="date__month">' + data[key][<?= News::PUBLISH ?>] + '</span>';
                                if (0 < data[key][<?= News::COMMENT ?>]) {
                                    html += '<a href="/article/' + data[key][<?= News::ID ?>] + '#commentList/" class="pagelist__comments">' + data[key][<?= News::COMMENT ?>] + '</a>';
                                }
                                html += '</div>' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/" class="pagelist__link">Подробнее</a>' +
                                    '</div>' +
                                    '</section>';

                                $('.outer-pagelist-item').append(html);
                            }
                        }

                        $("img.lazy[proc!=true]").lazyload({
                            effect : "fadeIn"
                        });
                        $("img.lazy").attr('proc', 'true');

                        if (1 > data.length) {
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
