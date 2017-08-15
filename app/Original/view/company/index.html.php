<?php
/**
 * @var array $item
 * @var int $type
 * @var string $static
 */
use Kinomania\Original\Key\Company\Company;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (1 == $type): ?>
    <title><?= $item[Company::TYPE] ?> компания <?= $item[Company::NAME] ?></title>
    <meta name="description" content="<?= $item[Company::TYPE] ?>: компания <?= $item[Company::NAME] ?>: сайт, телефон, список актеров и актрис"/>
    <meta name="keywords" content="<?= $item[Company::TYPE] ?>, кастинг, компания, актёры"/>
<?php elseif (2 == $type): ?>
    <title>Компания <?= $item[Company::NAME] ?></title>
    <meta name="description" content="Компания <?= $item[Company::NAME] ?>: сайт, телефон, фильмография"/>
    <meta name="keywords" content="<?= $item[Company::TYPE] ?>, компания, фильмы"/>
<?php else: ?>
    <title><?= $item[Company::TYPE] ?> компания <?= $item[Company::NAME] ?></title>
    <meta name="description" content="<?= $item[Company::TYPE] ?>: компания <?= $item[Company::NAME] ?>: описание, сайт, телефон, фильмография"/>
    <meta name="keywords" content="<?= $item[Company::TYPE] ?>, компания, фильмы"/>
<?php endif ?>

    <!-- include section/head.html.php -->
</head>
<body>
<div class="my-overlay">
    <div class="my-overlay-item" data-type="overlay-auth">
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
</div>
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
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h1 class="pagetitle mini__pagetitle company-pagetitle"><?= $item[Company::NAME] ?></h1>
                    <div class="page-content-head clear page-content-head-company">
                        <div class="page-content-head__image">
                            <div class="image-shadow ">
                                <div class="image-cover"><img src="<?= $item[Company::IMAGE] ?>" alt="" class=""></div>
                            </div>
                            <?php if (!empty($item[Company::SITE])): ?>
                                <div class="company-link">
                                    <a href="//<?= $item[Company::SITE] ?>/" rel="nofollow" target="blank"><?= $item[Company::SITE] ?></a>
                                </div>
                                <br />
                            <?php endif ?>
                        </div>
                        <div class="page-content-head__content">
                            <div class="page-content-head__content-text <?php if ($item[Company::TEXT_MORE]): ?>read-more-text<?php endif ?>">
                                <?= $item[Company::TEXT] ?>
                            </div>
                            <?php if ($item[Company::TEXT_MORE]): ?>
                                <div class="page-content-head__more">
                                    <a href="#" class="list-about-item__button animated read-more-trigger">Читать полностью</a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row-list-about adaptive-tile company-list-about active">
                        <?php if (1 == $type): ?>
                            <?php foreach ($item[Company::FILMOGRAPHY] as $person): ?>
                                <div class="list-content-item-inner">
                                    <div class="section-result-content clear">
                                        <div class="row-chief-title clear">
                                            <div class="section-result-item section-result-item-actor" style="width: 84%;">
                                                <div class="list-preview top_m_3">
                                                    <a href="/people/<?= $person[\Kinomania\Original\Key\Company\Person::ID] ?>">
                                                      <span>
                                                          <img alt="" src="//:0" width="88" data-original="<?= $person[\Kinomania\Original\Key\Company\Person::IMAGE] ?>" class="lazy  image-padding--white">
                                                      </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="section-result-item item2 clear">
                                            <div class="row-result-tabs-item row-result-tabs-item--left">
                                                <div class="name">
                                                    <a href="/people/<?= $person[\Kinomania\Original\Key\Company\Person::ID] ?>">
                                                        <?php if (empty($person[\Kinomania\Original\Key\Company\Person::NAME_RU])): ?>
                                                            <?= $person[\Kinomania\Original\Key\Company\Person::NAME_ORIGIN] ?>
                                                        <?php else: ?>
                                                            <?= $person[\Kinomania\Original\Key\Company\Person::NAME_RU] ?>
                                                        <?php endif ?>
                                                    </a>
                                                </div>
                                                <?php if (!empty($person[\Kinomania\Original\Key\Company\Person::NAME_RU])): ?>
                                                    <div class="name__eng"><?= $person[\Kinomania\Original\Key\Company\Person::NAME_ORIGIN] ?></div>
                                                <?php endif ?>
                                                <div class="section-result-item section-result-item-years "><?= $person[\Kinomania\Original\Key\Company\Person::BIRTHDAY] ?></div>
                                            </div>
                                            <div class="row-result-tabs-item--right">
                                                <div class="row-info-list-cinema">
                                                    <div class="main-folder-icon">
                                                        <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                                                            <a class="folder__icon personFolder icon"></a>
                                                            <div class="hint">Добавить в Избранное</div>
                                                            <div class="row-dropdown-folder">
                                                                <div class="dropdown-folder dropdown-folder-content">
                                                                    <div class="dropdown-folder-title"><span>В избранное</span></div>
                                                                    <ul class="dropdown-folder-list" data-id="<?= $person[\Kinomania\Original\Key\Company\Person::ID] ?>">

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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php
                            /**
                             * @var \Kinomania\Original\Key\Company\Film $film
                             */
                            $count = 1;
                            ?>
                            <?php foreach ($item[Company::FILMOGRAPHY] as $type => $filmList): ?>
                                <div class="shadow-list-about">
                                    <div class="list-about-item clear" data-type-openclose-button="<?= $count ?>">
                                        <div class="list-about-item-tile">
                                            <span class="list-about-item__title animated"><?= $type ?></span>
                                            <span class="list-about-item__number"><?= count($filmList) ?></span>
                                        </div>
                                        <?php if (1 == $count): ?>
                                            <div class="list-about-item-tile list-about-item-tile--right"><span class="list-about-item__button animated">СВЕРНУТЬ</span></div>
                                        <?php else: ?>
                                            <div class="list-about-item-tile list-about-item-tile--right"><span class="list-about-item__button animated">РАЗВЕРНУТЬ</span></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="row-list-about-result <?php if(1 == $count): ?>active<?php endif ?>" data-type-openclose-element="<?= $count ?>">
                                    <?php foreach ($filmList as $film): ?>
                                        <div class="list-content-item-inner">
                                            <div class="section-result-content clear">
                                                <div class="row-chief-title clear">
                                                    <div class="section-result-item section-result-item-years "><?= $film[\Kinomania\Original\Key\Company\Film::YEAR] ?></div>
                                                    <div class="section-result-item section-result-item-actor">
                                                        <div class="list-preview top_m_3">
                                                            <a href="/film/<?= $film[\Kinomania\Original\Key\Company\Film::ID] ?>">
                                                              <span>
                                                                  <img alt="" src="//:0" data-original="<?= $film[\Kinomania\Original\Key\Company\Film::IMAGE] ?>" class="lazy  image-padding--white">
                                                              </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="section-result-item item2 clear">
                                                    <div class="row-result-tabs-item row-result-tabs-item--left">
                                                        <div class="name">
                                                            <a href="/film/<?= $film[\Kinomania\Original\Key\Company\Film::ID] ?>">
                                                                <?php if (empty($film[\Kinomania\Original\Key\Company\Film::NAME_RU])): ?>
                                                                    <?= $film[\Kinomania\Original\Key\Company\Film::NAME_ORIGIN] ?>
                                                                <?php else: ?>
                                                                    <?= $film[\Kinomania\Original\Key\Company\Film::NAME_RU] ?>
                                                                <?php endif ?>
                                                            </a>
                                                        </div>
                                                        <?php if (!empty($film[\Kinomania\Original\Key\Company\Film::NAME_RU])): ?>
                                                            <div class="name__eng"><?= $film[\Kinomania\Original\Key\Company\Film::NAME_ORIGIN] ?></div>
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="row-result-tabs-item--right">
                                                        <div class="row-info-list-cinema">
                                                            <div class="main-folder-icon">
                                                                <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                                                                    <a class="folder__icon icon"></a>
                                                                    <div class="hint">Добавить в Избранное</div>
                                                                    <div class="row-dropdown-folder">
                                                                        <div class="dropdown-folder dropdown-folder-content">
                                                                            <div class="dropdown-folder-title"><span>В избранное</span></div>
                                                                            <ul class="dropdown-folder-list" data-id="<?= $film[\Kinomania\Original\Key\Company\Film::ID] ?>">

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
                                                                <div class="row-icon-add row-icon-add--white icon-star" data-id="<?= $film[\Kinomania\Original\Key\Company\Film::ID] ?>">
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
                                                                <?php if (0 < $film[\Kinomania\Original\Key\Company\Film::RATE]): ?>
                                                                    Рейтинг: <span class="number"><?= $film[\Kinomania\Original\Key\Company\Film::RATE] ?></span>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php $count++ ?>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
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
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        var collectionGet = false;
        var collectionList = [];

        var personCollectionGet = false;
        var personCollectionList = [];

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

        $('.page-content-head__more a').click(function(){
            $('.read-more-text').addClass('read-more-text_open');
            $(this).hide();
            return false;
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
                                        var html = '<li class="addCollection addPersonCollection" data-id="' + personCollectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + personCollectionList[key][1] + '</span></li>';
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
                                var html = '<li class="addCollection addPersonCollection" data-id="' + personCollectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + personCollectionList[key][1] + '</span></li>';
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

                    el.find('a').attr('href', '/user/' + login + '/films');
                    el.addClass('active');
                }
            } else {
                $('.my-overlay').addClass('active');
                $('.my-overlay .my-overlay-item').addClass('active');
            }
        });
        $(document).on('click', '.addCollection', function() {
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

        $('.list-about-item__button').click(function(){
            $(window).scrollTop($(window).scrollTop() + 1);
            setTimeout(function(){
                $(window).scrollTop($(window).scrollTop() + 1);
            }, 750);
        });
    });
</script>
</body>
</html>
