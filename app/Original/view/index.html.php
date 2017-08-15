<?php
/**
 * @var $options \Kinomania\System\Options\Options
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $options->get('seo_main_title') ?></title>
    <meta name="description" content="<?= $options->get('seo_main_description') ?>" />
    <link rel="image_src" href="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
    <meta name="keywords" content="<?= $options->get('seo_main_keywords') ?>" />

    <meta property="og:title" content="Новинки кино | KINOMANIA.RU" />
    <meta property="og:site_name" content="KINOMANIA.RU" />
    <meta property="og:image" content="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.kinomania.ru/" />
    <meta property="og:description" content="Самая интересная и актуальная информация о новинках мирового кинопроката и свежие новости из мира кино на сайте KINOMANIA.RU. Подробные сведения об актёрах и режиссёрах, саундтреки, постеры к фильмам и многое другое."/>

    <!-- include section/head.html.php -->
</head>
<body>
<div class="my-overlay">
    <div class="my-overlay-item overlay-trailer-item">
        <div class="my-overlay-bg"></div>
        <div class="row-inner-my-overlay video-overlay">
            <div class="inner-my-overlay">
                <div class="war-content">

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
        <div class="main-content clear">
            <!-- В ЦЕНТРЕ ВНИМАНИЯ -->
            <section class="outer-section clear section-news">
                <!--#include virtual="/index/ssi/center" -->
            </section>

            <!-- Новости Кино -->
            <section class="outer-section outer-shadow outer-news">
                <div class="parent-news">
                    <div class=" clear ">
                        <div class="section-content col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="parent-sticker clear">
                                <!--#include virtual="/index/ssi/news" -->
                                <div class="sticker">
                                    <div class="sticker-item">НОВОСТИ КИНО</div>
                                </div>
                            </div>
                        </div>
                        <div class=" section-gray-poster col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="section-gray">
                                <div class="section-gray__item">
                                      <!--#include virtual="/design/ssi/right_top" -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Трейлеры -->
            <section class="outer-section section-black outer-vert clear ">
                <!--#include virtual="/index/ssi/trailer" -->
            </section>
            <!-- Контент -->
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <!-- Зарубежные сериалы -->
                    <section class="inner-content outer-content-item parent-sticker">
                        <!--#include virtual="/index/ssi/series/foreign" -->
                    </section>

                    <!-- Желтый блок -->
                    <!--#include virtual="/index/ssi/yellow" -->

                    <!-- Российские сериалы -->
                    <section class="inner-content outer-content-item parent-sticker">
                        <!--#include virtual="/index/ssi/series/ru" -->
                    </section>
                    <!--#include virtual="/index/ssi/calendar" -->
                </content>
                <!-- Сайдбар -->
                <aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="section-gray layout outer-aside">
                        <div class="aside">
                            <div class="inner-aside">
                                <div class="aside-item no-mobile">
                                    <!--#include virtual="/index/ssi/new" -->
                                </div>
                                <div class="aside-item leaders">
                                    <!--#include virtual="/index/ssi/boxoffice" -->
                                </div>
                            </div>
                        </div>
                        <div class="dop-aside no-mobile">
                            <div class="dop-aside__item">
                                <div class="dop-aside__banner">
                                      <!--#include virtual="/design/ssi/right_bottom" -->
                                </div>
                            </div>
                            <div class="dop-aside__item">
                                <div class="dop-aside__poster">
                                    <div class="aside__title">ПОСТЕР ДНЯ</div>
                                    <!--#include virtual="/index/ssi/poster" -->
                                </div>
                            </div>
                            <div class="dop-aside__item">
                                <div class="section-social clear">
                                    <ul class="aside-social">
                                        <li class="aside-social__item active" data-type-sliderGroup="social" data-type-sliderButton="vk"><i class="social__icon social__icon-vk"></i><span>В контакте </span></li>
                                        <li class="aside-social__item default" data-type-sliderGroup="social" data-type-sliderButton="fb"><i class="social__icon social__icon-fb"></i><span>Facebook </span></li>
                                    </ul>
                                </div>
                                <div class="dop-aside__item-content">
                                    <div class="outer-content-social">
                                        <div class="content-social content-social-vk active" data-type-sliderElem="vk" data-type-sliderGroup="social">
                                            <div id="vk_groups"></div>
                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    setTimeout(function(){
                                                        if (undefined !== VK && undefined !== VK.Widgets) {
                                                            VK.Widgets.Group("vk_groups", {
                                                                mode: 0,
                                                                width: "250",
                                                                height: "300",
                                                                color1: 'FFFFFF',
                                                                color2: '2B587A',
                                                                color3: '5B7FA6'
                                                            }, 41464224);
                                                        }
                                                    }, 1500);
                                                });
                                            </script>
                                        </div>
                                        <div class="content-social content-social-fb default" data-type-sliderElem="fb" data-type-sliderGroup="social">
                                            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FKinomaniaru%2F106629932735181%3Fref%3Dstream%26hc_location%3Dstream&width=250&height=290&show_faces=true&colorscheme=light&stream=false&show_border=false&header=true&appId=306029476182010" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->

<!-- Magnific Popup core JS file -->
<script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    function sliderNavigation(){
        var w = window.innerWidth;
        if (w < 768) {
            topp = Math.round($(".section-news img").height()*0.85)-24;
        } else {
            topp = Math.round($(".section-news img").height()*0.85)-14;
        }
        $(".bx-default-pager").css('top',topp+"px");
    }

    function sliderNavigationButton(){
        var w = window.innerWidth;
        if (w < 320) {
            topp = Math.round($(".section-news img").height()*0.85)-40;
        }else if (w < 544) {
            topp = Math.round($(".section-news img").height()*0.85)-40;
        }else if (w < 768) {
            topp = Math.round($(".section-news img").height()*0.85)-100;
        }else if (w < 992) {
            topp = Math.round($(".section-news img").height()*0.85)-100;
        } else {
            topp = Math.round($(".section-news img").height()*0.85)-114;
        }
        $(".section-news .bx-controls-direction a").css('top',topp+"px");
    }

    function sliderTrailers(section, type, trailer) {
        toggleClass('default',"[data-type-trailersSection]");
        toggleClass('default',"[data-type-trailersSectionButton]");
        toggleClass('default',"[data-type-trailersType]");
        toggleClass('default',"[data-type-trailersTypeButton]");
        toggleClass('default',"[data-type-trailersTrailer]");
        toggleClass('default',"[data-type-trailersTrailerButton]");

        if(!section){
            section = $("[data-type-trailersSection]:first").attr('data-type-trailersSection');
        }
        if(!type){
            type = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType]:first").attr('data-type-trailersType');
        }
        if(!trailer){
            trailer = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType = "+type+"]").children("[data-type-trailersTrailer]:first").attr('data-type-trailersTrailer');
        }

        toggleClass('active',"[data-type-trailersSectionButton = "+section+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersTypeButton = "+type+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailerButton = "+trailer+"]");
        toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailer = "+trailer+"]");
    }


    $(window).load(function() {
        sliderNavigation();
        sliderNavigationButton();
    });

    $(document).ready(function() {
        $('#calendar_birthday').datetimepicker({
            format: "YYYY-MM-DD",
            locale: "ru"
        });
        window.hide_calendar = false;
        $('#calendar_birthday').on("dp.change",function (e) {
            if (window.hide_calendar) {
                window.hide_calendar = false;
                $('.outer-calendar').hide();
                
                var me = $(this);
                if (me.data('requestRunning')) {
                    return;
                }
                me.data('requestRunning', true);
                $('.content-item-dop-date').html('Обработка');

                $('.content-item-dop-section .happy-carousel').html('');
                $.ajax({
                    "type": "post",
                    "async": "true",
                    "url": "/index/calendar",
                    "data": "date=" + $('#calendar_birthday').val(),
                    "success": function(data){
                        data = JSON.parse(data);
                        console.log(data.length);
                        if (0 < data.length) {
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    $('.content-item-dop-section .happy-carousel').append('<div class="item">  '  +
                                        '                       <div class="row-item-image image-shadow">  '  +
                                        '                           <a href="/people/' + data[key]['id'] +  '/"><img alt="" src="' + data[key]['image'] +  '" class="item-image image-prewiew"></a>  '  +
                                        '                       </div>  '  +
                                        '                       <div class="item-text">  '  +
                                        '                           <div class="item-text-title">  '  +
                                        '                               <a href="/people/' + data[key]['id'] +  '/">' + data[key]['name'] +  '</a>  '  +
                                        '                           </div>  '  +
                                        '                           <div class="item-text-date">  '  +
                                        '                               <span>' + data[key]['birthday'] +  '</span>  '  +
                                        '                           </div>  '  +
                                        '     '  +
                                        '                       </div>  '  +
                                        '                  </div>  ' );
                                    $('.content-item-dop-date').html(data[key]['date']);
                                }
                            }
                            var currentSlide = window.mySlider.getCurrentSlide();

                            w = window.innerWidth;

                            if (w <= 992) {
                                window.mySlider.reloadSlider({
                                    startSlide: currentSlide,
                                    slideWidth: 0,
                                    maxSlides: 2,
                                    minSlides: 2,
                                    infiniteLoop: true,
                                    slideMargin: 70,
                                    pager: false
                                });
                            } else {
                                window.mySlider.reloadSlider({
                                    startSlide: currentSlide,
                                    slideWidth: 300,
                                    maxSlides: 2,
                                    minSlides: 2,
                                    infiniteLoop: true,
                                    slideMargin: 70,
                                    pager: false
                                });
                            }
                        }
                    },
                    complete: function() {
                        me.data('requestRunning', false);
                    },
                    error: function(){
                        me.data('requestRunning', false);
                    },
                    timeout: 12000
                });
            }
        });
        $('.content-item-dop-date').click(function() {
            $('.outer-calendar').show();
            $('#calendar_birthday').datetimepicker("show");
            window.hide_calendar = true;
        });


        <!-- bxSlider Init -->
        $('.slider-load').css('display', 'block');
        $('.bxslider').bxSlider({
            auto: false,
            onSliderLoad: function(){
                $(".bxslider").css("visibility", "visible");
            }
        });
        w = window.innerWidth;

        if (w <= 992) {
            window.mySlider = $('.happy-carousel').bxSlider({
                slideWidth: 0,
                maxSlides: 2,
                minSlides: 2,
                infiniteLoop: true,
                slideMargin: 70,
                pager: false
            });
        } else {
            window.mySlider = $('.happy-carousel').bxSlider({
                slideWidth: 300,
                maxSlides: 2,
                minSlides: 2,
                infiniteLoop: true,
                slideMargin: 70,
                pager: false
            });
        }

        $("img.lazy").lazyload({
            effect : "fadeIn"
        });


        // ====Слайдер для меню трейлеров
        // == Секции Пк версия
        $("[data-type-trailersSectionButton]").on('click', function () {
            section = $(this).attr('data-type-trailersSectionButton');
            sliderTrailers(section);
            // меняет содержимое селектора для моб. версии
            html_r = $(this).html();
            $(".mobile__select .result").html(html_r);
            $(".mobile__select .result-list").css('display', 'none');
        });
        // == Тип ПК версия
        $("[data-type-trailersTypeButton]").on('click', function () {
            type = $(this).attr('data-type-trailersTypeButton');
            section = $(this).parents("[data-type-trailersSection]").attr('data-type-trailersSection');
            sliderTrailers(section, type);
        });
        // == Трейлеры ПК версия
        $("[data-type-trailersTrailerButton]").mouseover(function () {
            trailer = $(this).attr('data-type-trailersTrailerButton');
            type = $(this).parents("[data-type-trailersType]").attr('data-type-trailersType');
            section = $(this).parents("[data-type-trailersType]").parents("[data-type-trailersSection]").attr('data-type-trailersSection');
            sliderTrailers(section, type, trailer);
        });
    });
</script>

<script src="http://userapi.com/js/api/share.js?3" async="async" type="text/javascript"></script>
<script src="http://vkontakte.ru/js/api/openapi.js?20" async="async" type="text/javascript"></script>
</body>
</html>
