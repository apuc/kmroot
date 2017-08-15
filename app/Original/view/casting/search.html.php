<?php
/**
 * @var array $list
 * @var string $static
 */
use Kinomania\Original\Key\Casting\Company as Company;
use Kinomania\Original\Key\Casting\Person as Person;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Поиск в кастинг-базе KINOMANIA.RU | Расширенный поиск, фото, видео</title>
    <meta name="description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>
    <meta name="keywords" content="Кастинг, кастинг-база, актерская база, поиск по актерам, кастинг агентства, видео актеров"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/casting/search" />
    <meta property="og:title" content="Поиск в кастинг-базе" />
    <meta property="og:description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>

    <!-- include section/head.html.php -->
    <link rel="stylesheet" href="<?= $static ?>/vendor/cms/_css/app.css">
    <link rel="stylesheet" href="<?= $static ?>/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
    <style>
        .tokenfield .token .token-label {
            max-width: 300px !important;
        }
        .tokenfield {
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            padding: 6px;
            font-size: 14px;
            width: 360px;
            color: #000;
            max-width: 100%;
        }
        .tokenfield .token .close {
            text-decoration: none;
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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h1 class="pagetitle">ПОИСК АКТЕРОВ</h1>

                    <div class="row-casting-filters clear">
                        <div class="casting-filters-item casting-filters-left">
                            <div class="row-input row-input-table">
                                <label class="filters-input filters-input-name">Пол</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-checkbox">
                                        <div class="checkbox">
                                            <input name="male" id="male" type="checkbox">
                                            <ins class="checkbox-icon"></ins>
                                        </div>
                                        <div class="checkbox-name">Мужской</div>
                                    </div>
                                    <div class="row-checkbox">
                                        <div class="checkbox">
                                            <input name="female" id="female" type="checkbox">
                                            <ins class="checkbox-icon"></ins>
                                        </div>
                                        <div class="checkbox-name">Женский</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table">
                                <label class="filters-input filters-input-name">Возраст</label>
                                <div class="filters-input filters-input-value clear-inline-block input-with-caption">
                                    <div class="row-table-input">
                                        <span class="table-input-name">от</span>
                                        <input type="text" name="age_from" id="age_from" class="input-field field--mini">
                                    </div>
                                    <div class="row-table-input">
                                        <span class="table-input-name">до</span>
                                        <input type="text"  name="age_to" id="age_to" class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table">
                                <div class="filters-input filters-input-name">Наличие</div>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-checkbox">
                                        <div class="checkbox">
                                            <input name="photo" id="photo" type="checkbox">
                                            <ins class="checkbox-icon"></ins>
                                        </div>
                                        <div class="checkbox-name">Фото</div>
                                    </div>
                                    <div class="row-checkbox">
                                        <div class="checkbox">
                                            <input name="video" id="video" type="checkbox">
                                            <ins class="checkbox-icon"></ins>
                                        </div>
                                        <div class="checkbox-name">Видео</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table">
                                <label class="filters-input filters-input-name">Рост</label>
                                <div class="filters-input filters-input-value clear-inline-block input-with-caption">
                                    <div class="row-table-input">
                                        <span class="table-input-name">от</span>
                                        <input name="height_from" id="height_from" type="text" class="input-field field--mini">
                                    </div>
                                    <div class="row-table-input">
                                        <span class="table-input-name">до</span>
                                        <input name="height_to" id="height_to" type="text" class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table">
                                <label class="filters-input filters-input-name">Вес</label>
                                <div class="filters-input filters-input-value clear-inline-block input-with-caption">
                                    <div class="row-table-input">
                                        <span class="table-input-name">от</span>
                                        <input name="weight_from" id="weight_from" type="text" class="input-field field--mini">
                                    </div>
                                    <div class="row-table-input">
                                        <span class="table-input-name">до</span>
                                        <input name="weight_to" id="weight_to" type="text" class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name">Цвет волос</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input">
                                        <select name="hair" id="hair">
                                            <option value="" selected="selected" title="1">Любой</option>
                                            <?php foreach (\Kinomania\System\Data\Hair::COLOR as $name): ?>
                                                <option value="<?= $name ?>"><?= $name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name">Цвет глаз</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input">
                                        <select name="eyes" id="eyes">
                                            <option value="" selected="selected" title="1">Любой</option>
                                            <?php foreach (\Kinomania\System\Data\Eyes::COLOR as $name): ?>
                                                <option value="<?= $name ?>"><?= $name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Этнический тип</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <!-- <select name="name__value">
                                          <option value="name" selected="selected" title="1">Выберите из списка</option>
                                        </select> -->
                                        <input type="text" name="ethnic" id="ethnic" class="input-field field--mini">
                                    </div>

                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Спорт</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <!-- <select name="name__value">
                                          <option value="name" selected="selected" title="1">Выберите из списка</option>
                                        </select> -->
                                        <input type="text" name="sport" id="sport"  class="input-field field--mini">
                                    </div>

                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Ин. язык</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <input type="text" name="language" id="language"  class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Муз. инструмент</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <input type="text" name="music_instrument" id="music_instrument"  class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Танец</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <input type="text" name="dance" id="dance"  class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                            <div class="row-input row-input-table row-input-select">
                                <label class="filters-input filters-input-name required">Пение</label>
                                <div class="filters-input filters-input-value clear-inline-block">
                                    <div class="row-dropdown-input row-dropdown-input-text">
                                        <input type="text" name="sing" id="sing"  class="input-field field--mini">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="casting-filters-item casting-filters-right casting-filters-items">
                            <label class="filters-input filters-input-name">Кастинг агенства</label>
                            <!--  -->
                            <?php foreach ($list as $item): ?>
                                <div class="row-checkbox row-checkbox-block">
                                    <div class="checkbox">
                                        <input name="company[]" class="company" value="<?= $item[Company::ID] ?>" type="checkbox">
                                        <ins class="checkbox-icon"></ins>
                                    </div>
                                    <div class="checkbox-name"><?= $item[Company::NAME] ?></div>
                                </div>
                            <?php endforeach; ?>
                            <!--  -->
                        </div>
                    </div>
                    <div class="input-table-place">
                        <div class="warning-lable">Поля поддерживают ввод нескольких значений через запятую</div>
                        <button class="button button4" id="search">ИСКАТЬ</button>
                    </div>

                    <div class="scripts-list-item" id="searchResult" style="display: none;">
                        <div class="content-page__titile">
                            <h2>РЕЗУЛЬТАТЫ ПОИСКА</h2>
                        </div>
                        <div class="row-posters row-posters-no-padding posters--hover">
                            <div class="row row-tile-block" id="searchContent">

                            </div>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text" style="display: none;"><span class="pagelist-more__text" id="more">Еще</span></span>
                    </div>

                    <div class="pagelist-social style-pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="casting/search"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fcasting%2Fsearch/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="casting/search"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fcasting%2Fsearch&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fcasting%2Fsearch/"></a></li>
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

  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/core.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/widget.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/mouse.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/sortable.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/position.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/menu.js"></script>
  <script src="<?= $static ?>/vendor/cms/jquery-ui/ui/autocomplete.js"></script>
  <script src="<?= $static ?>/vendor/cms/chosen_v1.2.0/chosen.order.jquery.min.js"></script>

  <script src="<?= $static ?>/vendor/cms/bootstrap-tagsinput/typehead.js"></script>
  <script src="<?= $static ?>/vendor/cms/tokenfield/bootstrap-tokenfield.min.js"></script>

  <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
    <script type="text/javascript">
        function getContent(FILTER, clearContent) {
            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);

            $('.center-loader').show();
            $('.pagelist-more').hide();

            $('.male').removeClass('active');
            $(this).addClass('active');

            if (clearContent) {
                $('#searchContent').html('');
            }

            $("img.lazy").attr('proc', 'true');

            $.ajax({
                "type": "post",
                "url": "?handler=search&male=" + FILTER['male'] + '&female=' + FILTER['female'] + '&photo=' + FILTER['photo'] + '&video=' + FILTER['video'] + '&age_from=' + FILTER['age_from'] + '&age_to=' + FILTER['age_to'] + '&height_from=' + FILTER['height_from'] + '&height_to=' + FILTER['height_to'] + '&weight_from=' + FILTER['weight_from'] + '&weight_to=' + FILTER['weight_to'] + '&hair=' + FILTER['hair'] + '&eyes=' + FILTER['eyes'] + '&ethnic=' + FILTER['ethnic'] + '&sport=' + FILTER['sport'] + '&language=' + FILTER['language'] + '&music_instrument=' + FILTER['music_instrument'] + '&dance=' + FILTER['dance'] + '&sing=' + FILTER['sing'] + '&company=' + FILTER['company'] + '&page=' + FILTER['page'],
                "success": function(data){
                    data = JSON.parse(data);

                    var html = '';
                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            html += '   <div class="posters-item posters-item-tile">  ' +
                                '   	<div class="row-posters__image">  ' +
                                '   		<a href="/people/' + data[key][<?= Person::ID ?>] + '/">  ' +
                                '   			<div class="image-shadow-poster posters__image">  ' +
                                '   				<img alt="" src="//:0" data-original="' + data[key][<?= Person::IMAGE ?>] + '" class="lazy parent responsive-image image-prewiew">  ' +
                                '   			</div>  ' +
                                '   		</a>  ' +
                                '   	</div>  ' +
                                '   	<div class="posters-caption">  ' +
                                '   		<div class="poster-title"><a href="/people/' + data[key][<?= Person::ID ?>] + '/">' + data[key][<?= Person::NAME ?>] + '</a></div>  ' +
                                '   	</div>  ' +
                                '  </div>  ';
                        }
                    }

                    if ('' == html) {
                        $('#searchResult h2').text('Ничего не найдено');
                    }


                    $('#searchContent').append(html);

                    $("img.lazy[proc!=true]").lazyload({
                        effect : "fadeIn"
                    });
                    $("img.lazy").attr('proc', 'true');

                    if (24 > data.length) {
                        $('.pagelist-more').hide();
                    } else {
                        $('.pagelist-more').show();
                    }

                    $('#searchResult').show();

                },
                complete: function() {
                    me.data('requestRunning', false);
                    $('.center-loader').hide();
                },
                error: function () {
                    me.data('requestRunning', false);
                    $('.center-loader').hide();
                }
            });
        }
        $(document).ready(function() {
            var FILTER = {
                'male': 'false',
                'female': 'false',
                'photo': 'false',
                'video': 'false',
                'age_from': '',
                'age_to': '',
                'height_from': '',
                'height_to': '',
                'weight_from': '',
                'weight_to': '',
                'hair': '',
                'eyes': '',
                'ethnic': '',
                'sport': '',
                'language': '',
                'music_instrument': '',
                'dance': '',
                'sing': '',
                'company': [],
                'page': 1
            };


            $('#search').click(function(){
                FILTER['male'] = 'false';
                if ($('#male:checkbox:checked').length) {
                    FILTER['male'] = 'true';
                }
                FILTER['female'] = 'false';
                if ($('#female:checkbox:checked').length) {
                    FILTER['female'] = 'true';
                }
                FILTER['photo'] = 'false';
                if ($('#photo:checkbox:checked').length) {
                    FILTER['photo'] = 'true';
                }
                FILTER['video'] = 'false';
                if ($('#video:checkbox:checked').length) {
                    FILTER['video'] = 'true';
                }
                FILTER['age_from'] = $('#age_from').val();
                FILTER['age_to'] = $('#age_to').val();
                FILTER['height_from'] = $('#height_from').val();
                FILTER['height_to'] = $('#height_to').val();
                FILTER['weight_from'] = $('#weight_from').val();
                FILTER['weight_to'] = $('#weight_to').val();
                FILTER['hair'] = $('#hair').val();
                FILTER['eyes'] = $('#eyes').val();
                FILTER['ethnic'] = $('#ethnic').val();
                FILTER['sport'] = $('#sport').val();
                FILTER['language'] = $('#language').val();
                FILTER['music_instrument'] = $('#music_instrument').val();
                FILTER['dance'] = $('#dance').val();
                FILTER['sing'] = $('#sing').val();
                FILTER['company'] = [];
                $('.company:checkbox:checked').each(function () {
                    FILTER['company'].push($(this).val());
                });
                FILTER['company'] = FILTER['company'].join(',');

                getContent(FILTER, true);

                return false;
            });

            $('#more').click(function(e){
                e = e || window.event;
                e.preventDefault();
                FILTER['page'] += 1;
                getContent(FILTER, false);
                return false;
            });


            /**
             * Autocomplete
             */
            $('#ethnic').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getEthnic",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value) {
                        event.preventDefault();
                    }
                });
            });

            $('#sport').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getSport",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value) {
                        event.preventDefault();
                    }
                });
            });

            $('#language').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getLanguage",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value)
                        event.preventDefault();
                });
            });

            $('#music_instrument').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getMusicInstrument",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value)
                        event.preventDefault();
                });
            });

            $('#dance').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getDance",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value)
                        event.preventDefault();
                });
            });

            $('#sing').tokenfield({
                createTokensOnBlur: true,
                autocomplete: {
                    source: "?handler=getSing",
                    minLength: 1
                }
            }).on('tokenfield:createtoken', function (event) {
                var existingTokens = $(this).tokenfield('getTokens');
                $.each(existingTokens, function (index, token) {
                    if (token.value === event.attrs.value)
                        event.preventDefault();
                });
            });
        });
    </script>
</body>
</html>
