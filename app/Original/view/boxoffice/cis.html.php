<?php
/**
 * @var array $list
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Кассовые сборы фильмов в прокате СНГ (Box-office)</title>
    <meta name="description" content="Кассовые сборы фильмов в прокате СНГ"/>
    <meta name="keywords" content="Кассовые сборы фильмов, Box-office, касса, лидерв проката"/>

    <meta property="og:title" content="Кассовые сборы фильмов в прокате СНГ (Box-office)" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/boxoffice/cis" />
    <meta property="og:description" content="Кассовые сборы фильмов в прокате СНГ"/>

    <!-- include section/head.html.php -->
<body>
  <!--#include virtual="/design/ssi/top" -->
<div class="outer">
    <div class="wrap">
        <!-- include section/header.html.php -->
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <section class=" outer-section clear outer-content-two">
                <content class="page-section-content section-content content-outer outer-vert content-not-aside col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-box-office">
                        <div class="row-list-nav-three">
                            <ul class="list-nav-second clear">
                                <li><a href="/boxoffice/russia/">СБОРЫ В РФ</a></li>
                                <li class="active"><a href="/boxoffice/cis/">СБОРЫ В СНГ</a></li>
                                <li><a href="/boxoffice/usa/">СБОРЫ В США</a></li>
                            </ul>
                        </div>
                        <h1 class="pagetitle pagetitle-two">Бокс-Офис</h1>
                        <div class="table-page-caption clear">
                            <div class="table-page-caption-item1">
                                ЛИДЕРЫ ПРОКАТА ЗА УИКЕНД <?= $list['date_from'] ?> — <?= $list['date_to'] ?>
                            </div>
                            <div class="table-page-caption-item2">
                                <div class="table-page-caption-name">Источник:</div>
                                <div class="table-page-caption-value">
                                    <a href="http://www.kinometro.ru/box" target="_blank" rel="nofollow">
                                        <span class="icon-text">BK@</span>
                                        <span class="value">БЮЛЛЕТЕНЬ КИНОПРОКАТЧИКА</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-page-caption">
                            Проверенные и актуальные данные о кассовых сборах фильмов за прошедшие выходные. Только точные цифры, ничего лишнего. По данным издания «Бюллетень кинопрокатчика».
                        </div>
                        <?php if (0 < $list['course']): ?>
                            <div class="table-page-caption">
                                Курс ЦБ РФ $1 = <?= number_format($list['course'], 2, ',', ' ') ?> руб.<br>
                                Суммы итоговых сборов фильмов в долларах расчитаны для каждого фильма по курсу ЦБ на стартовый четверг.
                            </div>
                        <?php endif ?>
                        <div class="row-table-page">
                            <div class="table-page-outer">
                                <div class="table-row clear">
                                    <div class="table-col">.</div>
                                    <div class="table-col">Пред.<br>неделя</div>
                                    <div class="table-col">Название</div>
                                    <div class="table-col">Дистрибьютор</div>
                                    <div class="table-col">Нед.</div>
                                    <div class="table-col">К/т</div>
                                    <div class="table-col">Касса<br>уикенда</div>
                                    <div class="table-col">Общая<br>касса</div>
                                    <div class="table-col">Зритель<br>уикенда</div>
                                    <div class="table-col">Общий<br>зритель</div>
                                    <div class="table-col">Бюджет</div>
                                </div>
                                <?php foreach ($list['table'] as $item): ?>
                                    <div class="table-row clear">
                                        <div class="table-col"><?= $item['position'] ?></div>
                                        <div class="table-col">
                                            <?php if (0 == $item['previous']): ?>
                                                New
                                            <?php else: ?>
                                                <?= $item['previous'] ?>
                                            <?php endif ?>
                                        </div>
                                        <div class="table-col">
                                            <div class="table-page-image">
                                                <div class="table-page-image-inner">
                                                    <div class="list-preview">
                                                        <?php if (0 < $item['filmId']): ?>
                                                            <a href="/film/<?= $item['filmId'] ?>/">
                                                                <span>
                                                                    <img class=" image-padding--white" src="<?= $item['image'] ?>" alt="">
                                                                </span>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="#">
                                                                <span>
                                                                    <img class=" image-padding--white" src="<?= $item['image'] ?>" alt="">
                                                                </span>
                                                            </a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-page-name">
                                                <div class="table-page-name-inner">
                                                    <?php if (0 < $item['filmId']): ?>
                                                        <?php if ('' != $item['name_ru']): ?>
                                                            <div class="on-table-text__name"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></div>
                                                            <div class="on-table-text__name-eng"><?= $item['name_origin'] ?></div>
                                                        <?php else: ?>
                                                            <div class="on-table-text__name"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_origin'] ?></a></div>
                                                        <?php endif ?>
                                                    <?php else: ?>
                                                        <?php if ('' != $item['name_ru']): ?>
                                                            <div class="on-table-text__name"><a href="#/"><?= $item['name_ru'] ?></a></div>
                                                            <div class="on-table-text__name-eng"><?= $item['name_origin'] ?></div>
                                                        <?php else: ?>
                                                            <div class="on-table-text__name"><a href="#/"><?= $item['name_origin'] ?></a></div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-col">
                                            <?php if (0 < $item['companyId']): ?>
                                                <a href="/company/<?= $item['companyId'] ?>/"><?= $item['company'] ?></a>
                                            <?php else: ?>
                                                <?= $item['company'] ?>
                                            <?php endif ?>
                                        </div>
                                        <div class="table-col"><?= $item['week'] ?></div>
                                        <div class="table-col"><?= $item['copy'] ?></div>
                                        <div class="table-col">
                                            <div><?= $item['gross_rub'] ?></div>
                                            <div><?= $item['gross'] ?></div>
                                        </div>
                                        <div class="table-col">
                                            <div><?= $item['gross_total_rub'] ?></div>
                                            <div><?= $item['gross_total'] ?></div>
                                        </div>
                                        <div class="table-col">
                                            <div><?= $item['views'] ?></div>
                                        </div>
                                        <div class="table-col">
                                            <div><?= $item['views_total'] ?></div>
                                        </div>
                                        <div class="table-col">
                                            <div><?= $item['budget'] ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="table-row footer-table-row clear">
                                    <div class="table-col">
                                        <div class="all-number">ИТОГО:</div>
                                    </div>
                                    <div class="table-col">
                                        <div><?= $list['total_rub'] ?></div>
                                        <div><?= $list['total_usd'] ?></div>
                                    </div>
                                    <div class="table-col">
                                    </div>
                                    <div class="table-col">
                                        <div><?= $list['total_views'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-dop clear">
                            <?php if ('' != $list['prev']): ?>
                                <div class="table-dop--left"><a href="/boxoffice/cis/<?= $list['prev'] ?>/" class="list-about-item__button animated">ПРЕДЫДУЩАЯ НЕДЕЛЯ</a></div>
                            <?php endif ?>
                            <?php if ('' != $list['next']): ?>
                                <div class="table-dop--right"><a href="/boxoffice/cis/<?= $list['next'] ?>/" class="list-about-item__button animated">СЛЕДУЮЩАЯ НЕДЕЛЯ</a></div>
                            <?php endif ?>
                        </div>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="boxoffice/cis"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fboxoffice%2Fcis/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="boxoffice/cis"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fboxoffice%2Fucis&t=%D0%9A%D0%B0%D1%81%D1%81%D0%BE%D0%B2%D1%8B%D0%B5+%D1%81%D0%B1%D0%BE%D1%80%D1%8B+%D1%84%D0%B8%D0%BB%D1%8C%D0%BC%D0%BE%D0%B2+%D0%B2+%D0%BF%D1%80%D0%BE%D0%BA%D0%B0%D1%82%D0%B5+%D0%A1%D0%9D%D0%93+%28Box-office%29&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=%D0%9A%D0%B0%D1%81%D1%81%D0%BE%D0%B2%D1%8B%D0%B5+%D1%81%D0%B1%D0%BE%D1%80%D1%8B+%D1%84%D0%B8%D0%BB%D1%8C%D0%BC%D0%BE%D0%B2+%D0%B2+%D0%BF%D1%80%D0%BE%D0%BA%D0%B0%D1%82%D0%B5+%D0%A1%D0%9D%D0%93+%28Box-office%29&url=http%3A%2F%2Fkinomania.ru%2Fboxoffice%2Fcis/"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </content>
            </section>
        </div>
    </div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->

</body>
</html>