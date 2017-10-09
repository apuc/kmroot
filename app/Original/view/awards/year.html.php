<?php
/**
 * @var array $list
 */
use Kinomania\Original\Key\Award\Award as Award;
use Kinomania\Original\Key\Award\Nominee as Nominee;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $list['item'][Award::NAME_RU] ?> - все номинанты и победители на KINOMANIA.RU</title>
    <meta name="description" content="<?= $list['item'][Award::NAME_RU] ?> - все номинанты и победители на KINOMANIA.RU"/>

	<link rel="canonical" href="http://www.kinomania.ru/awards/<?= $list['item'][Award::CODE] ?>"/>

    <meta property="og:title" content="<?= $list['item'][Award::NAME_RU] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/awards/<?= $list['item'][Award::CODE] ?>" />
    <meta property="og:description" content="<?= $list['item'][Award::NAME_RU] ?> - все номинанты и победители"/>

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
                    <div class="row-festival-item">
                        <a href="/awards/<?= $list['item'][Award::CODE] ?>" style="text-decoration: none; color: #000000;">
                            <h1 class="pagetitle pagetitle-with-mini"><?= $list['item'][Award::NAME_RU] ?> <?= $list['year'] ?></h1>
                            <div class="longtitle"><?= $list['item'][Award::NAME_EN] ?></div>
                        </a>
                        <div class="select-filters">
                            <ul class="select-filters-list">
                                <?php
                                $active = false;
                                ?>
                                <?php foreach ($list['item'][Award::YEAR] as $year): ?>
                                    <li <?php if ($list['year'] == $year): ?> class="active" <?php $active = true; ?> <?php endif; ?>><a href="/awards/<?= $list['item'][Award::CODE] ?>/<?= $year ?>/"><span><?= $year ?></span></a></li>
                                <?php endforeach; ?>
                                <li class="all-years"><div class="row-all-years"><span>Введите год</span>
                                        <input type="text" name="year" id="year" <?php if (!$active):  ?> value="<?= $list['year'] ?>" <?php endif ?> class="input-field field--mini"><span class="input-button input-button--blue" id="show">Показать</span>
                                    </div></li>
                            </ul>
                        </div>
                        <div class="row-outside row-outside-art row-outside-art-two clear">
                            <div class="inner-outside parent-sticker">
                                <?php foreach ($list['award'] as $item): ?>
                                    <div class="row-main-items">
                                        <div class="row-main-item-title">
                                            <div class="main-item-title title-black"><?= $item[0][Nominee::NAME_RU] ?></div>
                                            <div class="main-item-longtitle title-bold"><?= $item[0][Nominee::NAME_EN] ?></div>
                                        </div>
                                        <?php if ('film' == $item[0][Nominee::TYPE]): ?>
                                            <?php if (0 < $item[0][Nominee::FILM_ID]): ?>
                                                <div class="main-item">
                                                    <div class="main-item-all main-item__image ">
                                                        <div class="list-preview">
                                                            <a href="/film/<?= $item[0][Nominee::FILM_ID] ?>/">
                                                            <span>
                                                              <img src="//:0"  data-original="<?= $item[0][Nominee::IMAGE] ?>" alt="" class="lazy image-padding--white" />
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="main-item-all main-item__content">
                                                        <?php if ('' == $item[0][Nominee::FILM_RU]): ?>
                                                            <div class="main-item__content-title "><a href="/film/<?= $item[0][Nominee::FILM_ID] ?>/"><?= $item[0][Nominee::FILM_ORIGIN] ?></a></div>
                                                        <?php else: ?>
                                                            <div class="main-item__content-title "><a href="/film/<?= $item[0][Nominee::FILM_ID] ?>/"><?= $item[0][Nominee::FILM_RU] ?></a></div>
                                                            <div class="main-item__content-title-eng"><?= $item[0][Nominee::FILM_ORIGIN] ?></div>
                                                        <?php endif ?>
                                                        <div class="main-item__content-info">
                                                            <?php if (!empty($code)): ?>
                                                                <?= \Kinomania\System\Data\Country::RU[$code] ?>,
                                                            <?php endif ?>
                                                            <?= $item[0][Nominee::YEAR] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <?php else: ?>
                                            <?php if (0 < $item[0][Nominee::PERSON_ID]): ?>
                                                <div class="main-item">
                                                    <div class="main-item-all main-item__image ">
                                                        <div class="list-preview">
                                                            <a href="/people/<?= $item[0][Nominee::PERSON_ID] ?>/">
                                                            <span>
                                                                <img src="//:0"  data-original="<?= $item[0][Nominee::IMAGE] ?>" alt="" class="lazy image-padding--white" />
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="main-item-all main-item__content">
                                                        <?php if ('' == $item[0][Nominee::PERSON_RU]): ?>
                                                            <div class="main-item__content-title "><a href="/people/<?= $item[0][Nominee::PERSON_ID] ?>/"><?= $item[0][Nominee::PERSON_ORIGIN] ?></a></div>
                                                        <?php else: ?>
                                                            <div class="main-item__content-title "><a href="/people/<?= $item[0][Nominee::PERSON_ID] ?>/"><?= $item[0][Nominee::PERSON_RU] ?></a></div>
                                                            <div class="main-item__content-title-eng"><?= $item[0][Nominee::PERSON_ORIGIN] ?></div>
                                                        <?php endif ?>

                                                        <?php if ('' == $item[0][Nominee::FILM_RU]): ?>
                                                            <div class="main-item__content-title" style="font-size: 12px; font-weight: normal;"><a href="/film/<?= $item[0][Nominee::FILM_ID] ?>/" style="font-size: 12px; font-weight: normal;text-transform: none;"><?= $item[0][Nominee::FILM_ORIGIN] ?></a></div>
                                                        <?php else: ?>
                                                            <div class="main-item__content-title" style="font-size: 12px; font-weight: normal;"><a href="/film/<?= $item[0][Nominee::FILM_ID] ?>/" style="font-size: 12px; font-weight: normal;text-transform: none;"><?= $item[0][Nominee::FILM_RU] ?></a> <?= $item[0][Nominee::FILM_ORIGIN] ?></div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (isset($item[1])): ?>
                                        <div class="row-all-items">
                                            <div class="row-main-item-title">
                                                <div class="main-item-title title-black">ВСЕ УЧАСТНИКИ</div>
                                            </div>
                                            <div class="row-all-items-list row-all-items-list-tile clear">
                                                <ul class="all-items-list all-items-list-tile">
                                                    <?php $cnt = 0 ?>
                                                    <?php foreach ($item as $member): ?>
                                                        <?php $cnt++; if (1 == $cnt) { continue; } ?>
                                                        <?php if ('film' == $member[Nominee::TYPE]): ?>
                                                            <li>
                                                                <ul>
                                                                    <?php if ('' == $member[\Kinomania\Original\Key\Film\Film::NAME_RU]): ?>
                                                                        <li class="all-item-name-all all-item-name"><a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_ORIGIN] ?></a></li>
                                                                    <?php else: ?>
                                                                        <li class="all-item-name-all all-item-name"><a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_RU] ?></a></li>
                                                                        <li class="all-item-name-all all-item-name-eng"><a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_ORIGIN] ?></a></li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </li>
                                                        <?php else: ?>
                                                            <li>
                                                                <ul>
                                                                    <?php if ('' == $member[Nominee::PERSON_RU]): ?>
                                                                        <li class="all-item-name-all all-item-name">
                                                                            <a href="/people/<?= $member[Nominee::PERSON_ID] ?>/"><?= $member[Nominee::PERSON_ORIGIN] ?></a>
                                                                        </li>
                                                                    <?php else: ?>
                                                                        <li class="all-item-name-all all-item-name">
                                                                            <a href="/people/<?= $member[Nominee::PERSON_ID] ?>/"><?= $member[Nominee::PERSON_RU] ?></a> /
                                                                            <a href="/people/<?= $member[Nominee::PERSON_ID] ?>/"><?= $member[Nominee::PERSON_ORIGIN] ?></a>
                                                                        </li>
                                                                    <?php endif ?>

                                                                    <?php if ('' == $member[Nominee::FILM_RU]): ?>
                                                                        <li class="all-item-name-all all-item-name-eng">
                                                                            <a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_ORIGIN] ?></a>
                                                                        </li>
                                                                    <?php else: ?>
                                                                        <li class="all-item-name-all all-item-name-eng">
                                                                            <a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_RU] ?></a> /
                                                                            <a href="/film/<?= $member[Nominee::FILM_ID] ?>/"><?= $member[Nominee::FILM_ORIGIN] ?></a>
                                                                        </li>
                                                                    <?php endif ?>
                                                                </ul>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <br />
                                    <br />
                                <?php endforeach; ?>
                                <div class="sticker">
                                    <div class="sticker-item">ОСНОВНОЙ КОНКУРС</div>
                                </div>
                            </div>
                        </div>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="awards/<?= $list['item'][Award::CODE] ?>/<?= $list['year'] ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $list['item'][Award::CODE] ?>%2F<?= $list['year'] ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="awards/<?= $list['item'][Award::CODE] ?>/<?= $list['year'] ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $list['item'][Award::CODE] ?>%2F<?= $list['year'] ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fawards%2F<?= $list['item'][Award::CODE] ?>%2F<?= $list['year'] ?>/"></a></li>
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

        $('#show').click(function(){
            var year = $('#year').val();
            document.location = '/awards/<?= $list['item'][Award::CODE] ?>/' + year;
        })
    });
</script>
  <?php BodyScript::getContent();?>
</body>
</html>
