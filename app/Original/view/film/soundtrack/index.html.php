<?php
/**
 * @var int $id
 * @var array $min
 * @var array $list
 * @var array $popular
 * @var string $static
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Film\Soundtrack as Soundtrack;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ('' == $min[Film::NAME_RU]): ?>
        <title>Саундтреки к фильму <?= $min[Film::NAME_ORIGIN] ?> | OST в mp3 (прослушать / скачать) на KINOMANIA.RU</title>
        <meta name="description" content="Саундтреки и полная информация о фильме «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?> фильм саундтрек, ost, скачать, прослушать, mp3"/>

        <meta property="og:title" content="Саундтреки к фильму <?= $min[Film::NAME_ORIGIN] ?>" />
        <meta property="og:description" content="Саундтреки и полная информация о фильме <?= $min[Film::NAME_ORIGIN] ?>. OST в mp3 (прослушать / скачать)"/>
    <?php else: ?>
        <title>Саундтреки к фильму <?= $min[Film::NAME_RU] ?> | <?= $min[Film::NAME_ORIGIN] ?> | OST в mp3 (прослушать / скачать) на KINOMANIA.RU</title>
        <meta name="description" content="Саундтреки и полная информация о фильме «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?> фильм, саундтрек, ost, скачать, прослушать, mp3"/>

        <meta property="og:title" content="Саундтреки к фильму <?= $min[Film::NAME_RU] ?>" />
        <meta property="og:description" content="Саундтреки и полная информация о фильме <?= $min[Film::NAME_RU] ?>. OST в mp3 (прослушать / скачать)"/>
    <?php endif ?>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/soundtracks" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/soundtracks"/>

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
                    <div class="row-soundtracks">
                        <?php foreach ($list as $dir): ?>
                            <div class="page-content-head clear">
                                <div class="page-content-head__image">
                                    <div class="image-shadow ">
                                        <div class="image-cover">
                                            <?php if ('' == $min[Film::NAME_RU]): ?>
                                                <img src="<?= $dir[Soundtrack::IMAGE] ?>" alt="Саундтрек к фильму <?= $min[Film::NAME_ORIGIN] ?>">
                                            <?php else: ?>
                                                <img src="<?= $dir[Soundtrack::IMAGE] ?>" alt="Саундтрек к фильму <?= $min[Film::NAME_RU] ?>">
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="page-content-head__content">
                                    <div class="soundtrack-name-page">Саундтрек к фильму</div>
                                    <?php if ('' == $min[Film::NAME_RU]): ?>
                                        <div class="soundtrack-name-item"><?= $min[Film::NAME_ORIGIN] ?></div>
                                    <?php else: ?>
                                        <div class="soundtrack-name-item"><?= $min[Film::NAME_RU] ?></div>
                                    <?php endif ?>
                                    <div class="soundtrack-release">Релиз: <span class="value"><?= $dir[Soundtrack::YEAR] ?></span></div>
                                    <div class="warning-content">
                                        Музыка доступна только для ознакомления (треки представлены в качестве до 50 Кбит/с)
                                    </div>
                                </div>
                            </div>
                            <div class="soundtrack-content">
                                <div class="list-content-title">САУНДТРЕКИ <span class="number"><?= count($dir[Soundtrack::LIST]) ?></span></div>
                            </div>
                            <div class="soundtrack-content">
                                <?php foreach ($dir[Soundtrack::LIST] as $cnt => $item): ?>
                                    <div class="soundtrack-item clear">
                                        <div class="soundtrack-item__inner soundtrack-item__number"><?= (1 + $cnt) ?></div>
                                        <div class="soundtrack-item__inner soundtrack-item__info">
                                            <div class="soundtrack-item__name">
                                                <span class="soundtrack-item__name-author"><?= $item[Soundtrack::NAME] ?></span>
                                                <span class="soundtrack-item__name-value"><?= $item[Soundtrack::AUTHOR] ?></span>
                                            </div>
                                            <div class="player">
                                                <img src="<?= $static ?>/app/img/design/pl.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="soundtrack-item__inner soundtrack-item__time">
                                            <?= $item[Soundtrack::TIME] ?>
                                        </div>
                                        <div class="soundtrack">
                                            <audio src="<?= $item[Soundtrack::SOUND] ?>" preload="auto" />
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <br />
                            <br />
                        <?php endforeach; ?>


                        <div class="row-mini-slide row-mini-slide--two row-mini-slide--gray row-mini-slide-music">
                            <div class="mini-slide-title"><a href="#" class="no-link">РЕКОМЕНДУЕМЫЕ САУНДТРЕКИ <span class="number">12</span></a></div>
                            <div class="row-bx-mini-slider">
                                <div class="bx-mini-slider">
                                    <?php foreach ($popular as $item): ?>
                                        <div class="slide"><a href="/film/<?= $item[Soundtrack::FILM_ID] ?>/soundtracks/"><img src="<?= $item[Soundtrack::IMAGE] ?>"></a>
                                            <div class="bx-mini-slider-caption">
                                                <p class="mini-slider-caption-name"><a href="/film/<?= $item[Soundtrack::FILM_ID] ?>/soundtracks/"><?= $item[Soundtrack::FILM_NAME] ?></a></p>
                                                <p class="mini-slider-caption-name-eng"><?= $item[Soundtrack::FILM_NAME_EN] ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="all-slide">
                                <div class="row-all-slide">
                                    <div class="inner-all-slide">
                                        <div class="all-slide-item">
                                            <a href="/soundtracks/">ВСЕ САУНДТРЕКИ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/soundtracks"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fsoundtracks/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/soundtracks"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fsoundtracks&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fsoundtracks/"></a></li>
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

<script src="<?= $static ?>/app/js/audio/audio.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        audiojs.events.ready(function() {
            var as = audiojs.createAll();
        });

        $('.soundtrack-item__name').click(function(e){
            e = e || window.event;
            var audios = document.getElementsByTagName('audio');
            for(var i = 0, len = audios.length; i < len;i++){
                if(audios[i] != e.target){
                    audios[i].pause();
                }
            }
            $('.soundtrack').hide();
            $(this).parent().parent().find('.soundtrack').show();
            $(this).parent().parent().find('audio')[0].play();
        });
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
