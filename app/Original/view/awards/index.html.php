<?php
/**
 * @var array $list
 * @var string $static
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\Award\Award as Award;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_awards_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_awards_description') ?>"/>
    <meta name="keywords" content="<?= $options->get('seo_awards_keywords') ?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/awards"/>

    <meta property="og:title" content="Кинонаграды и кинофестивали | KINOMANIA.RU" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/awards" />
    <meta property="og:description" content="Кинонаграды и кинофестивали: ОСКАР, Золотой Глобус, ММКФ, Берлинский Кинофестиваль и др. на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров."/>

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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-festivals">
                        <h1 class="pagetitle"><?= $options->get('seo_awards_h1') ?></h1>
                        <div class="description">
                            В рубрике «Фестивали и премии» — новости о самых важных кинособытиях мира. Кто получил «Золотую пальмовую ветвь»? Кому отдала предпочтение Ассоциация иностранной прессы? Кто станет ведущим очередной церемонии вручения «Оскаров»? Итоги премий, лауреаты фестивалей, списки победителей и номинантов, репортажи с красных дорожек и дневники «Киномании» с места событий.
                        </div>
                        <section class="inner-content outer-content-item parent-sticker">
                            <!--#include virtual="/awards/ssi/news" -->
                        </section>
                        <div class="row-art-awards parent-sticker row-parent-sticker">
                            <?php foreach ($list['festival'] as $item): ?>
                                <div class="art-awards-item  clear">
                                    <div class="art-awards-image">
                                        <img src="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/icon/award/<?= $item[Award::ID] ?>.jpg" alt="<?= $item[Award::NAME_RU] ?>">
                                    </div>
                                    <div class="art-awards-content">
                                        <div class="art-awards__title"><a href="/awards/<?= $item[Award::CODE] ?>/"><?= $item[Award::NAME_RU] ?></a></div>
                                        <div class="art-awards__title-eng"><?= $item[Award::NAME_EN] ?></div>
                                        <div class="art-awards__date">
                                            <?php if (!empty($item[Award::FROM])): ?>
                                                <span class="art-awards__date-from"><?= $item[Award::FROM] ?></span> —
                                            <?php endif ?>
                                            <?php if (!empty($item[Award::TO])): ?>
                                                <span class="art-awards__date-from"><?= $item[Award::TO] ?></span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="sticker">
                                <div class="sticker-item">Кинофестивали</div>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <div class="row-art-awards parent-sticker row-parent-sticker">
                            <?php foreach ($list['award'] as $item): ?>
                                <div class="art-awards-item  clear">
                                    <div class="art-awards-image">
                                        <img src="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/icon/award/<?= $item[Award::ID] ?>.jpg" alt="<?= $item[Award::NAME_RU] ?>">
                                    </div>
                                    <div class="art-awards-content">
                                        <div class="art-awards__title"><a href="/awards/<?= $item[Award::CODE] ?>/"><?= $item[Award::NAME_RU] ?></a></div>
                                        <div class="art-awards__title-eng"><?= $item[Award::NAME_EN] ?></div>
                                        <div class="art-awards__date">
                                            <?php if (!empty($item[Award::FROM])): ?>
                                                <span class="art-awards__date-from"><?= $item[Award::FROM] ?></span> —
                                            <?php endif ?>
                                            <?php if (!empty($item[Award::TO])): ?>
                                                <span class="art-awards__date-from"><?= $item[Award::TO] ?></span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="sticker">
                                <div class="sticker-item">ПРЕМИИ</div>
                            </div>
                            <br />
                        </div>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="awards"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fawards/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="awards"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fawards&t=%D0%9A%D0%B8%D0%BD%D0%BE%D0%BD%D0%B0%D0%B3%D1%80%D0%B0%D0%B4%D1%8B+%D0%B8+%D0%BA%D0%B8%D0%BD%D0%BE%D1%84%D0%B5%D1%81%D1%82%D0%B8%D0%B2%D0%B0%D0%BB%D0%B8&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=%D0%9A%D0%B8%D0%BD%D0%BE%D0%BD%D0%B0%D0%B3%D1%80%D0%B0%D0%B4%D1%8B+%D0%B8+%D0%BA%D0%B8%D0%BD%D0%BE%D1%84%D0%B5%D1%81%D1%82%D0%B8%D0%B2%D0%B0%D0%BB%D0%B8&url=http%3A%2F%2Fkinomania.ru%2Fawards/"></a></li>
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
    });
</script>
  <?php BodyScript::getContent();?>
</body>
</html>
