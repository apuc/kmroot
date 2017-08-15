<?php
/**
 * @var int $id
 * @var string $static
 * @var array $item
 * @var array $team
 * @var array $news
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Film\TV as TV;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $item[Film::TITLE] ?> | KINOMANIA.RU</title>
    <meta name="description" content="Самая свежая и полная информация о <?php if ('' == $item[Film::TYPE]): ?>фильме<?php else: ?>сериале<?php endif ?> <?= $item[Film::TITLE] ?>: Истории на сайте KINOMANIA.RU. Обзоры новых фильмов, трейлеры, биографии актёров, обои на рабочий стол и многое другое из мира кино." />
    <meta name="keywords" content="<?= $item[Film::NAME_RU] ?> <?= $item[Film::NAME_ORIGIN] ?> <?php if ('' == $item[Film::TYPE]): ?>фильм<?php else: ?>сериал<?php endif ?> смотреть онлайн трейлер актеры" />

    <link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>"/>


    <meta property="og:title" content="<?= $item[Film::TITLE] ?> : всё о <?php if ('' == $item[Film::TYPE]): ?>фильме<?php else: ?>сериале<?php endif ?> | Обои, трейлеры, фотографии, фильмография, биография, факты, новости" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="<?= $item[Film::IMAGE_ORG] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>" />
    <meta property="og:description" content="<?= $item[Film::TITLE] ?> : cамая свежая и полная информация о <?php if ('' == $item[Film::TYPE]): ?>фильме<?php else: ?>сериале<?php endif ?>"/>

    <?php
/**
 * @var string $static
 */
?>
    <?php if (empty($static)): ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
    <meta name="geo_locale" content="RU">
    <link rel="shortcut icon" href="<?= $static ?>/favicon.ico" type="image/png"/>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<?php if (!empty($static)): ?>
    <link rel="stylesheet" href="<?= $static ?>/app/css/min.css?v=1.0.3">
<?php else: ?>
    <link rel="stylesheet" href="<?= $static ?>/app/libs/bootstrap/css/bootstrap.css?v=1.0.1"/>
    <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/bx/jquery.bxslider.css?v=1.0.1" />
    <link rel="stylesheet" href="<?= $static ?>/app/css/primary.css?v=1.0.1">
    <link rel="stylesheet" href="<?= $static ?>/app/css/main.css?v=1.0.2">
    <link rel="stylesheet" href="<?= $static ?>/app/css/fix.css?v=1.0.2">
<?php endif ?>

    <script src="<?= $static ?>/app/js/jquery/jquery-1.11.3.min.js?v=1.0.1"></script>

    <!--#include virtual="/design/ssi/include" -->
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
    <div class="my-overlay-item overlay-auth-item" data-type="overlay-auth">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay">
            <div class="inner-my-overlay">
                <div class="war-title overlay-content-outside">НЕОБХОДИМА АВТОРИЗАЦИЯ</div>
                <div class="war-content">
                    <?php
/**
 * @var string $static
 */
?>
<style>
    .war-content label:after {
        content: '' !important;
    }
</style>
<div class="outer-form login">
    <div class="form-content">
        <div id="response"></div>
        <form method="post" id="loginForm">
            <ul>
                <li>
                    <label for="login">Логин:</label>
                    <input type="text" name="login" id="login" placeholder="" value="">
                </li>
                <li>
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password">
                </li>
            </ul>
            <button class="button button4">войти</button>
            <div class="row-forgot-password"><a href="/restore/" class="forgot-password">Забыли пароль?</a></div>
            <input type="hidden" name="handler" value="login" />
        </form>
        <div class="reg">Еще нет аккаунта? <a href="/registration_/">Пожалуйста, зарегистрируйтесь</a></div>
    </div>
    <div class="form-add">
        <div class="form-social-text">Или войдите через акканут социальных сетей:</div>
        <div class="form-social">
            <ul>
                <li class="form-social-icon"><a href="http://oauth.vk.com/authorize?client_id=2142664&scope=notify&redirect_uri=http://kinomania.ru/social_login/vkontakte&response_type=code" class="vk"></a></li>
                <li class="form-social-icon"><a href="https://www.facebook.com/dialog/oauth?client_id=164790803722093&redirect_uri=http://kinomania.ru/social_login/facebook&response_type=code&scope=email" class="fb"></a></li>
                <!-- <li class="form-social-icon"><a href="#" class="ok"></a></li> -->
                <!-- <li class="form-social-icon"><a href="#" class="tw"></a></li> -->
                <!-- <li class="form-social-icon"><a href="#" class="gplus"></a></li> -->
            </ul>
        </div>
    </div>
</div>
<script src="<?= $static ?>/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery.validator.addMethod(
            'regexp',
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );
        $("#loginForm").validate({
            rules: {
                login: {
                    required: true,
                    minlength: 2,
                    maxlength: 64,
                    regexp: /^[A-Za-z0-9_-]+$/u,
                    remote: '/login?handler=checkLogin'
                },
                password: {
                    required: true,
                    minlength: 4
                }
            },
            messages: {
                login: {
                    required: "Введите логин",
                    minlength: "Не менее 2 символов",
                    maxlength: "Не более 64 символов",
                    regexp: 'Недопустимые символы',
                    remote: 'Такой логин не зарегистрирован'
                },
                password: {
                    required: "Введите пароль",
                    minlength: "Слишком короткий пароль"
                }
            },
            submitHandler: function() {
                $('#response').html('');
                var postData = $('#loginForm').serializeArray();
                $.ajax({
                    url: '/login?handler=login',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (data) {
                        if ('' == data.error) {
                            document.location.reload();
                        } else {
                            var message = '';
                            switch (data.error) {
                                case 'NOT_ACTIVE':
                                    message = 'Аккаунт не активирован <br /><br /> Проверьте папку "Спам" и убедитесь, что письмо не попало туда. <br /> Если вы не получили письмо, обратитесь за помощью по адресу support@kinomania.ru';
                                    break;
                                case 'BANNED':
                                    message = 'Ваш аккаунт заблокирован';
                                    break;
                                default:
                                    message = 'Неправильный логин или пароль';
                            }
                            $('#response').html('<div id="error" class="form-error-text">' + message + '</div>');
                            $('#password').val('');
                        }
                    },
                    error: function () {
                        $('#response').html('<div id="error" class="form-error-text">Ошибка при авторизации, попробуйте позже</div>');
                        $('#password').val('');
                    }
                });
                return false;
            }
        });
    });
</script>
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
                        <?php if ('' == $item[Film::NAME_RU]): ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_ORIGIN] ?></h1>
                        <?php else: ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_RU] ?></h1>
                            <h2 class="name__page"><?= $item[Film::NAME_ORIGIN] ?></h2>
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
                                fd.append("type", 'film');
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
                        <?php if ('' == $item[Film::NAME_RU]): ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_ORIGIN] ?></h1>
                        <?php else: ?>
                            <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_RU] ?></h1>
                            <h2 class="name__page"><?= $item[Film::NAME_ORIGIN] ?></h2>
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
                                fd.append("type", 'film');
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
        <?php
/**
 * @var string $static
 * @var string $q
 */
?>
<div class="outer-header">
    <header class="clear">
        <div class="top clear">
            <div class="outer-logo col-xl-3 col-lg-3 col-md-4 col-sm-5 col-xs-8">
                <div class="logo">
                    <a href="/" class="logo__link">
                        <img  src="<?= $static ?>/app/img/design/logo2.png" class="logo__image" alt="Киномания">
                        <span class="slogan">Это мы еще посмотрим!</span>
                    </a>
                </div>
            </div>
            <div class=" search-outer col-xl-6 col-lg-6 col-md-6 col-sm-7 col-xs-5">
                <div class="search">
                    <form method="get" action="/search" id="search_form">
                        <div class="row-search__input">
                            <input name="q" type="text" class="search__input" value="<?= $q ?? ''; ?>" autocomplete="off" placeholder="Поиск">
                            <div class="row-search-result">
                                <div class="search-input-result-content">
                                    <div class="search-loader">
                                        <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                    </div>
                                </div>
                                <div class="search-result_data">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="search__button-outer">
                            <a href="#" class="search__button button button1">Найти</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mobile-nav col-md-1 col-sm-7 col-xs-4">
                <span class="mobile-nav-button"></span>
                <div class="outer-mobile-nav default">
                    <div class="close">
                        <span href="#" class="mobile-nav-button__close">Закрыть</span>
                        <ul class="mobile-nav-list clear">
                            <li><a href="/billboard/">СМОТРЕТЬ</a>
                                <ul class="nav-list-dop">
                                    <!-- <li><a href="/billboard/">АФИША</a></li> -->
                                    <li><a href="/tv/">ТВ</a></li>
                                    <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                                    <li><a href="/article/shorts/">SHORTЫ</a></li>
                                </ul>
                            </li>
                            <li><a href="/news/">ЧИТАТЬ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/news/">НОВОСТИ</a></li>
                                    <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                                    <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                                    <!-- <li><a href="/blog/">БЛОГИ</a></li> -->
                                    <li><a href="/article/press_review/">ПРЕССА</a></li>
                                    <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                                    <!-- <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li> -->
                                    <li><a href="/article/inside/">ИНСАЙД</a></li>
                                    <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                                </ul>
                            </li>
                            <li><a href="/art/">АРТКИНОМАНИЯ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                                    <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                                    <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                                </ul>
                            </li>
                            <li><a href="/trailers/">МЕДИА</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                                    <li><a href="/posters/">ПОСТЕРЫ</a></li>
                                    <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                                    <li><a href="/photos/">ФОТО</a></li>
                                    <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                                    <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                                    <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                                </ul>
                            </li>
                            <li><a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                                <ul class="nav-list-dop">
                                    <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                                    <li><a href="/top/">ПОДБОРКИ</a></li>
                                    <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="autorization-outer col-xl-3 col-lg-3 col-md-7 col-sm-12 col-xs-12">
                <div class="autorization">
                    <ul class="autorization-list authorizationContent">
                        <li><a href="/login/"><span>ВХОД</span></a></li>
                        <li><a href="/registration_/"><span>РЕГИСТРАЦИЯ</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="nav col-xl-12 clear">
            <ul class="nav-list clear">
                <li><a href="/billboard/">СМОТРЕТЬ</a>
                    <ul class="nav-list-dop">
                        <!-- <li><a href="/billboard/">АФИША</a></li> -->
                        <li><a href="/tv/">ТВ</a></li>
                        <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                        <li><a href="/article/shorts/">SHORTЫ</a></li>
                    </ul>
                </li>
                <li><a href="/news/">ЧИТАТЬ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/news/">НОВОСТИ</a></li>
                        <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                        <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                        <!-- <li><a href="/blog/">БЛОГИ</a></li> -->
                        <li><a href="/article/press_review/">ПРЕССА</a></li>
                        <li><a href="/article/anticipation/">ОЖИДАНИЯ</a></li>
                        <!-- <li><a href="/article/in_ten/">В ДЕСЯТКУ</a></li> -->
                        <li><a href="/article/inside/">ИНСАЙД</a></li>
                        <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                    </ul>
                </li>
                <li><a href="/art/">АРТКИНОМАНИЯ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                        <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                    </ul>
                </li>
                <li><a href="/trailers/">МЕДИА</a>
                    <ul class="nav-list-dop">
                        <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                        <li><a href="/posters/">ПОСТЕРЫ</a></li>
                        <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                        <li><a href="/photos/">ФОТО</a></li>
                        <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                        <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                        <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                    </ul>
                </li>
                <li><a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                    <ul class="nav-list-dop">
                        <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                        <li><a href="/top/">ПОДБОРКИ</a></li>
                        <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                    </ul>
                </li>
            </ul>
            <div class="tablet-autorization-outer col-xl-3 col-lg-3 col-md-7 col-sm-7 col-xs-5">
                <div class="autorization">
                    <ul class="autorization-list authorizationContent">
                        <li><a href="/login/">ВХОД</a></li>
                        <li><a href="/registration_/">РЕГИСТРАЦИЯ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <div class="head-content">
                <div class="info-user">
                    <?php if ('' == $item[Film::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_ORIGIN] ?></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Film::NAME_RU] ?></h1>
                        <h2 class="name__page"><?= $item[Film::NAME_ORIGIN] ?></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <?php
/**
 * @var \Dspbee\Core\Request $request
 * @var int $id
 * @var array $stat
 */
use Kinomania\Original\Key\Film\Stat as Stat;
?>
<ul class="nav-content-list nav-content-list-films clear" id="filmMenu">
    <div class="mobile__select my-select">
        <span class="result"></span>
        <ul class="result-list">
            <li class="nav-content-item <?php if ('film/' . $id == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/">О фильме</a></li>
            <li class="nav-content-item <?php if ('film/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/reviews#filmMenu">Рецензии<span class="number"></span></a></li>
            <li class="nav-content-item <?php if ('film/' . $id . '/people' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/people#filmMenu">Актеры и создатели<span class="number"></span></a></li>

            <?php if (0 < $stat[Stat::FRAME]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/frames#filmMenu">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::WALLPAPER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/wallpapers#filmMenu">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::TRAILER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/trailers#filmMenu">Трейлеры <span class="number"><?= $stat[Stat::TRAILER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::SOUNDTRACK]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/soundtracks' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/soundtracks#filmMenu">Саундтреки <span class="number"><?= $stat[Stat::SOUNDTRACK] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::POSTER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/posters' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/posters#filmMenu">Постеры <span class="number"><?= $stat[Stat::POSTER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::AWARD]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/awards#filmMenu">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>

    <li class="nav-content-item <?php if ('film/' . $id == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/">О фильме</a></li>
    <li class="nav-content-item <?php if ('film/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/reviews#filmMenu">Рецензии<span class="number"></span></a></li>
    <li class="nav-content-item <?php if ('film/' . $id . '/people' == $request->route() || 'film/' . $id . '/people/creators' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/people#filmMenu">Актеры и создатели<span class="number"></span></a></li>

    <?php if (0 == $stat[Stat::FRAME]): ?>
        <li class="nav-content-item no-active"><span>Кадры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/frames#filmMenu">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::WALLPAPER]): ?>
        <li class="nav-content-item no-active"><span>Обои</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/wallpapers#filmMenu">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::TRAILER]): ?>
        <li class="nav-content-item no-active"><span>Трейлеры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/trailers#filmMenu">Трейлеры <span class="number"><?= $stat[Stat::TRAILER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::SOUNDTRACK]): ?>
        <li class="nav-content-item no-active"><span>Саундтреки</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/soundtracks' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/soundtracks#filmMenu">Саундтреки <span class="number"><?= $stat[Stat::SOUNDTRACK] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::POSTER]): ?>
        <li class="nav-content-item no-active"><span>Постеры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/posters' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/posters#filmMenu">Постеры <span class="number"><?= $stat[Stat::POSTER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::AWARD]): ?>
        <li class="nav-content-item no-active"><span>Награды</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/awards#filmMenu">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
    <?php endif ?>
</ul>
                </div>
                <div class="caption-page caption-page-actor clear">
                    <div class="caption-page-item caption-page-image">
                        <div class="outer-caption-page-image image-shadow">
                            <?php if ('' == $item[Film::IMAGE_ORG]): ?>
                                <img alt="" src="<?= $item[Film::IMAGE_MIN] ?>" class="responsive-image image-cover" style="cursor: default;">
                            <?php else: ?>
                                <a href="<?= $item[Film::IMAGE_ORG] ?>" class="image-cover-parent">
                                    <?php if ('' == $item[Film::NAME_RU]): ?>
                                        <img alt="<?= $item[Film::NAME_ORIGIN] ?>" src="<?= $item[Film::IMAGE_MIN] ?>" class="responsive-image image-cover">
                                    <?php else: ?>
                                        <img alt="<?= $item[Film::NAME_RU] ?>" src="<?= $item[Film::IMAGE_MIN] ?>" class="responsive-image image-cover">
                                    <?php endif ?>
                                    <i class="image-hover"><span>Увеличить</span></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="caption-page-item caption-page-info">
                        <div class="info-item">
                            <div class="outer-info-item-list">
                                <ul class="info-item-list">
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Страна:</li>
                                            <?php foreach ($item[Film::COUNTRY] as $code): ?>
                                                <li><?= \Kinomania\System\Data\Country::RU[$code] ?? '' ?></li>
                                            <?php endforeach; ?>
                                        </ul></li>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Год:</li>
                                            <li><a href="/list/year/<?= $item[Film::YEAR] ?>/"><?= $item[Film::YEAR] ?></a></li>
                                        </ul></li>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Жанр:</li>
                                            <?php foreach ($item[Film::GENRE] as $code): ?>
                                                <li><?= \Kinomania\System\Data\Genre::RU[$code] ?? '' ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <?php if (!empty($item[Film::RUNTIME])): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Продолжительность:</li>
                                            <li><?= $item[Film::RUNTIME] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                </ul>
                            </div>

                            <?php if ($item[Film::IS_BLOCK_2]): ?>
                            <div class="outer-info-item-list">
                                <ul class="info-item-list">
                                    <?php if (!empty($item[Film::PREMIERE_WORLD])): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Премьера (МИР):</li>
                                            <li><?= $item[Film::PREMIERE_WORLD] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>

                                    <?php if (!empty($item[Film::PREMIERE_RU])): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Премьера (РФ):</li>
                                            <li><?= $item[Film::PREMIERE_RU] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>

                                    <?php if (!empty($item[Film::PREMIERE_USA])): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Премьера (США):</li>
                                            <li><?= $item[Film::PREMIERE_USA] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>

                                    <?php foreach ($item[Film::COMPANY] as $company): ?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name"><?= $company[0] ?>:</li>
                                            <li><a href="/company/<?= $company[1] ?>/"><?= $company[2] ?></a></li>
                                        </ul>
                                    </li>
                                    <?php endforeach ?>

                                    <?php if (!empty($item[Film::LIMIT_US])) :?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Рейтинг MPAA:</li>
                                            <li><?= $item[Film::LIMIT_US] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>

                                    <?php if (!empty($item[Film::LIMIT_RU])) :?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Возраст:</li>
                                            <li><?= $item[Film::LIMIT_RU] ?>+</li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                            <?php endif ?>

                            <?php if ($item[Film::IS_BLOCK_3]): ?>
                            <div class="outer-info-item-list">
                                <ul class="info-item-list">
                                    <?php if (!empty($item[Film::BUDGET])) :?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">Бюджет:</li>
                                                <li>$<?= $item[Film::BUDGET] ?></li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($item[Film::GROSS_WORLD])) :?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Сборы (МИР):</li>
                                            <li>$<?= $item[Film::GROSS_WORLD] ?></li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                    <?php if (!empty($item[Film::GROSS_RU])) :?>
                                    <li>
                                        <ul class="value">
                                            <li class="value__name">Сборы (РФ):</li>
                                            <li><?= $item[Film::GROSS_RU] ?> руб.</li>
                                        </ul>
                                    </li>
                                    <?php endif ?>
                                    <?php if (!empty($item[Film::GROSS_USA])) :?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">Сборы (США):</li>
                                                <li>$<?= $item[Film::GROSS_USA] ?></li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                            <?php endif ?>

                            <?php if ($item[Film::IS_BLOCK_4]): ?>
                            <div class="outer-info-item-list">
                                <ul class="info-item-list">
                                    <?php if (!empty($item[Film::SEASON_COUNT])) :?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">Количество сезонов:</li>
                                                <li><?= $item[Film::SEASON_COUNT] ?></li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($item[Film::SERIES_COUNT])) :?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">Количество серий:</li>
                                                <li><?= $item[Film::SERIES_COUNT] ?></li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($item[Film::YEAR_FINISH])) :?>
                                        <li>
                                            <ul class="value">
                                                <li class="value__name">На экранах:</li>
                                                <li>
                                                    с <?= $item[Film::YEAR] ?>
                                                    по <?= $item[Film::YEAR_FINISH] ?>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="caption-page-item caption-page-dop">
                        <?php if (count($team['crew'])): ?>
                            <div class="caption-page-item-inner">
                                <a href="/film/<?= $id ?>/people/creators/">
                                    <div class="page-title--big">CОЗДАТЕЛИ</div>
                                </a>
                                <ul class="info-item-list">
                                    <?php foreach ($team['crew'] as $profession => $crew): ?>
                                        <?php if (count($crew)): ?>
                                            <li>
                                                <ul class="value">
                                                    <li class="value__name"><?= $profession ?>:</li>
                                                    <?php foreach ($crew as $person): ?>
                                                        <?php if (0 == $person[0]): ?>
                                                            <li><a href="/film/<?= $id ?>/people/creators/">...</a></li>
                                                        <?php else: ?>
                                                            <li><a href="/people/<?= $person[0] ?>/"><?= $person[1] ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>
                        <?php if (count($team['cast'])): ?>
                            <div class="caption-page-item-inner">
                                <a href="/film/<?= $id ?>/people">
                                    <div class="page-title--big">АКТЕРЫ</div>
                                </a>
                                <div class="row-tile-preview clear">
                                    <?php foreach ($team['cast'] as $actor): ?>
                                        <div class="tile-preview-item clear">
                                            <a href="/people/<?= $actor[0] ?>/" class="tile-preview-item__image-link">
                                                <img src="<?= $actor[1] ?>" width="34" height="45" alt="" class="tile-preview-item__image">
                                            </a>
                                            <div class="tile-preview-item__text">
                                                <a href="/people/<?= $actor[0] ?>/"><?= $actor[2] ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <!-- NEW Посмотреть фильм<br>с этим актером -->
                </div>
                <div class="band-nav">
                    <ul class="band-nav-list clear">
                        <li class="band-nav__icon my-films">
                            <a class="folder-icon-two collectFilm"><span>Мои фильмы</span></a>
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
                    <div class="row-raiting clear">
                        <div class="row-raiting-item row-raiting--left">
                            <ul class="raiting-item-list clear" data-type="kinomania">
                                <li class="raiting__value" id="average">
                                    <?php if (10 > $item[Film::RATE_COUNT]): ?>
                                        _
                                    <?php else: ?>
                                        <?= $item[Film::RATE] ?>
                                        <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                            <meta itemprop="bestRating" content="10">
                                            <meta itemprop="ratingValue" content="<?= $item[Film::RATE] ?>">
                                            <meta itemprop="ratingCount" content="<?= $item[Film::RATE_COUNT] ?>">
                                        </div>
                                    <?php endif ?>
                                </li>
                                <li>
                                    <ul>
                                        <li class="raiting__name">Рейтинг «Киномании»</li>
                                        <li class="raiting__number">Оценок: <span class="number">
                                                <?php if (0 == $item[Film::RATE_COUNT]): ?>
                                                    _
                                                <?php else: ?>
                                                    <?= $item[Film::RATE_COUNT] ?>
                                                <?php endif ?>
                                            </span></li>
                                    </ul>
                                </li>
                            </ul>


                            <ul class="raiting-item-list clear" data-type="other">
                                <li class="raiting__value" id="imdb">
                                    <?php if (10 > $item[Film::IMDB_COUNT]): ?>
                                        _
                                    <?php else: ?>
                                        <?= $item[Film::IMDB] ?>
                                    <?php endif ?>
                                </li>
                                <li>
                                    <ul>
                                        <li class="raiting__name">Рейтинг IMDb</li>
                                        <li class="raiting__number">Оценок: <span class="number" id="imdb_count">
                                                <?php if (0 == $item[Film::IMDB_COUNT]): ?>
                                                    _
                                                <?php else: ?>
                                                    <?= $item[Film::IMDB_COUNT] ?>
                                                <?php endif ?>
                                            </span></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="raiting-item-list clear" data-type="other">
                                <li class="raiting__value" id="kp">
                                    <?php if (10 > $item[Film::KP_COUNT]): ?>
                                        _
                                    <?php else: ?>
                                        <?= $item[Film::KP] ?>
                                    <?php endif ?>
                                </li>
                                <li>
                                    <ul>
                                        <li class="raiting__name">Рейтинг «КиноПоиска»</li>
                                        <li class="raiting__number">Оценок: <span class="number" id="kp_count">
                                                <?php if (0 == $item[Film::KP_COUNT]): ?>
                                                    _
                                                <?php else: ?>
                                                    <?= $item[Film::KP_COUNT] ?>
                                                <?php endif ?>
                                            </span></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <div class="row-raiting-item row-raiting--right icon-star" data-id="<?= $id ?>">
                            <div class="row-raiting-star">
                                <div class="raiting__name">Поставьте свою оценку </div>
                            </div>
                            <div class="row-raiting-star">
                                <div class="inner-raiting-star" data-fixed="fixed">
                                    <span class="raiting-star__title">Ваш рейтинг</span>
                                    <ul class="raiting-list-star clear rateList">
                                    </ul>
                                    <span class="raiting-number">

                                    </span>
                                    <span class="result-star"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-session">
                        <div class="row-session">
                            <div class="row-tabs">
                                <ul class="tabs-list clear">
                                    <li class="tabs-list-name"><span>СМОТРЕТЬ</span></li>
                                    <li class="" data-type-sliderGroup="smotr" data-type-sliderButton="1"><a><span>В КИНО</span></a></li>
                                    <li class="" data-type-sliderGroup="smotr" data-type-sliderButton="2"><a><span>ОНЛАЙН</span></a></li>
                                    <li class="active" data-type-sliderGroup="smotr" data-type-sliderButton="3"><a><span>НА ТВ</span></a></li>
                                </ul>
                            </div>
                            <div class="mobile__select my-select">
                                <span class="result">В КИНО</span>
                                <ul class="result-list">
                                    <li class="active" data-type-sliderGroup="smotr" data-type-sliderButton="1"><a><span>В КИНО</span></a></li>
                                    <li class="" data-type-sliderGroup="smotr" data-type-sliderButton="2"><a><span>ОНЛАЙН</span></a></li>
                                    <li class="" data-type-sliderGroup="smotr" data-type-sliderButton="3"><a><span>НА ТВ</span></a></li>
                                </ul>
                            </div>
                            <div class="row-session-table" data-type-sliderGroup="smotr" data-type-sliderElem="1">
                                <p style="text-align: center;">Данные отсутсвуют</p>
                            </div>
                            <div class="row-session-table" data-type-sliderGroup="smotr" data-type-sliderElem="2">
                                <p style="text-align: center;">Данные отсутсвуют</p>
                            </div>
                            <div class="row-session-table active" id="tv_program" data-type-sliderGroup="smotr" data-type-sliderElem="3">
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $.ajax({
                                            url: '?handler=getTv',
                                            type: "POST",
                                            data: 'filmId=<?= $id ?>',
                                            dataType: "json",
                                            success: function (data) {
                                                var html = '<br /><p style="text-align: center;">Данные отсутсвуют</p>';

                                                if (data.length) {
                                                    html = '<div class="tab-table-outer">' +
                                                        '<div class="tab-table-head clear">' +
                                                        '<div class="tab-table-col">Канал</div>' +
                                                        '<div class="tab-table-col">Дата</div>' +
                                                        '<div class="tab-table-col">Время</div>' +
                                                        '</div>';
                                                    for (var key in data) {
                                                        if (data.hasOwnProperty(key)) {
                                                            html += '<div class="tab-table-row clear">' +
                                                                '<div class="tab-table-col tab-table-col-name"><a href="/tv/">' + data[key][<?= TV::CHANEL ?>] + '</a></div>' +
                                                                '<div class="tab-table-col">' + data[key][<?= TV::DATE ?>] + '</div>' +
                                                                '<div class="tab-table-col">' + data[key][<?= TV::TIME ?>] + '</div>' +
                                                                '</div>';
                                                        }
                                                    }
                                                    html += '</div>';
                                                }

                                                $('#tv_program').html(html);
                                                $('#tv_program').addClass('row-session-tab-table row-session-logo-table');
                                            },
                                            complete: function () {
                                            },
                                            error: function () {
                                            },
                                            timeout: 5000
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="row-list-post-item">
                            <?php if ('' !=   $item[Film::PREVIEW]): ?>
                                <div class="list-post-item">
                                    <div class="list-post-item-title">
                                        О ФИЛЬМЕ
                                    </div>
                                    <div class="list-post-item-content">
                                        <div class="<?php if ($item[Film::PREVIEW_MORE]): ?>read-more-text<?php endif ?>">
                                            <?= $item[Film::PREVIEW] ?>
                                            <br />
                                            <br />
                                        </div>
                                        <?php if ($item[Film::PREVIEW_MORE]): ?>
                                            <div class="outer-pagelist-more page-content-head__more" style="text-align:center;">
                                                <a href="#" class="animated read-more-trigger" style="font-weight: normal;border: 0;">
                                                    <span class="pagelist-more sprite-before"><span class="pagelist-more__text">Еще</span></span>
                                                </a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ('' !=   $item[Film::FACT]): ?>
                                <br />
                                <br />
                                <style>
                                    .list-post-item-facts p {
                                        padding-bottom: 10px !important;
                                    }
                                </style>
                                <div class="list-post-item list-post-item-facts">
                                    <div class="list-post-item-title">
                                        ИНТЕРЕСНЫЕ ФАКТЫ О ФИЛЬМЕ
                                        <?php if ('' == $item[Film::NAME_RU]): ?>
                                            «<?= $item[Film::NAME_ORIGIN] ?>»
                                        <?php else: ?>
                                            «<?= $item[Film::NAME_RU] ?>»
                                        <?php endif ?>
                                    </div>
                                    <div class="list-post-item-content">
                                        <div class="<?php if ($item[Film::FACT_MORE]): ?>read-more-text<?php endif ?>">
                                            <?= $item[Film::FACT] ?>
                                            <br />
                                            <br />
                                        </div>
                                        <?php if ($item[Film::FACT_MORE]): ?>
                                            <div class="page-content-head__more">
                                                <a href="#" class="list-about-item__button animated read-more-trigger">Читать полностью</a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php if (0 < $stat[\Kinomania\Original\Key\Film\Stat::TRAILER]): ?>
                        <div class="row-black">
                            <div class="inner-black section-video">
                                <div class="inner-header-pagelist" id="trailerBlock">
                                    <div class="pagelist-title-black ">Трейлеры <span class="number--opacity"><?= $stat[\Kinomania\Original\Key\Film\Stat::TRAILER] ?></span></div>
                                    <div class="section-video section-black-video">
                                        <div class="outer-trailer-item">
                                            <div class="">
                                                <div class="trailer-list-item">
                                                    <div class="video-prewiew" data-id="<?= $item[Film::TRAILER]['id'] ?>">
                                                        <img alt="" src="<?= $item[Film::TRAILER]['image'] ?>" class="responsive-image video-prewiew__item">
                                                        </div>
                                                    <div class="head-desc clear">
                                                            <div class="trailer__title">
                                                               <p class="title"><a href="/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>/"><?= $item[Film::TRAILER]['name'] ?></a></p>
                                                            <p class="create__trailer-date">Добавлен: <?= $item[Film::TRAILER]['date'] ?></p>
                                                            </div>
                                                        <div class="item item2">
                                                            <span class="button button3" onclick="document.location='/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>#commentList'"><i class="item__icon sprite"></i><span class="number"><?= $item[Film::TRAILER]['comment'] ?></span>Комментировать</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="download download-trailer">
                                            <div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
                                                <div class="outer-dop-download">
                                                    <div class="dop-download">
                                                        <?php if ('' != $item[Film::TRAILER]['hd480']): ?>
                                                            <div class="dop-download-item">
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd480'] ?>">Низкое</a>
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd480'] ?>">HD 480</a>
                                                            </div>
                                                        <?php endif ?>
                                                        <?php if ('' != $item[Film::TRAILER]['hd720']): ?>
                                                            <div class="dop-download-item">
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd720'] ?>">Среднее</a>
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd720'] ?>">HD 720</a>
                                                            </div>
                                                        <?php endif ?>
                                                        <?php if ('' != $item[Film::TRAILER]['hd1080']): ?>
                                                            <div class="dop-download-item">
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd1080'] ?>">Высокое</a>
                                                                <a href="/load/n?file=<?= $item[Film::TRAILER]['hd1080'] ?>">HD 1080</a>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="outer-social clear">
                                            <ul class="social-list social-list--horizontal">
                                                <li class="vk" id="vk_item_share"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers%2F<?= $item[Film::TRAILER]['id'] ?>/"><span class="number"></span></a></li>
                                                <li class="fb" id="fb_item_share"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers%2F<?= $item[Film::TRAILER]['id'] ?>&src=sp/"><span class="number"></span></a></li>
                                                <li class="ok" id="ok_item_share"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers%2F<?= $item[Film::TRAILER]['id'] ?>/"><span class="number"></span></a></li>
                                                <li class="pinterest" id="pt_item_share"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Ftrailers%2F<?= $item[Film::TRAILER]['id'] ?>/"><span class="number"></span></a></li>
                                            </ul>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                setTimeout(function() {
                                                    /**
                                                     * Social
                                                     */
                                                    var url = '';
                                                    VK = {};
                                                    VK.Share = {};
                                                    VK.Share.count = function (index, count) {
                                                        $('#vk_item_share span').text(count);
                                                    };
                                                    $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>&format=json&callback=?');

                                                    $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>&callback=?', function (data) {
                                                        if ('undefined' == typeof data.share) {
                                                            data.share = {};
                                                            data.share.share_count = 0;
                                                        }
                                                        $('#fb_item_share span').text(data.share.share_count);
                                                    });

                                                    ODKL = {};
                                                    ODKL.updateCountOC = function (a, count) {
                                                        $('#ok_item_share span').text(count);
                                                    };
                                                    $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>&callback=?');

                                                    $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $item[Film::TRAILER]['id'] ?>&callback=?', function (data) {
                                                        $('#pt_item_share span').text(data.count);
                                                    });
                                                }, 1500);
                                            });
                                        </script>
                                        <div>
                                            <a href="/film/<?= $id ?>/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif ?>

                    <?php if (0 < $stat[\Kinomania\Original\Key\Film\Stat::FRAME]): ?>
                        <div class="slider-load row-mini-slide row-mini-slide--gray">
                            <div class="mini-slide-title"><a href="/film/<?= $id ?>/frames/" class="no-link">КАДРЫ <span class="number"><?= $stat[\Kinomania\Original\Key\Film\Stat::FRAME] ?></span></a></div>
                            <div class="row-bx-mini-slider" id="frameBlock">
                                <div class="bx-mini-slider">

                                </div>
                            </div>
                            <div class="all-slide">
                                <div class="all-slide-item">
                                    <a href="/film/<?= $id ?>/frames/">ВСЕ КАДРЫ</a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="pagelist-social no-mobile">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>/"></a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                    <?php if (count($news)): ?>
                        <div class="outer-other">
                            <section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew">
                                <div class="sticker">
                                    <div class="sticker-item">НОВОСТИ О ФИЛЬМЕ</div>
                                </div>
                                <div class="section-mini-prewiew section-mini-prewiew--yellow ">
                                    <div class="outer-section-mini-prewiew-item clear">
                                        <div class="outer-pagelist-yellow">
                                            <?php foreach ($news as $newsItem): ?>
                                                <div class="pagelist-prewiew-item">
                                                    <div class="section-mini-prewiew-wrap-item">
                                                        <div class="section-mini-prewiew-item">
                                                            <a href="/<?= $newsItem['category'] ?>/<?= $newsItem['id'] ?>/"><img alt="" src="<?= $newsItem['image'] ?>" class="responsive-image section-mini-prewiew-item__image"></a>
                                                            <div class="section-mini-prewiew-item-text">
                                                                <a href="/<?= $newsItem['category'] ?>/<?= $newsItem['id'] ?>/"><?= $newsItem['title'] ?></a>
                                                                <?php if (0 < $newsItem['comment']): ?>
                                                                    <a href="/<?= $newsItem['category'] ?>/<?= $newsItem['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $newsItem['comment'] ?></a>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="section-mini-prewiew-item-desc">
                                                                <?= $newsItem['anons'] ?>
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
                            <div class="full-comments-text"><a href="/film/<?= $id ?>/reviews/">РЕЦЕНЗИИ</a> <span class="number"></span></div>
                        </div>
                        <div class="inner">

                            
                        </div>

                        <div class="full-comments-head full-comments-foot">

                        </div>

                    </div>
                    <div class="row-pagelist-ligin">
                        <div class="pagelist__title pagelist-ligin__title">ДОБАВИТЬ РЕЦЕНЗИЮ</div>
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
                </content>
                <aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside-branding no-mobile">
              <!--#include virtual="/design/ssi/right_top" -->
        </div>
        <div class="aside">
            <div class="inner-aside inner-aside-billboards">
                <div class="aside-item ">
                    <!--#include virtual="/index/ssi/new" -->
                </div>
                <div class="aside-item leaders no-mobile">
                    <!--#include virtual="/index/ssi/boxoffice" -->
                </div>
            </div>
        </div>
        <div class="dop-aside no-mobile">
            <div class=" outer-aside-treilers">
                <div class="dop-aside__treilers">
                    <!--#include virtual="/index/ssi/popular" -->
                </div>
            </div>
            <div class="dop-aside__item outer-dop-aside__banner">
                <div class="dop-aside__banner">
                      <!--#include virtual="/design/ssi/right_bottom" -->
                </div>
            </div>
        </div>
    </div>
</aside>
            </section>
        </div>
    </div>
</div>
    <?php
/**
 * @var string $static
 */
?>
<div class="footer">
    <div class="wrap">
        <div class="inner-footer">
            <a href="/casting/" class="footer-sticker button button2">КАСТИНГ-БАЗА</a>
            <div class="copy-paste">ИСПОЛЬЗОВАНИЕ МАТЕРИАЛОВ САЙТА ВОЗМОЖНО ТОЛЬКО С РАЗРЕШЕНИЯ РЕДАКЦИИ. ГИПЕРССЫЛКА НА САЙТ ОБЯЗАТЕЛЬНА</div>
            <div class="mail"><a href="mailto:INFO@KINOMANIA.RU/">INFO@KINOMANIA.RU</a></div>
            <div class="footer-nav">
                <div class="outer-footer-nav-list">
                    <a href="/billboard/">СМОТРЕТЬ</a>
                    <ul class="footer-nav-list">
                        <!--<li><a href="/billboard/">АФИША</a></li>-->
                        <li><a href="/tv/">ТВ</a></li>
                        <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                        <li><a href="/article/shorts/">SHORTЫ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/news/">ЧИТАТЬ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/news/">НОВОСТИ</a></li>
                        <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                        <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                        <li><a href="/blog/">БЛОГИ</a></li>
                        <li><a href="/article/press_review/">ПРЕССА</a></li>
                        <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/art/">АРТКИНОМАНИЯ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                        <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/trailers/">МЕДИА</a>
                    <ul class="footer-nav-list">
                        <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                        <li><a href="/posters/">ПОСТЕРЫ</a></li>
                        <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                        <li><a href="/photos/">ФОТО</a></li>
                        <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                        <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                        <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                        <li><a href="/top/">ПОДБОРКИ</a></li>
                        <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                    </ul>
                </div>
            </div>
            <div class="outer-social clear">
                <ul class="social-list social-list--horizontal">
                    <li class="vk" id="vk_main_share"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2F/"><span class="number"></span></a></li>
                    <li class="fb" id="fb_main_share"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2F&t=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU&src=sp/"><span class="number"></span></a></li>
                    <li class="ok" id="ok_main_share"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2F&st.comments=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span class="number"></span></a></li>
                    <li class="pinterest" id="pt_main_share"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2F&description=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span class="number"></span></a></li>
                </ul>
            </div>
            <div class="copyright">© KINOMANIA.RU, 2000—2017</div>
            <div class="metrica">
                <script type="text/javascript">
                    document.write('<a href="http://www.liveinternet.ru/click" '+
                        'target=_blank><img src="http://counter.yadro.ru/hit?t20.3;r'+
                        escape(document.referrer)+((typeof(screen)=='undefined')?'':
                        ';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
                            screen.colorDepth:screen.pixelDepth))+';u'+escape(document.URL)+
                        ';'+Math.random()+
                        '" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодн\я" '+
                        'border=0 width=88 height=31></a>')
                </script>
            </div>
            <div class="planeta-inform"><a href="http://planeta-inform.tv//"><img alt="planeta inform" src="<?= $static ?>/app/img/icon/pi.png"></a></div>
        </div>
    </div>
</div>

<?php if (!empty($static)): ?>
    <noindex>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-34377221-1']);
            _gaq.push(['_setDomainName', 'kinomania.ru']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter36442360 = new Ya.Metrika({
                            id:36442360,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/36442360" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=n9YDAoQsS3qBs6nctL6/sKpAaXKqQUmWz2JpHbOhtVW5rhWj77lg8BM5v*ca1XNVEO*m9p9V91MVojo7t33gipPfdZYKcFC7OkNTn2ZZigqziiN0VdNuzic/Oypu7aH8tm72z7WYCQ0R9MPyR9F6pCDJnljbiMycdpE1KHtxV6I-';</script>
        

        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '130228840716894');
            fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=130228840716894&ev=PageView&noscript=1"/></noscript>


        <script language="JavaScript" type="text/javascript">
            //<!--
            d=document;var a='';a+=';r='+escape(d.referrer)
            js=10//-->
        </script>
        <script language="JavaScript1.1" type="text/javascript">//<!--
            a+=';j='+navigator.javaEnabled()
            js=11//-->
        </script>
        <script language="JavaScript1.2" type="text/javascript">//<!--
            s=screen;a+=';s='+s.width+'*'+s.height
            a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth)
            js=12//-->
        </script>
        <script language="JavaScript1.3" type="text/javascript">//<!--
            js=13//-->
        </script>
        <script language="JavaScript" type="text/javascript">//<!--
            d.write('<a href="http://top.mail.ru/jump?from=94147"'+
                ' target=_top><img src="http://df.c6.b1.a0.top.list.ru/counter'+
                '?id=94147;t=51;js='+js+a+';rand='+Math.random()+
                '" alt="Рейтинг@Mail.ru"'+' border=0 height=31 width=88/><\/a>')
            //if(11<js)d.write('<'+'!-- ')//-->
        </script>
    </noindex>
<?php endif ?>

    <?php
/**
 * @var string $static
 */
?>
<!-- bxSlider Javascript file -->
<script src="<?= $static ?>/app/js/plugins/bx/jquery.bxslider.js?v=1.0.2"></script>
<script type="text/javascript" src="<?= $static ?>/app/js/main.js?v=1.0.2"></script>

<script>
    $(document).ready(function(){
        $('.search__button').click(function(e){
            e = e || window.event;
            e.preventDefault();

            $(this).parent().parent().submit();

            return false;
        });

        var matches = document.cookie.match(new RegExp("(?:^|; )__user__=([^;]*)"));
        matches = matches ? decodeURIComponent(matches[1]) : undefined;
        if (undefined !== matches) {
            matches = matches.split('.');
            $('.authorizationContent').
            html('').
            append('<li><a href="/user/' + matches[0] + '/"><span>' + matches[0] + '</span></a></li>').
            append('<li><a href="/logout"><span>ВЫХОД</span></a></li>');
        }

        /**
         * Social
         */
        var url = '';
        VK = {};
        VK.Share = {};
        if ($('#vk_in_share').length) {
            $('#vk_in_share span').text('0');
            VK.Share.count = function(index, count){
                $('#vk_in_share span').text(count);
            };
            url = $('#vk_in_share').attr('data-url');
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/' + url + '&format=json&callback=?');

            setTimeout(function(){
                VK.Share.count = function (index, count) {
                    $('#vk_main_share span').text(count);
                };
                $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/&format=json&callback=?');
            }, 1000);
        } else {
            VK.Share.count = function (index, count) {
                $('#vk_main_share span').text(count);
            };
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/&format=json&callback=?');
        }

        if ($('#fb_in_share').length) {
            url = $('#fb_in_share').attr('data-url');
            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/' + url + '&callback=?', function(data) {
                if ('undefined' == typeof data.share) {
                    data.share = {};
                    data.share.share_count = 0;
                }
                $('#fb_in_share span').text(data.share.share_count);
            });

            setTimeout(function(){
                $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/&callback=?', function (data) {
                    if ('undefined' == typeof data.share) {
                        data.share = {};
                        data.share.share_count = 0;
                    }
                    $('#fb_main_share span').text(data.share.share_count);
                });
            }, 700);
        } else {
            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/&callback=?', function (data) {
                if ('undefined' == typeof data.share) {
                    data.share = {};
                    data.share.share_count = 0;
                }
                $('#fb_main_share span').text(data.share.share_count);
            });
        }

        ODKL = {};
        ODKL.updateCountOC = function (a, count) {
            $('#ok_main_share span').text(count);
        };
        $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=http://www.kinomania.ru/&callback=?');

        $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=http://www.kinomania.ru/&callback=?', function(data) {
            $('#pt_main_share span').text(data.count);
        });
    });
</script>

    <link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
    <script src="<?= $static ?>/app/js/video.ie8.js"></script>
    <script src="<?= $static ?>/app/js/video.js"></script>
    <script src="<?= $static ?>/app/js/videojs.ads.js"></script>
    <script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
    <script type="text/javascript">
        function setSelectionRange(input, selectionStart, selectionEnd) {
            if (input.setSelectionRange) {
                input.focus();
                input.setSelectionRange(selectionStart, selectionEnd);
            }
            else if (input.createTextRange) {
                var range = input.createTextRange();
                range.collapse(true);
                range.moveEnd('character', selectionEnd);
                range.moveStart('character', selectionStart);
                range.select();
            }
        }
        function amimatedStar() {
            $('.select-star').addClass('default');
        }
        function rateClick(authProb, login)
        {
            $('.star__item').click(function(e){
                e = e || window.event;
                e.preventDefault();

                if (authProb) {
                    window.star_click = 1;
                    var id = $(this).parent().parent().parent().parent().parent().parent().parent().attr('data-id');
                    var rate = $(this).attr('data-value');
                    var el = this;

                    window.rateData[0] = rate;
                    $.ajax({
                        url: '/user/' + login + '/films?handler=rate',
                        type: "POST",
                        data: 'id=<?= $id ?>&rate=' + rate,
                        dataType: "json",
                        success: function (data) {
                            if (0.0 < data) {
                                $('#average').text(data);
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
                    $(parent).find('.star__item').each(function () {
                        $(this).removeAttr('data-active');
                    });
                    $(this).attr('data-active', 'select');
                    $(this).parents('.inner-raiting-star').attr('data-fixed', 'fixed');
                    $(this).append('<span class="select-star">ваша оценка</span>');
                    setTimeout(amimatedStar, 2000);
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-auth-item').addClass('active');
                }

                return false;
            });
        }

        $(document).ready(function(){
            $('.page-content-head__more a').click(function(){
                var text = $(this).parent().parent().parent().find('.read-more-text')
                $(text).css('height', 'initial').toggleClass('read-more-text_open');
                $(this).hide();
                return false;
            });
        });
    </script>

    <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
    <script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
    <script type="text/javascript">
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

            if (undefined === window.rateData[0]) {
                if (authProb) {
                    $.ajax({
                        url: '/user/' + login + '/films?handler=getRate',
                        type: "POST",
                        data: 'id=<?= $id ?>',
                        dataType: "json",
                        success: function (data) {
                            var ul = $('.icon-star').find('.rateList');
                            $(ul).html('');
                            $(ul).parent().find('.raiting-number').html('');

                            window.rateData[0] = data;
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
                                window.star_click = 1;
                                $(ul).parent().find('.raiting-number').append('<span class="value">' + data + '</span> из 10');
                            } else {
                                $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');
                            }
                            rateClick(authProb, login);

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

                            $('.inner-raiting-star').mouseleave(function () {
                                if (0 == window.star_click) {
                                    $(this).find('.raiting-number .value').html('_');
                                }
                            });

                            $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                            $('.raiting-list-star').hover(function () {
                                $(this).find('.select-star').addClass('active');
                            }, function () {
                                parentStar = $(this).parents('.inner-raiting-star');
                                minStar = 0;
                                fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                                if ($('.inner-raiting-star').is('[data-fixed]')) {
                                    $(parentStar).find('.star__item').removeClass('active');
                                    while (minStar <= fixedStar) {
                                        $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
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
                    var ul = $('.icon-star').find('.rateList');
                    $(ul).html('');
                    $(ul).parent().find('.raiting-number').html('');
                    for (var i = 1; i < 11; i++) {
                        $(ul).append('<li class="star__item" data-value="' + i + '"><i class="icon__star"></i></li>');
                    }
                    $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');

                    rateClick(authProb, login);

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

                    $('.inner-raiting-star').mouseleave(function () {
                        $(this).find('.raiting-number .value').html('_');
                    });

                    $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                    $('.raiting-list-star').hover(function () {
                        $(this).find('.select-star').addClass('active');
                    }, function () {
                        parentStar = $(this).parents('.inner-raiting-star');
                        minStar = 0;
                        fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                        if ($('.inner-raiting-star').is('[data-fixed]')) {
                            $(parentStar).find('.star__item').removeClass('active');
                            while (minStar <= fixedStar) {
                                $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
                                minStar++
                            }
                            $(parentStar).find('.raiting-number .value').html(fixedStar);
                            $('.select-star').removeClass('active');
                            setTimeout(amimatedStar, 2000);
                        }
                    });
                }
            } else {
                var ul = $(el).find('.rateList');
                $(ul).html('');
                $(ul).parent().find('.raiting-number').html('');

                var data = window.rateData[0];
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
                rateClick(authProb, login);


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

            $('.collectFilm').click(function(){
                if (authProb) {
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
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-auth-item').addClass('active');
                }
            });
            $(document).on('click', '.addCollection', function() {
                var el = this;
                if (authProb) {
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
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            } else if (2 == data) {
                                $(el).parent().parent().parent().parent().notify("Фильм уже есть в данной коллекции", {
                                    className: "info",
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            } else {
                                $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                    position: "top",
                                    autoHideDelay: 2400
                                });
                            }
                        },
                        error: function () {
                            $(el).parent().parent().parent().removeClass('active');
                            $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                position: "top",
                                autoHideDelay: 2400
                            });
                        },
                        timeout: 5000
                    });
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
                var oldPlayer = document.getElementById('trailer_video');
                if (null !== oldPlayer) {
                    videojs(oldPlayer).dispose();
                }

                $('.my-overlay').removeClass('active');
                $('.my-overlay .overlay-auth-item').removeClass('active');
                $('.my-overlay .overlay-trailer-item').removeClass('active');
                $('.my-overlay .my-overlay-item').removeClass('active');
            });

            var id_kp = '<?= $item[Film::ID_KP] ?>';
            id_kp = parseInt(id_kp);
            if (0 < id_kp) {
                var range = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                if (1 == range[Math.floor(Math.random() * 5)]) {
                    localStorage.setItem("checkRate_" + id_kp, 0);
                }
            }
            if (0 < id_kp && 1 != localStorage.getItem("checkRate_" + id_kp)) {
                localStorage.setItem("checkRate_" + id_kp, 1);
                $.ajax({
                    url: '/film?handler=checkRate',
                    type: "POST",
                    data: 'filmId=<?= $id ?>',
                    success: function (data) {
                        if (1 == data) {
                            var meta = document.createElement('meta');
                            meta.name = "referrer";
                            meta.content = "no-referrer";
                            document.getElementsByTagName('head')[0].appendChild(meta);

                            $.get("https://rating.kinopoisk.ru/" + id_kp + ".xml", function(data) {
                                data = data.documentElement.innerHTML + '';
                                data = data.split('?>');
                                data = data[0];
                                data = data + '';

                                var kp = 0;
                                var kp_count = 0;
                                var imdb = 0;
                                var imdb_count = 0;

                                if (-1 != data.indexOf('kp_rating')) {
                                    kp_count = data.split('kp_rating num_vote="');
                                    kp_count = kp_count[1];
                                    kp_count = kp_count.split('"');
                                    kp_count = kp_count[0];

                                    kp = data.split('</kp_rating>');
                                    kp = kp[0];
                                    kp = kp.split('>');
                                    kp = kp[1];
                                    kp = parseFloat(kp).toFixed(1);
                                }

                                if (-1 != data.indexOf('imdb_rating')) {
                                    imdb_count = data.split('imdb_rating num_vote="');
                                    imdb_count = imdb_count[1];
                                    imdb_count = imdb_count.split('"');
                                    imdb_count = imdb_count[0];

                                    imdb = data.split('</imdb_rating>');
                                    imdb = imdb[0];
                                    imdb = imdb.split('<imdb_rating');
                                    imdb = imdb[1];
                                    imdb = imdb.split('>');
                                    imdb = imdb[1];
                                    imdb = parseFloat(imdb).toFixed(1);
                                }

                                if (0 < kp || 0 < kp_count || 0 < imdb || 0 < imdb_count) {
                                    $('#kp').html(kp);
                                    $('#kp_count').html(kp_count);
                                    $('#imdb').html(imdb);
                                    $('#imdb_count').html(imdb_count);

                                    $.ajax({
                                        url: '/film?handler=updateRate',
                                        type: "POST",
                                        data: 'filmId=<?= $id ?>&kp=' + kp + '&kp_count=' + kp_count + '&imdb=' + imdb + '&imdb_count=' + imdb_count,
                                        success: function (data) {
                                        },
                                        error: function () {
                                        },
                                        timeout: 5000
                                    });
                                }
                            });
                        }
                    },
                    error: function () {
                    },
                    timeout: 5000
                });
            }

            $('.video-prewiew').click(function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/film/?handler=getTrailer&id=' + id,
                    type: "POST",
                    success: function (data) {
                        data = JSON.parse(data);
                        if ('' != data.src) {
                            if (-1 !== data.src.indexOf('.mp4')) {
                                $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                                    '<source src="' + data.src + '" type=\'video/mp4\'>' +
                                    '<p class="vjs-no-js">' +
                                    'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                                    '</p>' +
                                    '</video>'
                                );
                            } else {
                                $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                                    '<source src="' + data.src + '" type=\'video/flv\'>' +
                                    '<p class="vjs-no-js">' +
                                    'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                                    '</p>' +
                                    '</video>'
                                );
                            }
                            var width = 800;
                            if (800 >= $(window).width()) {
                                width = $(window).width();
                            }
                            var player = videojs('trailer_video', {
                                "controls": true,
                                "autoplay": true,
                                "preload": "auto",
                                "width": width
                            }, function () {
                                this.play();
                            });
                            if ('' !== window.__pre_roll__) {
                                player.preroll({
                                    src: window.__pre_roll__,
                                    href: window.__pre_roll_link__,
                                    target: '_blank ',
                                    lang: {
                                        'skip':'Пропустить',
                                        'skip in': 'Пропустить через ',
                                        'advertisement': 'Реклама',
                                        'video start in': 'Видео начнется через: '
                                    }
                                });
                                player.one('adstart', function() {
                                    if('undefined' != typeof _gaq) {
                                        _gaq.push(['_trackEvent', 'Trailer', 'View'])
                                    }
                                });
                                player.one('adskip', function() {
                                    if('undefined' != typeof _gaq) {
                                        _gaq.push(['_trackEvent', 'Trailer', 'Skip'])
                                    }
                                });
                                $(document).on('click', 'a.preroll-blocker', function(){
                                    if('undefined' != typeof _gaq) {
                                        _gaq.push(['_trackEvent', 'Trailer', 'Click'])
                                    }
                                });
                            }
                        }
                        $('.my-overlay').addClass('active');
                        $('.my-overlay .overlay-trailer-item').addClass('active');
                    },
                    complete: function () {
                    },
                    error: function () {
                    },
                    timeout: 5000
                });
            });

            $(window).scroll(function() {
                if (undefined !== $('#frameBlock').offset()) {
                    if ($(window).scrollTop() + $(window).height() >= $('#frameBlock').offset().top) {
                        if (!$('#frameBlock').attr('loaded')) {
                            $('#frameBlock').attr('loaded', true);

                            $.ajax({
                                url: '?handler=getFrame',
                                type: "POST",
                                dataType: "json",
                                success: function (data) {
                                    for (var key in data) {
                                        if (data.hasOwnProperty(key)) {
                                            $('#frameBlock').find('.bx-mini-slider').append('<div class="slide"><img src="' + data[key] + '"></div>');
                                        }
                                    }
                                    create_bx_mini_slider();
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        }
                    }
                }

                if (undefined !== $('#reviews').offset()) {
                    if ($(window).scrollTop() + $(window).height() >= $('#reviews').offset().top) {
                        if (!$('#reviews').attr('loaded')) {
                            $('#reviews').attr('loaded', true);

                            $.ajax({
                                url: '?handler=getReview',
                                type: "POST",
                                dataType: "json",
                                success: function (data) {
                                    if (data.hasOwnProperty('main')) {
                                        $('#reviews').find('.inner').append('<div class="parent-author-full-comments row-author-full-comments kinomania">  ' +
                                            '   	<div class="author-full-comments-image">  ' +
                                            '   		<a href="/user/' + data['main']['login'] + '/"><img width="48" height="48" src="' + data['main']['avatar'] + '" alt=""></a>  ' +
                                            '   	</div>  ' +
                                            '   	<div class="author-full-comments-content">  ' +
                                            '   		<div class="author-comments-name author-reviews-name"><a href="/user/' + data['main']['login'] + '/">' + data['main']['name'] + '</a></div>  ' +
                                            '   		<div class="author-comments-text">  ' +
                                            data['main']['text'] +
                                            '   		</div>  ' +
                                            '   		<div class="author-comments-info clear">  ' +
                                            '   			<ul class="author-comment-info-list">  ' +
                                            '   				<li class="reply__comments">  ' +
                                            '   					<a href="/article/' + data['main']['id'] + '#commentList">  ' +
                                            '   						<span>Комментировать</span>  ' +
                                            '   						<i class="reply__icon reply__comment_icon"></i>  ' +
                                            '   						<span class="value">' + data['main']['comment'] + '</span>  ' +
                                            '   					</a>  ' +
                                            '   				</li>  ' +
                                            '   				<li class="date">' + data['main']['publish'] + '</li>  ' +
                                            '   			</ul>  ' +
                                            '   		</div>  ' +
                                            '   	</div>  ' +
                                            '   	<div class="sticker-mini">РЕЦЕНЗИЯ КИНОМАНИИ</div>  ' +
                                            '  </div>  ');
                                    }

                                    if (data.hasOwnProperty('user')) {
                                        for (var key in data['user']) {
                                            if (data['user'].hasOwnProperty(key)) {
                                                $('#reviews').find('.inner').append( '   <div class="parent-author-full-comments row-author-full-comments">  '  +
                                                    '   	<div class="author-full-comments-image">  '  +
                                                    '   		<a href="/user/' + data['user'][key]['login'] + '/"><img width="48" height="48" src="' + data['user'][key]['avatar'] + '" alt=""></a>  '  +
                                                    '   	</div>  '  +
                                                    '   	<div class="author-full-comments-content">  '  +
                                                    '   		<div class="author-comments-name author-reviews-name"><a href="/user/' + data['user'][key]['login'] + '/">' + data['user'][key]['name'] + '</a></div>  '  +
                                                    '   		<div class="author-comments-text">  '  +
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
                                                    '  </div>  ');
                                            }
                                        }
                                    }

                                    $('#reviews').find('.full-comments-foot').html(' <div class="full-comments-text"><a href="/film/<?= $id ?>/reviews/"><span>Все рецензии (' + data['count'] + ')</span></a></div>');

                                    $('.vote_item').on('click', function(e){
                                        e = e || window.event;
                                        e.preventDefault();
                                        if (authProb) {
                                            var el = this;
                                            var id  = $(this).attr('data-id');

                                            $.ajax({
                                                url: '/user/' + login + '?handler=voteReview&id=' + id,
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
                            url: '/user/' + login + '?handler=addReview',
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
                                        '   			<li class="date">рецензия будет опубликована после <b>модерации</b></li>  '  +
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
        });



        $('.my-add-info').click(function(){
            $('.my-overlay').addClass('active');
            $('.my-overlay .overlay-add').addClass('active');
        });

        $('.my-massage-error').click(function(){
            $('.my-overlay').addClass('active');
            $('.my-overlay .my-item-error').addClass('active');
        });
    </script>
</body>
</html>
