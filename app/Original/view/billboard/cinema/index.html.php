<?php
/**
 * @var array $item
 * @var $options Kinomania\System\Options\
 * @var $schedule object
 * @var $cinema object
 * @var $api \Kinomania\System\API\APIKassaRambler
 * @var $location \Kinomania\System\GeoLocation\IpGeoBase;
 */
use Kinomania\System\Body\BodyScript;
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
	                        <?php $city = unserialize($_COOKIE['city'] ?? []) ?>
	                       <?//= $city['city_id']?>
                            Афиша «Киномании» точно знает, в каких кинотеатрах и во сколько идет лучшее кино. Выбирайте ваш город — и мы покажем самые удобные сеансы. Всего пара кликов — и билет у вас в кармане, здесь и сейчас. Приятного просмотра!
                        </div>
	                                            <h2>Кинотеатр "<?= $cinema->Name ?>"</h2>
                        <div class="row-outside row-outside-bill bg-color-one row-outside-art clear">
	                        <!--Start Ticket widget-->
	                        <rb:inline key="1a2cbeaf-d285-45e9-90d7-a66078c15365" classType="place" objectID="<?=$cinema->ObjectID?>" cityID="<?=$city['city_id']?>" locale="" xmlns:rb="http://kassa.rambler.ru"></rb:inline>
	                        <!--End Ticket widget-->
	                        <script type="text/javascript" src="https://kassa.rambler.ru/s/widget/js/TicketManager.js"></script>
                        </div>
	                    
<!--                        <h2>Кинотеатр "--><?//= $cinema->Name ?><!--"</h2>-->
	                    
	                    <!--<a href="/billboard?theatre">Кинотеатры</a> <a href="/billboard?film">Фильмы</a>-->
<!--	                    <button id="btn">Показать</button>-->
<!--	                    <div id="block" >-->
<!--                            --><?php //foreach ((array)$schedule->List as $item): ?>
<!--                                --><?php //$film = $api->getObjectByCreationType(null, $item->CreationObjectID); ?>
<!--                                --><?php ////\Kinomania\System\Debug\Debug::prn($film) ?>
<!--                                <div style="border-bottom: solid 1px black">-->
<!--                                    <p><img src="--><?//=(isset($film->HorizonalThumbnail))? $film->HorizonalThumbnail :''?><!--" alt="" width="200px"></p>-->
<!--                                    <p><b>--><?//=(isset($film->Name))? $film->Name : '' ?><!--</b></p>-->
<!--                                    <p>Жанр: --><?//=(isset($film->Genre))? $film->Genre : ''?><!--</p>-->
<!--                                    <p>Страна: --><?//=(isset($film->Country))? $film->Country :'' ?><!--</p>-->
<!--                                    <p>Продолжительность: --><?//=(isset($film->Duration))? $film->Duration : '' ?><!--</p>-->
<!--                                    <p>Дата выхода: --><?//=(isset($film->ReleaseDate))? $film->ReleaseDate : '' ?><!--</p>-->
<!--                                    <p>Начало: --><?//=(isset($film->DateTime))? $item->DateTime : ''; ?><!--</p>-->
<!--                                    <p>Цена от: --><?//= $item->MinPrice; ?><!--</p>-->
<!--                                    <p>Цена до: --><?//= $item->MaxPrice; ?><!--</p>-->
<!--                                </div>-->
<!--                                --><?php //break; ?>
<!--                            --><?php //endforeach; ?>
<!--	                    </div>-->
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.page-content-head__more a').click(function(){
            $('.read-more-text').addClass('read-more-text_open');
            $(this).hide();
            return false;
        });
        /*if ($("#btn").html() ==='Показать'){
	        $( "#btn" ).on( "click", function() {
		        $("#block").show('slow');
		        $("#btn").html('Скрыть');
	        });
        }
        if($("#btn").html() === 'Скрыть') {
	        $( "#btn" ).on( "click", function() {
		        $("#block").hide('slow');
		        $("#btn").html('Показать');
	        });
        }*/
	   
    });
</script>
  <?php BodyScript::getContent();?>
</body>
</html>