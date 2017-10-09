<?php
/**
 * @var string $login
 * @var string $static
 * @var array $list
 * @var array $min
 */
use Kinomania\Original\Key\User\User;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Комментарии пользователя <?= $login ?></title>

    <!-- include section/head.html.php -->
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
                    <h2 class="name__page"><?= $min[User::NAME] ?> <?= $min[User::SURNAME] ?></h2>
                </div>
                <div class="nav-content">
                    <!-- include user/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content profile-section-content section-content content-outercol-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-user-comments">
                        <div class="profile-comments profile-section-item">
                            <?php foreach ($list as $item): ?>
                                <div class="profile-comments__item clear">
                                    <div class="profile-comment-preview profile-comment--left">
                                        <a href="<?= $item['link'] ?>/"><img src="//:0" data-original="<?= $item['image'] ?>" class="lazy profile-comment-image"></a>
                                        <div class="profile-comment-title">
                                            <a href="<?= $item['link'] ?>/"><?= $item['title'] ?></a>
                                        </div>
                                    </div>
                                    <div class="profile-comment-content profile-comment--right">
                                        <div class="profile-comment-heading"><?= $item['date'] ?></div>
                                        <div class="profile-comment-value">
                                            <?= $item['text'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="outer-pagelist-more">
                        <?php if (11 < count($list)): ?>
                            <div class="center-loader" style="display: none;">
                                <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                            </div>
                            <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                        <?php endif ?>
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
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        window.page = 1;
        $('#more').click(function(){
            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);

            $('.center-loader').show();
            $('.pagelist-more').hide();
            window.page += 1;
            var page = window.page;

            $("img.lazy").attr('proc', 'true');

            $.ajax({
                "type": "post",
                "url": "?handler=get&page=" + page,
                "success": function(data){
                    data = JSON.parse(data);

                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            var html = '<div class="profile-comments__item clear">  '  +
                            '   	<div class="profile-comment-preview profile-comment--left">  '  +
                            '   		<a href="' + data[key]['link'] + '/"><img src="//:0" data-original="' + data[key]['image'] + '" class="lazy profile-comment-image"></a>  '  +
                            '   		<div class="profile-comment-title">  '  +
                            '   			<a href="' + data[key]['link'] + '/">' + data[key]['title'] + '</a>  '  +
                            '   		</div>  '  +
                            '   	</div>  '  +
                            '   	<div class="profile-comment-content profile-comment--right">  '  +
                            '   		<div class="profile-comment-heading">' + data[key]['date'] + '</div>  '  +
                            '   		<div class="profile-comment-value">  '  +
                            data[key]['text'] +
                            '   		</div>  '  +
                            '   	</div>  '  +
                            '  </div>';

                            $('.profile-comments').append(html);
                        }
                    }

                    $("img.lazy[proc!=true]").lazyload({
                        effect : "fadeIn"
                    });
                    $("img.lazy").attr('proc', 'true');

                    if (12 > data.length) {
                        $('.pagelist-more').hide();
                    } else {
                        $('.pagelist-more').show();
                    }
                },
                complete: function() {
                    me.data('requestRunning', false);
                    $('.center-loader').hide();
                }
            });
        });
    })
</script>
  <?php BodyScript::getContent();?>

</body>
</html>