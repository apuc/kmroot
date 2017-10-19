<?php
/**
 * @var \Dspbee\Core\Request $request
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
            <div class="panel-heading text-center">
                Авторизация в системе
            </div>
            <div class="panel-body">
                <p class="text-center"></p>
                <form role="form" id="loginForm" method="post" class="mb-lg">
                    <div class="form-group has-feedback">
                        <label for="email" class="text-muted">Email (LOGIN@kinomania.ru)</label>
                        <input name="email" type="email" placeholder="Введите email" required class="form-control">
                        <span class="fa fa-envelope form-control-feedback text-muted"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password" class="text-muted">Пароль</label>
                        <input name="password" id="password" type="password" placeholder="Пароль" required class="form-control">
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right"><a href="<?= $request->makeUrl('restore') ?>/" class="text-muted">Забыли пароль?</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mt-lg">Войти</button>
                </form>
            </div>
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
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '?handler=checkEmail'
                },
                password: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                email: {
                    required: "Введите email",
                    email: "Ошибка в email",
                    remote: "Email не зарегистрирован"
                },
                password: {
                    required: "Введите пароль",
                    minlength: "Слишком короткий пароль"
                }
            },
            submitHandler: function() {
                var postData = $('#loginForm').serializeArray();
                $.ajax({
                    url : '?handler=login',
                    type: "POST",
                    data : postData,
                    dataType: "json",
                    success:function(data) {
                        if ('' == data.error) {
                            setTimeout(function(){
                                window.location.href = data.redirect;
                            }, 320)
                        } else {
                            switch (data.error) {
                                case 'BANNED':
                                    $('#errorMessage').text('Пользователь заблокирован');
                                    break;
                                case 'NOT_ACTIVE':
                                    $('#errorMessage').text('Пользователь не активирован');
                                    break;
                                default:
                                    $('#errorMessage').text('Ошибка авторизации');
                            }
                            $('#modal').modal({});
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.responseText);
                        console.log("Error: " + textStatus + ' ' + errorThrown);
                    }
                });
            }
        });
    });
</script>
</body>
</html>