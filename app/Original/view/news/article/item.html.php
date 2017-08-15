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

    <meta property="og:title" content="<?= $item[News::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <?php if ('' != $item[News::IMAGE]): ?>
    <meta property="og:image" content="http:<?= $item[News::IMAGE] ?>" />
    <?php endif ?>
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.kinomania.ru/news/<?= $newsId ?>" />
    <meta property="og:description" content="<?= $item[News::ANONS_STRIPED] ?>"/>

    <!-- include section/head.html.php -->

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
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
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
