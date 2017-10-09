<?php
/**
 * @var array $list
 * @var string $static
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\News\Preview as News;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_reason_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_reason_description') ?>"/>
    <meta name="keywords" content="<?= $options->get('seo_reason_keywords') ?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/article/reason"/>

    <meta property="og:title" content="Был бы повод..." />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/article/reason" />
    <meta property="og:description" content="Самые животрепещущие информационные поводы, дарящие возможность вспомнить то, о чём не стоит забывать, в рубрике «Был бы повод...». Наиболее интересная и актуальная информация о классике и новинках мирового кино и многое другое на сайте KINOMANIA.RU."/>

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
                    <h1 class="pagetitle"><?= $options->get('seo_reason_h1') ?></h1>
                    <div class="description description-border">
                        «Киномании» не нужен повод, чтобы говорить о хорошем кино каждый день. Но если он есть, то самое время вспомнить об отличных фильмах и сериалах, у которых нашлось нечто общее с премьерой недели. Или подробно рассказать о том, что прямо сейчас смотрят и обсуждают все вокруг.
                    </div>
                    <div class="outer-pagelist-item clear">
                        <?php foreach ($list as $item): ?>
                            <div class="pagelist-item clear">
                                <div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="image-shadow ">
                                        <a href="/article/<?= $item[News::ID] ?>/"><img alt="" src="//:0" data-original="<?= $item[News::IMAGE] ?>" class="lazy image-prewiew" ></a>
                                    </div>
                                </div>
                                <div class="pagelist-item-content news-pagelist-item-content col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="pagelist-item-title">
                                        <a href="/article/<?= $item[News::ID] ?>/"><?= $item[News::TITLE] ?></a>
                                    </div>
                                    <?= $item[News::ANONS] ?>
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
                            <li class="vk" id="vk_in_share" data-url="article/reason"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Farticle%2Freason/"><span class="number"></span></a></li>
                            <li class="fb" id="fb_in_share" data-url="article/reason"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Farticle%2Freason&t=%D0%91%D1%8B%D0%BB+%D0%B1%D1%8B+%D0%BF%D0%BE%D0%B2%D0%BE%D0%B4...&src=sp/"><span class="number"></span></a></li>
                            <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=%D0%91%D1%8B%D0%BB+%D0%B1%D1%8B+%D0%BF%D0%BE%D0%B2%D0%BE%D0%B4...&url=http%3A%2F%2Fkinomania.ru%2Farticle%2Freason/"></a></li>
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
                                    '<div class="pagelist-item-content news-pagelist-item-content col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                    '<div class="pagelist-item-title">' +
                                    '<a href="/article/' + data[key][<?= News::ID ?>] + '/">' + data[key][<?= News::TITLE ?>] + '</a>' +
                                    '</div>' +
                                    data[key][<?= News::ANONS ?>] +
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
