<?php
/**
 * @var int $id
 * @var int $frameId
 * @var array $min
 * @var array $list
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Frame as Frame;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Постер #<?= $frameId ?> для фильма <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Постер #<?= $frameId ?> для фильма «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, постер"/>
    <?php else: ?>
        <meta name="description" content="Постер #<?= $frameId ?> для фильма «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, постер"/>
    <?php endif ?>

	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/posters/<?= $frameId ?>" />

    <meta property="og:title" content="Постер #<?= $frameId ?> для фильма <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/posters/<?= $frameId ?>" />

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
                    <div class="posters-caption">
                        <span class="posters-caption__screen"><?= $list['item'][Frame::WIDTH] ?>x<?= $list['item'][Frame::HEIGHT] ?></span>,<span class="posters-caption__size"><?= $list['item'][Frame::SIZE] ?> КБ</span>
                    </div>
                    <div class="posters-caption">
                        <img alt="Постер фильма <?= $min[Film::TITLE] ?>" src="<?= $list['item'][Frame::IMAGE] ?>" />
                    </div>
                    <br />
                    
                    <div class="list_page">
                        <?php $page = 1; ?>
                        <?php foreach ($list['list'] as $item): ?>
                            <?php if ($frameId == $item): ?>
                                <a href="#"><b><?= $page ?></b></a>
                            <?php else: ?>
                                <a href="/film/<?= $id ?>/posters/<?= $item ?>"><?= $page ?></a>
                            <?php endif ?>
                            <?php $page++ ?>
                        <?php endforeach; ?>
                    </div>
                    <br />
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/posters/<?= $frameId ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters%2F<?= $frameId ?>/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/posters/<?= $frameId ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters%2F<?= $frameId ?>&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fposters%2F<?= $frameId ?>/"></a></li>
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
  <?php BodyScript::getContent();?>
</body>
</html>
