<?php
/**
 * @var array $item
 * @var $options Kinomania\System\Options\
 * @var $places \Kinomania\System\Options\Options
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
                            Афиша «Киномании» точно знает, в каких кинотеатрах и во сколько идет лучшее кино. Выбирайте ваш город — и мы покажем самые удобные сеансы. Всего пара кликов — и билет у вас в кармане, здесь и сейчас. Приятного просмотра!
                        </div>
                        <div class="row-outside row-outside-bill bg-color-one row-outside-art clear">
                            <div class="inner-outside ">
<!--                                <div class="bill-nav">-->
<!--                                    <ul class="part-filter-list clear">-->
<!--                                        <li class="part-filter-list__name">Сортировать</li>-->
<!--                                        <li class="active"><a href="/"><span>по количеству сеансов</span></a></li>-->
<!--                                        <li><a href="/"><span>самое новое</span></a></li>-->
<!--                                        <li><a href="/"><span>по алфавиту</span></a></li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!--                                <div class="row-bill-input">-->
<!--                                    <div class="row-form-input">-->
<!--                                        <div class="form-input-item clear">-->
<!--                                            <div class="row-input">-->
<!--                                                <div class="row-dropdown-input">-->
<!--                                                    <div class="bill-input-item"><select name="city" id="" class="">-->
<!--                                                            <option value="name" selected="selected">Москва</option>-->
<!--                                                        </select> </div>-->
<!--                                                    <div class="row-drop-down-where bill-input-item">-->
<!--                                                        <div class="drop-down-where">-->
<!--                                                            Сегодня-->
<!--                                                        </div>-->
<!--                                                        <div class="outer-calendar drop-down-where-calendar default">-->
<!--                                                            <div class="datepicker datepicker-dropdown dropdown-menu datepicker-orient-left datepicker-orient-bottom" style="top: 40px; right: 0px; display: block;">-->
<!--                                                                <div class="datepicker-days" style="display: block;">-->
<!--                                                                    <table class=" table-condensed">-->
<!--                                                                        <thead>-->
<!--                                                                        <tr>-->
<!--                                                                            <th colspan="7" class="datepicker-title" style="display: none;"></th>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr class="date">-->
<!--                                                                            <th class="prev" style="visibility: visible;">«</th>-->
<!--                                                                            <th colspan="5" class="datepicker-switch">Октябрь 2016</th>-->
<!--                                                                            <th class="next" style="visibility: visible;">»</th>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <th class="dow">Пн</th>-->
<!--                                                                            <th class="dow">Вт</th>-->
<!--                                                                            <th class="dow">Ср</th>-->
<!--                                                                            <th class="dow">Чт</th>-->
<!--                                                                            <th class="dow">Пт</th>-->
<!--                                                                            <th class="dow">Сб</th>-->
<!--                                                                            <th class="dow">Вс</th>-->
<!--                                                                        </tr>-->
<!--                                                                        </thead>-->
<!--                                                                        <tbody>-->
<!--                                                                        </tbody>-->
<!--                                                                    </table>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="bill-input-item">-->
<!--                                                        <select name="time" id="" class="">-->
<!--                                                            <option value="name" selected="selected" title="1">Время сеанса</option>-->
<!--                                                        </select> </div>-->
<!--                                                    <div class="bill-input-item">-->
<!--                                                        <select name="ganre" id="" class="">-->
<!--                                                            <option value="name" selected="selected">Жанр фильма</option>-->
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
	                        <strong style="font-size: 34px;">Кинотеатры</strong><!--<a href="/billboard?film">Фильмы</a>-->
	                        <!--	                    <button id="btn">Показать</button>-->
	                        <div id="block" >
		                        <table class="table">
			                        <thead>
			                        <tr>
				                        <td><strong>Кинотеатр:</strong></td>
				                        <td><strong>Адрес:</strong></td>
			                        </tr>
			                        </thead>
			                        <tbody>
			                        <?php foreach ($places as $place):?>
				                        <tr>
					                        <td><a href="/billboard/cinema?id=<?= $place->ObjectID ?>"><?=$place->Name?></a></td>
					                        <td> <?=$place->Address?></td>
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