<?php
/**
 * @var string static
 * @var array $list
 * @var array $dateList
 * @var $options \Kinomania\System\Options\Options
 */

use Kinomania\Original\Key\TV\Chanel as Chanel;
use Kinomania\Original\Key\TV\Program as Program;
use Kinomania\Original\Key\TV\Film as Film;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$options->get('seo_tv_title');?></title>
    <meta name="description" content="<?=$options->get('seo_tv_description');?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/tv"/>
	
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/tv" />
    <meta property="og:title" content="ТВ программа" />
	

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
                <div class="info-user head-two">
                    <h1 class="pagetitle"><?=$options->get('seo_tv_h1');?></h1>
                    <div class="row-tv-slider">
                        <div class="bx-tv-slider">
                            <?php foreach ($list['filmList'] as $film): ?>
                                <div class="slide">
                                    <a href="/film/<?= $film[Film::ID] ?>">
                                        <div class="bx-tv-slider__image"><img src="<?= $film[Film::IMAGE] ?>" width="274" height="206" alt="<?= $film[Film::NAME] ?>"></div>
                                        <div class="bx-tv-slider__caption">
                                            <div class="item1"><?= $film[Film::NAME] ?></div>
                                            <div class="item2"><span class="tv-time"><?= $film[Film::TIME] ?></span>, <span class="tv-channel"><?= $film[Film::CHANEL] ?></span></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <section class=" outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content section-content content-outer content-top--padding col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-tv">
                        <div class="row-outside row-outside-bill bg-color-one row-outside-art clear">
                            <div class="inner-outside ">
                                <div class="bill-nav">
                                    <ul class="part-filter-list clear">
                                        <li class="part-filter-list__name">Сортировать</li>
                                        <li class="typeFilter" data-type="film"><a href="/"><span>фильмы</span></a></li>
                                        <li class="typeFilter" data-type="series"><a href="/"><span>сериалы</span></a></li>
                                        <li class="typeFilter" data-type="mult"><a href="/"><span>кино для детей</span></a></li>
                                    </ul>
                                </div>
                                <!--  -->
                                <div class="row-bill-input row-tv-input">
                                    <div class="row-form-input clear">
                                        <div class="form-input-item clear">
                                            <div class="row-input">
                                                <div class="row-dropdown-input clear">
                                                    <div class="bill-input-item">
                                                        <select name="date" id="date" class="">
                                                            <?php foreach ($dateList as $date => $text): ?>
                                                                <option value="<?= $date ?>"><?= $text ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="bill-input-item">
                                                        <select name="channel" id="chanel" class="">
                                                            <option value="0">Основные каналы</option>
                                                            <option value="1">Первый канал (Россия)</option>
                                                            <option value="2">Россия 1</option>
                                                            <option value="3">НТВ</option>
                                                            <option value="4">5 канал (Россия)</option>
                                                            <option value="5">Карусель</option>
                                                            <option value="6">ОТР</option>
                                                            <option value="7">СТС</option>
                                                            <option value="8">ТНТ</option>
                                                            <option value="9">РЕН ТВ</option>
                                                            <option value="10">ТВ Центр</option>
                                                            <option value="11">Домашний</option>
                                                            <option value="12">Мир</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-tv-result">
                            <?php foreach ($list['chanel'] as $id => $chanel): ?>
                                <div class="channel-item">
                                    <div class="channel-item-head">
                                        <a href="#" class="channel-item-head__image channel__image-<?= $id ?>"></a>
                                        <div class="channel-item-head__name">
                                            <a href="#"><?= $chanel[Chanel::NAME] ?></a>
                                        </div>
                                    </div>
                                    <div class="channel-item-content">
                                        <ul class="channel-list">
                                            <?php foreach ($chanel[Chanel::LIST] as $program): ?>
                                                <li class="<?= $program[Program::PAST] ?>">
                                                    <span class="channel-item__time"><span class="channel-item-inner__time"><?= $program[Program::TIME] ?></span></span>
                                                    <?php if (0 < $program[Program::FILM_ID]): ?>
                                                        <a href="/film/<?= $program[Program::FILM_ID] ?>/" class="channel-item__name"><?= $program[Program::NAME] ?></a>
                                                    <?php else: ?>
                                                        <span class="channel-item__name"><?= $program[Program::NAME] ?></span>
                                                    <?php endif ?>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="outer-pagelist-more">
                            <div class="center-loader" style="display: none;">
                                <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="pagelist-social">
                        <div class="outer-social clear">
                            <ul class="social-list social-list--horizontal">
                                <li class="vk" id="vk_in_share" data-url="tv"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Ftv/"><span class="number"></span></a></li>
                                <li class="fb" id="fb_in_share" data-url="tv"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Ftv&src=sp/"><span class="number"></span></a></li>
                                <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Ftv/"></a></li>
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
  <script>
      $(document).ready(function(){
          $('.slider-load').css('display', 'block');
          $('.bxslider').bxSlider({
              auto: false
          });
          w = window.innerWidth;
          $('.bxslider-part').bxSlider({
              auto: false,
              minSlides: 1,
              maxSlides: 1,
              nextText: '',
              prevText: '',
              pager: false
          });

          var bx_tv_slider;
          var bx_mini_slider
          create_bx_tv_slider();
          create_bx_mini_slider();

          $(window).resize(function(){
              create_bx_tv_slider();
              create_bx_mini_slider();
          });

          function create_bx_tv_slider (){
              if($(bx_tv_slider).html() != undefined){
                  bx_tv_slider.destroySlider();
              }

              if(w < 768){
                  bx_tv_slider = {
                      minSlides: 1,
                      maxSlides: 1
                  };
              } else if(w < 992){
                  bx_tv_slider = {
                      slideWidth: 275,
                      minSlides: 3,
                      maxSlides: 3
                  };
              } else {
                  bx_tv_slider = {
                      slideWidth: 275,
                      minSlides: 4,
                      maxSlides: 4
                  };
              }
              param_def = {
                  auto: false,
                  slideMargin: 15,
                  nextText: '',
                  prevText: '',
                  pager: false
              };

              var param_def = $.extend(param_def, bx_tv_slider);
              bx_tv_slider = $('.bx-tv-slider').bxSlider(param_def);
          }


          function create_bx_mini_slider (){
              if($(bx_mini_slider).html() != undefined){
                  bx_mini_slider.destroySlider();
              }

              if(w < 768){
                  bx_mini_slider = {
                      minSlides: 1,
                      maxSlides: 1
                  };
              } else if(w < 992){
                  bx_mini_slider = {
                      minSlides: 3,
                      maxSlides: 3
                  };
              } else {
                  bx_mini_slider = {
                      minSlides: 3,
                      maxSlides: 3
                  };
              }
              param_def = {
                  slideWidth: 215,
                  slideMargin: 15,
                  pager: false,
                  nextText: '',
                  prevText: ''
              };

              var param_def = $.extend(param_def, bx_mini_slider);
              bx_mini_slider = $('.bx-mini-slider').bxSlider(param_def);
          }


          // $('.bx-mini-slider').bxSlider({
          //   slideWidth: 215,
          //   minSlides: 1,
          //   maxSlides: 3,
          //   slideMargin: 15,
          //   pager: false,
          //   nextText: '',
          //   prevText: ''
          // });

          if (w <= 992) {
              $('.happy-carousel').bxSlider({
                  slideWidth: 0,
                  maxSlides: 2,
                  minSlides: 2,
                  infiniteLoop: true,
                  slideMargin: 70,
                  pager: false
              });
          } else {
              $('.happy-carousel').bxSlider({
                  slideWidth: 300,
                  maxSlides: 2,
                  minSlides: 2,
                  infiniteLoop: true,
                  slideMargin: 70,
                  pager: false
              });
          }
      });
  </script>
  <script type="text/javascript">
      function typeFilter() {
          $('.typeFilter').click(function(e){
              e = e || window.event;
              e.preventDefault();
              var showAll = false;
              if ($(this).hasClass('active')) {
                  showAll = true;
              }
              $('.typeFilter').removeClass('active');
              if (!showAll) {
                  $(this).addClass('active');
              }
              var type = $(this).attr('data-type');
              $('.channel-item__name').each(function(){
                  if (showAll) {
                      $(this).parent().show();
                  } else {
                      $(this).parent().show();
                      switch (type) {
                          case 'film':
                              if (-1 === $(this).text().indexOf('Х/ф') && -1 === $(this).text().indexOf('Д/ф') ) {
                                  $(this).parent().hide();
                              }
                              break;
                          case 'series':
                              if (-1 === $(this).text().indexOf('Т/с') && -1 === $(this).text().indexOf('Д/с') ) {
                                  $(this).parent().hide();
                              }
                              break;
                          case 'mult':
                              if (-1 === $(this).text().indexOf('М/с') && -1 === $(this).text().indexOf('М/ф') ) {
                                  $(this).parent().hide();
                              }
                              break;
                      }
                  }
              });
              return false;
          });
      }
      $(document).ready(function(){
          typeFilter();

          $('#date').change(function(){
              var date = $(this).val();
              var chanelId = $('#chanel').val();

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.center-loader').show();
              $('.row-tv-result').html('');
              $('.typeFilter').removeClass('active');

              $.ajax({
                  "type": "post",
                  "url": "?handler=get&date=" + date + "&chanelId=" + chanelId,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      for (var key in data) {
                          if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                              html += '<div class="channel-item">  '  +
                              '   	<div class="channel-item-head">  '  +
                              '   		<a href="#" class="channel-item-head__image channel__image-' + key + '"></a>  '  +
                              '   		<div class="channel-item-head__name">  '  +
                              '   			<a href="#">' + data[key][<?= Chanel::NAME ?>] + '</a>  '  +
                              '   		</div>  '  +
                              '   	</div>  '  +
                              '   	<div class="channel-item-content">  '  +
                              '   		<ul class="channel-list">  ';
                              var list = data[key][<?= Chanel::LIST ?>];
                              for (var i in list) {
                                  if (list.hasOwnProperty(i)) {
                                      html += '   				<li class="' + list[i][<?= Program::PAST ?>] + '">  ' +
                                          '   					<span class="channel-item__time"><span class="channel-item-inner__time">' + list[i][<?= Program::TIME ?>] + '</span></span>  ';
                                      if (0 < list[i][<?= Program::FILM_ID ?>]) {
                                          html += '<a href="/film/' + list[i][<?= Program::FILM_ID ?>] + '/" class="channel-item__name">' + list[i][<?= Program::NAME ?>] + '</a>  ';
                                      } else {
                                          html += '<span class="channel-item__name">' + list[i][<?= Program::NAME ?>] + '</span>';
                                      }
                                      html += '</li>';
                                  }
                              }
                              html += '   		</ul>  '  +
                              '   	</div>  '  +
                              '  </div>';
                          }
                      }

                      $('.row-tv-result').append(html);
                  },
                  complete: function() {
                      me.data('requestRunning', false);
                      $('.center-loader').hide();
                  }
              });
          });

          $('#chanel').change(function(){
              console.log('test');
              var chanelId = $(this).val();
              var date = $('#date').val();

              var me = $(this);
              if (me.data('requestRunning')) {
                  return;
              }
              me.data('requestRunning', true);

              $('.center-loader').show();
              $('.row-tv-result').html('');
              $('.typeFilter').removeClass('active');

              $.ajax({
                  "type": "post",
                  "url": "?handler=get&date=" + date + "&chanelId=" + chanelId,
                  "success": function(data){
                      data = JSON.parse(data);

                      var html = '';
                      for (var key in data) {
                          if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                              html += '<div class="channel-item">  '  +
                              '   	<div class="channel-item-head">  '  +
                              '   		<a href="#" class="channel-item-head__image channel__image-' + key + '"></a>  '  +
                              '   		<div class="channel-item-head__name">  '  +
                              '   			<a href="#">' + data[key][<?= Chanel::NAME ?>] + '</a>  '  +
                              '   		</div>  '  +
                              '   	</div>  '  +
                              '   	<div class="channel-item-content">  '  +
                              '   		<ul class="channel-list">  ';
                              var list = data[key][<?= Chanel::LIST ?>];
                              for (var i in list) {
                                  if (list.hasOwnProperty(i)) {
                                      html += '   				<li class="' + list[i][<?= Program::PAST ?>] + '">  ' +
                                          '   					<span class="channel-item__time"><span class="channel-item-inner__time">' + list[i][<?= Program::TIME ?>] + '</span></span>  ';
                                      if (0 < list[i][<?= Program::FILM_ID ?>]) {
                                          html += '<a href="/film/' + list[i][<?= Program::FILM_ID ?>] + '/" class="channel-item__name">' + list[i][<?= Program::NAME ?>] + '</a>  ';
                                      } else {
                                          html += '<span class="channel-item__name">' + list[i][<?= Program::NAME ?>] + '</span>';
                                      }
                                      html += '</li>';
                                  }
                              }
                              html += '   		</ul>  '  +
                              '   	</div>  '  +
                              '  </div>';
                          }
                      }

                      $('.row-tv-result').append(html);
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
