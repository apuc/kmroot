<?php
/**
 * @var array $list
 * @var string $static
 */
use Kinomania\Original\Key\News\Preview as News;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KINOMANIA.RU :: Авторский блог - <?= $list['user']['name'] ?></title>
    <meta name="description" content="Архив новостей: все новости о мире кино и жизни актеров"/>
    <meta name="keywords" content="кино, новости, актеры, фильмы, кадры, рецензия, обои, ролик, саундтрек"/>

	<link rel="canonical" href="http://www.kinomania.ru/blog/<?= $list['user']['id'] ?>"/>


    <meta property="og:title" content="Авторский блог - <?= $list['user']['name'] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/blog/<?= $list['user']['id'] ?>" />
    <meta property="og:description" content="Блог <?= $list['user']['name'] ?>"/>

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
                    <h1 class="pagetitle">Блог</h1>
                    <div class="description">
                        Автор: <?= $list['user']['name'] ?>
                    </div>
                    <div class="outer-pagelist-item clear">
                        <?php foreach ($list['blog'] as $item): ?>
                            <div class="pagelist-item clear">
                                <div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="image-shadow ">
                                        <a href="/article/<?= $item[News::ID] ?>/"><img alt="" src="//:0" data-original="<?= $item[News::IMAGE] ?>" class="lazy image-prewiew" ></a>
                                    </div>
                                </div>
                                <div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="pagelist-item-title pagelist-item-title--black">
                                        <a href="/article/<?= $item[News::ID] ?>/"><?= $item[News::TITLE] ?></a>
                                    </div>

                                    <div class="pagelist-info full-pagelist-info">
                                        <?php if (!empty($item[News::LOGIN])): ?>
                                            <a href="/user/<?= $item[News::LOGIN] ?>/" class="author"><img src="<?= $item[News::AVATAR] ?>" width="34" alt="<?= $item[News::NAME] ?>" title="<?= $item[News::NAME] ?>"></a>
                                            <span class="pagelist__author"><a href="/user/<?= $item[News::LOGIN] ?>/"><?= $item[News::NAME] ?></a></span>,
                                            <span class="all-post__author"><a href="/user/<?= $item[News::LOGIN] ?>#blog/">Все посты автора</a></span>
                                        <?php endif; ?>
                                        <span class="date__month"><?= $item[News::PUBLISH] ?></span>
                                        <?php if (!empty($item[News::COMMENT])): ?>
                                            <a href="/article/<?= $item[News::ID] ?>#commentList/" class="pagelist__comments"><?= $item[News::COMMENT] ?></a>
                                        <?php endif ?>
                                    </div>
                                    <?= $item[News::ANONS] ?>
                                    <a href="/article/<?= $item[News::ID] ?>/" class="pagelist__link">Подробнее</a>
                                </div>
                            </div>
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
                            <li class="vk" id="vk_in_share" data-url="article/blog<?= $list['user']['id'] ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Farticle%2Fblog%2F<?= $list['user']['id'] ?>/"><span class="number"></span></a></li>
                            <li class="fb" id="fb_in_share" data-url="article/blog<?= $list['user']['id'] ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Farticle%2Fblog%2F<?= $list['user']['id'] ?>&src=sp/"><span class="number"></span></a></li>
                            <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Farticle%2Fblog%2F<?= $list['user']['id'] ?>/"></a></li>
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
                                var html = '<div class="pagelist-item clear">' +
                                    '<div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                    '<div class="image-shadow ">' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/"><img alt="" src="//:0" data-original="' + data[key][<?= News::IMAGE ?>] + '" class="lazy image-prewiew" ></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                    '<div class="pagelist-item-title">' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/">' + data[key][<?= News::TITLE ?>] + '</a>' +
                                    '</div>' +
                                    '<div class="pagelist-info full-pagelist-info">';
                                if ('' != data[key][<?= News::LOGIN ?>]) {
                                    html += '<a href="/user/' + data[key][<?= News::LOGIN ?>] + '/" class="author"><img src="' + data[key][<?= News::AVATAR ?>] + '" width="34" alt="' + data[key][<?= News::NAME ?>] + '" title="' + data[key][<?= News::NAME ?>] + '"></a>';
                                    html += '<span class="pagelist__author"><a href="/user/' + data[key][<?= News::LOGIN ?>] + '/">' + data[key][<?= News::NAME ?>] + '</a></span>, ';
                                    html += '<span class="all-post__author"><a href="/user/' + data[key][<?= News::LOGIN ?>] + '#blog/">Все посты автора</a></span> ';
                                }
                                html += '<span class="date__month">' + data[key][<?= News::PUBLISH ?>] + '</span>';
                                if (0 < data[key][<?= News::COMMENT ?>]) {
                                    html += '<a href="/article/' + data[key][<?= News::ID ?>] + '#commentList/" class="pagelist__comments">' + data[key][<?= News::COMMENT ?>] + '</a>';
                                }
                                html += data[key][<?= News::ANONS ?>];
                                html += '</div>' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/" class="pagelist__link">Подробнее</a>' +
                                    '</div>' +
                                    '</div>';
                                $('.outer-pagelist-item').append(html);
                            }
                        }

                        $("img.lazy[proc!=true]").lazyload({
                            effect : "fadeIn"
                        });
                        $("img.lazy").attr('proc', 'true');

                        if (12 > data.length) {
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
  <?php BodyScript::getContent();?>
</body>
</html>
