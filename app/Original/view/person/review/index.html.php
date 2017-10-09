<?php
/**
 * @var int $id
 * @var array $min
 * @var string $static
 * @var array $list
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Photo as Photo;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Отзывы о персоне <?= $min[Person::TITLE] ?> | KINOMANIA.RU</title>
    <?php if ('' == $min[Person::NAME_RU]): ?>
        <meta name="description" content="Отзывы о персоне «<?= $min[Person::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU. Обзоры новых сериалов, трейлеры, биографии актёров, обои на рабочий стол и многое другое из мира кино"/>
        <meta name="keywords" content="<?= $min[Person::NAME_ORIGIN] ?> отзывы обсуждение комментировать комментарий"/>

        <meta property="og:description" content="Отзывы о персоне «<?= $min[Person::NAME_ORIGIN] ?>»"/>
    <?php else: ?>
        <meta name="description" content="Отзывы о персоне «<?= $min[Person::NAME_RU] ?>» на сайте KINOMANIA.RU. Обзоры новых сериалов, трейлеры, биографии актёров, обои на рабочий стол и многое другое из мира кино"/>
        <meta name="keywords" content="<?= $min[Person::NAME_RU] ?>, <?= $min[Person::NAME_ORIGIN] ?> отзывы обсуждение комментировать комментарий"/>

        <meta property="og:description" content="Отзывы о персоне «<?= $min[Person::NAME_RU] ?>»"/>
    <?php endif ?>

    <meta property="og:title" content="Отзывы о персоне <?= $min[Person::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/reviews" />

	<link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/reviews"/>

    <!-- include section/head.html.php -->
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
                    <?php if ('' == $min[Person::NAME_RU]): ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h1>
                    <?php else: ?>
                        <h1 class="pagetitle mini__pagetitle"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_RU] ?></a></h1>
                        <h2 class="name__page"><a href="/people/<?= $id ?>/"><?= $min[Person::NAME_ORIGIN] ?></a></h2>
                    <?php endif ?>
                </div>
                <div class="nav-content">
                    <!-- include person/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-reviews-lis full-comments-reviews">
                        <?php foreach ($list as $item): ?>
                            <div class="parent-author-full-comments row-author-full-comments">
                                <div class="author-full-comments-image">
                                    <?php if ('' == $item['login']): ?>
                                        <img width="48" src="<?= $item['avatar'] ?>" alt="">
                                    <?php else: ?>
                                        <a href="/user/<?= $item['login'] ?>/"><img width="48" src="<?= $item['avatar'] ?>" alt=""></a>
                                    <?php endif ?>
                                </div>
                                <div class="author-full-comments-content">
                                    <div class="author-comments-name author-reviews-name">
                                        <?php if ('' == $item['login']): ?>
                                            <?= $item['name'] ?>
                                        <?php else: ?>
                                            <a href="/user/<?= $item['login'] ?>/"><?= $item['name'] ?></a>
                                        <?php endif ?>

                                    </div>
                                    <div class="author-comments-text">
                                        <?= $item['text'] ?>
                                    </div>
                                    <div class="author-comments-info clear">
                                        <ul class="author-comment-info-list">
                                            <li class=" reply__like"><a href="#" class="vote_item" data-id="<?= $item['id'] ?>"><span>Мне нравится</span>
                                                    <i class="reply__icon reply__like_icon"></i>
                                                    <span class="value"><?= $item['vote'] ?></span>
                                                </a>
                                            </li>
                                            <li class="reply__comments">
                                                <a href="/people/<?= $id ?>/reviews/<?= $item['id'] ?>">
                                                    <span>Комментировать</span>
                                                    <i class="reply__icon reply__comment_icon"></i>
                                                    <span class="value"><?= $item['comment'] ?></span>
                                                </a>
                                            </li>
                                            <li class="date"><?= $item['date'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br />
                        <?php endforeach; ?>
                    </div>
                    <br />
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/reviews"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Freviews/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/reviews"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Freviews&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Freviews/"></a></li>
                            </ul>
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
                </content>
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
    <script>
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
                                    $('.full-comments-reviews').append( '   <div class="parent-author-full-comments row-author-full-comments with-answer">  '  +
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

            $('.my-overlay-bg').click(function(event) {
                $('.my-overlay').removeClass('active');
                $('.my-overlay .my-overlay-item').removeClass('active');
            });

            $('.posters__image a').click(function(e){
                e.preventDefault();
            });
            $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px')
        });
    </script>
<?php BodyScript::getContent();?>
</body>
</html>
