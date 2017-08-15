<?php
/**
 * @var string $login
 * @var string $image
 * @var string $image_raw
 * @var string $image_small
 * @var string $image_small_raw
 * @var array $item
 * @var int $max
 * @var int $min
 */
use Kinomania\Original\Key\User\User;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Настройки пользователя <?= $login ?></title>

    <!-- include section/head.html.php -->
<body>
  <!--#include virtual="/design/ssi/top" -->
<div class="outer">
    <div class="wrap">
        <!-- include section/header.html.php -->
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <div class="head-content">
                <div class="info-user">
                    <h1 class="pagetitle mini__pagetitle login__user" id="login"><?= $login ?></h1>
                    <h2 class="name__page"><?= $item[User::NAME] ?> <?= $item[User::SURNAME] ?></h2>
                </div>
                <div class="nav-content">
                    <!-- include user/section/menu.html.php -->        
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content profile-section-content section-content content-outercol-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="list-content">
                        <div class="list-info-content">
                            <div class="list-info-content__title list-content-title">АВАТАР</div>
                            <div class="row-list-info-item clear">
                                <div class="row-avatar-profile">
                                    <div class="avatar-profile">
                                        <div class="section-result-item list-preview">
                                        <span class="image-portair">
                                            <img class=" image-padding--white" id="avatar_image" src="<?= $image ?>" data-src="<?= $image_raw ?>" alt="">
                                        </span>
                                        </div>
                                    </div>
                                    <div class="avatar-profile-add">
                                        <div class="avatar-profile--mini-image avatar-profile-m"><img src="<?= $image_small ?>" data-src="<?= $image_small_raw ?>" alt="" id="avatar_image_small"></div>
                                        <div class="avatar-profile--mini-image avatar-profile-mm"><img src="<?= $image_small ?>" alt="" width="36px" id="avatar_image_small_2"></div>
                                    </div>
                                </div>
                                <div class="row-avatar-content">
                                    <div class="avatar-upload-file">
                                        <div class="center-loader" style="display: none;margin-left: 50px;">
                                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                            <br />
                                        </div>
                                        <form method="post" id="fileForm">
                                            <input id="avatar" type="file">
                                        </form>
                                        <p class="avatar-upload-warning">
                                            Допустимы форматы: GIF, JPG, PNG.<br>Не более 5 Мб.<br>Не более 1600 px по большей стороне.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="post" id="lpForm">
                            <div class="list-info-content">
                                <div class="list-info-content__title list-content-title">ЛОГИН И ПАРОЛЬ</div>
                                <div class="row-list-info-item clear">
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="email">
                                                    Email
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="text" name="email" id="email" class="input-field" value="<?= $item[User::EMAIL] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="login">
                                                Логин
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="text" name="login" id="login" class="input-field" value="<?= $login ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="current_password">
                                                Текущий пароль
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="password" name="current_password" id="current_password" data-type="hide" class="input-field" value="">
                                            </div>
                                            <div class="row-field-add-icon">
                                                <ul class="field-add-icon-list">
                                                    <li class="check-hide" data-type="view">
                                                        <input type="checkbox" checked="" id="shit_1">
                                                        <label for="shit_1" class="noselect">
                                                        Скрыть
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="password">
                                                Новый пароль
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="password" name="password" id="password" data-type="hide" class="input-field" value="">
                                            </div>
                                            <div class="row-field-add-icon">
                                                <ul class="field-add-icon-list">
                                                    <li class="check-hide" data-type="view">
                                                        <input type="checkbox" checked="" id="shit_2">
                                                        <label for="shit_2" class="noselect">
                                                            Скрыть
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="password_re">
                                                Повтор пароля
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="password" name="password_re" id="password_re" data-type="hide" class="input-field" value="">
                                            </div>
                                            <div class="row-field-add-icon">
                                                <ul class="field-add-icon-list">
                                                    <li class="check-hide" data-type="view">
                                                        <input type="checkbox" checked="" id="shit_3">
                                                        <label for="shit_3" class="noselect">
                                                            Скрыть
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-button-form">
                                        <div class="center-loader-2" style="display: none;margin-left: 205px; margin-top: 20px; position: absolute;">
                                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                            <br />
                                        </div>
                                        <button class="button button4" id="lpFormBtn">СОХРАНИТЬ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" id="dataForm">
                            <div class="list-info-content data-profile">
                                <div class="list-info-content__title list-content-title">ДАННЫЕ ПОЛЬЗОВАТЕЛЯ</div>
                                <div class="row-list-info-item clear">
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="name">
                                                Имя
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="text" name="name" id="name" class="input-field" value="<?= $item[User::NAME] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="surname">
                                                    Фамилия
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="text" name="surname" id="surname" class="input-field" value="<?= $item[User::SURNAME] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">Пол</div>
                                            <div class="row-input">
                                                <div class="row-radio-my">
                                                    <div class="radio-my <?php if ('male' == $item[User::SEX]): ?> active <?php endif ?>">
                                                        <div class="inner-radio">
                                                            <input name="sex" value="male" type="radio" <?php if ('male' == $item[User::SEX]): ?> checked="checked" <?php endif ?> placeholder="">
                                                            <i class="my-radio"></i>
                                                        </div>
                                                        Мужской
                                                    </div>
                                                    <div class="radio-my <?php if ('female' == $item[User::SEX]): ?> active <?php endif ?>">
                                                        <div class="inner-radio">
                                                            <input name="sex" value="female" type="radio" <?php if ('female' == $item[User::SEX]): ?> checked="checked" <?php endif ?>  placeholder="">
                                                            <i class="my-radio"></i>
                                                        </div>
                                                        Женский
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">Дата рождения</div>
                                            <div class="row-input">
                                                <div class="row-dropdown-input">
                                                    <select name="day" id="day">
                                                        <option value="" selected="selected">День</option>
                                                        <?php for ($i = 1; $i <= 31; $i++): ?>
                                                            <option <?php if ($item[User::DAY] == $i): ?> selected="selected" <?php endif ?> value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                    <select name="month" id="month">
                                                        <option value="" selected="selected" title="1">Месяц</option>
                                                        <option <?php if (1 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="1">Январь - January</option>
                                                        <option <?php if (2 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="2">Февраль - February</option>
                                                        <option <?php if (3 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="3">Март - March</option>
                                                        <option <?php if (4 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="4">Апрель - April</option>
                                                        <option <?php if (5 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="5">Май - May</option>
                                                        <option <?php if (6 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="6">Июнь - June</option>
                                                        <option <?php if (7 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="7">Июль - July</option>
                                                        <option <?php if (8 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="8">Август - August</option>
                                                        <option <?php if (9 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="9">Сентябрь - September</option>
                                                        <option <?php if (10 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="10">Октябрь - October</option>
                                                        <option <?php if (11 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="11">Ноябрь - November</option>
                                                        <option <?php if (12 == $item[User::MONTH]): ?> selected="selected" <?php endif ?> value="12">Декабрь - December</option>
                                                    </select>
                                                    <select name="year" id="year">
                                                        <option value="" selected="selected">Год</option>
                                                        <?php for ($i = $max; $i > $min; $i--): ?>
                                                            <option <?php if ($item[User::YEAR] == $i): ?> selected="selected" <?php endif ?> value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="city">
                                                    Город
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <input type="text" name="city" id="city" class="input-field" value="<?= $item[User::CITY] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="about">
                                                    О себе
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <textarea name="about" id="about" class="input-field"><?= $item[User::ABOUT] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name">
                                                <label for="interest">
                                                    О Интересы
                                                </label>
                                            </div>
                                            <div class="row-input">
                                                <textarea name="interest" id="interest" class="input-field"><?= $item[User::INTEREST] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-vk"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="vk" id="vk" value="<?= $item[User::VK] ?>">
                                            </div>
                                            <!-- 
                                            <div class="row-field-add-icon">
                                                <ul class="field-add-icon-list">
                                                    <li class="field-add-icon field-add-icon-link" data-type="link"></li>
                                                </ul>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-fb"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="fb" id="fb" value="<?= $item[User::FB] ?>">
                                            </div>
                                            <!-- 
                                            <div class="row-field-add-icon">
                                                <ul class="field-add-icon-list">
                                                    <li class="field-add-icon field-add-icon-link" data-type="link"></li>
                                                </ul>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-mail"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="my_mail" id="my_mail" value="<?= $item[User::MY_MAIL] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-inst"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="instagram" id="my_mail" value="<?= $item[User::INSTAGRAM] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-tg"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="tg" id="tg" value="<?= $item[User::TG] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-tw"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="twitter" id="twitter" value="<?= $item[User::TWITTER] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-gp"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="google_plus" id="google_plus" value="<?= $item[User::GOOGLE_PLUS] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-lj"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="live_journal" id="live_journal" value="<?= $item[User::LIVE_JOURNAL] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-icq"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="icq" id="icq" value="<?= $item[User::ICQ] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-ok"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="ok" id="ok" value="<?= $item[User::OK] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form-input">
                                        <div class="form-input-item clear">
                                            <div class="value-name value-name-social value-name-social-sk"></div>
                                            <div class="row-input">
                                                <input type="text" class="input-field" name="skype" id="skype" value="<?= $item[User::SKYPE] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-button-form">
                                        <div class="center-loader-3" style="display: none;margin-left: 205px; margin-top: 20px; position: absolute;">
                                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                            <br />
                                        </div>
                                        <button class="button button4" id="dataFormBtn">СОХРАНИТЬ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

        $('#avatar').change(function(){
            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);

            $('.center-loader').show();
            $('#fileForm').hide();

            var fd = new FormData();
            fd.append("fileList[]", $('#avatar')[0].files[0]);
            if (undefined !== $('#avatar')[0].files[0] && 5242880 < $('#avatar')[0].files[0].size) { // 5m
                me.data('requestRunning', false);
                $('.center-loader').hide();
                $('#fileForm').show();
                document.getElementById('avatar').value = '';
                $('#avatar').notify("Недопустимый размер файла", {position: "top", autoHideDelay: 2000});
            } else {
                $.ajax({
                    "type": "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    "url": "?handler=avatar",
                    "success": function (data) {
                        data = JSON.parse(data);

                        $('#fileForm').show();
                        switch (data.er) {
                            case 0:
                                if ('' != data.ex) {
                                    var image_src = $('#avatar_image').attr('data-src');
                                    image_src = image_src.split('?');
                                    image_src = image_src[0];
                                    image_src = image_src.split('.');
                                    image_src[image_src.length - 1] = data.ex;
                                    image_src = image_src.join('.');
                                    
                                    var image_small_src = $('#avatar_image_small').attr('data-src');
                                    image_small_src = image_small_src.split('?');
                                    image_small_src = image_small_src[0];
                                    image_small_src = image_small_src.split('.');
                                    image_src[image_src.length - 1] = data.ex;
                                    image_small_src = image_small_src.join('.');

                                    $('#avatar_image').attr('src', image_src + '?' + Math.random() + 1);
                                    $('#avatar_image_small').attr('src', image_small_src + '?' + Math.random() + 2);
                                    $('#avatar_image_small_2').attr('src', image_small_src + '?' + Math.random() + 3);
                                }
                                break;
                            case 1:
                                $('#avatar').notify("Недопустимый формат файла", {
                                    position: "top",
                                    autoHideDelay: 2000
                                });
                                break;
                            case 2:
                                $('#avatar').notify("Недопустимый размер файла", {
                                    position: "top",
                                    autoHideDelay: 2000
                                });
                                break;
                            case 6:
                                $('#avatar').notify("Недопустимое разрешение файла", {
                                    position: "top",
                                    autoHideDelay: 2000
                                });
                                break;
                            default:
                                $('#avatar').notify("Не удалось загрузить файл", {
                                    position: "top",
                                    autoHideDelay: 2000
                                });
                        }
                    },
                    complete: function () {
                        me.data('requestRunning', false);
                        $('.center-loader').hide();
                        $('#fileForm').show();
                        document.getElementById('avatar').value = '';
                    }
                });
            }
        });

        $('#dataFormBtn').click(function(event){
            event = event || window.event;
            event.preventDefault();

            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);

            $('.center-loader-3').show();

            var postData = $('#dataForm').serializeArray();
            $.ajax({
                url: '?handler=editData',
                type: "POST",
                data: postData,
                dataType: "json",
                success: function (data) {
                    if ('' == data.error) {
                        $('#dataFormBtn').notify("Изменения успешно сохранены", {
                            className: "success",
                            position: "right",
                            autoHideDelay: 2000
                        });
                    } else {
                        switch (data.error) {
                            case 'EMAIL_EXIST':
                                $('#dataFormBtn').notify("Такой email уже зарегистрирован", {
                                    position: "right",
                                    autoHideDelay: 2000
                                });
                                break;
                            default:
                                $('#dataFormBtn').notify("Ошибка при обработке формы", {
                                    position: "right",
                                    autoHideDelay: 2000
                                });
                        }
                    }
                },
                complete: function () {
                    me.data('requestRunning', false);
                    $('.center-loader-3').hide();
                },
                error: function () {
                    me.data('requestRunning', false);
                    $('.center-loader-3').hide();
                    $('#dataFormBtn').notify("Ошибка при обработке формы", {
                        position: "right",
                        autoHideDelay: 2000
                    });
                },
                timeout: 5000
            });

            return false;
        });


        $('.check-hide input').click(function() {
            var findInputHide = $(this).parents('.form-input-item').find('input[data-type = hide]');
            if ($(this).is(':checked')){
                findInputHide.attr('type', 'password');
            }else {
                findInputHide.attr('type', 'text');
            }
        });
    })
</script>

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
        $("#lpForm").validate({
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
                current_password: {
                    minlength: 2,
                    remote: '?handler=checkPassword'
                },
                password: {
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
                current_password: {
                    minlength: "Слишком короткий пароль",
                    remote: "Неправильный пароль"
                },
                password: {
                    minlength: "Слишком короткий пароль"
                },
                password_re: {
                    equalTo: 'пароли должны совпадать'
                }
            },
            submitHandler: function() {
                var me = $(this);
                if (me.data('requestRunning')) {
                    return;
                }
                me.data('requestRunning', true);

                $('.center-loader-2').show();


                var postData = $('#lpForm').serializeArray();
                $.ajax({
                    url: '?handler=editMain',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (data) {
                        if ('' == data.error) {
                            if ('<?= $login ?>' != data.login) {
                                document.location = '/logout';
                            } else {
                                $('#lpFormBtn').notify("Изменения успешно сохранены", {
                                    className: "success",
                                    position: "right",
                                    autoHideDelay: 2000
                                });
                            }
                        } else {
                            switch (data.error) {
                                case 'EMAIL_EXIST':
                                    $('#lpFormBtn').notify("Такой email уже зарегистрирован", {
                                        position: "right",
                                        autoHideDelay: 2000
                                    });
                                    break;
                                case 'WRONG_EMAIL':
                                    $('#lpFormBtn').notify("Ошибка в формате email", {
                                        position: "right",
                                        autoHideDelay: 2000
                                    });
                                    break;
                                case 'LOGIN_EXIST':
                                    $('#lpFormBtn').notify("Такой login уже зарегистрирован", {
                                        position: "right",
                                        autoHideDelay: 2000
                                    });
                                    break;
                                case 'WRONG_LOGIN':
                                    $('#lpFormBtn').notify("Ошибка в формате login", {
                                        position: "right",
                                        autoHideDelay: 2000
                                    });
                                    break;
                                default:
                                    $('#lpFormBtn').notify("Ошибка при обработке формы", {
                                        position: "right",
                                        autoHideDelay: 2000
                                    });
                            }
                        }
                    },
                    complete: function () {
                        me.data('requestRunning', false);
                        $('.center-loader-2').hide();
                        $('#current_password').val('');
                        $('#password').val('');
                        $('#password_re').val('');
                    },
                    error: function () {
                        me.data('requestRunning', false);
                        $('.center-loader-2').hide();
                        $('#lpFormBtn').notify("Ошибка при обработке формы", {
                            position: "right",
                            autoHideDelay: 2000
                        });
                        $('#current_password').val('');
                        $('#password').val('');
                        $('#password_re').val('');
                    }
                });
                return false;
            }
        });

        $('.radio-my').click(function() {
            $(':radio').removeAttr('checked');
            $('.radio-my').removeClass('active');
            $(this).addClass('active');
            $(this).find('input').prop('checked', true);
        });
    });
</script>
</body>
</html>
