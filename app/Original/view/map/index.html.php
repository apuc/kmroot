<?php
/**
 * @var array $date
 * @var string $static
 * @var $options Kinomania\System\Options\Options
 */

use Kinomania\Original\Key\News\Preview as News;
use Kinomania\System\Body\BodyScript;

?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_top_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_top_description') ?>"/>

    <link rel="canonical" href="http://www.kinomania.ru/top"/>

    <meta property="og:site_name" content="KINOMANIA.RU"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.kinomania.ru/top"/>
    <meta property="og:title" content="Подборки киномании"/>

    <!-- include section/head.html.php -->

    <style>
        .__map {
            padding-left: 30px;
        }

        .__map ul {
            padding-left: 30px;
        }

        .__map li {
            list-style: circle;
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
            <section class=" outer-section clear outer-content">
                <!-- Контент -->
                <content
                        class="page-section-content section-content content-outer content-top--padding col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <ul class="__map">
                        <li>
                            <a href="/">Главная</a>
                            <ul>
                                <li>
                                    Новости
                                    <ul>
                                        <li><a href="/news/">Новости кино</a></li>
                                        <li><a href="/news/rus_serials/">Новости российского кино</a></li>
                                        <li><a href="/news/usa_serials/">Новости сериалов (США)</a></li>
                                        <li><a href="/art/">АртКиноМания</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Статьи
                                    <ul>
                                        <li><a href="/reviews/">Рецензии</a></li>
                                        <li><a href="/article/reason/">Был бы повод...</a></li>
                                        <li><a href="/article/anticipation/">Ожидания</a></li>
                                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                                        <li><a href="/article/in_ten/">В десятку</a></li>
                                        <li><a href="/article/boxoffice/">Бокс-офис</a></li>
                                        <li><a href="/article/press_review/">Пресс-обзор</a></li>
                                        <li><a href="/article/shorts/">Shortы</a></li>
                                        <li><a href="/article/interview/">Интервью</a></li>
                                        <li><a href="/article/inside/">Инсайд</a></li>
                                        <li><a href="/blog/">Блог Станислава Никулина</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Афиша
                                    <ul>
                                        <li><a href="/billboard/">Афиша Москвы</a></li>
                                        <li><a href="/releases/russia/">График релизов, Россия</a></li>
                                        <li><a href="/releases/usa/">График релизов в США</a></li>
                                        <li><a href="/boxoffice/russia/">ТОП 10 проката РФ</a></li>
                                        <li><a href="/boxoffice/usa/">ТОП 10 проката США</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Медиа
                                    <ul>
                                        <li><a href="/trailers/">Трейлеры</a></li>
                                        <li><a href="/posters/">Постеры к фильмам</a></li>
                                        <li><a href="/soundtracks/">Саундтреки к фильмам</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Обои
                                    <ul>
                                        <li><a href="/wallpapers/films/">Обои к фильмам</a></li>
                                        <li><a href="/wallpapers/actors/">Обои актеров</a></li>
                                        <li><a href="/wallpapers/actresses/">Обои актрис</a></li>
                                        <li><a href="/photos/">Все фото</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Разное
                                    <ul>
                                        <li><a href="/awards/">Награды и кинопремии</a></li>
                                        <li><a href="/scripts/">Сценарии к фильмам</a></li>
                                    </ul>
                                </li>
                                <li>
                                    Общение
                                    <ul>
                                        <li><a href="http://forum.kinomania.ru/ ">Форум Kinomania.RU</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/genres/films/">Жанры</a>
                                    <ul>
                                        <?php foreach (\Kinomania\System\Data\Genre::RU as $key => $item): ?>
                                            <li><a href="/genres/films?genre=<?= $key ?>"><?= \Kinomania\System\Text\TText::mbUcfirst($item) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
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
    $(document).ready(function () {
        $("img.lazy").lazyload({
            effect: "fadeIn"
        });

        window.page = 1;
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
