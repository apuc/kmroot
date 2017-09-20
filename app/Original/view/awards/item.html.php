<?php
/**
 * @var array $item
 * @var string $static
 */
use Kinomania\Original\Key\Award\Award as Award;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?= $item[Award::NAME_RU] ?> - все номинанты и победители на KINOMANIA.RU</title>
    <meta name="description" content="<?= $item[Award::NAME_RU] ?> - все номинанты и победители на KINOMANIA.RU"/>

	<link rel="canonical" href="http://www.kinomania.ru/awards/<?= $item[Award::CODE] ?>"/>

    <meta property="og:title" content="<?= $item[Award::NAME_RU] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/awards/<?= $item[Award::CODE] ?>" />
    <meta property="og:description" content="<?= $item[Award::NAME_RU] ?> - все номинанты и победители"/>

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
            <div class="head-content">
                <div class="top-head-page">
                    <div class="art-awards-item  clear">
                        <div class="art-awards-image">
                            <img src="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/icon/award/<?= $item[Award::ID] ?>.jpg" alt="<?= $item[Award::NAME_RU] ?>">
                        </div>
                        <div class="art-awards-content">
                            <div class="art-awards__title"><a href="#"><?= $item[Award::NAME_RU] ?></a></div>
                            <div class="art-awards__title-eng"><?= $item[Award::NAME_EN] ?></div>
                            <div class="select-filters">
                                <ul class="select-filters-list">
                                    <?php foreach ($item[Award::YEAR] as $year): ?>
                                        <li><a href="/awards/<?= $item[Award::CODE] ?>/<?= $year ?>/"><span><?= $year ?></span></a></li>
                                    <?php endforeach; ?>
                                    <li class="all-years"><div class="row-all-years"><span>Введите год</span>
                                            <input type="text" name="year" id="year" class="input-field field--mini"><span class="input-button input-button--blue" id="show">Показать</span>
                                        </div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        <?= $item[Award::DESCRIPTION] ?>
                    </div>
                </div>
            </div>

            <section class="outer-section section-black outer-vert clear festival-video">

            </section>

            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-festivals">
                        <section class="inner-content outer-content-item parent-sticker section-news-festival">
                            <!--#include virtual="/awards/ssi/news" -->
                        </section>
                        <section class="festival-posters">

                        </section>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="awards/<?= $item[Award::CODE] ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $item[Award::CODE] ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="awards/<?= $item[Award::CODE] ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $item[Award::CODE] ?>&t=<?= $item[Award::TITLE] ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=<?= $item[Award::TITLE] ?>&url=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $item[Award::CODE] ?>/"></a></li>
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
<script type="text/javascript">
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        $('#show').click(function(){
            var year = $('#year').val();
            document.location = '/awards/<?= $item[Award::CODE] ?>/' + year;
        })
    });
</script>
</body>
</html>
