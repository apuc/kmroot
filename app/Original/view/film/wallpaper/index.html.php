<?php
/**
 * @var int $id
 * @var array $min
 * @var array $list
 * @var string $static
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Wallpaper as Wallpaper;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Обои к фильму <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Лучшие обои к фильму «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, обои для рабочего стола"/>
    <?php else: ?>
        <meta name="description" content="Лучшие обои к фильму «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, обои для рабочего стола"/>
    <?php endif ?>

    <meta property="og:title" content="Обои к фильму <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/wallpapers" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/wallpapers"/>
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
<div class="overlay-photo overlay-posters">
    <div class="overlay-bg"></div>
    <div class="row-inner-overlay">
        <div class="inner-overlay-photo">
            <div class="inner-overlay-image">
                <img src="" alt="">
                <div class="overlay-photo-controls">
                    <div class="close"></div>
                </div>
            </div>
            <div class="inner-overlay-caption clear section-video ">
                <!--  Содержимое описания  -->
            </div>
        </div>
    </div>
</div>
<div class="desc-in-over">
    <span class="desc"></span><a class="link" target="_blank" href="/" download>Скачать</a>
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
                    <!-- <h1 class="pagetitle mini__pagetitle">РЕЗУЛЬТАТЫ ПОИСКА</h1> -->
                    <div class="row-wall">
                        <?php foreach ($list as $item): ?>
                            <div class="wall-items clear">
                                <div class="wall-image">
                                    <div class="image-shadow">
                                        <img alt="" data-original="<?= $item[Wallpaper::PREVIEW] ?>" src="//:0" class="lazy responsive-image image-prewiew">
                                    </div>
                                </div>
                                <div class="wall-content">
                                    <div class="wall-size-item">
                                        <div class="wall-size" data-type="">4x3</div>
                                        <ul class="wall-size-list">
                                            <?php if ('' == $item[Wallpaper::R_1600x1200]): ?>
                                                <li class="no-active open-help-in"><span>1600x1200</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1600x1200] ?>" data-type-over-desc-desc="1600x1200" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1600x1200/" class="parent">1600x1200</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1280x960]): ?>
                                                <li class="no-active open-help-in"><span>1280x960</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1280x960] ?>" data-type-over-desc-desc="1280x960" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1280x960/" class="parent">1280x960</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1024x768]): ?>
                                                <li class="no-active open-help-in"><span>1024x768</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1024x768] ?>" data-type-over-desc-desc="1024x768" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1024x768/" class="parent">1024x768</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_800x600]): ?>
                                                <li class="no-active open-help-in"><span>800x600</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_800x600] ?>" data-type-over-desc-desc="800x600" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_800x600/" class="parent">800x600</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <div class="wall-size-item">
                                        <div class="wall-size" data-type="">16x10</div>
                                        <ul class="wall-size-list">
                                            <?php if ('' == $item[Wallpaper::R_1920x1200]): ?>
                                                <li class="no-active open-help-in"><span>1920x1200</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1920x1200] ?>" data-type-over-desc-desc="1920x1200" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1920x1200/" class="parent">1920x1200</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1680x1050]): ?>
                                                <li class="no-active open-help-in"><span>1680x1050</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1680x1050] ?>" data-type-over-desc-desc="1680x1050" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1680x1050/" class="parent">1680x1050</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1440x900]): ?>
                                                <li class="no-active open-help-in"><span>1440x900</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1440x900] ?>" data-type-over-desc-desc="1440x900" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1440x900/" class="parent">1440x900</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1280x800]): ?>
                                                <li class="no-active open-help-in"><span>1280x800</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1280x800] ?>" data-type-over-desc-desc="1280x800" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1280x800/" class="parent">1280x800</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_960x600]): ?>
                                                <li class="no-active open-help-in"><span>960x600</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_960x600] ?>" data-type-over-desc-desc="960x600" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_960x600/" class="parent">960x600</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <div class="wall-size-item">
                                        <div class="wall-size" data-type="">16x9</div>
                                        <ul class="wall-size-list">
                                            <?php if ('' == $item[Wallpaper::R_1920x1080]): ?>
                                                <li class="no-active open-help-in"><span>1920x1080</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1920x1080] ?>" data-type-over-desc-desc="1920x1080" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1920x1080/" class="parent">1920x1080</a>
                                                </li>
                                            <?php endif ?>

                                            <?php if ('' == $item[Wallpaper::R_1366x768]): ?>
                                                <li class="no-active open-help-in"><span>1366x768</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1366x768] ?>" data-type-over-desc-desc="1366x768" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1366x768/" class="parent">1366x768</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <div class="wall-size-item">
                                        <div class="wall-size" data-type="">5x4</div>
                                        <ul class="wall-size-list">
                                            <?php if ('' == $item[Wallpaper::R_1280x1024]): ?>
                                                <li class="no-active open-help-in"><span>1280x1024</span>
                                                    <div class="help help--gray">Нет данного разрешения</div>
                                                </li>
                                            <?php else :?>
                                                <li data-type-over-img="<?= $item[Wallpaper::R_1280x1024] ?>" data-type-over-desc-desc="1280x1024" data-type-over-desc=".desc-in-over">
                                                    <a href="/film/<?= $id ?>/wallpapers/<?= $item[Wallpaper::ID] ?>/wallpaper_1280x1024/" class="parent">1280x1024</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <br />
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/wallpapers"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/wallpapers"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fwallpapers/"></a></li>
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
        var resolution = window.screen.width + 'x' + window.screen.height;
        $("li a:contains(" + resolution + ")").each(function(index){
            if (!$(this).parent().hasClass('open-help-in')) {
                $(this).parent().addClass('active open-help-in');
                $(this).parent().append('<div class="help help--color2">Ваше разрешение</div>');
            }
        });

        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        $('.posters__image a').click(function(e){
            e.preventDefault();
        });
        $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px');
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
