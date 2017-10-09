<?php
/**
 * @var int $id
 * @var string $static
 * @var array $min
 * @var array $list
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Award as Award;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ('' == $min[Film::NAME_RU]): ?>
        <title>Трейлеры к фильму <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="Трейлеры и полная информация о фильме «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер"/>

        <meta property="og:title" content="Трейлеры к фильму <?= $min[Film::NAME_ORIGIN] ?>" />
        <meta property="og:description" content="Трейлеры и полная информация о фильме <?= $min[Film::NAME_ORIGIN] ?>."/>
    <?php else: ?>
        <title>Трейлеры к фильму <?= $min[Film::NAME_RU] ?> | <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="Трейлеры и полная информация о фильме «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер"/>

        <meta property="og:title" content="Трейлеры к фильму <?= $min[Film::NAME_RU] ?>" />
        <meta property="og:description" content="Трейлеры и полная информация о фильме <?= $min[Film::NAME_RU] ?>."/>
    <?php endif ?>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/awards" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/awards"/>

    <!-- include section/head.html.php -->
</head>
<body>
<div class="my-overlay">
    <div class="my-overlay-item overlay-trailer-item">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay video-overlay">
            <div class="inner-my-overlay">
                <div class="war-content">

                </div>
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
                        <h1 class="pagetitle mini__pagetitle"><?= $min[Film::NAME_ORIGIN] ?></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $min[Film::NAME_RU] ?></h1>
                        <h2 class="name__page"><?= $min[Film::NAME_ORIGIN] ?></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include film/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-awards">
                        <?php foreach ($list as $awardId => $award): ?>
                            <div class="big-awards-item">
                                <div class="big-awards-head clear">
                                    <div class="big-awards__image">
                                        <img src="<?= $static ?>/app/img/icon/award/<?= $awardId ?>.jpg" alt="">
                                    </div>
                                    <div class="row-big-awards-head__content">
                                        <div class="big-awards-head__content">
                                            <div class="awards__title"><?= $award[0][Award::AWARD_RU] ?></div>
                                            <div class="awards__raiting"><a href="/awards/<?= $award[0][Award::CODE] ?>/"><?= $award[0][Award::AWARD_EN] ?> <span class="value"><?= $award[0][Award::COUNT] ?>/<?= $award[0][Award::TOTAL] ?></span></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="big-awards-content">
                                    <?php foreach ($award as $item): ?>
                                        <div class="big-awards-inner-item clear">
                                            <div class="year"><?= $item[Award::YEAR] ?></div>
                                            <div class="big-awards-info">
                                                <div class="nomination"><?= $item[Award::NOMINATION] ?></div>
                                                <ul class="big-awards-list-name">
                                                    <li>
                                                        <?php if (!empty($item[Award::FILM_RU])): ?>
                                                            <a href="/film/<?= $item[Award::FILM_ID] ?>/" class="big-awards-name"><?= $item[Award::FILM_RU] ?></a>
                                                        <?php endif ?>
                                                        <?php if (!empty($item[Award::FILM_EN])): ?>
                                                            <a href="/film/<?= $item[Award::FILM_ID] ?>/" class="big-awards-name"><?= $item[Award::FILM_EN] ?></a>
                                                        <?php endif ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row-awards-icon">
                                                <?php if ('true' == $item[Award::WIN]): ?>
                                                    <i class="awards__icon awards__icon-win"></i>
                                                <?php else: ?>
                                                    <i class="awards__icon awards__icon-nomination"></i>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/awards"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fawards/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/awards"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fawards&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fawards/"></a></li>
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
