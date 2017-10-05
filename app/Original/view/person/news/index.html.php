<?php
/**
 * @var int $id
 * @var array $min
 * @var string $static
 * @var array $list
 * @var array $stat
 */
use Kinomania\Original\Key\Person\Person as Person;
use Kinomania\Original\Key\Person\Award as Award;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $min[Person::TITLE] ?>: новости | KINOMANIA.RU</title>
    <meta name="description" content="<?= $min[Person::TITLE] ?>: новости на KINOMANIA.RU. Фильмография, биография, факты, новости и многое другое о звёздах мирового кинематографа."/>
    <meta name="keywords" content="<?= $min[Person::TITLE] ?> новости"/>

	<link rel="canonical" href="http://www.kinomania.ru/people/<?= $id ?>/news"/>

    <meta property="og:title" content="<?= $min[Person::TITLE] ?> новости" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/people/<?= $id ?>/news" />
    <meta property="og:description" content=""/>

    <!-- include section/head.html.php -->
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
                    <div class="row-actor-news">
                        <div class="outer-pagelist-item clear">
                            <?php foreach ($list as $item): ?>
                                <div class="pagelist-item clear">
                                    <div class="pagelist-item-image news-pagelist-item-image col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class=" image-shadow ">
                                            <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/"><img alt="" src="//:0" data-original="<?= $item['image'] ?>" class="lazy responsive-image  image-prewiew"   style="width: 365px; height: 199px;"></a>
                                        </div>
                                    </div>
                                    <div class="pagelist-item-content news-pagelist-item-content col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="pagelist-item-title">
                                            <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/"><?= $item['title'] ?></a>
                                        </div>
                                        <p>
                                            <?= $item['anons'] ?>
                                        </p>
                                        <div class="pagelist-info">
                                            <span class="date__month"><?= $item['publish'] ?></span>
                                            <?php if (0 < $item['comment']): ?>
                                                <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>#commentList/" class="pagelist__comments"><?= $item['comment'] ?></a>
                                            <?php endif ?>
                                        </div>
                                        <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/" class="pagelist__link">Подробнее</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="people/<?= $id ?>/news"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fnews/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="people/<?= $id ?>/news"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fnews&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fpeople%2F<?= $id ?>%2Fnews/"></a></li>
                            </ul>
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
                              var html = '<div class="pagelist-item clear">' +
                                      '<div class="pagelist-item-image news-pagelist-item-image col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                      '<div class=" image-shadow ">' +
                                      '<a href="/' + data[key]['category'] + '/' + data[key]['id'] + '/"><img alt="" src="//:0" data-original="' + data[key]['image'] + '" class="lazy image-prewiew" style="width: 365px;height: 199px;"></a>' +
                                      ' </div> </div>' +
                                      '<div class="pagelist-item-content news-pagelist-item-content col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                                      '<div class="pagelist-item-title">' +
                                      '<a href="/' + data[key]['category'] + '/' + data[key]['id'] + '/">' + data[key]['title'] + '</a>' +
                                      '</div>' +
                                      '<p>' +
                                      data[key]['anons'] +
                                      '</p>' +
                                      '<div class="pagelist-info">' +
                                      '<span class="date__month">' + data[key]['publish'] + '</span>';
                                      if (0 < data[key]['comment']) {
                                          html += '<a href="/' + data[key]['category'] + '/' + data[key]['id'] + '#commentList/" class="pagelist__comments">' + data[key]['comment'] + '</a>';
                                      }
                                      html += '</div>' +
                                      '<a href="/' + data[key]['category'] + '/' + data[key]['id'] + '/" class="pagelist__link">Подробнее</a>' +
                                      '</div></div>';

                              $('.outer-pagelist-item').append(html);
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
      });
  </script>
</body>
</html>
