<?php
/**
 * @var string $login
 * @var string $static
 * @var array $item
 */
use Kinomania\Original\Key\User\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Профиль пользователя <?= $login ?></title>
    <meta name="description" content="Профиль пользователя на сайте KINOMANIA.RU"/>

    <meta property="og:title" content="Профиль пользователя <?= $login ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/user/<?= $login ?>" />
    <meta property="og:description" content="Профиль пользователя на сайте KINOMANIA.RU"/>

    <!-- include section/head.html.php -->
    <style>
        .notifyjs-foo-base {
            opacity: 0.85;
            background: #F5F5F5;
            padding: 5px;
            border-radius: 10px;
            position: relative;
        }

        .notifyjs-foo-base .title {
            margin: 10px 0 0 10px;
            text-align: left;
            position: relative;
            top: -4px;
        }

        .notifyjs-foo-base .buttons {
            font-size: 9px;
            position: absolute;
            top: 2px;
            right: 5px;
        }

        .notifyjs-foo-base button {
            font-size: 9px;
            outline: 0;
            border: 0;
            padding: 5px !important;
            margin: 0 !important;
            width: auto !important;
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
            <div class="head-content">
                <div class="info-user">
                    <h1 class="pagetitle mini__pagetitle login__user" id="login"><?= $login ?></h1>
                    <h2 class="name__page"><?= $item[User::NAME] ?> <?= $item[User::SURNAME] ?></h2>
                </div>
                <div class="nav-content">
                    <!-- include user/section/menu.html.php -->        
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content profile-section-content section-content content-outercol-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="list-content">
                        <div class="user-head row-profile-item profile-item-chief">
                            <div class="user-head--left">
                                <div class="section-result-item list-preview">
                                    <a href="#login" style="cursor:default;">
                                        <span>
                                          <img class=" image-padding--white" src="<?= $item[User::IMAGE] ?>" alt="">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="user-head--right">
                                <div class="profile-item profile-item-chief">
                                    <div class="profile profile__title">ПРОФИЛЬ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::BIRTHDAY])): ?>
                                            <li class="date__user">Дата рождения: <span class="value"><?= $item[User::BIRTHDAY] ?></span></li>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::REGISTRATION])): ?>
                                            <li class="date-registration">Дата регистрации: <span class="value"><?= $item[User::REGISTRATION] ?></span></li>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::SEX])): ?>
                                            <?php if ('male' == $item[User::SEX]): ?>
                                                <li class="gender">Пол: <span class="value">мужчина</span></li>
                                            <?php else: ?>
                                                <li class="gender">Пол: <span class="value">женщина</span></li>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if (!empty($item[User::CITY])): ?>
                                            <li class="city">Город: <span class="value"><?= $item[User::CITY] ?></span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <div class="profile profile__title">О СЕБЕ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::ABOUT])): ?>
                                            <li><span class="value"><?= $item[User::ABOUT] ?></span></li>
                                        <?php else :?>
                                            <li><span class="value">Информация отсутствует</span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <div class="profile profile__title">ИНТЕРЕСЫ</div>
                                    <ul class="profile-value-list">
                                        <?php if (!empty($item[User::INTEREST])): ?>
                                            <li><span class="value"><?= $item[User::INTEREST] ?></span></li>
                                        <?php else :?>
                                            <li><span class="value">Информация отсутствует</span></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="profile-item">
                                    <?php if ($item[User::IS_SOCIAL]): ?>
                                        <div class="profile profile__title">СОЦСЕТИ</div>
                                        <ul class="profile-value-list profile-value-list__social pagelist-ligin__social-list">
                                            <?php if (!empty($item[User::VK])): ?>
                                                <li class="vk"><a href="//vk.com/<?= $item[User::VK] ?>/" rel="nofollow"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::FB])): ?>
                                                <li class="fb"><a href="//facebook.com/profile.php?id=<?= $item[User::FB] ?>/"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::TWITTER])): ?>
                                                <li class="tw"><a href="//twitter.com/<?= $item[User::TWITTER] ?>/" rel="nofollow"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::MY_MAIL])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::MY_MAIL] ?>/" rel="nofollow"><img src="/app/img/icon-socials/mailru.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::INSTAGRAM])): ?>
                                                <li class="tw"><a href="//instagram.com/<?= $item[User::INSTAGRAM] ?>/" rel="nofollow"><img src="/app/img/icon-socials/instagram.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::TG])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::TG] ?>/" rel="nofollow"><img src="/app/img/icon-socials/telegram.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::GOOGLE_PLUS])): ?>
                                                <li><a href="//plus.google.com/u/0/<?= $item[User::GOOGLE_PLUS] ?>/" rel="nofollow"><img src="/app/img/icon-socials/g-plus.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::LIVE_JOURNAL])): ?>
                                                <li class="tw"><a href="//<?= $item[User::LIVE_JOURNAL] ?>.livejournal.com/" rel="nofollow"><img src="/app/img/icon-socials/lg.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::ICQ])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::ICQ] ?>/" rel="nofollow"><img src="/app/img/icon-socials/icq.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::OK])): ?>
                                                <li class="tw"><a href="//ok.ru/profile/<?= $item[User::OK] ?>/" rel="nofollow"><img src="/app/img/icon-socials/ok.png"></a></li>
                                            <?php endif ?>
                                            <?php if (!empty($item[User::SKYPE])): ?>
                                                <li class="tw"><a class="tooltip" href="<?= $item[User::SKYPE] ?>/" rel="nofollow"><img src="/app/img/icon-socials/skype.png"></a></li>
                                            <?php endif ?>
                                        </ul>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="blog">

                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="comment">

                        </div>
                        <div class="row-profile-item row-profile-item-wihtsteacker" id="vote">

                        </div>
                        <div class="pagelist-social profile-pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="user/<?= $login ?>"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="user/<?= $login ?>"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fuser%2F<?= $login ?>/"></a></li>
                                </ul>
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
  <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    $.notify.addStyle('foo', {
        html:
        "<div>" +
        "<div class='clearfix'>" +
        "<div class='title' data-notify-html='title'/>" +
        "<div class='buttons'>" +
        "<button class='no'>x</button>" +
        "</div>" +
        "</div>" +
        "</div>"
    });
    $(document).on('click', '.notifyjs-foo-base .no', function() {
        $(this).trigger('notify-hide');
    });

    $(document).ready(function(){
        $('.tooltip').click(function(e){
            e = e || window.event;
            e.preventDefault();

            $(this).notify({title: $(this).attr('href')}, {
                position: "top",
                autoHide: false,
                clickToHide: false,
                style: 'foo'
            });

            return false;
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getBlog",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html = '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">БЛОГ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '  <div class="row-profile-item-content">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html += '<div class="profile-post-item">  '  +
                                '     <a href="/article/' + data[k]['id'] + '/" class="profile-post-item__title">' + data[k]['title'] + '</a>  '  +
                                '     <div class="profile-post-item__content">' + data[k]['anons'] + '</div>  '  +
                                '     <div class="profile-post-item__date">  '  +
                                '   	<div class="pagelist-info">  '  +
                                '   	  <span class="date__month">' + data[k]['publish'] + '</span>  '  +
                                '   	  <a href="/article/' + data[k]['id'] + '#commentList/" class="pagelist__comments">' + data[k]['comment'] + '</a>  '  +
                                '   	</div>  '  +
                                '     </div>  '  +
                                '     <div class="">  '  +
                                '   	<a href="/article/' + data[k]['id'] + '/" class="pagelist__link">Подробнее</a>  '  +
                                '     </div>  '  +
                                '  </div>';
                        }
                    }

                    html += '<div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/blog/' + data[0]['authorId'] + '/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '  </div>  ';

                    $('#blog').append(html);
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getComment",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html = '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">КОММЕНТАРИИ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '   <div class="row-profile-item-content">  '  +
                        '  <div class="profile-comments profile-section-item">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html += '<div class="profile-comments__item clear">  '  +
                                '   	<div class="profile-comment-preview profile-comment--left">  '  +
                                '   	  <div class="profile-comment-heading">К ' + data[k]['type'] + '</div>  '  +
                                '   	  <a href="' + data[k]['link'] + '#comment_' + data[k]['id'] + '/"><img src="//:0" data-original="' + data[k]['image'] + '" class="lazy profile-comment-image"></a>  '  +
                                '   	  <div class="profile-comment-title">  '  +
                                '   		<a href="' + data[k]['link'] + '#comment_' + data[k]['id'] + '/">' + data[k]['title'] + '</a>  '  +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '   	<div class="profile-comment-content profile-comment--right">  '  +
                                '   	  <div class="profile-comment-heading">' + data[k]['date'] + '</div>  '  +
                                '   	  <div class="profile-comment-value">  '  +
                                data[k]['text'] +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '    </div>';
                        }
                    }

                    html += '</div>  '  +
                        '   <div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/user/<?= $login ?>/comments/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '   </div>';
                    $('#comment').append(html);

                    $("img.lazy").lazyload({
                        effect : "fadeIn"
                    });
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });

        $.ajax({
            "type": "post",
            "url": "?handler=getVote",
            "success": function (data) {
                data = JSON.parse(data);
                if (data.length) {
                    var html =  '<div class="inner parent-sticker">  '  +
                        '   <div class="sticker">  '  +
                        '     <div class="sticker-item">ОЦЕНКИ</div>  '  +
                        '   </div>  '  +
                        '   </div>  '  +
                        '   <div class="row-profile-item-content">  '  +
                        '  <div class="rating-profile profile-section-item">';

                    for (var k in data) {
                        if (data.hasOwnProperty(k)) {
                            html +=  '<div class="rating-profile-item">  '  +
                                '   	<div class="section-result-content clear">  '  +
                                '   	  <div class="section-result-item item1  list-preview">  '  +
                                '   		<a href="/film/' + data[k]['id'] + '/">  '  +
                                '   		  <span>  '  +
                                '   			<img class="lazy image-padding--white" src="//:0" data-original="' + data[k]['image'] + '">  '  +
                                '   		  </span>  '  +
                                '   		</a>  '  +
                                '   	  </div>  '  +
                                '   	  <div class="section-result-item item2">  '  +
                                '   		<div class="profile-cinema-heading">' + data[k]['date'] + '</div>  '  +
                                '   		<div class="name"><a href="/film/' + data[k]['id'] + '/">' + data[k]['name_ru'] + '</a></div>  '  +
                                '   		<div class="name__eng">' + data[k]['name_origin'] + '</div>  '  +
                                '   		<div class="star-rating">  '  +
                                '   		  <span class="number">' + data[k]['rate'] + '</span>  '  +
                                '   		  из 10  '  +
                                '   		</div>  '  +
                                '   		<div class="main-raiting">Общий рейтинг фильма: <span class="number">' + data[k]['average'] + '</span></div>  '  +
                                '   	  </div>  '  +
                                '   	</div>  '  +
                                '    </div>';
                        }
                    }

                    html +=  '</div>  '  +
                        '   <div class="outer-pagelist-more">  '  +
                        '     <span class="pagelist-more sprite-before"><span class="pagelist-more__text"><a href="/user/<?= $login ?>/ratings/">Еще</a></span></span>  '  +
                        '   </div>  '  +
                        '  </div>  ';
                    $('#vote').append(html);

                    $("img.lazy").lazyload({
                        effect : "fadeIn"
                    });
                }
            },
            complete: function () {

            },
            error: function () {

            },
            timeout: 5000
        });
    });
</script>
</body>
</html>
