<?php
/**
 * @var int $id
 * @var array $item
 */
use \Kinomania\Original\Key\Person\Person;
use \Kinomania\Original\Key\Person\Filmography;
use \Kinomania\System\Config\Server;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация на сайте kinomania.ru</title>
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
        <section class="outer-section clear outer-content-two">
            <!-- Контент -->
            <content class="page-section-content page-no-aside section-content content-outer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="outer-form registration" id="registration">
                    <section class=" outer-section clear outer-content">
                        <div class="page-section-content page-no-aside section-content content-outer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="outer-form registration" id="registration">
                                <div class="form-title pagetitle">Активация аккаунта</div>
                                <div class="form-welcome">
                                    <div class="form-welcome-title"></div>
                                    <div id="success" class="form-success-text">
                                        Ваш аккаунт успешно активирован
                                    </div>
                                </div>
                                <div class="form-content">
                                </div>
                                <div class="form-add">

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </content>
        </section>
    </div>
</div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->
</body>
</html>