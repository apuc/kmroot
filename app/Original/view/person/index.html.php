<?php
/**
 * @var int $id
 * @var array $item
 * @var array $list
 * @var array $news
 * @var string $static
 */
use \Kinomania\Original\Key\Person\Person;
use \Kinomania\Original\Key\Person\Filmography;
use \Kinomania\System\Config\Server;
use Kinomania\Original\Key\Person\TV as TV;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $item[Person::TITLE] ?> : всё о персоне | Обои, фотографии, фильмография, биография, факты, новости</title>
    <meta name="description" content="<?= $item[Person::TITLE] ?> : всё о персоне на сайте KINOMANIA.RU. Обои, фотографии, фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа" />
    <meta name="Personwords" content="<?= $item[Person::NAME_RU] ?> обои, фотографии, биография, факты, фильмография, новости" />

    <link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>"/>

    <meta property="og:title" content="<?= $item[Person::TITLE] ?> : всё о персоне | Обои, фотографии, фильмография, биография, факты, новости" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="<?= $item[Person::IMAGE] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>" />
    <meta property="og:description" content="<?= $item[Person::TITLE] ?> : всё о персоне на сайте KINOMANIA.RU. Обои, фотографии, фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа"/>

    <!-- include section/head.html.php -->
    <style>
        .actor-caption p {
            font-size: inherit;
        }
    </style>
</head>
<body>
<div class="my-overlay">
    <div class="my-overlay-item overlay-auth-item" data-type="overlay-auth">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay">
            <div class="inner-my-overlay">
                <div class="war-title overlay-content-outside">НЕОБХОДИМА АВТОРИЗАЦИЯ</div>
                <div class="war-content">
                    <!-- include section/auth.html.php -->
                </div>
            </div>
        </div>
    </div>

    <div class="my-overlay-item overlay-add">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay">
            <div class="inner-my-overlay">
                <div class="war-title overlay-content-outside"><i class="content-icon content-icon-add"></i>ДОБАВИТЬ ИНФОРМАЦИЮ</div>
                <div class="war-title-content overlay-content-outside">
                    <div class="">
                        <?php if ('' == $item[Person::NAME_RU]): ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_ORIGIN] ?></h1>
                        <?php else: ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_RU] ?></h1>
                            <h2 class="name__page"><?= $item[Person::NAME_ORIGIN] ?></h2>
                        <?php endif ?>
                    </div>
                </div>
                <div class="war-content">
                    <div class="war-content-item">
                        <label class="label-important">Информация <i></i></label>
                        <textarea name="info" id="info_extra" type="text" class="input-field"></textarea>
                    </div>
                    <div class="war-content-item">
                        <label>Источник </label>
                        <input name="source" id="source_extra" type="text" class="input-field">
                    </div>
                    <div class="war-content-dop">
                        Ссылка на сайт или наименование ресурса, подтверждающего верность информации
                    </div>
                    <div class="war-content-bottom clear">
                        <div class="row-button-right">
                            <button id="send_extra" class="button button4">Отправить</button>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#send_extra').click(function(){
                                var me = $(this);
                                if (me.data('requestRunning')) {
                                    return;
                                }
                                me.data('requestRunning', true);

                                var fd = new FormData();
                                fd.append("info", $('#info_extra').val());
                                fd.append("source", $('#source_extra').val());
                                fd.append("type", 'person');
                                fd.append("relatedId", <?= $id ?>);
                                fd.append("form", 'extra');

                                $.ajax({
                                    "type": "post",
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    "url": "?handler=addExtra",
                                    "success": function (data) {
                                        if ('empty' == data) {
                                            $('#send_extra').notify("Заполните поле информация", {
                                                position: "left",
                                                autoHideDelay: 2000
                                            });
                                        } else {
                                            if ('ok' == data) {
                                                $('#info_extra').val('');
                                                $('#source_extra').val('');
                                                $('#send_extra').notify("Информация отправлена", {
                                                    className: "success",
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            } else if ('auth' == data) {
                                                $('#send_extra').notify("Необхоима авторизация", {
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            } else {
                                                $('#send_extra').notify("Не удалось отправить данные", {
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            }
                                            setTimeout(function () {
                                                $('.my-overlay').removeClass('active');
                                                $('.my-overlay .my-overlay-item').removeClass('active');
                                            }, 2000);
                                        }
                                    },
                                    complete: function () {
                                        me.data('requestRunning', false);
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="my-overlay-item my-item-error">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay">
            <div class="inner-my-overlay">
                <div class="war-title overlay-content-outside"><i class="content-icon content-icon-error"></i>Сообщить об ошибке</div>
                <div class="war-title-content overlay-content-outside">
                    <div class="">
                        <?php if ('' == $item[Person::NAME_RU]): ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_ORIGIN] ?></h1>
                        <?php else: ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_RU] ?></h1>
                            <h2 class="name__page"><?= $item[Person::NAME_ORIGIN] ?></h2>
                        <?php endif ?>
                    </div>
                </div>
                <div class="war-content">
                    <div class="war-content-item">
                        <label class="label-important">Информация <i></i></label>
                        <textarea id="info_error" type="text" class="input-field"></textarea>
                    </div>
                    <div class="war-content-item">
                        <label>Источник</label>
                        <input id="source_error" type="text" class="input-field">
                    </div>
                    <div class="war-content-dop">
                        Ссылка на сайт или наименование ресурса, подтверждающего верность информации
                    </div>
                    <div class="war-content-bottom clear">
                        <div class="row-button-right">
                            <button id="send_error"  class="button button4">Отправить</button>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#send_error').click(function(){
                                var me = $(this);
                                if (me.data('requestRunning')) {
                                    return;
                                }
                                me.data('requestRunning', true);

                                var fd = new FormData();
                                fd.append("info", $('#info_error').val());
                                fd.append("source", $('#source_error').val());
                                fd.append("type", 'person');
                                fd.append("relatedId", <?= $id ?>);
                                fd.append("form", 'error');

                                $.ajax({
                                    "type": "post",
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    "url": "?handler=addError",
                                    "success": function (data) {
                                        if ('empty' == data) {
                                            $('#send_error').notify("Заполните поле информация", {
                                                position: "left",
                                                autoHideDelay: 2000
                                            });
                                        } else {
                                            if ('ok' == data) {
                                                $('#info_error').val('');
                                                $('#source_error').val('');
                                                $('#send_error').notify("Информация отправлена", {
                                                    className: "success",
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            } else if ('auth' == data) {
                                                $('#send_error').notify("Необхоима авторизация", {
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            } else {
                                                $('#send_error').notify("Не удалось отправить данные", {
                                                    position: "left",
                                                    autoHideDelay: 2000
                                                });
                                            }
                                            setTimeout(function () {
                                                $('.my-overlay').removeClass('active');
                                                $('.my-overlay .my-overlay-item').removeClass('active');
                                            }, 2000);
                                        }
                                    },
                                    complete: function () {
                                        me.data('requestRunning', false);
                                    }
                                });
                            });
                        });
                    </script>
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
                    <?php if ('' == $item[Person::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_ORIGIN] ?></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_RU] ?></h1>
                        <h2 class="name__page"><?= $item[Person::NAME_ORIGIN] ?></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include person/section/menu.html.php -->
                </div>
                <div class="caption-page caption-page-actor clear">
                    <div class="caption-page-item caption-page-image">
                        <div class="outer-caption-page-image image-shadow">
                            <?php if ('' == $item[Person::IMAGE_ORG]): ?>
                                <img alt="" src="<?= $item[Person::IMAGE_MIN] ?>" class="responsive-image image-cover" style="cursor: default;">
                            <?php else: ?>
                                <a href="<?= $item[Person::IMAGE_ORG] ?>" class="image-cover-parent">
                                    <?php if ('' == $item[Person::NAME_RU]): ?>
                                        <img alt="<?= $item[Person::NAME_ORIGIN] ?>" src="<?= $item[Person::IMAGE_MIN] ?>" class="responsive-image image-cover">
                                    <?php else: ?>
                                        <img alt="<?= $item[Person::NAME_RU] ?>" src="<?= $item[Person::IMAGE_MIN] ?>" class="responsive-image image-cover">
                                    <?php endif ?>
                                    <i class="image-hover"><span>Увеличить</span></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="caption-page-item caption-page-info">
                        <div class="info-item">
                            <div class="info-item-actor-title">КРАТКО</div>
                            <div class="outer-info-item-list">
                                <ul class="info-item-list">
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Дата рождения:</li>
                                            <li><?= $item[Person::BIRTHDAY] ?></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Место рождения:</li>
                                            <li><?= $item[Person::BIRTHPLACE_RU] ?></li>
                                        </ul>
                                    </li>

                                    <?php if (!empty($item[Person::DEATH])): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Дата смерти:</li>
                                            <li><?= $item[Person::DEATH] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                    <?php if ($item[Person::IS_PROFESSION]): ?>
                                        <li><ul class="value">
                                                <li class="value__name">Профессия:</li>
                                                <?php if ('yes' == $item[Person::ACTOR]): ?>
                                                    <li>актер</li>
                                                <?php endif ?>
                                                <?php if ('yes' == $item[Person::DIRECTOR]): ?>
                                                    <li>режиссер</li>
                                                <?php endif ?>
                                                <?php if ('yes' == $item[Person::SCREENWRITER]): ?>
                                                    <li>сценарист</li>
                                                <?php endif ?>
                                                <?php if ('yes' == $item[Person::PRODUCER]): ?>
                                                    <li>продюсер</li>
                                                <?php endif ?>
                                                <?php if ('yes' == $item[Person::COMPOSER]): ?>
                                                    <li>композитор</li>
                                                <?php endif ?>
                                                <?php if ('yes' == $item[Person::OPERATOR]): ?>
                                                    <li>оператор</li>
                                                <?php endif ?>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                    <?php if (0 != $item[Person::HEIGHT]): ?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">Рост:</li>
                                                <li><?= $item[Person::HEIGHT] ?> см</li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                    <?php if (0 < $item[Person::MATCH_ID]): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Семейное положение:</li>
                                            <li>
                                                в браке с <a href="/people/<?= $item[Person::MATCH_ID] ?>/"><?= $item[Person::MATCH_NAME] ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                            <div class="outer-info-item-list outer-info-item-list-social">
                                <ul class="info-item-list">
                                    <li>
                                        <ul class="value mini-social-list">
                                            <li class="value__name">Соцсети:</li>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>/"><i class="mini-social-icon mini-social-icon--fb"></i></a></li>
                                            <li><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>&text=<?= $item[Person::TITLE] ?>+%D0%BD%D0%B0+KINOMANIA.RU/"><i class="mini-social-icon mini-social-icon--tw"></i></a></li>
                                            <li><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>/"><i class="mini-social-icon mini-social-icon--vk"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <?php if (0 < $item[Person::AWARD_TOTAL]): ?>
                                <div class="outer-info-item-list">
                                    <div class="info-item-actor-title">Награды <span class="number"><?= $item[Person::AWARD_TOTAL] ?></span></div>
                                    <ul class="awords-list">
                                        <li>
                                            <?php foreach ($item[Person::AWARD_LIST] as $award): ?>
                                                <ul class="awords-list-value clear">
                                                    <li class="awords-list__image"><img src="<?= Server::STATIC[0] ?>/app/img/icon/award/s<?= $award[0] ?>.jpg" alt=""></li>
                                                    <li>
                                                        <a href="/people/<?= $id ?>/awards#<?= $award[0] ?>" class="awords-list-name name">
                                                            <?= $award[1] ?>
                                                            <span class="awords-list-name dop-name">
                                                              <?= $award[2] ?> <span class="value"><?= $award[3] ?>/<?= $award[4] ?></span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- NEW Посмотреть фильм<br>с этим актером -->
                </div>
                <div class="band-nav">
                    <ul class="band-nav-list clear">
                        <li class="band-nav__icon my-films">
                            <a class="folder-icon-two collectPerson"><span>Мои актёры</span></a>
                            <div class="row-dropdown-folder">
                                <div class="dropdown-folder dropdown-folder-content">
                                    <div class="dropdown-folder-title"><span>В избранное</span></div>
                                    <ul class="dropdown-folder-list" data-id="<?= $id ?>">
                                    </ul>
                                </div>
                                <div class="dropdown-folder dropdown-folder-setting">
                                    <a href="#" class="clear">
                                        <!-- <i class="setting-icon"></i> -->
                                        <span>Управление папками</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="band-nav__icon my-add-info"><a><span>Добавить информацию</span></a></li>
                        <li class="band-nav__icon my-massage-error"><a><span>Сообщить об ошибке</span></a></li>
                    </ul>
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-actor">
                        <div class="actor-caption" style="border: 0;">
                            <div class="<?php if ($item[Person::TEXT_MORE]): ?>read-more-text<?php endif ?>">
                                <?= $item[Person::TEXT] ?>
                                <br />
                                <br />
                            </div>
                            <?php if ($item[Person::TEXT_MORE]): ?>
                                <div class="outer-pagelist-more page-content-head__more" style="text-align:center;">
                                    <a href="#" class="animated read-more-trigger" style="font-weight: normal;border: 0;">
                                        <span class="pagelist-more sprite-before"><span class="pagelist-more__text">Еще</span></span>
                                    </a>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row-actor-about">
                            <div class="row-tabs">
                                <ul class="tabs-list clear">
                                    <li class="active" data-type-sliderGroup="tab" data-type-sliderButton="1"><a><span>ФИЛЬМОГРАФИЯ</span></a></li>
                                    <li class="tabs-list-name"><span>СМОТРЕТЬ</span></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="2"><a><span>В КИНО</span></a></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="3"><a><span>ОНЛАЙН</span></a></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="4"><a><span>НА ТВ</span></a></li>
                                </ul>
                            </div>
                            <div class="mobile__select my-select">
                                <span class="result">ФИЛЬМОГРАФИЯ</span>
                                <ul class="result-list">
                                    <li class="active" data-type-sliderGroup="tab" data-type-sliderButton="1"><a><span>ФИЛЬМОГРАФИЯ</span></a></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="2"><a><span>В КИНО</span></a></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="3"><a><span>ОНЛАЙН</span></a></li>
                                    <li class="" data-type-sliderGroup="tab" data-type-sliderButton="4"><a><span>НА ТВ</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row-list-about adaptive-tile active" data-type-sliderGroup="tab" data-type-sliderElem="1">
                            <?php $cnt = 0; ?>
                            <?php
                            function plural_form($number, $after) {
                                $cases = array (2, 0, 1, 1, 1, 2);
                                echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
                            }
                            ?>
                            <?php foreach ($list as $type => $subList): ?>
                                <?php $cnt++ ?>
                                <div class="parent-list-about">
                                    <div class="shadow-list-about">
                                        <div class="list-about-item clear" data-type-openclose-button="<?= $cnt ?>">
                                            <div class="list-about-item-tile">
                                                <span class="list-about-item__title animated"><?= $type ?></span>
                                                <?php $total = count($subList); ?>
                                                <span class="list-about-item__number"><?= plural_form($total, ['работа', 'работы', 'работ']) ?></span>
                                            </div>
                                            <div class="list-about-item-tile list-about-item-tile--right"><span class="list-about-item__button animated">РАЗВЕРНУТЬ</span></div>
                                        </div>
                                    </div>
                                    <div class="row-list-about-result" data-type-openclose-element="<?= $cnt ?>">
                                        <?php foreach ($subList as $item_): ?>
                                            <div class="list-content-item-inner">
                                                <div class="section-result-content clear">
                                                    <div class="row-chief-title clear">
                                                        <div class="section-result-item section-result-item-years "><?= $item_[Filmography::YEAR] ?></div>
                                                        <div class="section-result-item section-result-item-actor">
                                                            <div class="list-preview">
                                                                <a href="/film/<?= $item_[Filmography::ID] ?>/">
                                                                    <span>
                                                                      <img alt="" src="//:0" data-original="<?= $item_[Filmography::IMAGE] ?>" class="lazy  image-padding--white">
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="section-result-item item2 clear">
                                                        <div class="row-result-tabs-item row-result-tabs-item--left">
                                                            <?php if ('' == $item_[Filmography::NAME_RU]): ?>
                                                                <div class="name"><a href="/film/<?= $item_[Filmography::ID] ?>/"><?= $item_[Filmography::NAME_ORIGIN] ?></a></div>
                                                            <?php else: ?>
                                                                <div class="name"><a href="/film/<?= $item_[Filmography::ID] ?>/"><?= $item_[Filmography::NAME_RU] ?></a></div>
                                                                <div class="name__eng"><?= $item_[Filmography::NAME_ORIGIN] ?></div>
                                                            <?php endif ?>
                                                            <?php if (1 == $cnt): ?>
                                                                <div class="section-result-info">
                                                                    <div class="actors-info-content">
                                                                        <ul>
                                                                            <li class="actors-info-role">Роль — <?= $item_[Filmography::ROLE_EN] ?></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="row-result-tabs-item--right">
                                                            <div class="result-tabs-image">
                                                                <div class="list-preview" gallery-number="1">

                                                                </div>
                                                            </div>
                                                            <div class="row-info-list-cinema">
                                                                <div class="main-folder-icon">
                                                                    <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                                                                        <a class="folder__icon icon"></a>
                                                                        <div class="hint">Добавить в Избранное</div>
                                                                        <div class="row-dropdown-folder">
                                                                            <div class="dropdown-folder dropdown-folder-content">
                                                                                <div class="dropdown-folder-title"><span>В избранное</span></div>
                                                                                <ul class="dropdown-folder-list" data-id="<?= $item_[Filmography::ID] ?>">

                                                                                </ul>
                                                                            </div>
                                                                            <div class="dropdown-folder dropdown-folder-setting">
                                                                                <a href="#" class="clear">
                                                                                    <!-- <i class="setting-icon"></i> -->
                                                                                    <span>Управление папками</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row-icon-add row-icon-add--white icon-star" data-id="<?= $item_[Filmography::ID] ?>">
                                                                        <div class="star__icon icon">
                                                                            <div class="hint-block">
                                                                                <div class="hint-inner-block">
                                                                                    <div class="hint-inner-block__title">
                                                                                        <i class="star__icon icon"></i>Мой рейтинг
                                                                                    </div>
                                                                                    <div class="row-raiting-star">
                                                                                        <div class="inner-raiting-star" data-fixed="fixed">
                                                                                            <ul class="raiting-list-star clear rateList">
                                                                                            </ul>
                                                                                        <span class="raiting-number">

                                                                                        </span>
                                                                                            <span class="result-star"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-mini-raiting-number">
                                                                    <?php if (0 < $item_[Filmography::RATE]): ?>
                                                                        Рейтинг: <span class="number"><?= $item_[Filmography::RATE] ?></span>
                                                                    <?php endif ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row-list-about row-session-table" data-type-sliderGroup="tab" data-type-sliderElem="2">
                            <p style="text-align: center;">Данные отсутсвуют</p>
                        </div>
                        <div class="row-list-about row-session-table" data-type-sliderGroup="tab" data-type-sliderElem="3">
                            <p style="text-align: center;">Данные отсутсвуют</p>
                        </div>
                        <div class="row-list-about row-session-table" id="tv_program" data-type-sliderGroup="tab" data-type-sliderElem="4">
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $.ajax({
                                        url: '?handler=getTv',
                                        type: "POST",
                                        data: 'personId=<?= $id ?>',
                                        dataType: "json",
                                        success: function (data) {
                                            var html = '<p style="text-align: center;">Данные отсутсвуют</p>';

                                            if (Object.keys(data).length) {
                                                html = '<div class="tab-table-outer">' +
                                                    '<div class="tab-table-head clear">' +
                                                    '<div class="tab-table-col">Канал</div>' +
                                                    '<div class="tab-table-col">Дата</div>' +
                                                    '<div class="tab-table-col">Время</div>' +
                                                    '</div>';
                                                for (var key in data) {
                                                    if (data.hasOwnProperty(key)) {
                                                        html += '<div class="outer-cinema-online">';
                                                        html += '<div class="link-cinema"><a href="/film/' + key + '/">' + data[key][<?= TV::NAME ?>] + '</a></div>';

                                                        var list = data[key][<?= TV::LIST ?>];
                                                        for (var i in list) {
                                                            if (list.hasOwnProperty(i)) {
                                                                html += '<div class="tab-table-row clear">' +
                                                                    '<div class="tab-table-col tab-table-col-name"><a href="/tv/">' + list[i][<?= TV::CHANEL ?>] + '</a></div>' +
                                                                    '<div class="tab-table-col">' + list[i][<?= TV::DATE ?>] + '</div>' +
                                                                    '<div class="tab-table-col">' + list[i][<?= TV::TIME ?>] + '</div>' +
                                                                    '</div>';
                                                            }
                                                        }

                                                        html += '</div>';
                                                    }
                                                }
                                                html += '</div>';
                                                $('#tv_program').addClass('row-session-tab-table row-session-logo-table row-session-logo-table-channel');
                                            }

                                            $('#tv_program').html(html);
                                        },
                                        complete: function () {
                                        },
                                        error: function () {
                                        },
                                        timeout: 5000
                                    });
                                });
                            </script>
                            <div class="tab-table-outer">
                                
                            </div>
                        </div>
                        <div class="pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>/"></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php if (count($news)): ?>
                            <div class="outer-other">
                                <section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew">
                                    <div class="sticker">
                                        <div class="sticker-item">ПОСЛЕДНИЕ НОВОСТИ О ПЕРСОНЕ</div>
                                    </div>
                                    <div class="section-mini-prewiew section-mini-prewiew--yellow ">
                                        <div class="outer-section-mini-prewiew-item clear">
                                            <div class="outer-pagelist-yellow">
                                                <?php foreach ($news as $article): ?>
                                                    <div class="pagelist-prewiew-item">
                                                        <div class="section-mini-prewiew-wrap-item">
                                                            <div class="section-mini-prewiew-item">
                                                                <a href="/<?= $article['category'] ?>/<?= $article['id'] ?>/"><img alt="" src="<?= $article['image'] ?>" class="responsive-image section-mini-prewiew-item__image"></a>
                                                                <div class="section-mini-prewiew-item-text">
                                                                    <a href="/<?= $article['category'] ?>/<?= $article['id'] ?>/"><?= $article['title'] ?></a>
                                                                    <?php if (0 < $article['comment']): ?>
                                                                        <a href="/<?= $article['category'] ?>/<?= $article['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $article['comment'] ?></a>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="section-mini-prewiew-item-desc">
                                                                    <?= $article['anons'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php endif ?>
                        <div class="full-comments full-comments-reviews" id="reviews">
                            <div class="full-comments-head">
                                <div class="full-comments-text"><a href="/people/<?= $id ?>/reviews/">Отзывы</a> <span class="number"></span></div>
                            </div>
                            <div class="inner">

                            </div>
                            <div class="full-comments-head full-comments-foot">

                            </div>
                        </div>

                        <div class="row-pagelist-ligin">
                            <div class="pagelist__title pagelist-ligin__title">ОТПРАВИТЬ ОТЗЫВ</div>
                            <div class="pagelist-ligin clear">
                                <div class="answer-avatar">
                                    <div class="avatar-profile--mini-image avatar-profile-m" id="myAvatar"><img src="//fs.kinomania.ru/app/img/content/no-avatar-m.jpg" alt=""></div>
                                </div>
                                <div class="answer-layout">
                                    <div class="answer-layout-place parent-sticker">
                                        <textarea></textarea>
                                        <div class="sticker-item-elements">
                                            <div class="sticker-elements">
                                                <ul>
                                                    <li class="comment_add_i"><i>I</i></li>
                                                    <li class="comment_add_b"><b>B</b></li>
                                                    <li class="comment_add_quote">Цитата</li>
                                                    <li class="comment_add_spoiler">Спойлер</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="answer-button">
                                            <button class="button button4" id="sendReview">Отправить</button>
                                        </div>
                                    </div>
                                </div>
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
            $('.page-content-head__more a').click(function(){
                $('.read-more-text').addClass('read-more-text_open');
                $(this).hide();
                return false;
            });
        });
    </script>

    <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
    <script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
    <script type="text/javascript">
        function amimatedStar() {
            $('.select-star').addClass('default');
        }
        function rateClick()
        {
            $('.star__item').click(function(e){
                e = e || window.event;
                e.preventDefault();

                var id = $(this).parent().parent().parent().parent().parent().parent().parent().attr('data-id');
                var rate = $(this).attr('data-value');
                var el = this;

                window.rateData[id] = rate;
                $.ajax({
                    url: '/user/' + login + '/films?handler=rate',
                    type: "POST",
                    data: 'id=' + id + '&rate=' + rate,
                    dataType: "json",
                    success: function (data) {
                        if (0.0 < data) {
                            $(el).parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.number').text(data);
                        }
                    },
                    complete: function () {
                    },
                    error: function () {
                    },
                    timeout: 5000
                });

                var parent = $(this).parent();
                $(parent).find('.select-star').remove();
                $(parent).find('.star__item').each(function(){
                    $(this).removeAttr('data-active');
                });
                $(this).attr('data-active', 'select');
                $(this).parents('.inner-raiting-star').attr('data-fixed', 'fixed');
                $(this).append('<span class="select-star">ваша оценка</span>');
                setTimeout(amimatedStar, 2000);

                return false;
            });
        }
        $(document).ready(function(){
            var collectionGet = false;
            var collectionList = [];

            window.star_click = 0;
            window.rateData = [];

            var authProb = false;
            var login = '';
            window.authProb = authProb;
            var matches = document.cookie.match(new RegExp("(?:^|; )__user__=([^;]*)"));
            matches = matches ? decodeURIComponent(matches[1]) : undefined;
            if (undefined !== matches) {
                login = matches.split('.');
                login = login[0];
                if (1 < login.length) {
                    authProb = true;
                }
            }

            $("img.lazy").lazyload({
                effect : "fadeIn"
            });

            $('.image-cover-parent').magnificPopup({
                type: 'image'
            });
            $("[gallery-number]").each(function(i, item){
                var num = $(item).attr('gallery-number');
                $('[gallery-number='+num+'] > a').magnificPopup({
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.'
                    }
                });
            });
            $('.popup-gallery-list-trailers').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    }
                }
            });

            $('.page-content-head__more a').click(function(){
                $('.read-more-text').css('height', 'initial').toggleClass('read-more-text_hidden');
                $(this).hide();
                return false;
            });

            $('.collectPerson').click(function(){
                if (authProb) {
                    var el = $(this).parent().children('.row-dropdown-folder');

                    if (!collectionGet) {
                        $.ajax({
                            url: '/user/' + login + '/people?handler=folderList',
                            type: "POST",
                            dataType: "json",
                            success: function (data) {
                                collectionGet = true;

                                for (var key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        collectionList.push([data[key][0], data[key][1]]);
                                    }
                                }

                                var cnt = 0;
                                for (key in collectionList) {
                                    if (collectionList.hasOwnProperty(key)) {
                                        cnt += 1;
                                        var html = '<li class="addCollection" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
                                        $(el).find('ul.dropdown-folder-list').append(html);
                                    }
                                }
                            },
                            complete: function () {
                            },
                            error: function () {
                            },
                            timeout: 5000
                        });
                    } else {
                        var cnt = 0;
                        $(el).find('ul.dropdown-folder-list').html('');
                        for (var key in collectionList) {
                            if (collectionList.hasOwnProperty(key)) {
                                cnt += 1;
                                var html = '<li class="addCollection" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
                                $(el).find('ul.dropdown-folder-list').append(html);
                            }
                        }
                    }

                    el.find('a').attr('href', '/user/' + login + '/people');
                    el.addClass('active');
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-auth-item').addClass('active');
                }
            });
            $(document).on('click', '.addCollection', function() {
                var el = this;
                if (authProb) {
                    var folderId = $(this).attr('data-id');
                    var personId = $(this).parent().attr('data-id');
                    $.ajax({
                        url: '/user/' + login + '/people?handler=addPerson',
                        type: "POST",
                        data: 'folderId=' + folderId + '&personId=' + personId,
                        dataType: "json",
                        success: function (data) {
                            $(el).parent().parent().parent().removeClass('active');
                            if (0 == data) {
                                $(el).parent().parent().parent().parent().notify("Персона добавлена в коллекцию", {
                                    className: "success",
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            } else if (2 == data) {
                                $(el).parent().parent().parent().parent().notify("Персона уже есть в данной коллекции", {
                                    className: "info",
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            } else {
                                $(el).parent().parent().parent().parent().notify("Не удалось добавить персону в коллекцию", {
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            }
                        },
                        error: function () {
                            $(el).parent().parent().parent().removeClass('active');
                            $(el).parent().parent().parent().parent().notify("Не удалось добавить персону в коллекцию", {
                                position: "top",
                                autoHideDelay: 2400
                            });
                        },
                        timeout: 5000
                    });
                }
            });

            $('.icon-star').click(function(){
                if (authProb) {
                    $(this).find('.hint-block').css('visibility', 'visible');
                    $(this).find('.hint-block').css('opacity', '1');

                    var id = $(this).attr('data-id');
                    var el = this;

                    if (undefined === window.rateData[id]) {
                        $.ajax({
                            url: '/user/' + login + '/films?handler=getRate',
                            type: "POST",
                            data: 'id=' + id,
                            dataType: "json",
                            success: function (data) {
                                var ul = $(el).find('.rateList');
                                $(ul).html('');
                                $(ul).parent().find('.raiting-number').html('');

                                window.rateData[id] = data;
                                for (var i = 1; i < 11; i++) {
                                    if (i > data) {
                                        $(ul).append('<li class="star__item" data-value="' + i + '"><i class="icon__star"></i></li>');
                                    } else {
                                        if (i != data) {
                                            $(ul).append('<li class="star__item active" data-value="' + i + '"><i class="icon__star"></i></li>');
                                        } else {
                                            $(ul).append('<li class="star__item active" data-value="' + i + '" data-active="select">' +
                                                '<i class="icon__star"></i></li>');
                                        }
                                    }
                                }
                                if (0 < data) {
                                    $(ul).parent().find('.raiting-number').append('<span class="value">' + data + '</span> из 10');
                                } else {
                                    $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');
                                }
                                rateClick();

                                $('.star__item').hover(function () {
                                    thisStar = $(this).attr('data-value');
                                    parentStar = $(this).parents('.inner-raiting-star');
                                    minStar = 0;
                                    maxStar = $(parentStar).find('.star__item').length;
                                    if (!$(this).is('[data-active]')) {
                                        while (minStar <= thisStar) {
                                            $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
                                            minStar++
                                        }
                                    }
                                    while (maxStar > thisStar) {
                                        $(parentStar).find('.star__item[data-value = ' + maxStar + ']').removeClass('active');
                                        maxStar--
                                    }
                                    $(parentStar).find('.raiting-number .value').html(thisStar);
                                }, function () {
                                    if (!$('.inner-raiting-star').is('[data-fixed]')) {
                                        $('.inner-raiting-star .star__item').removeClass('active');
                                        $('.raiting-number .value').html(0);

                                    }
                                });

                                $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                                $('.raiting-list-star').hover(function() {
                                    $(this).find('.select-star').addClass('active');
                                }, function() {
                                    parentStar = $(this).parents('.inner-raiting-star');
                                    minStar = 0;
                                    fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                                    if ($('.inner-raiting-star').is('[data-fixed]')) {
                                        $(parentStar).find('.star__item').removeClass('active');
                                        while (minStar <= fixedStar) {
                                            $(parentStar).find('.star__item[data-value = '+ minStar +']').addClass('active');
                                            minStar++
                                        }
                                        $(parentStar).find('.raiting-number .value').html(fixedStar);
                                        $('.select-star').removeClass('active');
                                        setTimeout(amimatedStar, 2000);
                                    }
                                });
                            },
                            complete: function () {
                            },
                            error: function () {
                            },
                            timeout: 5000
                        });
                    } else {
                        var ul = $(el).find('.rateList');
                        $(ul).html('');
                        $(ul).parent().find('.raiting-number').html('');

                        var data = window.rateData[id];
                        for (var i = 1; i < 11; i++) {
                            if (i > data) {
                                $(ul).append('<li class="star__item" data-value="' + i + '"><i class="icon__star"></i></li>');
                            } else {
                                if (i != data) {
                                    $(ul).append('<li class="star__item active" data-value="' + i + '"><i class="icon__star"></i></li>');
                                } else {
                                    $(ul).append('<li class="star__item active" data-value="' + i + '" data-active="select">' +
                                        '<i class="icon__star"></i></li>');
                                }
                            }
                        }
                        if (0 < data) {
                            $(ul).parent().find('.raiting-number').append('<span class="value">' + data + '</span> из 10');
                        } else {
                            $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');
                        }
                        rateClick();


                        $('.star__item').hover(function () {
                            thisStar = $(this).attr('data-value');
                            parentStar = $(this).parents('.inner-raiting-star');
                            minStar = 0;
                            maxStar = $(parentStar).find('.star__item').length;
                            if (!$(this).is('[data-active]')) {
                                while (minStar <= thisStar) {
                                    $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
                                    minStar++
                                }
                            }
                            while (maxStar > thisStar) {
                                $(parentStar).find('.star__item[data-value = ' + maxStar + ']').removeClass('active');
                                maxStar--
                            }
                            $(parentStar).find('.raiting-number .value').html(thisStar);
                        }, function () {
                            if (!$('.inner-raiting-star').is('[data-fixed]')) {
                                $('.inner-raiting-star .star__item').removeClass('active');
                                $('.raiting-number .value').html(0);

                            }
                        });

                        $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                        $('.raiting-list-star').hover(function() {
                            $(this).find('.select-star').addClass('active');
                        }, function() {
                            parentStar = $(this).parents('.inner-raiting-star');
                            minStar = 0;
                            fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                            if ($('.inner-raiting-star').is('[data-fixed]')) {
                                $(parentStar).find('.star__item').removeClass('active');
                                while (minStar <= fixedStar) {
                                    $(parentStar).find('.star__item[data-value = '+ minStar +']').addClass('active');
                                    minStar++
                                }
                                $(parentStar).find('.raiting-number .value').html(fixedStar);
                                $('.select-star').removeClass('active');
                                setTimeout(amimatedStar, 2000);
                            }
                        });
                    }
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .my-overlay-item').addClass('active');
                }
            });

            $('.folder__icon').click(function(){
                if (authProb) {
                    if ($(this).hasClass('personFolder')) {
                        var el = $(this).parent().children('.row-dropdown-folder');

                        if (!personCollectionGet) {
                            $.ajax({
                                url: '/user/' + login + '/people?handler=folderList',
                                type: "POST",
                                dataType: "json",
                                success: function (data) {
                                    personCollectionGet = true;

                                    for (var key in data) {
                                        if (data.hasOwnProperty(key)) {
                                            personCollectionList.push([data[key][0], data[key][1]]);
                                        }
                                    }

                                    var cnt = 0;
                                    for (key in personCollectionList) {
                                        if (personCollectionList.hasOwnProperty(key)) {
                                            cnt += 1;
                                            var html = '<li class="addCollectionFilm addPersonCollection" data-id="' + personCollectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + personCollectionList[key][1] + '</span></li>';
                                            $(el).find('ul.dropdown-folder-list').append(html);
                                        }
                                    }
                                },
                                complete: function () {
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        } else {
                            var cnt = 0;
                            $(el).find('ul.dropdown-folder-list').html('');
                            for (var key in personCollectionList) {
                                if (personCollectionList.hasOwnProperty(key)) {
                                    cnt += 1;
                                    var html = '<li class="addCollectionFilm addPersonCollection" data-id="' + personCollectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + personCollectionList[key][1] + '</span></li>';
                                    $(el).find('ul.dropdown-folder-list').append(html);
                                }
                            }
                        }

                        el.find('a').attr('href', '/user/' + login + '/people');
                        el.addClass('active');
                    } else {
                        var el = $(this).parent().children('.row-dropdown-folder');

                        if (!collectionGet) {
                            $.ajax({
                                url: '/user/' + login + '/films?handler=folderList',
                                type: "POST",
                                dataType: "json",
                                success: function (data) {
                                    collectionGet = true;

                                    for (var key in data) {
                                        if (data.hasOwnProperty(key)) {
                                            collectionList.push([data[key][0], data[key][1]]);
                                        }
                                    }

                                    var cnt = 0;
                                    for (key in collectionList) {
                                        if (collectionList.hasOwnProperty(key)) {
                                            cnt += 1;
                                            var html = '<li class="addCollectionFilm" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
                                            $(el).find('ul.dropdown-folder-list').append(html);
                                        }
                                    }
                                },
                                complete: function () {
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        } else {
                            var cnt = 0;
                            $(el).find('ul.dropdown-folder-list').html('');
                            for (var key in collectionList) {
                                if (collectionList.hasOwnProperty(key)) {
                                    cnt += 1;
                                    var html = '<li class="addCollectionFilm" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
                                    $(el).find('ul.dropdown-folder-list').append(html);
                                }
                            }
                        }

                        el.find('a').attr('href', '/user/' + login + '/films');
                        el.addClass('active');
                    }
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .my-overlay-item').addClass('active');
                }
            });
            $(document).on('click', '.addCollectionFilm', function() {
                var el = this;
                if (authProb) {
                    if ($(this).hasClass('addPersonCollection')) {
                        var folderId = $(this).attr('data-id');
                        var personId = $(this).parent().attr('data-id');
                        $.ajax({
                            url: '/user/' + login + '/people?handler=addPerson',
                            type: "POST",
                            data: 'folderId=' + folderId + '&personId=' + personId,
                            dataType: "json",
                            success: function (data) {
                                $(el).parent().parent().parent().removeClass('active');
                                if (0 == data) {
                                    $(el).parent().parent().parent().parent().notify("Персона добавлена в коллекцию", {
                                        className: "success",
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                } else if (2 == data) {
                                    $(el).parent().parent().parent().parent().notify("Персона уже есть в данной коллекции", {
                                        className: "info",
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                } else {
                                    $(el).parent().parent().parent().parent().notify("Не удалось добавить персону в коллекцию", {
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                }
                            },
                            error: function () {
                                $(el).parent().parent().parent().removeClass('active');
                                $(el).parent().parent().parent().parent().notify("Не удалось добавить персону в коллекцию", {
                                    position: "left",
                                    autoHideDelay: 2400
                                });
                            },
                            timeout: 5000
                        });
                    } else {
                        var folderId = $(this).attr('data-id');
                        var filmId = $(this).parent().attr('data-id');
                        $.ajax({
                            url: '/user/' + login + '/films?handler=addFilm',
                            type: "POST",
                            data: 'folderId=' + folderId + '&filmId=' + filmId,
                            dataType: "json",
                            success: function (data) {
                                $(el).parent().parent().parent().removeClass('active');
                                if (0 == data) {
                                    $(el).parent().parent().parent().parent().notify("Фильм добавлен в коллекцию", {
                                        className: "success",
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                } else if (2 == data) {
                                    $(el).parent().parent().parent().parent().notify("Фильм уже есть в данной коллекции", {
                                        className: "info",
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                } else {
                                    $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                        position: "left",
                                        autoHideDelay: 2400
                                    });
                                }
                            },
                            error: function () {
                                $(el).parent().parent().parent().removeClass('active');
                                $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                    position: "left",
                                    autoHideDelay: 2400
                                });
                            },
                            timeout: 5000
                        });
                    }
                }
            });

            $(window).scroll(function() {
                if (undefined !== $('#reviews').offset()) {
                    if ($(window).scrollTop() + $(window).height() >= $('#reviews').offset().top) {
                        if (!$('#reviews').attr('loaded')) {
                            $('#reviews').attr('loaded', true);
                            
                            $.ajax({
                                url: '?handler=getReview',
                                type: "POST",
                                dataType: "json",
                                success: function (data) {
                                    if (data.hasOwnProperty('user')) {
                                        for (var key in data['user']) {
                                            if (data['user'].hasOwnProperty(key)) {
                                                var html = '   <div class="parent-author-full-comments row-author-full-comments">  '  +
                                                    '   	<div class="author-full-comments-image">  ';
                                                    if (0 == data['user'][key]['login']) {
                                                        html += '<img width="48" height="48" src="' + data['user'][key]['avatar'] + '" alt="">';
                                                    } else {
                                                        html += '<a href="/user/' + data['user'][key]['login'] + '/"><img width="48" height="48" src="' + data['user'][key]['avatar'] + '" alt=""></a>  ';
                                                    }
                                                    html += '   	</div>  '  +
                                                    '   	<div class="author-full-comments-content">  ';
                                                    if (0 == data['user'][key]['login']) {
                                                        html += '<div class="author-comments-name author-reviews-name">' + data['user'][key]['name'] + '</div>  ';
                                                    } else {
                                                        html += '<div class="author-comments-name author-reviews-name"><a href="/user/' + data['user'][key]['login'] + '/">' + data['user'][key]['name'] + '</a></div>  ';
                                                    }
                                                    html += '   		<div class="author-comments-text">  '  +
                                                    data['user'][key]['text'] +
                                                    '   		</div>  '  +
                                                    '   		<div class="author-comments-info clear">  '  +
                                                    '   			<ul class="author-comment-info-list">  '  +
                                                    '   				<li class=" reply__like"><a href="#/" class="vote_item" data-id="' + data['user'][key]['id'] + '"><span>Мне нравится</span>  '  +
                                                    '   						<i class="reply__icon reply__like_icon"></i>  '  +
                                                    '   						<span class="value">' + data['user'][key]['vote'] + '</span>  '  +
                                                    '   					</a>  '  +
                                                    '   				</li>  '  +
                                                    '   				<li class="reply__comments">  '  +
                                                    '   					<a href="<?= $id ?>/reviews/' + data['user'][key]['id'] + '">  '  +
                                                    '   						<span>Комментировать</span>  '  +
                                                    '   						<i class="reply__icon reply__comment_icon"></i>  '  +
                                                    '   						<span class="value">' + data['user'][key]['comment'] + '</span>  '  +
                                                    '   					</a>  '  +
                                                    '   				</li>  '  +
                                                    '   				<li class="date">' + data['user'][key]['date'] + '</li>  '  +
                                                    '   			</ul>  '  +
                                                    '   		</div>  '  +
                                                    '   	</div>  '  +
                                                    '  </div>  ';
                                                $('#reviews').find('.inner').append(html);
                                            }
                                        }
                                    }

                                    $('#reviews').find('.full-comments-foot').html(' <div class="full-comments-text"><a href="/people/<?= $id ?>/reviews/"><span>Все отзывы (' + data['count'] + ')</span></a></div>');

                                    $('.vote_item').on('click', function(e){
                                        e = e || window.event;
                                        e.preventDefault();
                                        if (authProb) {
                                            var el = this;
                                            var id  = $(this).attr('data-id');

                                            $.ajax({
                                                url: '/user/' + login + '?handler=voteFeedback&id=' + id,
                                                type: "POST",
                                                dataType: "json",
                                                success: function (data) {
                                                    if (0 < data) {
                                                        $(el).find('.value').html(data);
                                                    }
                                                },
                                                complete: function () {
                                                },
                                                error: function () {
                                                },
                                                timeout: 5000
                                            });

                                        } else {
                                            $('.my-overlay').addClass('active');
                                            $('.my-overlay .overlay-auth-item').addClass('active');
                                        }
                                        return false;
                                    });
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        }
                    }
                }
            });

            $(document).mouseup(function (e){
                if (authProb) {
                    var div = $(".row-dropdown-folder.active");
                    if (!div.is(e.target) && div.has(e.target).length === 0) {
                        div.removeClass('active');
                    }
                    div = $(".hint-inner-block");
                    if (!div.is(e.target) && div.has(e.target).length === 0) {
                        $(this).find('.hint-block').css('visibility', 'hidden');
                        $(this).find('.hint-block').css('opacity', '0');
                    }
                }
            });
            $('.my-overlay-bg').click(function(event) {
                $('.my-overlay').removeClass('active');
                $('.my-overlay .my-overlay-item').removeClass('active');
            });


            $(document).on('click', '#sendReview', function(){
                if (authProb) {
                    var button = this;
                    var text = $(this).parent().parent().parent().parent().find('textarea').val();
                    var id = 0;
                    if (!$(this).hasClass('main')) {
                        id = $(this).parent().parent().parent().parent().parent().parent().parent().find('.author-comments-text').attr('data-id');
                    }

                    if (1 < text.length) {
                        $.ajax({
                            url: '/user/' + login + '?handler=addFeedback',
                            type: "POST",
                            data: "relatedId=<?= $id ?>&text=" + text,
                            success: function (data) {
                                if (1 == data) {
                                    $(button).notify("Не удалось добавить", {
                                        position: "right",
                                        autoHideDelay: 2400
                                    });

                                    $(button).parent().parent().parent().parent().find('textarea').val('');
                                } else if (2 == data) {
                                    window.clickCount += 1;
                                    $(button).notify("Слишком часто", {
                                        position: "right",
                                        autoHideDelay: 2400
                                    });
                                    if (1 < window.clickCount) {
                                        $(button).parent().parent().parent().parent().find('textarea').val('');
                                    }
                                } else {
                                    var avatar = $('#myAvatar').find('img').attr('src');
                                    $('#reviews').find('.inner').append( '   <div class="parent-author-full-comments row-author-full-comments with-answer">  '  +
                                        '   <div class="author-full-comments-image"> <a href="/user/' + login + '/"><img src="' + avatar + '" alt=""></a></div>  '  +
                                        '   <div class="author-full-comments-content"><div class="author-comments-name"><a href="/user/' + login + '/">' + login + '</a></div><div class="author-comments-text" data-parent="0" data-id="0" style="">' + text + '</div>  '  +
                                        '   	<div class="author-comments-info clear">  '  +
                                        '   		<ul class="author-comment-info-list">  '  +
                                        '   			<li class="date">отзыв будет опубликована после <b>модерации</b></li>  '  +
                                        '   		</ul>  '  +
                                        '   		<div class="like-button clear">  '  +
                                        '   		</div>  '  +
                                        '   	</div>  '  +
                                        '     '  +
                                        '   </div>  '  +
                                        '  </div>  ');

                                    $(button).parent().parent().parent().parent().find('textarea').val('');
                                }
                            },
                            complete: function () {
                            },
                            error: function () {
                                $(button).notify("Не удалось добавить", {
                                    position: "right",
                                    autoHideDelay: 2400
                                });
                            },
                            timeout: 5000
                        });
                    } else {
                        $(button).notify("Введите текст", {
                            position: "right",
                            autoHideDelay: 2400
                        });
                    }
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-auth-item').addClass('active');
                }
            });

            $(document).on('click', '.comment_add_i', function(){
                var el = $(this).parent().parent().parent().parent().find('textarea');
                $(el).val(el.val() + " " + '[i][/i]');
                var pos = $(el).val().length - 4;
                setSelectionRange(el[0], pos, pos);
            });

            $(document).on('click', '.comment_add_b', function(){
                var el = $(this).parent().parent().parent().parent().find('textarea');
                $(el).val(el.val() + " " + '[b][/b]');
                var pos = $(el).val().length - 4;
                setSelectionRange(el[0], pos, pos);
            });

            $(document).on('click', '.comment_add_quote', function(){
                var el = $(this).parent().parent().parent().parent().find('textarea');
                $(el).val(el.val() + " " + '[quote][/quote]');
                var pos = $(el).val().length - 8;
                setSelectionRange(el[0], pos, pos);
            });

            $(document).on('click', '.comment_add_spoiler', function(){
                var el = $(this).parent().parent().parent().parent().find('textarea');
                $(el).val(el.val() + " " + '[spoiler][/spoiler]');
                var pos = $(el).val().length - 10;
                setSelectionRange(el[0], pos, pos);
            });

            if (authProb) {
                $.ajax({
                    url: '/user/' + login + '?handler=getImage',
                    type: "POST",
                    success: function (data) {
                        if ('' != data) {
                            $('#myAvatar img').attr('src', data);
                        }
                    },
                    complete: function () {
                    },
                    error: function () {
                    },
                    timeout: 5000
                });
            }
            

            $('.list-about-item').click(function(){
                $(window).scrollTop($(window).scrollTop() + 1);
                setTimeout(function(){
                    $(window).scrollTop($(window).scrollTop() + 1);
                }, 750);
            });
        });

        $('.my-add-info').click(function(){
            $('.my-overlay').addClass('active');
            $('.my-overlay .overlay-add').addClass('active');
        });

        $('.my-massage-error').click(function(){
            $('.my-overlay').addClass('active');
            $('.my-overlay .my-item-error').addClass('active');
        });

        $(document).ready(function(){
            var max = 0, el = null;
            $('.list-about-item__number').each(function(){
                var count = parseInt($(this).text().split(' ')[0]);
                if (count > max) {
                    max = count;
                    el = this;
                }
            });
            if (0 < max) {
                $(el).parent().parent().parent().parent().find('.row-list-about-result').addClass('active');
                $(el).parent().parent().find('.list-about-item__button').text('СВЕРНУТЬ');
            }
        });
    </script>
</body>
</html>
