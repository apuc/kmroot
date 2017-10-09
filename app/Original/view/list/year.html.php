<?php
/**
 * @var array $list
 * @var string static
 * @var int $year
 */
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (2017 == $year): ?>
        <title>Новинки кино <?= $year ?> года | Самые ожидаемые фильмы на KINOMANIA.RU</title>
    <?php else: ?>
        <title>Лучшие фильмы <?= $year ?> года | Самые ожидаемые фильмы на KINOMANIA.RU</title>
    <?php endif ?>
    <meta name="description" content="Самая интересная и актуальная информация о новинках кино <?= $year ?> года и самых ожидаемых премьерах на сайте KINOMANIA.RU. Подробные сведения об актёрах и режиссёрах, саундтреки, трейлеры, постеры к фильмам и многое другое."/>
    <meta name="keywords" content="список фильмов, список фильмов, <?= $year ?> год"/>

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
                    <?php if (2017 == $year): ?>
                        <h1 class="pagetitle">НОВИНКИ КИНО - <?= $year ?></h1>
                    <?php else: ?>
                        <h1 class="pagetitle">ЛУЧШИЕ ФИЛЬМЫ - <?= $year ?></h1>
                    <?php endif ?>
                    <?php if (2016 == $year): ?>
                        <div class="description">
                            Интересуют мировые премьеры кинолент известных и начинающих режиссеров? Хотите получать максимум интересной информации о новых картинах? Ищите все новинки кино 2016 года на KINOMANIA!
                            На сайте собрана богатейшая коллекция трейлеров, имеются полные описания сюжетных линий, приведены биографические данные об актерах. Здесь можно скачать постеры, найти саундтреки, поделиться собственными ожиданиями и впечатлениями. Ни одна из новинок кино не остается без внимания обозревателей!
                            Среди наиболее популярных лент 2016 года стоит отметить российский блокбастер "Дуэлянт", ставший культовым "Отряд Самоубийц" и столь ожидаемый "Викинг". Читайте также новости о других, не менее увлекательных лентах европейских, голливудских и азиатских режиссеров на одном из крупнейших online-кинопроектов в рунете!
                        </div>
                    <?php elseif (2015 == $year): ?>
                        <div class="description">
                            Интересуют мировые премьеры кинолент известных и начинающих режиссеров? Хотите получать максимум интересной информации о новых картинах? Ищите лучшие фильмы 2015 года на KINOMANIA!
                            На сайте собрана богатейшая коллекция трейлеров, имеются полные описания сюжетных линий, приведены биографические данные об актерах. Здесь можно скачать постеры, найти саундтреки, поделиться собственными ожиданиями и впечатлениями. Ни одна из новинок кино не остается без внимания обозревателей!
                            Лучшими среди фильмов 2015 года зрители назвали мультипликационную картину "Головоломка", драму "Выживший" и ремейк культовой картины "Безумный Макс". Читайте также новости о других, не менее увлекательных лентах европейских, голливудских и азиатских режиссеров на одном из крупнейших online-кинопроектов в рунете!
                        </div>
                    <?php endif ?>
                    <div class="list-content-item">
                        <?php foreach ($list as $item): ?>
                            <div class="list-content-item-inner">
                                <div class="section-result-content clear">
                                    <div class="section-result-item item1 list-preview">
                                        <a href="/film/<?= $item['id'] ?>/">
                                              <span>
                                                <img alt="" src="//:0" data-original="<?= $item['image'] ?>" class="lazy image-padding--white"">
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
                                            <div class="place">
                                                <?php foreach ($item['country'] as $code): ?>
                                                    <?php if (!empty($code)): ?>
                                                        <?= \Kinomania\System\Data\Country::RU[$code] ?>,
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                                <?php if (0 == count($item['crew'])): ?>
                                                    <?= $year ?>
                                                <?php endif ?>
                                                <?php foreach ($item['crew'] as $personId => $name): ?>
                                                    Реж.: <a href="/people/<?= $personId ?>/"><?= $name ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (count($item['cast'])): ?>
                                                <div class="cinema">
                                                    <span>В ролях:</span>
                                                    <ul class="cinema-list list--horizontal">
                                                        <?php foreach ($item['cast'] as $personId => $name): ?>
                                                            <li><a href="/people/<?= $personId ?>/"><?= $name ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                            <div class="row-section-result-nav">
                                                <ul class="section-result-nav section-result-nav--black">
                                                    <li><a href="/film/<?= $item['id'] ?>/">О фильме</a></li>
                                                    <?php if (0 < $item['frame']): ?>
                                                        <li><a href="/film/<?= $item['id'] ?>/frames/">Кадры (<?= $item['frame'] ?>)</a></li>
                                                    <?php endif ?>
                                                    <?php if (0 < $item['trailer']): ?>
                                                        <li><a href="/film/<?= $item['id'] ?>/trailers/">Видео (<?= $item['trailer'] ?>)</a></li>
                                                    <?php endif ?>
                                                    <?php if (0 < $item['wallpaper']): ?>
                                                        <li><a href="/film/<?= $item['id'] ?>/wallpapers/">Обои (<?= $item['wallpaper'] ?>)</a></li>
                                                    <?php endif ?>
                                                    <?php if (0 < $item['poster']): ?>
                                                        <li><a href="/film/<?= $item['id'] ?>/posters/">Постеры (<?= $item['poster'] ?>)</a></li>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="outer-pagelist-more">
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
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
                  "url": "?handler=getMore&page=" + page,
                  "success": function(data){
                      data = JSON.parse(data);
                      for (var key in data) {
                          if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                              var html =  '   <div class="list-content-item-inner">  '  +
                                  '   	<div class="section-result-content clear">  '  +
                                  '   		<div class="section-result-item item1 list-preview">  '  +
                                  '   			<a href="/film/' + data[key]['id'] + '/">  '  +
                                  '   				  <span>  '  +
                                  '   					<img alt="" src="//:0" data-original="' + data[key]['image'] + '" class="lazy image-padding--white"">  '  +
                                  '   				  </span>  '  +
                                  '   			</a>  '  +
                                  '   		</div>  '  +
                                  '   		<div class="section-result-item item2">  ';
                              if ('' == data[key]['name_ru']) {
                                  html += '<div class="name"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_origin'] + '</a></div>  ';
                              } else {
                                  html += '<div class="name"><a href="/film/' + data[key]['id'] + '/">' + data[key]['name_ru'] + '</a></div>  ';
                                  html += '<div class="name__eng">' + data[key]['name_origin'] + '</div>  ';
                              }
                              html += '   			<div class="section-result-info">  '  +
                                  '   				<div class="place">  ' + data[key]['country'];
                              if (0 != data[key]['crew'].length) {
                                  for (var k in data[key]['crew']) {
                                      html += ' &nbsp;Реж.: <a href="/people/' + k + '/">' + data[key]['crew'][k] + '</a>  ';
                                  }
                              } else {
                                  html += ' &nbsp;' + <?= $year ?>;
                              }
                              html += '</div>  ';
                              if (0 != data[key]['cast'].length) {
                                  html += '   					<div class="cinema">  '  +
                                      '   						<span>В ролях:</span>  '  +
                                      '   						<ul class="cinema-list list--horizontal">  ';
                                  for (var k in data[key]['cast']) {
                                      html += '<li><a href="/people/' + k + '/">' + data[key]['cast'][k] + '</a></li>  ';
                                  }
                                  html += '   						</ul>  '  +
                                      '   					</div>  ';
                              }
                              html +=    '   				<div class="row-section-result-nav">  '  +
                                  '   					<ul class="section-result-nav section-result-nav--black">  '  +
                                  '   						<li><a href="/film/' + data[key]['id'] + '/">О фильме</a></li>  ';
                              if (0 <  data[key]['frame']) {
                                  html += '<li><a href="/film/' + data[key]['id'] + '/frames/">Кадры (' + data[key]['frame'] + ')</a></li>  ';
                              }
                              if (0 <  data[key]['trailer']) {
                                  html += '<li><a href="/film/' + data[key]['id'] + '/trailers/">Видео (' + data[key]['trailer'] + ')</a></li>  ';
                              }
                              if (0 <  data[key]['wallpaper']) {
                                  html += '<li><a href="/film/' + data[key]['id'] + '/wallpaper/">Обои (' + data[key]['wallpaper'] + ')</a></li>  ';
                              }
                              if (0 <  data[key]['poster']) {
                                  html += '<li><a href="/film/' + data[key]['id'] + '/posters/">Постеры (' + data[key]['poster'] + ')</a></li>  ';
                              }

                              html += '</ul>  '  +
                                  '   				</div>  '  +
                                  '   			</div>  '  +
                                  '   		</div>  '  +
                                  '   	</div>  '  +
                                  '  </div>  ';
                              $('.list-content-item').append(html);
                          }
                      }

                      $('.posters__image a').click(function(e){
                          e.preventDefault();
                      });
                      $('.inner-overlay-image img').css('max-height', $(window.top).height() - 150 + 'px');

                      $("[data-type-over-img]").on('click',function(){
                          obj = this;
                          open_over( obj );
                      });

                      $("img.lazy[proc!=true]").lazyload({
                          effect : "fadeIn"
                      });
                      $("img.lazy").attr('proc', 'true');

                      if (24 > data.length) {
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
<?php BodyScript::getContent();?>
</body>
</html>
