<?php
/**
 * @var int $id
 * @var array $item
 * @var array $min
 */
use Kinomania\Original\Key\Film\Film;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> <?= $min[Film::TITLE] ?> | режиссеры, сценаристы, продюсеры | KINOMANIA.RU</title>
    <?php if ('' == $min[Film::NAME_RU]): ?>
        <meta name="description" content="Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> «<?= $min[Film::NAME_ORIGIN] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_ORIGIN] ?>, <?php if ('' == $item['type']): ?>фильм<?php else: ?>сериал<?php endif ?>, режиссеры, сценаристы, продюсеры"/>
        
        <meta property="og:description" content="Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> «<?= $min[Film::NAME_ORIGIN] ?>»"/>
    <?php else: ?>
        <meta name="description" content="Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> «<?= $min[Film::NAME_RU] ?>» на сайте KINOMANIA.RU"/>
        <meta name="keywords" content="<?= $min[Film::NAME_RU] ?>, <?= $min[Film::NAME_ORIGIN] ?>, <?php if ('' == $item['type']): ?>фильм<?php else: ?>сериал<?php endif ?>, режиссеры, сценаристы, продюсеры"/>
        
        <meta property="og:description" content="Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> «<?= $min[Film::NAME_RU] ?>»"/>
    <?php endif ?>

    <meta property="og:title" content="Создатели <?php if ('' == $item['type']): ?>фильма<?php else: ?>сериала<?php endif ?> <?= $min[Film::TITLE] ?>" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/film/<?= $id ?>/people/creators/" />

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
    <div class="my-overlay-item" data-type="overlay-auth">
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
                    <div class="row-actors">
                        <div class="row-tabs">
                            <ul class="tabs-list clear">
                                <li class="default" data-type-slidergroup="actors_creaters" data-type-sliderbutton="1"><a href="/film/<?= $id ?>/people/"><span>АКТЕРЫ</span></a></li>
                                <li class="active" data-type-slidergroup="actors_creaters" data-type-sliderbutton="2"><a><span>СОЗДАТЕЛИ</span></a></li>
                            </ul>
                        </div>
                        <div class="row-result-tabs active" data-type-slidergroup="actors_creaters" data-type-sliderelem="1">
                            <?php foreach ($item['list'] as $person): ?>
                                <div class="list-content-item-inner">
                                    <div class="section-result-content clear">
                                        <div class="section-result-item section-result-item-actor   list-preview">
                                            <a href="/people/<?= $person[0] ?>/">
                                        <span>
                                          <img class="lazy image-padding--white" src="//:0"  data-original="<?= $person[1] ?>" alt="">
                                        </span>
                                            </a>
                                        </div>
                                        <div class="section-result-item item2 clear">
                                            <div class="row-result-tabs-item row-result-tabs-item--left">
                                                <div class="name"><a href="/people/<?= $person[0] ?>/"><?= $person[2] ?></a></div>
                                                <div class="name__eng"><?= $person[3] ?></div>
                                                <div class="section-result-info">
                                                    <div class="actors-info-content">
                                                        <ul>
                                                            <?php if ('' != $person[4]): ?>
                                                            <li class="actors-info-role"><?= $person[4] ?></li>
                                                            <?php endif ?>
                                                            <?php if ('' != $person[5]): ?>
                                                                <li class="actors-info-year">
                                                                    <?= $person[5] ?>
                                                                </li>
                                                            <?php endif ?>
                                                            <?php if (0 < $person[6]): ?>
                                                                <li class="actors-info-year">
                                                                    эпизодов - <?= $person[6] ?>
                                                                </li>
                                                            <?php endif ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-result-tabs-item--right">
                                                <div class="main-folder-icon">
                                                    <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                                                        <a class="folder__icon personFolder icon"></a>
                                                        <div class="hint">Добавить в Избранное</div>
                                                        <div class="row-dropdown-folder">
                                                            <div class="dropdown-folder dropdown-folder-content">
                                                                <div class="dropdown-folder-title"><span>В избранное</span></div>
                                                                <ul class="dropdown-folder-list" data-id="<?= $person[0] ?>">

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

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row-result-tabs default" data-type-slidergroup="actors_creaters" data-type-sliderelem="2">

                        </div>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="film/<?= $id ?>/people/creators/"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fpeople%2Fcreators/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="film/<?= $id ?>/people/creators/"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fpeople%2Fcreators/&src=sp"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ffilm%2F<?= $id ?>%2Fpeople%2Fcreators/"></a></li>
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
  <link rel="stylesheet" href="<?= $static ?>/app/js/plugins/mp/magnific-popup.css">
  <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
  <!-- Magnific Popup core JS file -->
  <script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
  <script>
      $(document).ready(function() {
          var personCollectionGet = false;
          var personCollectionList = [];

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

          $("img.lazy").lazyload({
              effect : "fadeIn"
          });
          $('.image-cover-parent').magnificPopup({
              type: 'image'
          });
          $("[gallery-number]").each(function(i, item){
              var num = $(item).attr('gallery-number');
              $('[gallery-number='+num+'] > a').magnificPopup({
                  type: 'image',
                  tLoading: 'Loading image #%curr%...',
                  mainClass: 'mfp-img-mobile',
                  gallery: {
                      enabled: true,
                      navigateByImgClick: true,
                      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                  },
                  image: {
                      tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.'
                  }
              });
          });
          $('.popup-gallery-list-trailers').magnificPopup({
              delegate: 'a',
              type: 'image',
              tLoading: 'Loading image #%curr%...',
              mainClass: 'mfp-img-mobile',
              gallery: {
                  enabled: true,
                  navigateByImgClick: true,
                  preload: [0,1] // Will preload 0 - before current, and 1 after the current image
              },
              image: {
                  tError: '<a href="%url%/">The image #%curr%</a> could not be loaded.',
                  titleSrc: function(item) {
                      return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                  }
              }
          });

          $('.folder__icon').click(function(){
              if (authProb) {
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
                  $('.my-overlay').addClass('active');
                  $('.my-overlay .my-overlay-item').addClass('active');
              }
          });
          $(document).on('click', '.addCollection', function() {
              var el = this;
              if (authProb) {
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
