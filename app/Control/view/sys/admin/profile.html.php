<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Admin\Item $admin
 * @var array $groupList
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Редактировать профиль</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?= $admin->email() ?>" id="email" class="form-control" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" value="<?= $admin->name() ?>" id="name" class="form-control" placeholder="Имя" />
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input type="text" name="surname" value="<?= $admin->surname() ?>" id="surname" class="form-control" placeholder="Фамилия" />
                        </div>
                        <div class="form-group">
                            <label for="userId">ID аккаунта на сайте</label>
                            <input type="text" name="userId" value="<?= $admin->userId() ?>" id="userId" class="form-control" placeholder="ID пользователя" />
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" value="" id="password" class="form-control" placeholder="Оставьте пустым если не хотите изменять пароль" />
                        </div>
                        <div class="form-group">
                            <label for="password_re">Пароль еще раз</label>
                            <input type="password" name="password_re" value="" id="password_re" class="form-control" />
                        </div>

                        <input type="submit" class="btn btn-primary" value="Сохранить" />

                        <input type="hidden" name="id" value="<?= $admin->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '?handler=checkEmail&id=<?= $admin->id() ?>'
                },
                name: {
                    required: true
                },
                userId: {
                    remote: '?handler=checkUserId&id=<?= $admin->id() ?>'
                },
                password: {
                    minlength: 3
                },
                password_re: {
                    minlength: 3,
                    equalTo: "#password"
                }
            },
            messages: {
                email: {
                    required: "Введите email",
                    email: "Ошибка в email",
                    remote: "Email уже зарегистрирован"
                },
                name: {
                    required: "Введите имя"
                },
                userId: {
                    remote: "Этот ID уже связан с другим аккаунтом"
                },
                password: {
                    minlength: "Слишком короткий пароль"
                },
                password_re: {
                    minlength: "Слишком короткий пароль",
                    equalTo: "Пароли должны совпадать"
                }
            }
        });
    });
</script>