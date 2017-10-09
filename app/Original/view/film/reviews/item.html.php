<?php
/**
 * @var int $id
 * @var int $reviewId
 * @var array $item
 * @var array $min
 */
use Kinomania\Original\Key\Film\Film;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Комментарии рецензии №<?= $reviewId ?> к фильму <?= $min[Film::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Комментарии рецензии №<?= $reviewId ?> к фильму «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых сериалов, трейлеры, биографии актёров, обои на рабочий стол и многое другое из мира кино"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, фильм, рецензия №<?= $reviewId ?>, комментарии"/>
    <?php else: ?>
        <meta name="description" content="Комментарии рецензии №<?= $reviewId ?> к фильму «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых сериалов, трейлеры, биографии актёров, обои на рабочий стол и многое другое из мира кино"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, фильм, рецензия №<?= $reviewId ?>"/>
    <?php endif ?>

    <!-- include section/head.html.php -->

    <style>
        .inner-overlay-caption .text a {
            text-decoration: none;
        }
        .inner-overlay-caption .text a:after {
            content: ",  ";
        }
        .inner-overlay-caption .text a:last-child:after {
            content: "";
        }
        .row-reviews-list .row-author-full-comments {
            padding-bottom: 10px;
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
                    <!-- <h1 class="pagetitle mini__pagetitle">РЕЗУЛЬТАТЫ ПОИСКА</h1> -->
                    <div class="row-reviews-list full-comments-reviews" id="review">

                    </div>
                    <br />
                    <div class="full-comments" id="commentList">
                        <div class="full-comments-head">
                            <div class="full-comments-text">КОММЕНТАРИИ <span class="number"><?php if (0 < $item['count']): ?> <?= $item['count'] ?>   <?php endif ?></span></div>
                        </div>
                        <?php if (0 < $item['count']): ?>
                            <?php \Kinomania\System\Data\Comment::print($item['list']) ?>
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
                            data: "relatedId=<?= $reviewId ?>&parent=" + id + "&type=film&text=" + text,
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
                    url: '/user/' + login + '?handler=getFilmVote&relatedId=<?= $reviewId ?>',
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

            $('.my-overlay-bg').click(function(event) {
                $('.my-overlay').removeClass('active');
                $('.my-overlay .my-overlay-item').removeClass('active');
            });


            $.ajax({
                url: '?handler=getReview',
                type: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.hasOwnProperty(0)) {
                        $('#review').html('<div class="author-full-comments-image">  ' +
                            '   		<a href="/user/' + data[0]['login'] + '/"><img width="48" src="' + data[0]['avatar'] + '" alt=""></a>  ' +
                            '   	</div>  ' +
                            '   	<div class="author-full-comments-content">  ' +
                            '   		<div class="author-comments-name author-reviews-name"><a href="/user/' + data[0]['login'] + '/">' + data[0]['name'] + '</a></div>  ' +
                            '   		<div class="author-comments-text">  ' +
                            data[0]['text'] +
                            '   		</div>  ' +
                            '   		<div class="author-comments-info clear">  ' +
                            '   			<ul class="author-comment-info-list">  ' +
                            '   				<li class=" reply__like"><a href="#" class="vote_item" data-id="' + data[0]['id'] + '"><span>Мне нравится</span>  ' +
                            '   						<i class="reply__icon reply__like_icon"></i>  ' +
                            '   						<span class="value">' + data[0]['vote'] + '</span>  ' +
                            '   					</a>  ' +
                            '   				</li>  ' +
                            '   				<li class="reply__comments">  ' +
                            '   					<a href="#commentList">  ' +
                            '   						<span>Комментировать</span>  ' +
                            '   						<i class="reply__icon reply__comment_icon"></i>  ' +
                            '   						<span class="value">' + data[0]['comment'] + '</span>  ' +
                            '   					</a>  ' +
                            '   				</li>  ' +
                            '   				<li class="date">' + data[0]['date'] + '</li>  ' +
                            '   			</ul>  ' +
                            '   		</div>  ' +
                            '   	</div> <br />');

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
                    }
                },
                error: function () {
                },
                timeout: 5000
            });
        });
    </script>
<?php BodyScript::getContent();?>
</body>
</html>
