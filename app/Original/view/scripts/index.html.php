<?php
/**
 * @var array $genre
 * @var array $list
 */

use Kinomania\Original\Key\Film\Script as Script;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Сценарии к фильмам на KINOMANIA.RU</title>
    <meta name="description" content="Сценарии к фильмам на KINOMANIA.RU"/>

    <meta property="og:title" content="Сценарии к фильмам" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/scripts" />

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
            <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h1 class="pagetitle trailers-pagetitle">ВСЕ СЦЕНАРИИ</h1>
                <div class="outer-selection-trailers">
                    <div data-type-openclose-button="open_close" data-type-openclose-class="active" class="button__selection-trailers"><span>Подбор по параметрам</span></div>
                    <div class="selection-trailers">
                        <div class="row-selection-hide" data-type-openclose-element="open_close">
                            <div class="selection-trailers-item clear">
                                <div class="item ganre">
                                    <div class="selection-trailers__name">Жанр:</div>
                                    <div class="selection-trailers__value">
                                        <ul class="selection-trailers__value-list">
                                            <?php foreach ($genre as $code => $name): ?>
                                                <li><a href="/" data-value="<?= $code ?>" class="filter genre"><?= $name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="selection-trailers-item clear">
                                <div class="item years" data-type="slider" data-type-slider-min="1888" data-type-slider-max="2020">
                                    <div class="selection-trailers__name">Года:</div>
                                    <div class="selection-trailers__value">
                                        <div class="outer-time-bar clear">
                                            <div class="time-bar-years">
                                                <ul>
                                                    <li>1930</li>
                                                    <li>1970</li>
                                                    <li>2020</li>
                                                </ul>
                                            </div>
                                            <div class="time-bar-slide">
                                                <div class="slide-bar-bottom" data-type-slider="bg">
                                                    <div class="slide-bar-top" data-type-slider="fr" style="left: 0px; width: 100px;"></div>
                                                    <div class="slide-bar-controls">
                                                        <div class="slide-bar-controls__item slide-bar-controls__left" data-type-slider="left_controller" style="left: 0px;"></div>
                                                        <div class="slide-bar-controls__item slide-bar-controls__right" data-type-slider="right_controller" style="left: 100px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="outer-time-value clear">
                                            <span>с</span>
                                            <input type="text" id="yearFrom" name="yearFrom" class="time-value-after" data-type-slider="input_left" value="1888">
                                            <span>по</span>
                                            <input type="text" id="yearTo" name="yearTo"  class="time-value-before" data-type-slider="input_right" value="2020">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="selection-trailers-item">
                            <div class="item letters">
                                <div class="letters-select">
                                    <ul class="tab-list clear">
                                        <li class="active" data-type-slidergroup="lang" data-type-sliderbutton="ru">RU</li>
                                        <li class="default" data-type-slidergroup="lang" data-type-sliderbutton="eng">ENG</li>
                                    </ul>
                                </div>
                                <div class="letters-text">
                                    <ul class="letters-text-list active filter" data-type-slidergroup="lang" data-type-sliderelem="ru">
                                        <li>А</li>
                                        <li>Б</li>
                                        <li>В</li>
                                        <li>Г</li>
                                        <li>Д</li>
                                        <li>Е</li>
                                        <li>Ё</li>
                                        <li>Ж</li>
                                        <li>З</li>
                                        <li>И</li>
                                        <li>Й</li>
                                        <li>К</li>
                                        <li>Л</li>
                                        <li>М</li>
                                        <li>Н</li>
                                        <li>О</li>
                                        <li>П</li>
                                        <li>Р</li>
                                        <li>С</li>
                                        <li>Т</li>
                                        <li>У</li>
                                        <li>Ф</li>
                                        <li>Х</li>
                                        <li>Ц</li>
                                        <li>Ч</li>
                                        <li>Ш</li>
                                        <li>Щ</li>
                                        <li>Ъ</li>
                                        <li>Ы</li>
                                        <li>Ь</li>
                                        <li>Э</li>
                                        <li>Ю</li>
                                        <li>Я</li>
                                    </ul>
                                    <ul class="letters-text-list filter" data-type-slidergroup="lang" data-type-sliderelem="eng">
                                        <li>A</li>
                                        <li>B</li>
                                        <li>C</li>
                                        <li>D</li>
                                        <li>E</li>
                                        <li>F</li>
                                        <li>G</li>
                                        <li>H</li>
                                        <li>I</li>
                                        <li>J</li>
                                        <li>K</li>
                                        <li>L</li>
                                        <li>M</li>
                                        <li>N</li>
                                        <li>O</li>
                                        <li>P</li>
                                        <li>Q</li>
                                        <li>R</li>
                                        <li>S</li>
                                        <li>T</li>
                                        <li>U</li>
                                        <li>V</li>
                                        <li>W</li>
                                        <li>X</li>
                                        <li>Y</li>
                                        <li>Z</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scripts-list-item show_block" style="display: none;">
                    <div class="content-page__titile">
                        <h2>СЦЕНАРИИ</h2>
                    </div>
                    <div class="row-scripts-item">
                        <div class="row-list-tile clear">

                        </div>
                    </div>

                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                    </div>
                </div>
                <div class="scripts-list-item hide_block">
                    <div class="content-page__titile">
                        <h2>СЦЕНАРИИ НА РУССКОМ ЯЗЫКЕ</h2>
                    </div>
                    <div class="row-scripts-item">
                        <div class="row-list-tile clear">
                            <?php foreach ($list['ru'] as $item): ?>
                                <div class="list-tile-item" style="height: 205px;">
                                    <div class="list-tile-preview list-preview">
                                        <a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/">
                                        <span>
                                          <img alt="" src="//:0" data-original="<?= $item[Script::IMAGE] ?>" class="lazy image-padding--white">
                                        </span>
                                        </a>
                                    </div>
                                    <div class="list-tile-text">
                                        <?php if ('' == $item[Script::FILM_NAME]): ?>
                                            <div class="list-tile-value list-tile-name"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME_EN] ?></a></div>
                                        <?php else: ?>
                                            <div class="list-tile-value list-tile-name"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME] ?></a></div>
                                            <div class="list-tile-value list-tile-name-eng"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME_EN] ?></a></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <div class="scripts-list-item hide_block">
                    <div class="content-page__titile">
                        <h2>СЦЕНАРИИ НА АНГЛИЙСКОМ ЯЗЫКЕ</h2>
                    </div>
                    <div class="row-scripts-item">
                        <div class="row-list-tile clear">
                            <?php foreach ($list['en'] as $item): ?>
                                <div class="list-tile-item" style="height: 205px;">
                                    <div class="list-tile-preview list-preview">
                                        <a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/">
                                        <span>
                                          <img alt="" src="//:0" data-original="<?= $item[Script::IMAGE] ?>" class="lazy image-padding--white">
                                        </span>
                                        </a>
                                    </div>
                                    <div class="list-tile-text">
                                        <?php if ('' == $item[Script::FILM_NAME]): ?>
                                            <div class="list-tile-value list-tile-name"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME_EN] ?></a></div>
                                        <?php else: ?>
                                            <div class="list-tile-value list-tile-name"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME] ?></a></div>
                                            <div class="list-tile-value list-tile-name-eng"><a href="/film/<?= $item[Script::FILM_ID] ?>/script/<?= $item[Script::ID] ?>/"><?= $item[Script::FILM_NAME_EN] ?></a></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <div class="pagelist-social">
                    <div class="outer-social clear">
                        <ul class="social-list social-list--horizontal">
                            <li class="vk" id="vk_in_share" data-url="scripts"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fscripts/"><span class="number"></span></a></li>
                            <li class="fb" id="fb_in_share" data-url="scripts"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fscripts&t=%D0%A1%D1%86%D0%B5%D0%BD%D0%B0%D1%80%D0%B8%D0%B8&src=sp/"><span class="number"></span></a></li>
                            <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?text=%D0%A1%D1%86%D0%B5%D0%BD%D0%B0%D1%80%D0%B8%D0%B8&url=http%3A%2F%2Fkinomania.ru%2Fscripts/"></a></li>
                        </ul>
                    </div>
                </div>
            </content>
            <section class="outer-section clear outer-content">
                <!-- Контент -->

                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
    <!-- include section/footer.html.php -->
    <!-- include section/scripts.html.php -->
  <script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
  <script type="text/javascript">
      function getContent(filter, clearContent) {
          var me = $(this);
          if (me.data('requestRunning')) {
              return;
          }
          me.data('requestRunning', true);

          $('.center-loader').show();
          $('.pagelist-more').hide();

          if (clearContent) {
              $('.show_block .row-list-tile').html('');
          }
          $('.hide_block').hide();
          $('.show_block').show();

          $("img.lazy").attr('proc', 'true');

          $.ajax({
              "type": "post",
              "url": "?handler=search",
              dataType: "json",
              data: 'filter=' + JSON.stringify(filter),
              "success": function (data) {
                  var html = '';
                  for (var key in data) {
                      if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                          html +=  '   <div class="list-tile-item" style="height: 205px;">  '  +
                              '   	<div class="list-tile-preview list-preview">  '  +
                              '   		<a href="/film/' + data[key][<?= Script::FILM_ID ?>] + '/script/' + data[key][<?= Script::ID ?>] + '/">  '  +
                              '   		<span>  '  +
                              '   		  <img alt="" src="//:0" data-original="' + data[key][<?= Script::IMAGE ?>] + '" class="lazy image-padding--white">  '  +
                              '   		</span>  '  +
                              '   		</a>  '  +
                              '   	</div>  '  +
                              '   	<div class="list-tile-text">  ' ;
                              if ('' == data[key]['name_ru']) {
                                  html += '<div class="list-tile-value list-tile-name"><a href="/film/' + data[key][<?= Script::FILM_ID ?>] + '/script/' + data[key][<?= Script::ID ?>] + '/">' + data[key][<?= Script::FILM_NAME_EN ?>] + '</a></div>';
                              } else {
                                  html += '<div class="list-tile-value list-tile-name"><a href="/film/' + data[key][<?= Script::FILM_ID ?>] + '/script/' + data[key][<?= Script::ID ?>] + '/">' + data[key][<?= Script::FILM_NAME ?>] + '</a></div>';
                                  html += '<div class="list-tile-value list-tile-name-eng"><a href="/film/' + data[key][<?= Script::FILM_ID ?>] + '/script/' + data[key][<?= Script::ID ?>] + '/">' + data[key][<?= Script::FILM_NAME_EN ?>] + '</a></div>';
                              }
                          html += '   	</div>  '  +
                              '  </div>  ';
                      }
                  }
                  if (0 == data.length) {
                      html = '<p>&nbsp; &nbsp; &nbsp; Ничего не найдено</p>';
                  }

                  $('.show_block .row-list-tile').append(html);

                  $("img.lazy[proc!=true]").lazyload({
                      effect : "fadeIn"
                  });
                  $("img.lazy").attr('proc', 'true');

                  if (16 > data.length) {
                      $('.pagelist-more').hide();
                  } else {
                      $('.pagelist-more').show();
                  }
              },
              complete: function () {
                  me.data('requestRunning', false);
                  $('.center-loader').hide();
              },
              error: function () {
                  me.data('requestRunning', false);
                  $('.center-loader').hide();
              },
              timeout: 30000
          });
      }
      $(document).ready(function(){
          $("img.lazy").lazyload({
              effect : "fadeIn"
          });

          $('.pagelist-more').hide();

          var filterTimer;
          var doneFilterInterval = 500;
          var FILTER = {
              'genre': [],
              'year': [],
              'letter': '',
              'page': 1
          };

          $('.filter').click(function(e){
              e = e || window.event;
              e.preventDefault();

              FILTER['page'] = 1;

              if ($(this).hasClass('genre')) {
                  var genre = $(this).attr('data-value');
                  if(-1 == FILTER.genre.indexOf(genre)) {
                      FILTER.genre.push(genre);
                      $(this).addClass('active');
                  } else {
                      FILTER.genre.splice(FILTER.genre.indexOf(genre), 1);
                      $(this).removeClass('active');
                  }
              }

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true);
              }, doneFilterInterval);

              return false;
          });

          $('#yearFrom').change(function(){
              FILTER['page'] = 1;
              FILTER.year[0] = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true, true);
              }, doneFilterInterval);
          });
          $('#yearTo').change(function(){
              FILTER['page'] = 1;
              FILTER.year[1] = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true);
              }, doneFilterInterval);
          });

          $('.letters-text-list li').click(function(){
              FILTER['page'] = 1;
              if (FILTER.letter == $(this).text()) {
                  FILTER.letter = '';
              } else {
                  FILTER.letter = $(this).text();
              }

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true);
              }, doneFilterInterval);
          });

          $('#more').click(function(e){
              e = e || window.event;
              e.preventDefault();
              FILTER['page'] += 1;
              getContent(FILTER, false);
              return false;
          });
      });
  </script>
</body>
</html>
