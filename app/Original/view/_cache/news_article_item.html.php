<?php
/**
 * @var int $newsId
 * @var array $item
 * @var array $moreList
 * @var array $comment
 * @var string $static
 */
use Kinomania\Original\Key\News\News;
use Kinomania\Original\Key\News\Preview as Preview;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $item[News::TITLE_HTML] ?></title>
    <meta name="description" content="<?= $item[News::ANONS_STRIPED] ?>" />

    <link rel="canonical" href="http://www.kinomania.ru/article/<?= $newsId ?>"/>

    <meta property="og:title" content="<?= $item[News::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <?php if ('' != $item[News::IMAGE]): ?>
    <meta property="og:image" content="http:<?= $item[News::IMAGE] ?>" />
    <?php endif ?>
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.kinomania.ru/news/<?= $newsId ?>" />
    <meta property="og:description" content="<?= $item[News::ANONS_STRIPED] ?>"/>

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
        .bx-wrapper img {
            width: 100%;
            cursor: pointer;
        }
        .section-news .bx-controls-direction .bx-next {
            right: 3% !important;
        }
        .section-news .bx-controls-direction .bx-prev {
            left: 3% !important;
        }
        .bx-wrapper .bx-controls-direction a {
            top: 49% !important;
        }
        .bx-wrapper .bx-viewport {
             background: none !important;
         }
        .section-news {
              padding-left: 0;
              padding-right: 0;
        }
        
        .content-text iframe{
            width: 100% !important;
        }
        .content-text p img:not(.image-prewiew) {
            width: 100% !important;
            height: auto !important;
        }
    </style>
    <link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
    <script src="<?= $static ?>/app/js/video.ie8.js"></script>
    <script src="<?= $static ?>/app/js/video.js"></script>
    <script src="<?= $static ?>/app/js/videojs.ads.js"></script>
    <script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
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

    <div class="my-overlay-item overlay-login-item" data-type="overlay-auth">
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
            <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <?php if ('Блог' == $item[News::CATEGORY]): ?>
                    <div class="row-blog-item">
                        <div class="page-item-title"><?= $item[News::TITLE] ?></div>
                        <div class="page-item-info clear">
                            <div class="page-item-info--left">
                                <div class="page-item-info__author">
                                    <?php if (0 != $item[News::AUTHOR_ID]): ?>
                                        <a href="/user/<?= $item[News::AUTHOR_LOGIN] ?>/" class="author blog-author">
                                            <img src="<?= $item[News::AVATAR] ?>" alt="<?= $item[News::AUTHOR_NAME] ?>" title="<?= $item[News::AUTHOR_NAME] ?>">
                                        </a>
                                        <a href="/user/<?= $item[News::AUTHOR_LOGIN] ?>/" class="author__name"><?= $item[News::AUTHOR_NAME] ?></a>
                                    <?php else: ?>
                                        &nbsp;
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="page-item-info--right">
                                <div class="page-item-info__date blog-date-author"><?= $item[News::PUBLISH] ?></div>
                            </div>
                        </div>
                        <div class="page-item-content clear">
                            <?php if (!empty($item[News::IMAGE])): ?>
                                <div class="image-shadow page-item__image">
                                    <img alt="<?= $item[News::TITLE] ?>" src="<?= $item[News::IMAGE] ?>" class="image-prewiew" style="max-width: 450px;">
                                </div>
                            <?php endif ?>
                            <div class="page-content-text">
                                <?= $item[News::TEXT] ?>
                            </div>
                        </div>
                    </div>
                    <div class="tags blog-tags clear">
                        <div class="inner-blog-tags inner-blog-tags--left">
                            <a href="/user/<?= $item[News::AUTHOR_LOGIN] ?>#blog/" class="all-posts-author">Все посты автора</a>
                        </div>
                        <?php if (count($item[News::TAGS])): ?>
                            <div class="inner-blog-tags inner-blog-tags--right">
                                <div class="inner-tags">Тэги:
                                    <ul class="list-tags">
                                        <?php foreach ($item[News::TAGS] as $id => $tag): ?>
                                            <li><a href="/tag/<?= $id ?>/"><?= $tag ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                <?php elseif ('Рецензии' == $item[News::CATEGORY]): ?>
                    <div class="header-pagelist header-pagelist-prewiew header-pagelist--black">
                        <div class="inner-header-pagelist parent-sticker">
                            <div class="sticker">
                                <div class="sticker-item"><a href="/<?= $item[News::LINK] ?>/"><?= $item[News::CATEGORY] ?></a></div>
                            </div>
                            <h1 class="pagetitle pagetitle-interview">
                                <?php if (0 < $item[News::FILM_ID]): ?>
                                    <a href="/film/<?= $item[News::FILM_ID] ?>/">Рецензия на фильм «<?= $item[News::FILM_NAME] ?>»</a>
                                <?php else: ?>
                                    <?= $item[News::TITLE] ?>
                                <?php endif ?>
                            </h1>
                            <div class="header-pagelist-info">
                                <div class="pagelist-info">
                                    <?php if (0 != $item[News::AUTHOR_ID]): ?>
                                        <span class="pagelist__author"><a href="/user/<?= $item[News::AUTHOR_LOGIN] ?>/" class="author__name"><?= $item[News::AUTHOR_NAME] ?></a></span>,
                                    <?php else: ?>
                                        &nbsp;
                                    <?php endif ?>
                                    <span class="date__month"><?= $item[News::PUBLISH] ?></span>
                                    <?php if (0 < $comment['count']): ?>
                                        <a href="#commentList/" class="pagelist__comments"><?= $comment['count'] ?></a>
                                    <?php endif ?>

                                </div>
                            </div>
                            <div class="pagelist-prewiew">
                                <img alt="" src="<?= $item[News::IMAGE] ?>" class="image-prewiew">
                            </div>
                            <div class="description">
                                <?= $item[News::ANONS] ?>
                            </div>
                        </div>
                    </div>
                    <div class="content-text">
                        <?= $item[News::TEXT] ?>
                    </div>
                    <?php if (count($item[News::TAGS])): ?>
                        <div class="tags">
                            <div class="inner-tags">Тэги:
                                <ul class="list-tags">
                                    <?php foreach ($item[News::TAGS] as $id => $tag): ?>
                                        <li><a href="/tag/<?= $id ?>/"><?= $tag ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif ?>
                <?php else: ?>
                    <div class="header-pagelist header-pagelist-prewiew header-pagelist--black">
                        <div class="inner-header-pagelist parent-sticker">
                            <div class="sticker">
                                <div class="sticker-item"><a href="/<?= $item[News::LINK] ?>/"><?= $item[News::CATEGORY] ?></a></div>
                            </div>
                            <h1 class="pagetitle pagetitle-interview"><?= $item[News::TITLE] ?></h1>
                            <div class="header-pagelist-info">
                                <div class="pagelist-info">
                                    <?php if (0 != $item[News::AUTHOR_ID]): ?>
                                        <span class="pagelist__author"><a href="/user/<?= $item[News::AUTHOR_LOGIN] ?>/" class="author__name"><?= $item[News::AUTHOR_NAME] ?></a></span>,
                                    <?php else: ?>
                                        &nbsp;
                                    <?php endif ?>
                                    <span class="date__month"><?= $item[News::PUBLISH] ?></span>
                                    <?php if (0 < $comment['count']): ?>
                                        <a href="#commentList/" class="pagelist__comments"><?= $comment['count'] ?></a>
                                    <?php endif ?>

                                </div>
                            </div>
                            <?php if ('' != $item[News::IMAGE]): ?>
                            <div class="pagelist-prewiew">
                                <img alt="" src="<?= $item[News::IMAGE] ?>" class="image-prewiew">
                            </div>
                            <?php endif ?>
                            <?php if ('Инсайд' != $item[News::CATEGORY]): ?>
                            <div class="description">
                                <?= $item[News::ANONS] ?>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="content-text">
                        <?= $item[News::TEXT] ?>
                    </div>
                    <?php if (count($item[News::TAGS])): ?>
                        <div class="tags">
                            <div class="inner-tags">Тэги:
                                <ul class="list-tags">
                                    <?php foreach ($item[News::TAGS] as $id => $tag): ?>
                                        <li><a href="/tag/<?= $id ?>/"><?= $tag ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endif ?>

                <div class="pagelist-social news-pagelist-social">
                    <div class="outer-social clear">
                        <ul class="social-list social-list--horizontal">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="article/<?= $newsId ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Farticle%2F<?= $newsId ?>/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="article/<?= $newsId ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Farticle%2F<?= $newsId ?>/&t=<?= $item[News::TITLE_ENCODED] ?>&src=sp"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=<?= $item[News::TITLE_ENCODED] ?>&url=http%3A%2F%2Fkinomania.ru%2Farticle%2F<?= $newsId ?>/"></a></li>
                            </ul>
                        </ul>
                        <br /> <br /> <br /> <br /> <br />
                    </div>
                </div>
                <?php if (count($moreList)): ?>
                    <div class="outer-other no-mobile">
                        <section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew">
                            <div class="sticker">
                                <?php if ('Блог' == $item[News::CATEGORY]): ?>
                                    <div class="sticker-item">другие БЛОГИ</div>
                                <?php else: ?>
                                    <div class="sticker-item">другие <?= $item[News::CATEGORY] ?></div>
                                <?php endif ?>
                            </div>
                            <div class="section-mini-prewiew section-mini-prewiew--yellow ">
                                <div class="outer-section-mini-prewiew-item clear">
                                    <div class="outer-pagelist-yellow">
                                        <?php foreach ($moreList as $item): ?>
                                            <div class="pagelist-prewiew-item">
                                                <div class="section-mini-prewiew-wrap-item">
                                                    <div class="section-mini-prewiew-item">
                                                        <a href="/article/<?= $item[Preview::ID] ?>/"><img alt="" src="<?= $item[Preview::IMAGE] ?>" class="responsive-image section-mini-prewiew-item__image"></a>
                                                        <div class="section-mini-prewiew-item-text">
                                                            <a href="/article/<?= $item[Preview::ID] ?>/"><?= $item[Preview::TITLE] ?></a>
                                                            <?php if (0 < $item[Preview::COMMENT]): ?>
                                                                <a href="/article/<?= $item[Preview::ID] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $item[Preview::COMMENT] ?></a>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="section-mini-prewiew-item-desc">
                                                            <?= $item[Preview::ANONS] ?>
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
                <div class="full-comments" id="commentList">
                    <div class="full-comments-head">
                        <div class="full-comments-text">КОММЕНТАРИИ <span class="number"><?php if (0 < $comment['count']): ?> <?= $comment['count'] ?>   <?php endif ?></span></div>
                    </div>
                    <?php if (0 < $comment['count']): ?>
                        <?php \Kinomania\System\Data\Comment::print($comment['list']) ?>
                    <?php endif ?>
                </div>
                <br />
                <div class="row-pagelist-ligin">
                    <div class="pagelist__title pagelist-ligin__title">ОТПРАВИТЬ КОММЕНТАРИЙ</div>
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
                                    <button class="button button4 send main">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </content>
            <section class="outer-section clear outer-content">
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

    <script>
        function setSelectionRange(input, selectionStart, selectionEnd) {
            if (input.setSelectionRange) {
                input.focus();
                input.setSelectionRange(selectionStart, selectionEnd);
                console.log(selectionEnd);
            }
            else if (input.createTextRange) {
                var range = input.createTextRange();
                range.collapse(true);
                range.moveEnd('character', selectionEnd);
                range.moveStart('character', selectionStart);
                range.select();
                console.log(selectionEnd);
            }
        }

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
        
        $(document).ready(function(){
            $(document).on("mouseenter", ".author-comments-text", function() {
                $('.author-comments-text').css("background", "");
                $(this).css("background", "#FBFBFB");
                var parent = $(this).attr('data-parent');
                while (0 != parent) {
                    var el = $('.author-comments-text[data-id=' + parent + ']');
                    $(el).css("background", "#FBFBFB");
                    parent = $(el).attr('data-parent');
                }
            }).on("mouseleave", ".author-full-comments-content", function() {
                $('.author-comments-text').css("background", "");
            });

            $(document).on('click', '.reply', function(e){
                e = e || window.event;
                e.preventDefault();

                $('.extra_comment').remove();

                if (authProb) {
                    var avatar = $('#myAvatar').find('img').attr('src');

                    $(this).parent().parent().append('<div class="row-pagelist-ligin extra_comment" style="margin-top: 20px;">  ' +
                        '   	<div class="pagelist__title pagelist-ligin__title">ОТПРАВИТЬ КОММЕНТАРИЙ</div>  ' +
                        '   	<div class="pagelist-ligin clear">  ' +
                        '   		<div class="answer-avatar">  ' +
                        '   			<div class="avatar-profile--mini-image avatar-profile-m"><img src="' + avatar + '" alt=""></div>  ' +
                        '   		</div>  ' +
                        '   		<div class="answer-layout">  ' +
                        '   			<div class="answer-layout-place parent-sticker">  ' +
                        '   				<textarea></textarea>  ' +
                        '   				<div class="sticker-item-elements">  ' +
                        '   					<div class="sticker-elements">  ' +
                        '   						<ul>  ' +
                        '   							<li class="comment_add_i"><i>I</i></li>  ' +
                        '   							<li class="comment_add_b"><b>B</b></li>  ' +
                        '   							<li class="comment_add_quote">Цитата</li>  ' +
                        '   							<li class="comment_add_spoiler">Спойлер</li>  ' +
                        '   						</ul>  ' +
                        '   					</div>  ' +
                        '   				</div>  ' +
                        '   				<div class="answer-button">  ' +
                        '   					<button class="button button4 send">Отправить</button>  ' +
                        '   				</div>  ' +
                        '   			</div>  ' +
                        '   		</div>  ' +
                        '   	</div>  ' +
                        '  </div>');
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-login-item').addClass('active');
                }

                return false;
            });

            $(document).on('click', '.quote', function(e){
                e = e || window.event;
                e.preventDefault();

                $('.extra_comment').remove();

                if (authProb) {
                    var avatar = $('#myAvatar').find('img').attr('src');
                    var id = $(this).parent().parent().parent().find('.author-comments-text').attr('data-id');
                    if (0 < id) {
                        var text = $('.author-comments-text[data-id=' + id + ']').text();
                        text = '[quote=' + id + ']' + text + '[/quote]';
                        $(this).parent().parent().append('<div class="row-pagelist-ligin extra_comment" style="margin-top: 20px;">  ' +
                            '   	<div class="pagelist__title pagelist-ligin__title">ОТПРАВИТЬ КОММЕНТАРИЙ</div>  ' +
                            '   	<div class="pagelist-ligin clear">  ' +
                            '   		<div class="answer-avatar">  ' +
                            '   			<div class="avatar-profile--mini-image avatar-profile-m"><img src="' + avatar + '" alt=""></div>  ' +
                            '   		</div>  ' +
                            '   		<div class="answer-layout">  ' +
                            '   			<div class="answer-layout-place parent-sticker">  ' +
                            '   				<textarea>' + text + '</textarea>  ' +
                            '   				<div class="sticker-item-elements">  ' +
                            '   					<div class="sticker-elements">  ' +
                            '   						<ul>  ' +
                            '   							<li class="comment_add_i"><i>I</i></li>  ' +
                            '   							<li class="comment_add_b"><b>B</b></li>  ' +
                            '   							<li class="comment_add_quote">Цитата</li>  ' +
                            '   							<li class="comment_add_spoiler">Спойлер</li>  ' +
                            '   						</ul>  ' +
                            '   					</div>  ' +
                            '   				</div>  ' +
                            '   				<div class="answer-button">  ' +
                            '   					<button class="button button4 send">Отправить</button>  ' +
                            '   				</div>  ' +
                            '   			</div>  ' +
                            '   		</div>  ' +
                            '   	</div>  ' +
                            '  </div>');
                    }
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-login-item').addClass('active');
                }

                return false;
            });

            window.clickCount = 0;

            $(document).on('click', '.send', function(){
                if (authProb) {
                    var button = this;
                    var text = $(this).parent().parent().parent().parent().find('textarea').val();
                    var id = 0;
                    if (!$(this).hasClass('main')) {
                        id = $(this).parent().parent().parent().parent().parent().parent().parent().find('.author-comments-text').attr('data-id');
                    }

                    if (1 < text.length) {
                        $.ajax({
                            url: '/user/' + login + '?handler=addComment',
                            type: "POST",
                            data: "relatedId=<?= $newsId ?>&parent=" + id + "&type=news&text=" + text,
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
                                    if (0 == id) {
                                        $('#commentList').append( '   <div class="parent-author-full-comments row-author-full-comments with-answer">  '  +
                                            '   <div class="author-full-comments-image"> <a href="/user/' + login + '/"><img src="' + avatar + '" alt=""></a></div>  '  +
                                            '   <div class="author-full-comments-content"><div class="author-comments-name"><a href="/user/' + login + '/">' + login + '</a></div><div class="author-comments-text" data-parent="0" data-id="0" style="">' + text + '</div>  '  +
                                            '   	<div class="author-comments-info clear">  '  +
                                            '   		<ul class="author-comment-info-list">  '  +
                                            '   			<li class="reply"><a href="#"></a></li>  '  +
                                            '   			<li class="quote"><a href="#"></a></li>  '  +
                                            '   			<li class="date">новый комментарий, будет добавлен в течении минуты</li>  '  +
                                            '   		</ul>  '  +
                                            '   		<div class="like-button clear">  '  +
                                            '   		</div>  '  +
                                            '   	</div>  '  +
                                            '     '  +
                                            '   </div>  '  +
                                            '  </div>  ');
                                    } else {
                                        $('.author-comments-text[data-id=' + id + ']').parent().append( '   <div class="parent-author-full-comments row-author-full-comments with-answer">  '  +
                                            '   <div class="author-full-comments-image"> <a href="/user/' + login + '/"><img src="' + avatar + '" alt=""></a></div>  '  +
                                            '   <div class="author-full-comments-content"><div class="author-comments-name"><a href="/user/' + login + '/">' + login + '</a></div><div class="author-comments-text" data-parent="0" data-id="0" style="">' + text + '</div>  '  +
                                            '   	<div class="author-comments-info clear">  '  +
                                            '   		<ul class="author-comment-info-list">  '  +
                                            '   			<li class="reply"><a href="#"></a></li>  '  +
                                            '   			<li class="quote"><a href="#"></a></li>  '  +
                                            '   			<li class="date">новый комментарий, будет добавлен в течении минуты</li>  '  +
                                            '   		</ul>  '  +
                                            '   		<div class="like-button clear">  '  +
                                            '   		</div>  '  +
                                            '   	</div>  '  +
                                            '     '  +
                                            '   </div>  '  +
                                            '  </div>  ');


                                        $('.extra_comment').remove();
                                    }

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
                    $('.my-overlay .overlay-login-item').addClass('active');
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

                $.ajax({
                    url: '/user/' + login + '?handler=getNewsVote&relatedId=<?= $newsId ?>',
                    type: "POST",
                    success: function (data) {
                        data = JSON.parse(data);
                        var key, id;
                        for (key in data['like']) {
                            if (data['like'].hasOwnProperty(key)) {
                                id = data['like'][key];
                                $('.like[data-id=' + id + ']').addClass('active');
                            }
                        }
                        for (key in data['dislike']) {
                            if (data['dislike'].hasOwnProperty(key)) {
                                id = data['dislike'][key];
                                $('.dislike[data-id=' + id + ']').addClass('active');
                            }
                        }
                    },
                    complete: function () {
                    },
                    error: function () {
                    },
                    timeout: 5000
                });
            }

            $('.like-button .like , .like-button .dislike').click(function() {
                if (authProb) {
                    var par = $(this).parents('.like-button');

                    var ttt = $(par).children('.dislike');
                    if($(this).is('.like') && ttt.is('.active')) {
                        ttt.removeClass('active');
                        ttt.next('.number').html( (parseInt(ttt.next('.number').html() - 1)) );
                        if(ttt.next('.number').html() == 0){
                            ttt.next('.number').attr('data-type','default');
                        }
                    }
                    ttt = $(par).children('.like');
                    if($(this).is('.dislike') && ttt.is('.active')) {
                        ttt.removeClass('active');
                        ttt.next('.number').html( (parseInt(ttt.next('.number').html() - 1)) );
                        if(ttt.next('.number').html() == 0){
                            ttt.next('.number').attr('data-type','default');
                        }
                    }

                    if($(this).parents('.like-button').find('.active').attr('class') == undefined){
                        $(this).addClass('active');
                        if(parseInt($(this).next('.number').html()) == 0 ) {
                            if($(this).is('.like')) {
                                $(this).next('.number').attr('data-type','more');
                            }
                            if($(this).is('.dislike')) {
                                $(this).next('.number').attr('data-type','less');
                            }
                        }
                        $(this).next('.number').html( (parseInt($(this).next('.number').html()) + 1) );
                        var id =$(this).attr('data-id');
                        if($(this).is('.like')) {
                            $.ajax({
                                url: '/user/' + login + '?handler=likeComment&id=' + id,
                                type: "POST",
                                success: function (data) {
                                },
                                complete: function () {
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        }
                        if($(this).is('.dislike')) {
                            $.ajax({
                                url: '/user/' + login + '?handler=dislikeComment&id=' + id,
                                type: "POST",
                                success: function (data) {
                                },
                                complete: function () {
                                },
                                error: function () {
                                },
                                timeout: 5000
                            });
                        }
                    }
                } else {
                    $('.my-overlay').addClass('active');
                    $('.my-overlay .overlay-login-item').addClass('active');
                }
            });

            var slider = $('.bxslider').bxSlider({
                auto: false,
                pager: false,
                adaptiveHeight: true,
                onSliderLoad: function(){
                    $(".bxslider").css("visibility", "visible");
                }
            });
            $('.bxslider').click(function() {
                slider.goToNextSlide();
                return false;
            });

            $('.w-img-layer').click(function(){
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/film/?handler=getTrailer&id=' + id,
                    type: "POST",
                    success: function (data) {
                        data = JSON.parse(data);
                        if ('' != data.src) {
                            $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                                '<source src="' + data.src + '" type=\'video/mp4\'>' +
                                '<p class="vjs-no-js">' +
                                'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                                '</p>' +
                                '</video>'
                            );
                            var width = 800;
                            if (800 >= $(window).width()) {
                                width = $(window).width();
                            }
                            var player = videojs('trailer_video', { "controls": true, "autoplay": true, "preload": "auto", "width": width }, function() {
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

            $('.my-overlay-bg').click(function(event) {
                var oldPlayer = document.getElementById('trailer_video');
                if (null !== oldPlayer) {
                    videojs(oldPlayer).dispose();
                }
                $('.my-overlay').removeClass('active');
                $('.my-overlay .my-overlay-item').removeClass('active');
            });
        });
    </script>
</body>
</html>
