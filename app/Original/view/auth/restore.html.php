<?php
/**
 * @var string $static
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
            <content class="page-section-content page-no-aside section-content content-outer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="outer-form login">
                    <div class="form-title pagetitle">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</div>
                    <div id="response"></div>
                    <noscript>
                        <div id="error" class="form-error-text">
                            пожалуйста включите javascript для нормальной работы сайта
                        </div>
                    </noscript>
                    <div class="form-content">
                        <?php if (empty($hash)): ?>
                            <form method="post" id="restoreForm">
                                <ul>
                                    <li>
                                        <label for="email">Email:</label>
                                        <input type="text" name="email" id="email" placeholder="Введите email" value="">
                                    </li>
                                </ul>
                                <button class="button button4">восстановить</button>
                                <input type="hidden" name="handler" value="recover" />
                            </form>
                        <?php else: ?>
                            <form method="post" id="resetForm">
                                <ul>
                                    <li>
                                        <label for="password">Пароль:</label>
                                        <input type="password" name="password" id="password">
                                    </li>
                                    <li>
                                        <label for="password_re">Пароль ещё раз:</label>
                                        <input type="password" name="password_re" id="password_re">
                                    </li>
                                </ul>
                                <button class="button button4">сменить пароль</button>
                                <input type="hidden" name="h" value="<?= $hash ?>" />
                                <input type="hidden" name="handler" value="reset" />
                            </form>
                        <?php endif ?>
                    </div>
                    <div class="form-add" id="socialBlock">
                        <div class="form-social-text">Или войдите через акканут социальных сетей:</div>
                        <div class="form-social">
                            <ul>
                                <li class="form-social-icon"><a href="#" class="vk"></a></li>
                                <li class="form-social-icon"><a href="#" class="fb"></a></li>
                                <li class="form-social-icon"><a href="#" class="ok"></a></li>
                                <li class="form-social-icon"><a href="#" class="tw"></a></li>
                                <li class="form-social-icon"><a href="#" class="gplus"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?= $static ?>/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            <?php if (empty($hash)): ?>
            $(document).ready(function(){
                $("#restoreForm").validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                            remote: '?handler=checkEmail'
                        }
                    },
                    messages: {
                        email: {
                            required: "Введите email",
                            email: "Ошибка в email",
                            remote: "Email не зарегистрирован"
                        }
                    },
                    submitHandler: function() {
                        var postData = $('#restoreForm').serializeArray();
                        $.ajax({
                            url: '?handler=recover',
                            type: "POST",
                            data: postData,
                            dataType: "json",
                            success: function (data) {
                                if ('' == data.error) {
                                    $('#response').html('<div id="success" class="form-success-text"> Вам на <a href="http://' + data.host + '//">Email</a> отправлено письмо <br /> перейдите по ссылке внутри письма чтобы восстановить пароль. <br /><br /> Проверьте папку "Спам" и убедитесь, что письмо не попало туда. <br /> Если вы не получили письмо, обратитесь за помощью по адресу support@kinomania.ru </div>');
                                    $('#restoreForm').hide();
                                    $('#socialBlock').hide();
                                } else {
                                    var message = '';
                                    switch (data.error) {
                                        case 'PENDING_TIME':
                                            message = 'Вы недавно отправляли запрос на восстановление, запрашивать ссылку на восстановление пароля можно не более одного раза в сутки';
                                            break;
                                        case 'USER_BAD_STATUS':
                                            message = 'Ваш аккаунт заблокирован';
                                            break;
                                        case 'CANT_SEND_EMAIL':
                                            message = 'Не удалось отправить email, обратитесь за помощью по адресу support@kinomania.ru';
                                            $('#restoreForm').hide();
                                            break;
                                        default:
                                            message = 'Ошибка при отправке запроса на восставноление пароля, попробуйте позже';
                                    }
                                    $('#response').html('<div id="error" class="form-error-text">' + message + '</div>');
                                }
                            },
                            error: function () {
                                $('#response').html('<div id="error" class="form-error-text">Ошибка при отправке запроса на восставноление пароля, попробуйте позже</div>');
                            }
                        });
                        return false;
                    }
                });
            });
            <?php else: ?>
            $(document).ready(function(){
                $("#resetForm").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 4
                        },
                        password_re: {
                            equalTo: '#password'
                        }
                    },
                    messages: {
                        password: {
                            required: "Введите пароль",
                            minlength: "Слишком короткий пароль"
                        },
                        password_re: {
                            equalTo: 'пароли должны совпадать'
                        }
                    },
                    submitHandler: function() {
                        var postData = $('#resetForm').serializeArray();
                        $.ajax({
                            url: '?handler=reset',
                            type: "POST",
                            data: postData,
                            dataType: "json",
                            success: function (data) {
                                if ('' == data.error) {
                                    $('#response').html('<div id="success" class="form-success-text"> Новый пароль успешно установлен <br /> перенаправление через 3 секунды </div>');
                                    $('#resetForm').hide();
                                    $('#socialBlock').hide();
                                    setTimeout(function(){
                                        document.location = '/';
                                    }, 3000);
                                } else {
                                    $('#response').html('<div id="error" class="form-error-text">Не удалось сменить пароль</div>');
                                }
                            },
                            error: function () {
                                $('#response').html('<div id="error" class="form-error-text">Ошибка при смене пароля, попробуйте позже</div>');
                            }
                        });
                        return false;
                    }
                });
            });
            <?php endif ?>
        </script>
    </div>
</div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->
<script src="<?= $static ?>/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
</body>
</html>