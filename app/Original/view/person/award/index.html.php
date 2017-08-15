<?php
/**
 * @var int $id
 * @var array $min
 * @var string $static
 * @var array $list
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Award as Award;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $min[Person::TITLE] ?>: награды и номинации | KINOMANIA.RU</title>
    <meta name="description" content="<?= $min[Person::TITLE] ?>: награды и номинации на KINOMANIA.RU. Фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа."/>
    <meta name="keywords" content="<?= $min[Person::TITLE] ?> награды номинации премии"/>

    <meta property="og:title" content="<?= $min[Person::TITLE] ?> награды и номинации" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/awards" />
    <meta property="og:description" content=""/>

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
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/awards"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fawards/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/awards"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fawards&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fawards/"></a></li>
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
