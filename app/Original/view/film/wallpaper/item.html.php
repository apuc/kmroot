<?php
/**
 * @var int $id
 * @var int $width
 * @var int $height
 * @var int $wallpaperId
 * @var array $min
 * @var array $list
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Wallpaper as Wallpaper;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Обои <?= $width ?> на <?= $height ?> к фильму <?= $min[Film::TITLE] ?> #<?= $wallpaperId ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Лучшие обои <?= $width ?> на <?= $height ?> к фильму «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, обои для рабочего стола, <?= $width ?>x<?= $height ?>"/>
    <?php else: ?>
        <meta name="description" content="Лучшие обои <?= $width ?> на <?= $height ?> к фильму «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, обои для рабочего стола, <?= $width ?>x<?= $height ?>"/>
    <?php endif ?>

    <meta property="og:title" content="Обои <?= $width ?> на <?= $height ?> к фильму <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/wallpapers<?= $wallpaperId ?>/wallpaper_<?= $width ?>x<?= $height ?>" />

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
                        <span class="posters-caption__screen"><?= $width ?>x<?= $height ?></span>
                    </div>
                    <div class="posters-caption">
                        <img alt="Фильм <?= $min[Film::TITLE] ?> - лучшие обои для рабочего стола" src="<?= $list['item'][Wallpaper::IMAGE] ?>" />
                    </div>
                    <br />
                    <?php if (count($list['item'][Wallpaper::PREVIEW])): ?>
                        <p class="text name">
                            На изображении:
                            <?php foreach ($list['item'][Wallpaper::PREVIEW] as $cast): ?>
                                <a href="/people/<?= $cast[0] ?>/"><?= $cast[1] ?></a>
                            <?php endforeach; ?>
                        </p>
                    <?php endif ?>

                    <br />
                    <div class="list_page">
                        <?php $page = 1; ?>
                        <?php foreach ($list['list'] as $item): ?>
                            <?php if ($wallpaperId == $item): ?>
                                <a href="#" style="text-decoration: none;"><b><?= $page ?></b></a>
                            <?php else: ?>
                                <a href="/film/<?= $id ?>/wallpapers/<?= $item ?>/wallpaper_<?= $width ?>x<?= $height ?>/"><?= $page ?></a>
                            <?php endif ?>
                            <?php $page++ ?>
                        <?php endforeach; ?>
                    </div>
                    <br />
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/wallpapers/<?= $wallpaperId ?>/wallpaper_<?= $width ?>x<?= $height ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/wallpapers/<?= $wallpaperId ?>/wallpaper_<?= $width ?>x<?= $height ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>/"></a></li>
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
</body>
</html>
