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

    <title>Сценарий  фильма <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Сценарий  фильма «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, сценарий"/>
    <?php else: ?>
        <meta name="description" content="Сценарий  фильма «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, сценарий"/>
    <?php endif ?>

    <meta property="og:title" content="Сценарий  фильма <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/script/<?= $frameId ?>" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/script/<?= $frameId ?>"/>

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
                    <div class="row-script clear">
                        <div class="caption-page script-caption-page clear">
                            <div class="caption-page-item caption-page-image">
                                <div class="outer-caption-page-image image-shadow">
                                    <?php if ('' == $list['film']['image_org']): ?>
                                        <img alt="" src="<?= $list['film']['image_min'] ?>" class="responsive-image image-cover" style="cursor: default;">
                                    <?php else: ?>
                                        <a href="<?= $list['film']['image_org'] ?>" class="image-cover-parent">
                                            <img alt="" src="<?= $list['film']['image_min'] ?>" class="responsive-image image-cover">
                                            <i class="image-hover"><span>Увеличить</span></i>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="caption-page-item caption-page-info">
                                <div class="info-item scripts-info-item">
                                    <div class="outer-info-item-list">
                                        <ul class="info-item-list">
                                            <?php if (0 < count($list['film']['script'])): ?>
                                                <li>
                                                    <ul class="value">
                                                        <li class="value__name">Автор сценария:</li>
                                                        <?php foreach ($list['film']['script'] as $id => $name): ?>
                                                            <li><a href="/people/<?= $id ?>/"><?= $name ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (0 < count($list['film']['director'])): ?>
                                                <li>
                                                    <ul class="value">
                                                        <li class="value__name">Режиссер:</li>
                                                        <?php foreach ($list['film']['director'] as $id => $name): ?>
                                                            <li><a href="/people/<?= $id ?>/"><?= $name ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="scripts-info-caption">
                                    <?= $list['film']['preview'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-scripts-content">
                            <?php if (!empty($list['item']['file'])): ?>
                                <div class="content-page__titile">
                                    <h2>СКАЧАТЬ</h2>
                                </div>
                                <div class="row-files ">
                                    <div class="row-files-inner clear">
                                        <div class="files-item">
                                            <div class="files-item-inner">
                                                <div class="files-item__image files-item__image-pdf"></div>
                                                <div class="files-item__info">
                                                    <span class="files-item__format"><a href="http://kinomania.ru/_scripts/<?= $list['item']['file'] ?>.zip/">ZIP</a></span>,
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="row-text">
                                <p>
                                    <pre style="white-space: pre-wrap;">
                                        <?= $list['item']['text'] ?>
                                    </pre>
                                </p>
                            </div>
                        </div>
                        <br />
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/script/<?= $frameId ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fscript%2F<?= $frameId ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/script/<?= $frameId ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fscript%2F<?= $frameId ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fscript%2F<?= $frameId ?>/"></a></li>
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
  <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
  <script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.image-cover-parent').magnificPopup({
            type: 'image'
        });
    });
</script>
  <?php BodyScript::getContent();?>
</body>
</html>
