<?php
/**
 * @var array $list
 */
use Kinomania\Original\Key\Casting\Person as Person;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Кастинг-база KINOMANIA.RU | Расширенный поиск, фото, видео</title>
    <meta name="description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>
    <meta name="keywords" content="Кастинг, кастинг-база, актерская база, поиск по актерам, кастинг агентства, видео актеров"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/casting" />
    <meta property="og:title" content="Кастинг-база" />
    <meta property="og:description" content="Актерская база с расширенным поиском, фото и видео российсских актеров и актрис, информация по кастинг-агентсвам"/>

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
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-casting row-page-two">
                        <div class="page-two-head">
                            <h1 class="pagetitle mini__pagetitle">Кастинг-база</h1>
                            <div class="link-big">CASTING.KINOMANIA.RU</div>
                            <ul class="list-casting">
                                <li><span class="list-casting-value" data-type="actors">7 961 </span> <span class="list-casting-name">актеров</span></li>
                                <li><span class="list-casting-value" data-type="actress">6 552 </span> <span class="list-casting-name">актрис</span></li>
                                <li><span class="list-casting-value" data-type="photo">53 307</span> <span class="list-casting-name">фото</span></li>
                                <li><span class="list-casting-value" data-type="video">11 326</span> <span class="list-casting-name">видео</span></li>
                            </ul>
                            <div class="list-casting__button">
                                <a href="/casting/search/" class="button button3">Поиск актеров по параметрам</a>
                            </div>
                        </div>
                        <section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew art-yellow parent-whom">
                            <div class="section-mini-prewiew section-mini-prewiew--yellow">
                                <div class="row-whom clear">
                                    <div class="whom-item">
                                        <div class="whom-item__name">Пользователям</div>
                                        <div class="whom-item__caption">Расширенный поиск, тысячи фото и видео материалов</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                    <div class="whom-item">
                                        <div class="whom-item__name">Агентствам</div>
                                        <div class="whom-item__caption">Продвижение актеров, размещение доп.материалов</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                    <div class="whom-item">
                                        <div class="whom-item__name">Актерам</div>
                                        <div class="whom-item__caption">Размещение<br>информации о себе в базе</div>
                                        <div class="whom-item__link"><a href="/info/casting/">ПОДРОБНЕЕ</a></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row-part-filter">
                            <div class="part-filter-title">АКТЕРЫ</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По возрасту</li>
                                        <li class="male active" data-value="0"><a href="/"><span>Все</span></a></li>
                                        <li class="male" data-value="10"><a href="/"><span>до 10</span></a></li>
                                        <li class="male" data-value="20"><a href="/"><span>от 10 до 20</span></a></li>
                                        <li class="male" data-value="30"><a href="/"><span>от 20 до 30</span></a></li>
                                        <li class="male" data-value="40"><a href="/"><span>от 30 до 40</span></a></li>
                                        <li class="male" data-value="50"><a href="/"><span>от 40 до 50</span></a></li>
                                        <li class="male" data-value="60"><a href="/"><span>от 60</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="maleContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['male'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-part-filter">
                            <div class="part-filter-title">АКТРИСЫ</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По возрасту</li>
                                        <li class="female active" data-value="0"><a href="/"><span>Все</span></a></li>
                                        <li class="female" data-value="10"><a href="/"><span>до 10</span></a></li>
                                        <li class="female" data-value="20"><a href="/"><span>от 10 до 20</span></a></li>
                                        <li class="female" data-value="30"><a href="/"><span>от 20 до 30</span></a></li>
                                        <li class="female" data-value="40"><a href="/"><span>от 30 до 40</span></a></li>
                                        <li class="female" data-value="50"><a href="/"><span>от 40 до 50</span></a></li>
                                        <li class="female" data-value="60"><a href="/"><span>от 60</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="femaleContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['female'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-part-filter">
                            <div class="part-filter-title">Дети</div>
                            <div class="row-outside bg-color-three part-filter-outside">
                                <div class="inner-outside">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">По полу</li>
                                        <li class="child active" data-value=""><a href="/"><span>Все</span></a></li>
                                        <li class="child" data-value="male"><a href="/"><span>мальчики</span></a></li>
                                        <li class="child" data-value="female"><a href="/"><span>девочки</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="part-filter-result">
                                <div class="" id="childContent">
                                    <div class="row-bxslider-part">
                                        <div class="bxslider-part bx-mini-slider-posters posters--hover">
                                            <?php foreach ($list['child'] as $sub): ?>
                                                <div class="slide">
                                                    <div class="row-part-filter-slide">
                                                        <?php foreach ($sub as $item): ?>
                                                            <div class="part-filter-slide">
                                                                <div class="row-posters__image">
                                                                    <a href="/people/<?= $item[Person::ID] ?>/">
                                                                        <div class="image-shadow-poster posters__image">
                                                                            <img alt="" src="<?= $item[Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="bx-mini-slider-caption">
                                                                    <div class="bxslider-part-title"><a href="/people/<?= $item[Person::ID] ?>/"><?= $item[Person::NAME] ?></a></div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagelist-social style-pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="casting"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fcasting/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="casting"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fcasting&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fcasting/"></a></li>
                            </ul>
                        </div>
                    </div>
                </content>
                <!-- include section/aside.casting.html.php -->
            </section>
        </div>
    </div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->
  <script type="text/javascript">
      $(document).ready(function(){
          $('.male').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var date = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.male').removeClass('active');
              $(this).addClass('active');

              $('#maleContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getMale&date=" + date,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#maleContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });


          $('.female').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var date = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.female').removeClass('active');
              $(this).addClass('active');

              $('#femaleContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getFemale&date=" + date,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#femaleContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });
          
          $('.child').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var sex = $(this).attr('data-value');

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.child').removeClass('active');
              $(this).addClass('active');

              $('#childContent').html('');

              $.ajax({
                  "type": "post",
                  "url": "?handler=getChild&sex=" + sex,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      if (0 < data.length) {
                          html += '<div class="row-bxslider-part">' +
                              '<div class="bxslider-part bx-mini-slider-posters posters--hover">';
                          for (var key in data) {
                              if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                                  html += '<div class="slide">' +
                                      '<div class="row-part-filter-slide">';

                                  var list = data[key];
                                  for (var i in list) {
                                      if (list.hasOwnProperty(i)) {
                                          html += '<div class="part-filter-slide">' +
                                              '<div class="row-posters__image">' +
                                              '<a href="/people/' + list[i][<?= Person::ID ?>] + '/">' +
                                              '<div class="image-shadow-poster posters__image">' +
                                              '<img alt="" src="' + list[i][<?= Person::IMAGE ?>] + '" class="parent responsive-image image-prewiew">' +
                                              '</div>' +
                                              '</a>' +
                                              '</div>' +
                                              '<div class="bx-mini-slider-caption">' +
                                              '<div class="bxslider-part-title"><a href="/people/' + list[i][<?= Person::ID ?>] + '/">' + list[i][<?= Person::NAME ?>] + '</a></div>' +
                                              '</div>' +
                                              '</div>';
                                      }
                                  }

                                  html += '</div></div>'
                              }
                          }

                          html += '</div></div>'
                      }

                      $('#childContent').append(html);
                      $('.bxslider-part').bxSlider({
                          auto: false,
                          minSlides: 1,
                          maxSlides: 1,
                          nextText: '',
                          prevText: '',
                          pager: false
                      });
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                  }
              });

              return false;
          });
          
      });
  </script>
</body>
</html>
