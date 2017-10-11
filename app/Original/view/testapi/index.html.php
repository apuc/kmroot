<?php
/**
 * @var string $static
 * @var array $genre
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Trailer as Trailer;
use Kinomania\System\Body\BodyScript;

?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$options->get('seo_trailers_title');?></title>
    <meta name="description" content="<?=$options->get('seo_trailers_description');?>"/>
    <meta name="keywords" content="<?=$options->get('seo_trailers_keywords');?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/trailers"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/trailers" />
    <meta property="og:title" content="Трейлеры фильмов" />
    <meta property="og:description" content="Трейлеры фильмов: новые трейлеры к фильмам, мультфильмам, российским и зарубежным сериалам."/>

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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <!--<h1 class="pagetitle trailers-pagetitle">--><?//=$options->get('seo_trailers_h1');?><!--</h1>-->

                </content>
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
<link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
<script src="<?= $static ?>/app/js/video.ie8.js"></script>
<script src="<?= $static ?>/app/js/video.js"></script>
<script src="<?= $static ?>/app/js/videojs.ads.js"></script>
<script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
