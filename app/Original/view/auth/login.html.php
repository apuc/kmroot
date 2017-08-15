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
                <!-- Контент -->
                <content class="page-section-content page-no-aside section-content content-outer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="outer-form login">
                        <div class="form-title pagetitle">ВХОД</div>
                        <div class="form-welcome">
                            <div class="form-welcome-text">
                                Войдите или зарегистрируйтесь, чтобы комментировать, ставить оценки, участвовать в конкурсах, создавать коллекции любимых фильмов, получать рекомендации и всегда знать, на что сходить в кино и что посмотреть дома.
                            </div>
                        </div>
                        <div id="response"></div>
                        <noscript>
                            <div id="error" class="form-error-text">
                                пожалуйста включите javascript для нормальной работы сайта
                            </div>
                        </noscript>
                        <div class="form-content">
                            <form method="post" id="loginForm">
                                <ul>
                                    <li>
                                        <label for="login">Логин:</label>
                                        <input type="text" name="login" id="login" placeholder="" value="">
                                    </li>
                                    <li>
                                        <label for="password">Пароль:</label>
                                        <input type="password" name="password" id="password">
                                    </li>
                                </ul>
                                <button class="button button4">войти</button>
                                <div class="row-forgot-password"><a href="/restore/" class="forgot-password">Забыли пароль?</a></div>
                                <input type="hidden" name="handler" value="login" />
                            </form>
                            <div class="reg">Еще нет аккаунта? <a href="/registration_/">Пожалуйста, зарегистрируйтесь</a></div>
                        </div>
                        <div class="form-add">
                            <div class="form-social-text">Или войдите через акканут социальных сетей:</div>
                            <div class="form-social">
                                <ul>
                                    <li class="form-social-icon"><a href="http://oauth.vk.com/authorize?client_id=2142664&scope=notify&redirect_uri=http://kinomania.ru/social_login/vkontakte&response_type=code" class="vk"></a></li>
                                    <li class="form-social-icon"><a href="https://www.facebook.com/dialog/oauth?client_id=164790803722093&redirect_uri=http://kinomania.ru/social_login/facebook&response_type=code&scope=email" class="fb"></a></li>
                                    <!-- <li class="form-social-icon"><a href="#" class="ok"></a></li> -->
                                    <!-- <li class="form-social-icon"><a href="#" class="tw"></a></li> -->
                                    <!-- <li class="form-social-icon"><a href="#" class="gplus"></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </content>
            </section>
        </div>
    </div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->
<script src="<?= $static ?>/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery.validator.addMethod(
            'regexp',
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );
        $("#loginForm").validate({
            rules: {
                login: {
                    required: true,
                    minlength: 2,
                    maxlength: 64,
                    regexp: /^[A-Za-z0-9_-]+$/u,
                    remote: '?handler=checkLogin'
                },
                password: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                login: {
                    required: "Введите логин",
                    minlength: "Не менее 2 символов",
                    maxlength: "Не более 64 символов",
                    regexp: 'Недопустимые символы',
                    remote: 'Такой логин не зарегистрирован'
                },
                password: {
                    required: "Введите пароль",
                    minlength: "Слишком короткий пароль"
                }
            },
            submitHandler: function() {
                $('#response').html('');
                var postData = $('#loginForm').serializeArray();
                $.ajax({
                    url: '?handler=login',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (data) {
                        if ('' == data.error) {
                            document.location = '/';
                        } else {
                            var message = '';
                            switch (data.error) {
                                case 'NOT_ACTIVE':
                                    message = 'Аккаунт не активирован <br /><br /> Проверьте папку "Спам" и убедитесь, что письмо не попало туда. <br /> Если вы не получили письмо, обратитесь за помощью по адресу support@kinomania.ru';
                                    break;
                                case 'BANNED':
                                    message = 'Ваш аккаунт заблокирован';
                                    break;
                                default:
                                    message = 'Неправильный логин или пароль';
                            }
                            $('#response').html('<div id="error" class="form-error-text">' + message + '</div>');
                            $('#password').val('');
                        }
                    },
                    error: function () {
                        $('#response').html('<div id="error" class="form-error-text">Ошибка при авторизации, попробуйте позже</div>');
                        $('#password').val('');
                    }
                });
                return false;
            }
        });
    });
</script>
</body>
</html>