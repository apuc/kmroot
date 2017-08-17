<?php
/**
 * @var array $list
 * @var array $genre
 * @var array $country
 * @var string static
 * @var $options \Kinomania\System\Options\Options
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $options->get('seo_top_films_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_top_films_description') ?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/top/films"/>

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
    <div class="my-overlay-item" data-type="overlay-auth">
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
            <section class=" outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer content-top--padding col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-top-films">
                        <h1 class="pagetitle"><?= $options->get('seo_top_films_h1') ?></h1>
                        <div class="description">
                            Читатели «Киномании» сами выбирают, какое кино считать хорошим, а какое совсем не удалось. В нашем рейтинге — фильмы с самими высокими оценками на сайте. Выбирайте жанр, страну-производителя, временной период — и перед вами топ лучших фильмов, составленный по оценкам зрителей.
                        </div>
                        <div class="row-top">
                            <div class="top-forms">
                                <form action="">
                                    <div class="row-dropdown-input session-dropdown-input">
                                        <select name="genre" id="genre" class="">
                                            <option value="name" selected="selected">Выберите жанр</option>
                                            <?php foreach ($genre as $code => $name): ?>
                                                <option value="<?= $code ?>"><?= $name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="country" id="country" class=""  style="max-width: 250px;">
                                            <option value="1" selected="selected">Выберите страну</option>
                                            <?php foreach ($country as $code => $name): ?>
                                                <option value="<?= $code ?>"><?= $name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="years-two" id="year" class="">
                                            <option value="name" selected="selected">По десятилетиям</option>
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
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row-table-top">
                            <div class="session-table">
                                <?php $count = 0; ?>
                                <?php foreach ($list as $item): ?>
                                    <?php $count++ ?>
                                    <div class="session-table-item table-top-item clear">
                                        <div class="table-top-info-one">
                                            <div class="table-number"><?= $count ?></div>
                                            <div class="session-table-item__name">
                                                <?php if ('' == $item['name_ru']): ?>
                                                    <div class="table-top-title"><a href="/film/<?= $item['id'] ?>/"><?= $item['name_origin'] ?></a></div>
                                                <?php else: ?>
                                                    <div class="table-top-title"><a href="/film/<?= $item['id'] ?>/"><?= $item['name_ru'] ?></a></div>
                                                    <div class="table-top-title-eng"><?= $item['name_origin'] ?></div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="table-top-info">
                                            <div class="row-button-list">

                                            </div>
                                            <span class="table-top-info-text table-top-info-raiting"><?= $item['rate'] ?></span>
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
                                                            <ul class="dropdown-folder-list" data-id="<?= $item['id'] ?>">

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
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="top/films/"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="top/films/"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ftop%2Ffilms%2F"></a></li>
                            </ul>
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
                          html +=  '   <div class="session-table-item table-top-item clear">  '  +
                              '   	<div class="table-top-info-one">  '  +
                              '   		<div class="table-number">' + (1 * key + 1) + '</div>  '  +
                              '   		<div class="session-table-item__name">  ';
                          if ('' == data[key]['name_ru']) {
                              html += '<div class="table-top-title"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_origin'] + '</a></div>  ';
                          } else {
                              html += '<div class="table-top-title"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_ru'] + '</a></div>  ';
                              html += '<div class="table-top-title-eng">' + data[key]['name_origin'] + '</div> ';
                          }
                          html += '   		</div>  '  +
                              '   	</div>  '  +
                              '   	<div class="table-top-info">  '  +
                              '   		<div class="row-button-list">  '  +
                              '     '  +
                              '   		</div>  '  +
                              '   		<span class="table-top-info-text table-top-info-raiting">' + data[key]['rate'] + '</span>  '  +
                              '   		<div class="table-top-info-text table-top-info-views open-help-in">' + data[key]['rate_count'] + '  '  +
                              '   			<div class="help help--gray">Количество оценок</div>  '  +
                              '   		</div>  '  +
                              '   		<div class="main-folder-icon">  '  +
                              '   			<div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">  '  +
                              '   				<a class="folder__icon icon"></a>  '  +
                              '   				<div class="hint">Добавить в Избранное</div>  '  +
                              '   				<div class="row-dropdown-folder">  '  +
                              '   					<div class="dropdown-folder dropdown-folder-content">  '  +
                              '   						<div class="dropdown-folder-title"><span>В избранное</span></div>  '  +
                              '   						<ul class="dropdown-folder-list" data-id="' + data[key]['id'] + '">  '  +
                              '     '  +
                              '   						</ul>  '  +
                              '   					</div>  '  +
                              '   					<div class="dropdown-folder dropdown-folder-setting">  '  +
                              '   						<a href="#" class="clear">  '  +
                              '   							<!-- <i class="setting-icon"></i> -->  '  +
                              '   							<span>Управление папками</span>  '  +
                              '   						</a>  '  +
                              '   					</div>  '  +
                              '   				</div>  '  +
                              '   			</div>  '  +
                              '   		</div>  '  +
                              '   	</div>  '  +
                              '  </div>  ' ;
                      }
                  }

                  $('.session-table').append(html);

                  $("img.lazy[proc!=true]").lazyload({
                      effect : "fadeIn"
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
      $(document).ready(function(){
          $("img.lazy").lazyload({
              effect : "fadeIn"
          });

          var filterTimer;
          var doneFilterInterval = 500;
          var FILTER = {
              'genre': '',
              'country': '',
              'year':  ''
          };

          $('#genre').change(function(){
              FILTER.genre = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true, true);
              }, doneFilterInterval);
          });
          $('#country').change(function(){
              FILTER.country = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true, true);
              }, doneFilterInterval);
          });
          $('#year').change(function(){
              FILTER.year = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
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

          $('.page-content-head__more a').click(function(){
              $('.read-more-text').addClass('read-more-text_open');
              $(this).hide();
              return false;
          });

          

          $(document).on('click', '.folder__icon', function(){
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
      });
  </script>
</body>
</html>
