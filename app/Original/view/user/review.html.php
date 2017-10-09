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

    <title>Рецензии пользователя <?= $login ?></title>

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
                    <div class="row-user-reviews">
                        <?php foreach ($list as $item): ?>
                            <div class="user-reviews-item clear">
                                <div class="user-reviews-info clear">
                                    <div class="user-reviews-image">
                                        <div class="section-result-item item1  list-preview">
                                            <a href="/film/<?= $item['filmId'] ?>/">
                                              <span>
                                                <img src="//:0" data-original="<?= $item['image'] ?>" class="lazy image-padding--white" alt="">
                                              </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="user-reviews-name">
                                        <?php if ('' == $item['name_ru']): ?>
                                            <a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_origin'] ?></a>
                                        <?php else: ?>
                                            <a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_origin'] ?></a>
                                            <span class="user-reviews-name-eng"><?= $item['name_origin'] ?></span>
                                        <?php endif; ?>

                                        <span><?= $item['country'] ?> <?= $item['year'] ?></span>
                                    </div>
                                </div>
                                <div class="user-reviews-content clear">
                                    <div class="user-reviews-text">
                                        <?= $item['text'] ?>
                                    </div>
                                    <div class="user-reviews-comments">
                                        <div class="pagelist-info">
                                            <span class="date__month"><?= $item['date'] ?></span>
                                            <a href="/film/<?= $item['filmId'] ?>/reviews/<?= $item['id'] ?>#commentList/" class="pagelist__comments"><?= $item['comment'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                            var html =  '   <div class="user-reviews-item clear">  '  +
                                '   	<div class="user-reviews-info clear">  '  +
                                '   		<div class="user-reviews-image">  '  +
                                '   			<div class="section-result-item item1  list-preview">  '  +
                                '   				<a href="/film/' + data[key]['filmId'] + '/">  '  +
                                '   				  <span>  '  +
                                '   					<img src="//:0" data-original="' + data[key]['image'] + '" class="lazy image-padding--white" alt="">  '  +
                                '   				  </span>  '  +
                                '   				</a>  '  +
                                '   			</div>  '  +
                                '   		</div>  '  +
                                '   		<div class="user-reviews-name">  ';
                            if ('' == data[key]['name_ru']) {
                                html += '<a href="/film/' + data[key]['filmId'] + '/">' + data[key]['name_origin'] + '</a>  ';
                            } else {
                                html += '<a href="/film/' + data[key]['filmId'] + '/">' + data[key]['name_ru'] + '</a>  ' +
                                        ' <span class="user-reviews-name-eng">' + data[key]['name_origin'] + '</span>';
                            }
                            html += '   			<span>' + data[key]['country'] + ' ' + data[key]['year'] + '</span>  '  +
                                '   		</div>  '  +
                                '   	</div>  '  +
                                '   	<div class="user-reviews-content clear">  '  +
                                '   		<div class="user-reviews-text">  '  +
                                data[key]['text'] +
                                '   		</div>  '  +
                                '   		<div class="user-reviews-comments">  '  +
                                '   			<div class="pagelist-info">  '  +
                                '   				<span class="date__month">' + data[key]['date'] + '</span>  '  +
                                '   				<a href="/film/' + data[key]['filmId'] + '/reviews/' + data[key]['id'] + '#commentList/" class="pagelist__comments">' + data[key]['comment'] + '</a>  '  +
                                '   			</div>  '  +
                                '   		</div>  '  +
                                '   	</div>  '  +
                                '  </div>  ' ;

                            $('.row-user-reviews').append(html);
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