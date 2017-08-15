<?php
/**
 * @var array $data
 * @var string $static
 * @var bool $found
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Результаты поиска</title>
    <meta name="description" content="Результаты поиска на KINOMANIA.RU"/>

    <!-- include section/head.html.php -->
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
            <section class=" outer-section clear outer-content">
                <!-- Контент -->
                <content class="pagelist page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <?php if ($found): ?>
                        <h1 class="pagetitle">РЕЗУЛЬТАТЫ ПОИСКА</h1>
                        <?php if (count($data['prob']['item'])): ?>
                            <div class="header-pagelist header-search header-pagelist--black">
                                <div class="inner-header-pagelist">
                                    <div class="pagelist-title-black search-title">СКОРЕЕ ВСЕГО ВЫ ИЩЕТЕ</div>
                                    <div class="section-result-content clear">
                                        <?php if ('film' == $data['prob']['type']): ?>
                                            <div class="section-result-item item1">
                                                <a href="/film/<?= $data['prob']['item']['id'] ?>/"><img class="image-padding image-padding--white" src="<?= $data['prob']['item']['image'] ?>" alt=""></a>
                                            </div>
                                            <div class="section-result-item item2">
                                                <?php if (empty($data['prob']['item']['name_ru'])): ?>
                                                    <div class="name name--white"><a href="/film/<?= $data['prob']['item']['id'] ?>/"><?= $data['prob']['item']['name_origin'] ?></a></div>
                                                <?php else: ?>
                                                    <div class="name name--white"><a href="/film/<?= $data['prob']['item']['id'] ?>/"><?= $data['prob']['item']['name_ru'] ?></a></div>
                                                    <div class="name__eng"><?= $data['prob']['item']['name_origin'] ?></div>
                                                <?php endif ?>
                                                <div class="section-result-info">
                                                    <div class="place"><?= $data['prob']['item']['year'] ?></div>
                                                    <div class="row-section-result-nav">
                                                        <ul class="section-result-nav  section-result-nav--white">
                                                            <li><a href="/film/<?= $data['prob']['item']['id'] ?>/">О фильме</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="section-result-item item1">
                                                <a href="/people/<?= $data['prob']['item']['id'] ?>/"><img class="image-padding image-padding--white" src="<?= $data['prob']['item']['image'] ?>" alt=""></a>
                                            </div>
                                            <div class="section-result-item item2">
                                                <?php if (empty($data['prob']['item']['name_ru'])): ?>
                                                    <div class="name name--white"><a href="/people/<?= $data['prob']['item']['id'] ?>/"><?= $data['prob']['item']['name_origin'] ?></a></div>
                                                <?php else: ?>
                                                    <div class="name name--white"><a href="/people/<?= $data['prob']['item']['id'] ?>/"><?= $data['prob']['item']['name_ru'] ?></a></div>
                                                    <div class="name__eng"><?= $data['prob']['item']['name_origin'] ?></div>
                                                <?php endif ?>
                                                <div class="section-result-info">
                                                    <?php if (!empty($data['prob']['item']['birthday'])): ?>
                                                        <div class="date"><span>Дата рождения:</span> <span class="number"><?= $data['prob']['item']['birthday'] ?></span></div>
                                                    <?php endif ?>
                                                    <div class="row-section-result-nav">
                                                        <ul class="section-result-nav section-result-nav--white">
                                                            <li><a href="/people/<?= $data['prob']['item']['id'] ?>/">Фильмография</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (0 < $data['film_total']): ?>
                            <div class="list-content-item">
                                <div class="list-content-title">ФИЛЬМЫ <span class="number"><?= $data['film_total'] ?></span></div>
                                <?php foreach ($data['film'] as $item): ?>
                                    <div class="list-content-item-inner">
                                        <div class="section-result-content clear">
                                            <div class="section-result-item item1 list-preview">
                                                <a href="/film/<?= $item['id'] ?>/">
                                              <span>
                                                <img class=" image-padding--white" src="<?= $item['image'] ?>" alt="">
                                              </span>
                                                </a>
                                            </div>
                                            <div class="section-result-item item2">
                                                <?php if (empty($item['name_ru'])): ?>
                                                    <div class="name"><a href="/film/<?= $item['id'] ?>/"><?= $item['name_origin'] ?></a></div>
                                                <?php else: ?>
                                                    <div class="name"><a href="/film/<?= $item['id'] ?>/"><?= $item['name_ru'] ?></a></div>
                                                    <div class="name__eng"><?= $item['name_origin'] ?></div>
                                                <?php endif ?>
                                                <div class="section-result-info">
                                                    <div class="place"><?= $item['year'] ?></div>
                                                    <div class="row-section-result-nav">
                                                        <ul class="section-result-nav section-result-nav--black">
                                                            <li><a href="/film/<?= $item['id'] ?>/">О фильме</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <br />
                            <br />
                            <br />
                            <br />
                        <?php endif ?>
                        
                        <?php if (0 < $data['person_total']): ?>
                            <div class="list-content-item">
                                <div class="list-content-title">ПЕРСОНЫ <span class="number"><?= $data['person_total'] ?></span></div>
                                <?php foreach ($data['person'] as $item): ?>
                                    <div class="list-content-item-inner">
                                        <div class="section-result-content clear">
                                            <div class="section-result-item item1 list-preview">
                                                <a href="/people/<?= $item['id'] ?>/">
                                              <span>
                                                <img class=" image-padding--white" src="<?= $item['image'] ?>" alt="">
                                              </span>
                                                </a>
                                            </div>
                                            <div class="section-result-item item2">
                                                <?php if (empty($item['name_ru'])): ?>
                                                    <div class="name"><a href="/people/<?= $item['id'] ?>/"><?= $item['name_origin'] ?></a></div>
                                                <?php else: ?>
                                                    <div class="name"><a href="/people/<?= $item['id'] ?>/"><?= $item['name_ru'] ?></a></div>
                                                    <div class="name__eng"><?= $item['name_origin'] ?></div>
                                                <?php endif ?>
                                                <div class="section-result-info">
                                                    <?php if (!empty($item['birthday'])): ?>
                                                        <div class="date"><span>Дата рождения:</span> <span class="number"><?= $item['birthday'] ?></span></div>
                                                    <?php endif ?>
                                                    <div class="row-section-result-nav">
                                                        <ul class="section-result-nav section-result-nav--black">
                                                            <li><a href="/people/<?= $item['id'] ?>/">Фильмография</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <br />
                            <br />
                            <br />
                            <br />
                        <?php endif ?>

                        <?php if (0 < $data['news_total']): ?>
                            <div class="list-content-item">
                                <div class="list-content-title">СТАТЬИ <span class="number"><?= $data['news_total'] ?></span></div>
                                <?php foreach ($data['news'] as $item): ?>
                                    <div class="list-content-item-inner list-content-item-post">
                                        <div class="section-result-content clear">
                                            <div class="prevew-post__title"><a href="/<?= $item['url'] ?>/<?= $item['id'] ?>/"><?= $item['title'] ?></a></div>
                                            <div class="prevew-post__content"><?= $item['anons'] ?></div>
                                            <div class="prevew-post__data"><a href="/<?= $item['url'] ?>/<?= $item['id'] ?>/"><?= $item['category'] ?></a></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif ?>
                    <?php else: ?>
                        <h1 class="pagetitle">По Вашему запросу ничего не найдено</h1>
                    <?php endif; ?>
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
      function amimatedStar() {
          $('.select-star').addClass('default');
      }
      function rateClick()
      {
          $('.star__item').click(function(e){
              e = e || window.event;
              e.preventDefault();

              var id = $(this).parent().parent().parent().parent().parent().parent().parent().attr('data-id');
              var rate = $(this).attr('data-value');
              var el = this;

              window.rateData[id] = rate;
              $.ajax({
                  url: '/user/' + login + '/films?handler=rate',
                  type: "POST",
                  data: 'id=' + id + '&rate=' + rate,
                  dataType: "json",
                  success: function (data) {
                      if (0.0 < data) {
                          $(el).parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.number').text(data);
                      }
                  },
                  complete: function () {
                  },
                  error: function () {
                  },
                  timeout: 5000
              });

              var parent = $(this).parent();
              $(parent).find('.select-star').remove();
              $(parent).find('.star__item').each(function(){
                  $(this).removeAttr('data-active');
              });
              $(this).attr('data-active', 'select');
              $(this).parents('.inner-raiting-star').attr('data-fixed', 'fixed');
              $(this).append('<span class="select-star">ваша оценка</span>');
              setTimeout(amimatedStar, 2000);

              return false;
          });
      }
      function getContent(filter, clearContent) {
          var me = $(this);
          if (me.data('requestRunning')) {
              return;
          }
          me.data('requestRunning', true);

          $('.center-loader').show();
          $('.pagelist-more').hide();

          if (clearContent) {
              $('.row-tile-block').html('');
          }

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
                          html +=  '   div class="releases-item">  '  +
                              '   	<div class="list-content-item-inner">  '  +
                              '   		<div class="section-result-content clear">  '  +
                              '   			<div class="section-result-item item1  list-preview">  '  +
                              '   				<a href="/film/' + data[key]['id'] + '/">  '  +
                              '   				<span>  '  +
                              '   				  <img alt="" src="//:0" data-original="' + data[key]['image'] + '" class="lazy image-padding--white" >  '  +
                              '   				</span>  '  +
                              '   				</a>  '  +
                              '   			</div>  '  +
                              '   			<div class="section-result-item item2 clear">  '  +
                              '   				<div class="bill-result-info bill-result-info-one">  ';
                          if ('' == data[key]['name_ru']) {
                              html += '<div class="name"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_origin'] + '</a></div>  '  +
                                  '<div class="name__eng"></div>  ';
                          } else {
                              html += '<div class="name__eng">' + data[key]['name_origin'] + '</div>  ';
                          }
                          html += '<div class="section-result-info">  '  +
                              '   						<div class="cinema">  '  +
                              '   							<span>  '  +
                              '   								' + data[key]['country'] + ' '  +
                              '   								' + data[key]['year'] + ',  '  +
                              '   								Реж.  '  +
                              '   							</span>  '  +
                              '   							<ul class="cinema-list list--horizontal">  ';
                          for (var k in data[key]['crew']) {
                                html += '<li><a href="/people/' + k + '/">' + data[key]['crew'][k] + '</a></li>  ';
                          }

                              html += '   							</ul>  '  +
                              '   						</div>  '  +
                              '   						<div class="releases-ganre">  '  +
                              '   							<ul class="releases-ganre-list">  '  +
                               + data[key]['genre'] +
                              '   							</ul>  '  +
                              '   						</div>  '  +
                              '   						<div class="cinema">  '  +
                              '   							<span>В ролях</span>  '  +
                              '   							<ul class="cinema-list list--horizontal">  ';
                          for (var k in data[key]['cast']) {
                              html += '<li><a href="/people/' + k + '/">' + data[key]['crew'][k] + '</a></li>  ';
                          }

                          html += ' </ul>  '  +
                              '   						</div>  '  +
                              '   					</div>  '  +
                              '   				</div>  '  +
                              '   				<div class="bill-result-info bill-result-info-two">  '  +
                              '   					<div class="row-info-list-cinema">  '  +
                              '   						<div class="releases-date">  '  +
                              '   							<div class="releases-date-number">' + data[key]['date_d'] + '</div>  '  +
                              '   							<div class="releases-date-info">  '  +
                              '   								<div class="releases-date-month">' + data[key]['date_m'] + '</div>  '  +
                              '   								<div class="releases-date-years">' + data[key]['date_y'] + '</div>  '  +
                              '   							</div>  '  +
                              '   						</div>  '  +
                              '   						<div class="releases-made">  '  +
                              '   							<a href="/company/' + data[key]['company_id'] + '/">' + data[key]['company_name'] + '</a>  '  +
                              '   						</div>  '  +
                              '   						<div class="row-info-list-cinema">  '  +
                              '   							<div class="main-folder-icon">  '  +
                              '   								<div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">  '  +
                              '   									<a class="folder__icon icon"></a>  '  +
                              '   									<div class="hint">Добавить в Избранное</div>  '  +
                              '   									<div class="row-dropdown-folder">  '  +
                              '   										<div class="dropdown-folder dropdown-folder-content">  '  +
                              '   											<div class="dropdown-folder-title"><span>В избранное</span></div>  '  +
                              '   											<ul class="dropdown-folder-list" data-id="' + data[key]['id'] + '">  '  +
                              '     '  +
                              '   											</ul>  '  +
                              '   										</div>  '  +
                              '   										<div class="dropdown-folder dropdown-folder-setting">  '  +
                              '   											<a href="#" class="clear">  '  +
                              '   												<!-- <i class="setting-icon"></i> -->  '  +
                              '   												<span>Управление папками</span>  '  +
                              '   											</a>  '  +
                              '   										</div>  '  +
                              '   									</div>  '  +
                              '   								</div>  '  +
                              '   								<div class="row-icon-add row-icon-add--white icon-star" data-id="' + data[key]['id'] + '">  '  +
                              '   									<div class="star__icon icon">  '  +
                              '   										<div class="hint-block">  '  +
                              '   											<div class="hint-inner-block">  '  +
                              '   												<div class="hint-inner-block__title">  '  +
                              '   													<i class="star__icon icon"></i>Мой рейтинг  '  +
                              '   												</div>  '  +
                              '   												<div class="row-raiting-star">  '  +
                              '   													<div class="inner-raiting-star" data-fixed="fixed">  '  +
                              '   														<ul class="raiting-list-star clear rateList">  '  +
                              '   														</ul>  '  +
                              '   													<span class="raiting-number">  '  +
                              '     '  +
                              '   													</span>  '  +
                              '   														<span class="result-star"></span>  '  +
                              '   													</div>  '  +
                              '   												</div>  '  +
                              '   											</div>  '  +
                              '   										</div>  '  +
                              '   									</div>  '  +
                              '   								</div>  '  +
                              '   							</div>  '  +
                              '   							<div class="row-mini-raiting-number">  ';
                              if (0 < data[key]['rate']) {
                                  html += '   									Рейтинг: <span class="number">' + data[key]['rate'] + '</span>  ';
                              }
                              html += '   							</div>  '  +
                              '   						</div>  '  +
                              '   					</div>  '  +
                              '   				</div>  '  +
                              '   			</div>  '  +
                              '   		</div>  '  +
                              '   	</div>  '  +
                              '  </div>  ' ;
                      }
                  }

                  $('.row-tile-block').append(html);

                  $("img.lazy[proc!=true]").lazyload({
                      effect : "fadeIn"
                  });
                  $("img.lazy").attr('proc', 'true');
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

          var filterTimer;
          var doneFilterInterval = 500;
          var FILTER = {
              'month': $('#month').val(),
              'year':  $('#year').val()
          };

          $('#month').change(function(){
              FILTER.month = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true, true);
              }, doneFilterInterval);
          });
          $('#year').change(function(){
              FILTER.year = $(this).val();

              clearTimeout(filterTimer);
              filterTimer = setTimeout(function() {
                  getContent(FILTER, true);
              }, doneFilterInterval);
          });

          var collectionGet = false;
          var collectionList = [];

          var personCollectionGet = false;
          var personCollectionList = [];

          window.rateData = [];

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

          $('.page-content-head__more a').click(function(){
              $('.read-more-text').addClass('read-more-text_open');
              $(this).hide();
              return false;
          });

          $(document).on('click', '.icon-star', function(){
              if (authProb) {
                  $(this).find('.hint-block').css('visibility', 'visible');
                  $(this).find('.hint-block').css('opacity', '1');

                  var id = $(this).attr('data-id');
                  var el = this;

                  if (undefined === window.rateData[id]) {
                      $.ajax({
                          url: '/user/' + login + '/films?handler=getRate',
                          type: "POST",
                          data: 'id=' + id,
                          dataType: "json",
                          success: function (data) {
                              var ul = $(el).find('.rateList');
                              $(ul).html('');
                              $(ul).parent().find('.raiting-number').html('');

                              window.rateData[id] = data;
                              for (var i = 1; i < 11; i++) {
                                  if (i > data) {
                                      $(ul).append('<li class="star__item" data-value="' + i + '"><i class="icon__star"></i></li>');
                                  } else {
                                      if (i != data) {
                                          $(ul).append('<li class="star__item active" data-value="' + i + '"><i class="icon__star"></i></li>');
                                      } else {
                                          $(ul).append('<li class="star__item active" data-value="' + i + '" data-active="select">' +
                                              '<i class="icon__star"></i></li>');
                                      }
                                  }
                              }
                              if (0 < data) {
                                  $(ul).parent().find('.raiting-number').append('<span class="value">' + data + '</span> из 10');
                              } else {
                                  $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');
                              }
                              rateClick();

                              $('.star__item').hover(function () {
                                  thisStar = $(this).attr('data-value');
                                  parentStar = $(this).parents('.inner-raiting-star');
                                  minStar = 0;
                                  maxStar = $(parentStar).find('.star__item').length;
                                  if (!$(this).is('[data-active]')) {
                                      while (minStar <= thisStar) {
                                          $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
                                          minStar++
                                      }
                                  }
                                  while (maxStar > thisStar) {
                                      $(parentStar).find('.star__item[data-value = ' + maxStar + ']').removeClass('active');
                                      maxStar--
                                  }
                                  $(parentStar).find('.raiting-number .value').html(thisStar);
                              }, function () {
                                  if (!$('.inner-raiting-star').is('[data-fixed]')) {
                                      $('.inner-raiting-star .star__item').removeClass('active');
                                      $('.raiting-number .value').html(0);

                                  }
                              });

                              $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                              $('.raiting-list-star').hover(function() {
                                  $(this).find('.select-star').addClass('active');
                              }, function() {
                                  parentStar = $(this).parents('.inner-raiting-star');
                                  minStar = 0;
                                  fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                                  if ($('.inner-raiting-star').is('[data-fixed]')) {
                                      $(parentStar).find('.star__item').removeClass('active');
                                      while (minStar <= fixedStar) {
                                          $(parentStar).find('.star__item[data-value = '+ minStar +']').addClass('active');
                                          minStar++
                                      }
                                      $(parentStar).find('.raiting-number .value').html(fixedStar);
                                      $('.select-star').removeClass('active');
                                      setTimeout(amimatedStar, 2000);
                                  }
                              });
                          },
                          complete: function () {
                          },
                          error: function () {
                          },
                          timeout: 5000
                      });
                  } else {
                      var ul = $(el).find('.rateList');
                      $(ul).html('');
                      $(ul).parent().find('.raiting-number').html('');

                      var data = window.rateData[id];
                      for (var i = 1; i < 11; i++) {
                          if (i > data) {
                              $(ul).append('<li class="star__item" data-value="' + i + '"><i class="icon__star"></i></li>');
                          } else {
                              if (i != data) {
                                  $(ul).append('<li class="star__item active" data-value="' + i + '"><i class="icon__star"></i></li>');
                              } else {
                                  $(ul).append('<li class="star__item active" data-value="' + i + '" data-active="select">' +
                                      '<i class="icon__star"></i></li>');
                              }
                          }
                      }
                      if (0 < data) {
                          $(ul).parent().find('.raiting-number').append('<span class="value">' + data + '</span> из 10');
                      } else {
                          $(ul).parent().find('.raiting-number').append('<span class="value">_</span> из 10');
                      }
                      rateClick();


                      $('.star__item').hover(function () {
                          thisStar = $(this).attr('data-value');
                          parentStar = $(this).parents('.inner-raiting-star');
                          minStar = 0;
                          maxStar = $(parentStar).find('.star__item').length;
                          if (!$(this).is('[data-active]')) {
                              while (minStar <= thisStar) {
                                  $(parentStar).find('.star__item[data-value = ' + minStar + ']').addClass('active');
                                  minStar++
                              }
                          }
                          while (maxStar > thisStar) {
                              $(parentStar).find('.star__item[data-value = ' + maxStar + ']').removeClass('active');
                              maxStar--
                          }
                          $(parentStar).find('.raiting-number .value').html(thisStar);
                      }, function () {
                          if (!$('.inner-raiting-star').is('[data-fixed]')) {
                              $('.inner-raiting-star .star__item').removeClass('active');
                              $('.raiting-number .value').html(0);

                          }
                      });

                      $('.star__item[data-active = select]').append('<span class="select-star default">ваша оценка</span>');

                      $('.raiting-list-star').hover(function() {
                          $(this).find('.select-star').addClass('active');
                      }, function() {
                          parentStar = $(this).parents('.inner-raiting-star');
                          minStar = 0;
                          fixedStar = $(parentStar).find('.star__item[data-active = select]').attr('data-value');
                          if ($('.inner-raiting-star').is('[data-fixed]')) {
                              $(parentStar).find('.star__item').removeClass('active');
                              while (minStar <= fixedStar) {
                                  $(parentStar).find('.star__item[data-value = '+ minStar +']').addClass('active');
                                  minStar++
                              }
                              $(parentStar).find('.raiting-number .value').html(fixedStar);
                              $('.select-star').removeClass('active');
                              setTimeout(amimatedStar, 2000);
                          }
                      });
                  }
              } else {
                  $('.my-overlay').addClass('active');
                  $('.my-overlay .my-overlay-item').addClass('active');
              }
          });

          $(document).on('click', '.folder__icon', function(){
              if (authProb) {
                  if ($(this).hasClass('personFolder')) {
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
                      var el = $(this).parent().children('.row-dropdown-folder');

                      if (!collectionGet) {
                          $.ajax({
                              url: '/user/' + login + '/films?handler=folderList',
                              type: "POST",
                              dataType: "json",
                              success: function (data) {
                                  collectionGet = true;

                                  for (var key in data) {
                                      if (data.hasOwnProperty(key)) {
                                          collectionList.push([data[key][0], data[key][1]]);
                                      }
                                  }

                                  var cnt = 0;
                                  for (key in collectionList) {
                                      if (collectionList.hasOwnProperty(key)) {
                                          cnt += 1;
                                          var html = '<li class="addCollection" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
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
                          for (var key in collectionList) {
                              if (collectionList.hasOwnProperty(key)) {
                                  cnt += 1;
                                  var html = '<li class="addCollection" data-id="' + collectionList[key][0] + '"><i class="dropdown-folder-content-icon"><span>' + cnt + '</span></i><span class="name-icon">' + collectionList[key][1] + '</span></li>';
                                  $(el).find('ul.dropdown-folder-list').append(html);
                              }
                          }
                      }

                      el.find('a').attr('href', '/user/' + login + '/films');
                      el.addClass('active');
                  }
              } else {
                  $('.my-overlay').addClass('active');
                  $('.my-overlay .my-overlay-item').addClass('active');
              }
          });
          $(document).on('click', '.addCollection', function() {
              var el = this;
              if (authProb) {
                  if ($(this).hasClass('addPersonCollection')) {
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
                  } else {
                      var folderId = $(this).attr('data-id');
                      var filmId = $(this).parent().attr('data-id');
                      $.ajax({
                          url: '/user/' + login + '/films?handler=addFilm',
                          type: "POST",
                          data: 'folderId=' + folderId + '&filmId=' + filmId,
                          dataType: "json",
                          success: function (data) {
                              $(el).parent().parent().parent().removeClass('active');
                              if (0 == data) {
                                  $(el).parent().parent().parent().parent().notify("Фильм добавлен в коллекцию", {
                                      className: "success",
                                      position: "left",
                                      autoHideDelay: 2400
                                  });
                              } else if (2 == data) {
                                  $(el).parent().parent().parent().parent().notify("Фильм уже есть в данной коллекции", {
                                      className: "info",
                                      position: "left",
                                      autoHideDelay: 2400
                                  });
                              } else {
                                  $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                      position: "left",
                                      autoHideDelay: 2400
                                  });
                              }
                          },
                          error: function () {
                              $(el).parent().parent().parent().removeClass('active');
                              $(el).parent().parent().parent().parent().notify("Не удалось добавить фильм в коллекцию", {
                                  position: "left",
                                  autoHideDelay: 2400
                              });
                          },
                          timeout: 5000
                      });
                  }
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
