<?php
/**
 * @var array $item
 * @var $options Kinomania\System\Options\
 * @var $places \Kinomania\System\Options\Options
 * @var $films \Kinomania\System\Options\Options
 * @var $films_place \Kinomania\System\Options\Options
 * @var $name \Kinomania\System\Options\Options
 */
use Kinomania\System\Body\BodyScript;
use Kinomania\System\GeoLocation\IpGeoBase;

?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $options->get('seo_billboard_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_billboard_description') ?>"/>

	<link rel="canonical" href="http://www.kinomania.ru/billboard"/>

    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/billboard" />
    <meta property="og:title" content="Афиша Москвы" />
    <meta property="og:description" content="Афиша Москвы - все кинотеатры, расписание, фильмы"/>

    <!-- include section/head.html.php -->
</head>
<body>
<div class="overlay-ajax-load"  style="position: absolute;z-index: 100; width: 100%; height: 100%">
	<img class="load-ajax"  src="<?= $static ?>/app/img/design/load.gif" style="align-self: center">
</div>
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
                    <div class="row-page">
                        <h1 class="pagetitle"><?= $options->get('seo_billboard_h1') ?></h1>
                        <div class="description">
                            Афиша «Киномании» точно знает, в каких кинотеатрах и во сколько идет лучшее кино. Выбирайте ваш город — и мы покажем самые удобные сеансы. Всего пара кликов — и билет у вас в кармане, здесь и сейчас. Приятного просмотра!
	                        <p>
		                        <br>
		                        <a href="#" id="theatre">Кинотеатры</a>
		                        <a href="#" id="films">Фильмы</a>
	                        </p>
                        </div>
	                    <div id="result"></div>
	                    <div id="block_index_afisha">
		                    <strong style="font-size: 34px;">Кинотеатры г.
	                            <?= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
	                        </strong>
		                    <div id="block" >
			                    <table class="table">
				                    <thead>
				                    <tr>
					                    <td><strong>Кинотеатр:</strong></td>
					                    <td><strong>Адрес:</strong></td>
				                    </tr>
				                    </thead>
				                    <tbody class="film__table">
				                    <?php foreach ($places as $place):?>
					                    <tr>
						                    <td valign="bottom">
							                    <span class="anchor-cube">
							                    </span>
							                        <a href="/billboard/cinema?id=<?= $place->ObjectID ?>">
								                        <?=$place->Name?>
							                        </a>
						                    </td>
						                    <td valign="bottom">
							                    <?=$place->Address?>
						                    </td>
					                    </tr>
				                    <?php endforeach;?>
				                    </tbody>
			                    </table>
		                    </div>
	                    </div>
	                    
                        <div class="pagelist-social style-pagelist-social">
                            <div class="outer-social clear">
                                <ul class="social-list social-list--horizontal">
                                    <li class="vk" id="vk_in_share" data-url="billboard"><a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2Fbillboard/"><span class="number"></span></a></li>
                                    <li class="fb" id="fb_in_share" data-url="billboard"><a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2Fbillboard&src=sp/"><span class="number"></span></a></li>
                                    <li class="tw" id="tw_in_share"><a href="http://twitter.com/share?url=http%3A%2F%2Fkinomania.ru%2Fbillboard/"></a></li>
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
<script type="text/javascript" src="<?= $static ?>/app/js/afisha.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.page-content-head__more a').click(function(){
            $('.read-more-text').addClass('read-more-text_open');
            $(this).hide();
            return false;
        });
    });
</script>
  <?php BodyScript::getContent();?>
</body>
</html>