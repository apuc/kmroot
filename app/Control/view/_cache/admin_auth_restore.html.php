<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $hash
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Авторизация</title>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="/vendor/cms/fontawesome/css/font-awesome.min.css">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="/vendor/cms/simple-line-icons/css/simple-line-icons.css">
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="/vendor/cms/_css/bootstrap.css">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="/vendor/cms/_css/app.css">
    <style>
        body {
            background-color: #3a3f51;
        }
        .panel-heading {
            background-color: #323644 !important;
            border-radius: 0;
            color: #909fa7 !important;
        }
        .panel-flat {
            margin-top: 100px !important;
            -webkit-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.15);
            -moz-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.15);
            box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="block-center mt-xl wd-xl">
        <!-- START panel-->
        <div class="panel panel-dark panel-flat">
            <?php if (empty($hash)): ?>
                <div class="panel-heading text-center">
                    Восстановление пароля
                </div>
                <div class="panel-body">
                    <p class="text-center"></p>
                    <form role="form" id="recoverForm" method="post" class="mb-lg">
                        <div class="form-group has-feedback">
                            <label for="email" class="text-muted">Email</label>
                            <input name="email" id="email" type="email" placeholder="Введите email" required class="form-control">
                            <span class="fa fa-envelope form-control-feedback text-muted"></span>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mt-lg">Отправить</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="panel-heading text-center">
                    Установка нового пароля
                </div>
                <div class="panel-body">
                    <p class="text-center"></p>
                    <form role="form" id="passwordForm" method="post" class="mb-lg">
                        <div class="form-group has-feedback">
                            <label for="password" class="text-muted">Пароль</label>
                            <input name="password" id="password" type="password" placeholder="Пароль" required class="form-control">
                            <span class="fa fa-lock form-control-feedback text-muted"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password_re" class="text-muted">Повторите пароль</label>
                            <input name="password_re" id="password_re" type="password" placeholder="Пароль еще раз" required class="form-control">
                            <span class="fa fa-lock form-control-feedback text-muted"></span>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mt-lg">Сохранить</button>
                    </form>
                </div>
            <?php endif ?>
        </div>
        <!-- END panel-->
        <div class="p-lg text-center">
            <span class="font-os"></span>
        </div>
    </div>
</div>

<div id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelSmall" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="modal_title" class="modal-title">Авторизация</h4>
            </div>
            <div class="modal-body alert-danger" id="errorMessage"></div>
            <div class="modal-footer">
                <button id="close" type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="/vendor/cms/modernizr/modernizr.js"></script>
<!-- JQUERY-->
<script src="/vendor/cms/jquery/dist/jquery.js"></script>
<!-- BOOTSTRAP-->
<script src="/vendor/cms/bootstrap/dist/js/bootstrap.js"></script>
<!-- STORAGE API-->
<script src="/vendor/cms/jQuery-Storage-API/jquery.storageapi.js"></script>
<!-- PARSLEY-->
<script src="/vendor/cms/parsleyjs/dist/parsley.min.js"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="/vendor/cms/_js/app.js"></script>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<style>
    .fa.fa-lock.form-control-feedback, .has-feedback label~.form-control-feedback {
        left: 88%;
        top: 26px;
    }
    label.error, #errorText{
        color: #FF0000;
        font-size: 0.9em;
        font-weight: normal;
        margin-left: 13px;
        display: inline-block;
    }
    #modal {
        margin-top: 100px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if (empty($hash)): ?>
        $("#recoverForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '<?= $request->makeUrl('login?handler=checkEmail') ?>'
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
                var postData = $('#recoverForm').serializeArray();
                $.ajax({
                    url : '?handler=recover',
                    type: "POST",
                    data : postData,
                    dataType: "json",
                    success:function(data) {
                        if ('' == data.error) {
                            $('#errorMessage').text('Вам на email отправлена ссылка на изменение пароля').removeClass('alert-danger').addClass('alert-success');
                            $('#modal').modal({});
                        } else {
                            $('#errorMessage').addClass('alert-danger').removeClass('alert-success');
                            switch (data.error) {
                                case 'CANT_SEND_EMAIL':
                                    $('#errorMessage').text('Не удалось отправить email');
                                    break;
                                case 'WRONG_EMAIL':
                                    $('#errorMessage').text('Ошибка в email адресе');
                                    break;
                                case 'EMAIL_NOT_FOUND':
                                    $('#errorMessage').text('Пользователь не найден');
                                    break;
                                case 'PENDING_TIME':
                                    $('#errorMessage').text('Вы уже надавно отправляли запрос на восстановление');
                                    break;
                                case 'USER_BAD_STATUS':
                                    $('#errorMessage').text('Пользователь не активирован или заблокирован');
                                    break;
                                default:
                                    $('#errorMessage').text('Ошибка при обработке запроса на восстановление');
                            }
                            $('#modal').modal({});
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + textStatus + ' ' + errorThrown);
                    }
                });
            }
        });
        <?php else: ?>
        $("#passwordForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 3
                },
                password_re: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                password: {
                    required: "Введите пароль",
                    minlength: "Слишком короткий пароль"
                },
                password_re: {
                    required: "Введите пароль",
                    equalTo: "Пароли должны совпадать"
                }
            },
            submitHandler: function() {
                var postData = $('#passwordForm').serializeArray();
                $.ajax({
                    url : '?handler=reset&h=<?= $hash ?>',
                    type: "POST",
                    data : postData,
                    dataType: "json",
                    success:function(data) {
                        if ('' == data.error) {
                            document.location = '/control/';
                        } else {
                            switch (data.error) {
                                case 'FAIL':
                                    $('#errorMessage').text('Не удалось изменить пароль');
                                    break;
                                default:
                                    $('#errorMessage').text('Не удалось изменить пароль');
                            }
                            $('#modal').modal({});
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + textStatus + ' ' + errorThrown);
                    }
                });
            }
        });
        <?php endif ?>
    });
</script>
</body>
</html>