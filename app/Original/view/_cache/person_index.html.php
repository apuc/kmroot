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

    <link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/"/>

    <meta property="og:title" content="<?= $item[Person::TITLE] ?> : всё о персоне | Обои, фотографии, фильмография, биография, факты, новости" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="<?= $item[Person::IMAGE] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>" />
    <meta property="og:description" content="<?= $item[Person::TITLE] ?> : всё о персоне на сайте KINOMANIA.RU. Обои, фотографии, фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа"/>

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
                    <?php if ('' == $item[Person::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_ORIGIN] ?></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><?= $item[Person::NAME_RU] ?></h1>
                        <h2 class="name__page"><?= $item[Person::NAME_ORIGIN] ?></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <?php
/**
 * @var int $id
 * @var \Dspbee\Core\Request $request
 * @var array $stat
 */
use \Kinomania\Original\Key\Person\Stat;
?>
<ul class="nav-content-list clear nav-content-list-actor">
    <div class="mobile__select my-select">
        <span class="result">КИНО</span>
        <ul class="result-list">
            <li class="nav-content-item default <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="#">Фильмография</a></li>
            <li class="nav-content-item default <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

            <?php if (0 < $stat[Stat::PHOTO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::WALLPAPER]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::FRAME]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::VIDEO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::AWARD]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span>/a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::NEWS]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>
    <li class="nav-content-item <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id ?>/">Фильмография</a></li>
    <li class="nav-content-item <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

    <?php if (0 == $stat[Stat::PHOTO]): ?>
        <li class="nav-content-item no-active"><span>Фото</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span> </a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::WALLPAPER]): ?>
        <li class="nav-content-item no-active"><span>Обои</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::FRAME]): ?>
        <li class="nav-content-item no-active"><span>Кадры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::VIDEO]): ?>
        <li class="nav-content-item no-active"><span>Видео</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::AWARD]): ?>
        <li class="nav-content-item no-active"><span>Награды</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::NEWS]): ?>
        <li class="nav-content-item no-active"><span>Новости</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
    <?php endif ?>
</ul>
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
