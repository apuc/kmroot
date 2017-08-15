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
                    <div class="form-title pagetitle">РЕГИСТРАЦИЯ</div>
                    <div class="form-welcome">
                        <div class="form-welcome-title">Добро пожаловать на KINOMANIA.RU!</div>
                        <div class="form-welcome-text"></div>
                        <div id="response"></div>
                        <noscript>
                            <div id="error" class="form-error-text">
                                пожалуйста включите javascript для нормальной работы сайта
                            </div>
                        </noscript>
                    </div>
                    <div class="form-content">
                        <form method="post" id="registrationForm">
                            <ul>
                                <li>
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" placeholder="" value="">
                                </li>
                                <li>
                                    <label for="login">Логин:</label>
                                    <input type="text" name="login" id="login" placeholder="" value="">
                                </li>
                                <li>
                                    <label for="password">Пароль:</label>
                                    <input type="password" name="password" id="password">
                                </li>
                                <li>
                                    <label for="password_re">Пароль ещё раз:</label>
                                    <input type="password" name="password_re" id="password_re">
                                </li>
                            </ul>
                            <button class="button button4">создать аккаунт</button>
                            <input type="hidden" name="handler" value="register" />
                        </form>
                    </div>
                    <div class="form-add" id="socialBlock">
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
        $("#registrationForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '?handler=checkEmail'
                },
                login: {
                    required: true,
                    minlength: 2,
                    maxlength: 64,
                    regexp: /^[A-Za-z0-9_-]+$/u,
                    remote: '?handler=checkLogin'
                },
                password: {
                    required: true,
                    minlength: 4
                },
                password_re: {
                    equalTo: '#password'
                }
            },
            messages: {
                email: {
                    required: "Введите email",
                    email: "Ошибка в email",
                    remote: "Email уже зарегистрирован"
                },
                login: {
                    required: "Введите логин",
                    minlength: "Не менее 2 символов",
                    maxlength: "Не более 64 символов",
                    regexp: 'Недопустимые символы',
                    remote: 'Такой логин уже занят'
                },
                password: {
                    required: "Введите пароль",
                    minlength: "Слишком короткий пароль"
                },
                password_re: {
                    equalTo: 'пароли должны совпадать'
                }
            },
            submitHandler: function() {
                var postData = $('#registrationForm').serializeArray();
                $.ajax({
                    url: '?handler=register',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (data) {
                        if ('' == data.error) {
                            $('#response').html('<div id="success" class="form-success-text"> Вам на <a href="http://' + data.host + '//">Email</a> отправлено письмо <br /> перейдите по ссылке внутри письма чтобы завершить регистрацию. <br /><br /> Проверьте папку "Спам" и убедитесь, что письмо не попало туда. <br /> Если вы не получили письмо, обратитесь за помощью по адресу support@kinomania.ru </div>');
                            $('#registrationForm').hide();
                            $('#socialBlock').hide();
                        } else {
                            var message = '';
                            switch (data.error) {
                                case 'EMAIL_EXIST':
                                    message = 'Такой email уже зарегистрирован, <a href="/login">авторизироваться</a>';
                                    break;
                                case 'WRONG_EMAIL':
                                    message = 'Ошибка в формате email';
                                    break;
                                case 'LOGIN_EXIST':
                                    message = 'Такой login уже зарегистрирован';
                                    break;
                                case 'WRONG_LOGIN':
                                    message = 'Недопустимые символы в поле login';
                                    break;
                                case 'EMPTY_PASSWORD':
                                    message = 'Пароль должен быть не менее 4 символов';
                                    break;
                                case 'ERROR_SEND_MAIL':
                                    message = 'Не удалось отправить email, обратитесь за помощью по адресу support@kinomania.ru';
                                    $('#registrationForm').hide();
                                    break;
                                default:
                                    message = 'Ошибка при регистрации, попробуйте позже';
                            }
                            $('#response').html('<div id="error" class="form-error-text">' + message + '</div>');
                            $('#password').val('');
                            $('#password_re').val('');
                        }
                    },
                    error: function () {
                        $('#response').html('<div id="error" class="form-error-text">Ошибка при регистрации, попробуйте позже</div>');
                        $('#password').val('');
                        $('#password_re').val('');
                    }
                });
                return false;
            }
        });
    });
</script>
</body>
</html>