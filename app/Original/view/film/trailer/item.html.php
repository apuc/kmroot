<?php
/**
 * @var int $id
 * @var int $trailerId
 * @var array $min
 * @var array $list
 * @var string $static
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Person\Trailer as Trailer;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ('' == $min[Film::NAME_RU]): ?>
        <title><?= $list['item'][Trailer::NAME] ?> к фильму <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="<?= $list['item'][Trailer::NAME] ?>  и полная информация о фильме «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер <?= $list['item'][Trailer::NAME] ?> "/>

        <meta property="og:title" content="<?= $list['item'][Trailer::NAME] ?>  к фильму <?= $min[Film::NAME_ORIGIN] ?>" />
        <meta property="og:description" content="<?= $list['item'][Trailer::NAME] ?>  и полная информация о фильме <?= $min[Film::NAME_ORIGIN] ?>."/>
    <?php else: ?>
        <title><?= $list['item'][Trailer::NAME] ?> к фильму <?= $min[Film::NAME_RU] ?> | <?= $min[Film::NAME_ORIGIN] ?> | Смотреть трейлеры онлайн в HD качестве на KINOMANIA.RU</title>
        <meta name="description" content="<?= $list['item'][Trailer::NAME] ?>  и полная информация о фильме «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых фильмов, биографии актёров, обои на рабочий стол и многое другое из мира кино."/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?> трейлер фильм смотреть онлайн hd скачать mp4 официальный русский тизер <?= $list['item'][Trailer::NAME] ?> "/>

        <meta property="og:title" content="<?= $list['item'][Trailer::NAME] ?>  к фильму <?= $min[Film::NAME_RU] ?>" />
        <meta property="og:description" content="<?= $list['item'][Trailer::NAME] ?>  и полная информация о фильме <?= $min[Film::NAME_RU] ?>."/>
    <?php endif ?>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $list['item'][Trailer::ID] ?>" />
	<link rel="canonical" href="http://www.kinomania.ru/film/<?= $id ?>/trailers/<?= $list['item'][Trailer::ID] ?>" />
    <!-- include section/head.html.php -->
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
            <div class="head-content">
                <div class="info-user">
                    <?php if ('' == $min[Film::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_ORIGIN] ?></a></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_RU] ?></a></h1>
                        <h2 class="name__page"><a href="/film/<?= $id ?>/"><?= $min[Film::NAME_ORIGIN] ?></a></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include film/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-pagelist header-search header-pagelist--black">
                        <div class="inner-header-pagelist">
                            <div class="pagelist-title-black "><?= $list['item'][Trailer::NAME] ?></div>
                            <div class="section-video section-black-video">
                                <div class="outer-trailer-item">
                                    <div class="">
                                        <div class="trailer-list-item">
                                            <div class="video-prewiew video_top">
                                                <img alt="" src="<?= $list['item'][Trailer::IMAGE] ?>" class="responsive-image video-prewiew__item">
                                            </div>
                                            <div class="head-desc clear">
                                                <div class="trailer__title">
                                                    <p class="create__trailer-date">Добавлен: <?= $list['item'][Trailer::DATE] ?></p>
                                                </div>

                                                <div class="item item2">
                                                    <a href="/film/<?= $list['item'][Trailer::FILM_ID] ?>/trailers/<?= $list['item'][Trailer::ID] ?>#commentList">
                                                    <span class="button button3">
                                                        <i class="item__icon sprite"></i>
                                                        <?php if (0 < $list['item'][Trailer::COMMENT]): ?>
                                                            <span class="number"><?= $list['item'][Trailer::COMMENT] ?></span>
                                                        <?php endif ?>
                                                        Комментировать
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="download download-trailer">
                                    <div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
                                        <div class="outer-dop-download">
                                            <div class="dop-download">
                                                <?php if ('' != $list['item'][Trailer::HD_480]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_480] ?>">Низкое</a>
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_480] ?>">HD 480</a>
                                                    </div>
                                                <?php endif ?>
                                                <?php if ('' != $list['item'][Trailer::HD_720]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_720] ?>">Среднее</a>
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_720] ?>">HD 720</a>
                                                    </div>
                                                <?php endif ?>
                                                <?php if ('' != $list['item'][Trailer::HD_1080]): ?>
                                                    <div class="dop-download-item">
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_1080] ?>">Высокое</a>
                                                        <a href="/load/n?file=<?= $list['item'][Trailer::HD_1080] ?>">HD 1080</a>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="outer-social clear">
                                    <ul class="social-list social-list--horizontal">
                                        <li class="vk" id="vk_item_share"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list['item'][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list['item'][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                        <li class="fb" id="fb_item_share"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list['item'][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list['item'][Trailer::ID] ?>&src=sp/"><span class="number"></span></a></li>
                                        <li class="ok" id="ok_item_share"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list['item'][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list['item'][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                        <li class="pinterest" id="pt_item_share"><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $list['item'][Trailer::FILM_ID] ?>%2Ftrailers%2F<?= $list['item'][Trailer::ID] ?>/"><span class="number"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="full-comments" id="commentList">
                        <div class="full-comments-head">
                            <div class="full-comments-text">КОММЕНТАРИИ <span class="number"><?php if (0 < $list['count']): ?> <?= $list['count'] ?>   <?php endif ?></span></div>
                        </div>
                        <?php if (0 < $list['count']): ?>
                            <?php \Kinomania\System\Data\Comment::print($list['list']) ?>
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
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
<link rel="stylesheet" href="<?= $static ?>/app/css/videojs.ads.css">
<script src="<?= $static ?>/app/js/video.ie8.js"></script>
<script src="<?= $static ?>/app/js/video.js"></script>
<script src="<?= $static ?>/app/js/videojs.ads.js"></script>
<script src="<?= $static ?>/app/js/videojs-preroll.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
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

    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

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

        $(document).on("mouseenter", "#commentList .author-comments-text", function() {
            $('.author-comments-text').css("background", "");
            $(this).css("background", "#FBFBFB");
            var parent = $(this).attr('data-parent');
            while (0 != parent) {
                var el = $('.author-comments-text[data-id=' + parent + ']');
                $(el).css("background", "#FBFBFB");
                parent = $(el).attr('data-parent');
            }
        }).on("mouseleave", "#commentList .author-full-comments-content", function() {
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
                $('.my-overlay .overlay-auth-item').addClass('active');
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
                $('.my-overlay .overlay-auth-item').addClass('active');
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
                        data: "relatedId=<?= $trailerId ?>&parent=" + id + "&type=trailer&text=" + text,
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
                $('.my-overlay .overlay-auth-item').addClass('active');
            }
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
                url: '/user/' + login + '?handler=getTrailerVote&relatedId=<?= $trailerId ?>',
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

        $('.video_top').click(function(){
            var href = $(this).parent().parent().parent().parent().find('.dop-download').find('a:last').attr('href');
            if ('' != href) {
                href = href.split('file=');
                href = href[1];
                if (-1 !== href.indexOf('.mp4')) {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/mp4\'>' +
                        '<p class="vjs-no-js">' +
                        'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
                        '</p>' +
                        '</video>'
                    );
                } else {
                    $('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
                        '<source src="' + href + '" type=\'video/flv\'>' +
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
        });


        $('.my-overlay-bg').click(function(event) {
            var oldPlayer = document.getElementById('trailer_video');
            if (null !== oldPlayer) {
                videojs(oldPlayer).dispose();
            }

            $('.my-overlay').removeClass('active');
            $('.my-overlay .overlay-auth-item').removeClass('active');
            $('.my-overlay .overlay-trailer-item').removeClass('active');
        });

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
            $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=http://www.kinomania.ru/film/<?= $list['item'][Trailer::FILM_ID] ?>/trailers/<?= $list['item'][Trailer::ID] ?>&format=json&callback=?');

            $.getJSON('http://graph.facebook.com/?id=http://www.kinomania.ru/film/<?= $list['item'][Trailer::FILM_ID] ?>/trailers/<?= $list['item'][Trailer::ID] ?>&callback=?', function (data) {
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
            $.getJSON('http://www.odnoklassniki.ru/dk?st.cmd=extOneClickLike&uid=odklocs0&ref=http://www.kinomania.ru/film/<?= $list['item'][Trailer::FILM_ID] ?>/trailers/<?= $list['item'][Trailer::ID] ?>&callback=?');

            $.getJSON('http://api.pinterest.com/v1/urls/count.json?url=http://www.kinomania.ru/film/<?= $list['item'][Trailer::FILM_ID] ?>/trailers/<?= $list['item'][Trailer::ID] ?>&callback=?', function (data) {
                $('#pt_item_share span').text(data.count);
            });
        }, 1500);
    });
</script>
</body>
</html>
