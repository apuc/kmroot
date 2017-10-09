<?php
/**
 * @var int $id
 * @var int $wallpaperId
 * @var int $width
 * @var int $height
 * @var array $min
 * @var string $static
 * @var array $photo
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Wallpaper as Wallpaper;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Обои <?= $width ?> на <?= $height ?> <?= $min[Person::TITLE] ?>  #<?= $wallpaperId ?> | KINOMANIA.RU</title>
    <meta name="description" content="Обои <?= $width ?> на <?= $height ?> <?= $min[Person::TITLE] ?>  #<?= $wallpaperId ?> на KINOMANIA.RU. Фильмография, биография, обои, факты, новости и многое другое о звёздах мирового кинематографа." />
    <meta name="keywords" content="<?= $min[Person::NAME_RU] ?> <?= $min[Person::NAME_ORIGIN] ?> обои" />

	<link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/wallpapers/<?= $wallpaperId ?>"/>

    <meta property="og:title" content="Обои <?= $width ?> на <?= $height ?> <?= $min[Person::TITLE] ?>  #<?= $wallpaperId ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/wallpapers/<?= $wallpaperId ?>" />
    <meta property="og:description" content="<?= $min[Person::TITLE] ?> Только лучшие обои"/>

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
                    <div class="posters-caption">
                        <span class="posters-caption__screen"><?= $width ?>x<?= $height ?></span>
                    </div>
                    <div class="posters-caption">
                        <img alt="Обои <?= $min[Person::TITLE] ?> лучшие обои для рабочего стола" src="<?= $list['item'][Wallpaper::IMAGE] ?>" />
                    </div>

                    <br />
                    <div class="list_page">
                        <?php $page = 1; ?>
                        <?php foreach ($list['list'] as $item): ?>
                            <?php if ($wallpaperId == $item): ?>
                                <a href="#" style="text-decoration: none;"><b><?= $page ?></b></a>
                            <?php else: ?>
                                <a href="/people/<?= $id ?>/wallpapers/<?= $item ?>/wallpaper_<?= $width ?>x<?= $height ?>/"><?= $page ?></a>
                            <?php endif ?>
                            <?php $page++ ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/wallpapers/<?= $wallpaperId ?>/wallpaper_<?= $width ?>x<?= $height ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/wallpapers/<?= $wallpaperId ?>/wallpaper_<?= $width ?>x<?= $height ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fwallpapers%2F<?= $wallpaperId ?>%2Fwallpaper_<?= $width ?>x<?= $height ?>/"></a></li>
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
