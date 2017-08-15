<?php
/**
 * @var array $item
 * @var string $static
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>АртКиноМания :: Артхаус, другое кино, авторское кино</title>
    <meta name="description" content="Рецензии на авторское кино, обзоры, новости"/>
    <meta name="keywords" content="артхаус, другое кино, авторское кино"/>

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
                <content class="page-section-content section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row-festivals">
                        <h1 class="pagetitle">АРТКИНОМАНИЯ</h1>
                        <div class="description">
                            Фестивали национальных фильмов и главные смотры планеты, разговоры по душам с выдающимися деятелями авторского кино, рецензии на актуальный артхаус и классику, новости о лентах, в которых главным остается творец, режиссер, а все коммерческие аспекты остаются за кадром — все это и не только в рубрике «АРТКиномания». Мы знаем, где смотреть самое интересное «другое» кино, как не пропустить лучшие фестивали, где найти билеты на редкие показы и что настоящему киноману просто обязательно знать.
                        </div>
                        <div class="section-content row-art-news clear">
                            <div class="parent-sticker clear parent-sticker-all-posts">
                                <div class="row">
                                    <!--#include virtual="/art/ssi/news" -->
                                </div>
                                <div class="sticker">
                                    <div class="sticker-item">НОВОСТИ</div>
                                </div>
                            </div>
                        </div>
                        <!-- Желтый блок -->
                        <!--#include virtual="/art/ssi/yellow" -->
                        <div class="row-art-awards parent-sticker row-parent-sticker">
                            <!--#include virtual="/art/ssi/festival" -->
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
<script type="text/javascript">
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });
</script>
</body>
</html>
