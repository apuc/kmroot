<?php
/**
 * @var array $list
 * @var array $genre
 * @var array $country
 * @var string static
 * @var $options \Kinomania\System\Options\Options
 * @var Kinomania\System\Buttons\Buttons
 */
use Kinomania\System\Pagination\Pagination;
use Kinomania\System\Search\Search;
use Kinomania\System\Body\BodyScript;
use Kinomania\System\MobileDetect\MobileDetect;


?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(isset($_GET['genre'])):?>
		<title><?= $options->get('seo_genre_'.$_GET['genre'].'_title')?></title>
	    <meta name="description" content="<?= $options->get('seo_genre_'.$_GET['genre'].'_description') ?>"/>
	    <meta name="keywords" content="<?= $options->get('seo_genre_'.$_GET['genre'].'_keywords') ?>"/>
	<?php else:?>
		<title>Жанры</title>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
	<?php endif;?>
    <link rel="canonical" href="http://www.kinomania.ru/top/films"/>

    <!-- include section/head.html.php -->
    <link rel="stylesheet" href="<?= $static ?>/app/css/main.css?v=1.0.2">
</head>
<body>
<div class="overlay-ajax-load"  style="position: absolute;z-index: 100; width: 100%; height: 100%">
    <img class="load-ajax"  src="<?= $static ?>/app/img/design/load.gif" style="align-self: center">
</div>
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
                <content class="page-section-content section-content content-outer content-top--padding col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-top-films">

                        <h1 class="pagetitle"><?= (isset($genre[$genreSelected])) ? $genre[$genreSelected] : '' ?></h1>
                        <div class="description">
                            <!--<?= $options->get('seo_top_films_description') ?>-->
                        </div>
                        <div class="row-top">
                            <div class="top-forms">
                                <form action="" class="form-filter">
                                    <div class="row-dropdown-input session-dropdown-input">
                                        <select name="genre" class="genre-filter">
                                            <option value="0" <?= ($genreSelected) ? '' : 'selected="selected'?>">Выберите жанр</option>
                                            <?php foreach ($genre as $code => $name): ?>
                                                <option value="<?= $code ?>" <?= ($genreSelected === $code) ? 'selected="selected"' : '' ?>>
                                                    <?= $name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <form method="get" action="films.html.php">

                                        <select name="country" class="country-filter select-filter" style="max-width: 250px;">
                                            <option value="0" selected="selected">Выберите страну</option>
                                            <?php foreach ($country as $code => $name): ?>
                                                <option value="<?= $code ?>"><?= $name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="years-two" class="years-filter select-filter">
                                            <option value="0" selected="selected">По десятилетиям</option>
                                            <option value="2010">2010-е годы</option>
                                            <option value="2000">2000-е годы</option>
                                            <option value="1990">1990-е годы</option>
                                            <option value="1980">1980-е годы</option>
                                            <option value="1970">1970-е годы</option>
                                            <option value="1960">1960-е годы</option>
                                            <option value="1950">1950-е годы</option>
                                            <option value="1940">1940-е годы</option>
                                            <option value="1930">1930-е годы</option>
                                            <option value="1920">1920-е годы</option>
                                            <option value="1910">1910-е годы</option>
                                            <option value="1900">1900-е годы</option>
                                        </select>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="row-table-top">
                            <div class="session-table">
                                <?php
                                /*$buttons->page;// page No. 5 button
                                $count = 0;
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $p = new $pagination([
                                    'itemsCount' => count($list),
                                    'itemsPerPage' => 5,
                                    'currentPage' => $page
                                ]);
                               
                                $pc = intval(round(intval(count($list)/$num))); //количество страниц
                                $num_films = intval(count($list));
                                $start = $page * $num - $num;
                                if(isset($_GET['page'])){$count = $start; $page = intval($_GET['page']);}
                                $fs = array_intersect_key($list,array_fill_keys(range($start,$start + 20 -1),''));*/
                                ?>
                                

		                            <?php
                                    $i = 0;
									$pages = new Pagination($count, 1, [
									]);
	                                ?>
                                <?php foreach ($list as $item): ?>
                                <?php $i++ ?>
                                    <div class="session-table-item table-top-item clear">
                                        <div class="table-top-info-one">
                                            <div class="table-number"><?= $i ?></div>
	                                            <div class="session-table-item__name">
	                                                <?php if ('' == $item['name_ru']): ?>
	                                                    <div class="table-top-title"><a href="/film/
							                                <?= $item['id'] ?>/"><?= $item['name_origin'] ?></a>
	                                                    </div>
	                                                <?php else: ?>
		                                                <div class="table-top-title">
			                                                <a href="/film/<?= $item['id'] ?>/">
				                                                <?= $item['name_ru'] ?></a>
		                                                </div>
		                                                <div class="table-top-title-eng">
							                                <?= $item['name_origin'] ?>
		                                                </div>
	                                                <?php endif; ?>
	                                            </div>
                                            </div>
                                        <div class="table-top-info">
                                            <div class="row-button-list">
                                        </div>
		                                <span class="table-top-info-text table-top-info-raiting">
		                                <?= $item['rate'] ?></span>
                                            <div class="table-top-info-text table-top-info-views open-help-in"><?= $item['rate_count'] ?>
                                                <div class="help help--gray">Количество оценок</div>
                                            </div>
                                            <div class="main-folder-icon">
                                                <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                                                    <a class="folder__icon icon"></a>
                                                    <div class="hint">Добавить в Избранное</div>
                                                    <div class="row-dropdown-folder">
                                                        <div class="dropdown-folder dropdown-folder-content">
                                                            <div class="dropdown-folder-title"><span>В избранное</span></div>
                                                            <ul class="dropdown-folder-list" data-id="<?= $item['id'] ?>"></ul>
                                                        </div>
                                                        <div class="dropdown-folder dropdown-folder-setting">
                                                            <a href="#" class="clear">
                                                                 <i class="setting-icon"></i>
                                                                <span>Управление папками</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php $pages->printPag(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="seo-text">

                            <?= $options->get('seo_genre_'.$genreSelected.'_text')?>

                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="top/films/"><a
                                            href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F"><span
                                                class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="top/films/"><a
                                            href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F&src=sp/"><span
                                                class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a
                                            href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F"></a>
                                </li>
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
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?= $static ?>/app/js/filter.js"></script>
<script type="text/javascript">
    function getContent(filter, clearContent) {
        var me = $(this);
        if (me.data('requestRunning')) {
            return;
        }
        me.data('requestRunning', true);

        $('.center-loader').show();
        $('.pagelist-more').hide();

        if (clearContent) {
            $('.session-table').html('');
        }

        $("img.lazy").attr('proc', 'true');

        $.ajax({
            "type": "post",
            "url": "?handler=search",
            dataType: "json",
            data: 'filter=' + JSON.stringify(filter),
            "success": function (data) {
                var html = '';
                for (var key in data) {
                    if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                        html += '   <div class="session-table-item table-top-item clear">  ' +
                            '   	<div class="table-top-info-one">  ' +
                            '   		<div class="table-number">' + (1 * key + 1) + '</div>  ' +
                            '   		<div class="session-table-item__name">  ';
                        if ('' == data[key]['name_ru']) {
                            html += '<div class="table-top-title"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_origin'] + '</a></div>  ';
                        } else {
                            html += '<div class="table-top-title"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_ru'] + '</a></div>  ';
                            html += '<div class="table-top-title-eng">' + data[key]['name_origin'] + '</div> ';
                        }
                        html += '   		</div>  ' +
                            '   	</div>  ' +
                            '   	<div class="table-top-info">  ' +
                            '   		<div class="row-button-list">  ' +
                            '     ' +
                            '   		</div>  ' +
                            '   		<span class="table-top-info-text table-top-info-raiting">' + data[key]['rate'] + '</span>  ' +
                            '   		<div class="table-top-info-text table-top-info-views open-help-in">' + data[key]['rate_count'] + '  ' +
                            '   			<div class="help help--gray">Количество оценок</div>  ' +
                            '   		</div>  ' +
                            '   		<div class="main-folder-icon">  ' +
                            '   			<div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">  ' +
                            '   				<a class="folder__icon icon"></a>  ' +
                            '   				<div class="hint">Добавить в Избранное</div>  ' +
                            '   				<div class="row-dropdown-folder">  ' +
                            '   					<div class="dropdown-folder dropdown-folder-content">  ' +
                            '   						<div class="dropdown-folder-title"><span>В избранное</span></div>  ' +
                            '   						<ul class="dropdown-folder-list" data-id="' + data[key]['id'] + '">  ' +
                            '     ' +
                            '   						</ul>  ' +
                            '   					</div>  ' +
                            '   					<div class="dropdown-folder dropdown-folder-setting">  ' +
                            '   						<a href="#" class="clear">  ' +
                            '   							<!-- <i class="setting-icon"></i> -->  ' +
                            '   							<span>Управление папками</span>  ' +
                            '   						</a>  ' +
                            '   					</div>  ' +
                            '   				</div>  ' +
                            '   			</div>  ' +
                            '   		</div>  ' +
                            '   	</div>  ' +
                            '  </div>  ';
                    }
                }

                $('.session-table').append(html);

                $("img.lazy[proc!=true]").lazyload({
                    effect: "fadeIn"
                });
                $("img.lazy").attr('proc', 'true');
            },
            complete: function () {
                me.data('requestRunning', false);
                $('.center-loader').hide();
            },
            error: function () {
                me.data('requestRunning', false);
                $('.center-loader').hide();
            },
            timeout: 30000
        });
    }
    $(document).ready(function () {
        $("img.lazy").lazyload({
            effect: "fadeIn"
        });

        var filterTimer;
        var doneFilterInterval = 500;
        var FILTER = {
            'genre': '',
            'country': '',
            'year': ''
        };
        $('#genre').change(function () {
            FILTER.genre = $(this).val();

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function () {
                getContent(FILTER, true, true);
            }, doneFilterInterval);
        });
        $('#country').change(function () {
            FILTER.country = $(this).val();

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function () {
                getContent(FILTER, true, true);
            }, doneFilterInterval);
        });
        $('#year').change(function () {
            FILTER.year = $(this).val();

            clearTimeout(filterTimer);
            filterTimer = setTimeout(function () {
                getContent(FILTER, true);
            }, doneFilterInterval);
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

        $('.page-content-head__more a').click(function () {
            $('.read-more-text').addClass('read-more-text_open');
            $(this).hide();
            return false;
        });


        $(document).on('click', '.folder__icon', function () {
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
        $(document).on('click', '.addCollection', function () {
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
        $(document).mouseup(function (e) {
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
        $('.my-overlay-bg').click(function (event) {
            $('.my-overlay').removeClass('active');
            $('.my-overlay .my-overlay-item').removeClass('active');
        });
    });
</script>
<?php BodyScript::getContent();?>
</body>
</html>
