<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Dspbee\Bundle\Common\Bag\PostBag $post
 * @var array $groupList
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Добавить администратора</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?= $post->fetch('email') ?>" id="email" class="form-control" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" value="<?= $post->fetch('name') ?>" id="name" class="form-control" placeholder="Имя" />
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input type="text" name="surname" value="<?= $post->fetch('surname') ?>" id="surname" class="form-control" placeholder="Фамилия" />
                        </div>
                        <div class="form-group">
                            <label for="userId">ID аккаунта на сайте</label>
                            <input type="text" name="userId" value="<?= $post->fetch('userId') ?>" id="userId" class="form-control" placeholder="ID пользователя" />
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" value="" id="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password_re">Пароль еще раз</label>
                            <input type="password" name="password_re" value="" id="password_re" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="group">Группа</label>
                            <select name="group">
                                <option value="0">Вне групп</option>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Admin\Group\Item $group
                                 */
                                ?>
                                <?php foreach ($groupList as $group): ?>
                                    <option value="<?= $group->id() ?>" <?php if ($post->fetchInt('group') == $group->id()): ?> selected="selected" <?php endif ?>>
                                        <?= $group->name() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <a href="<?= $request->makeUrl('sys/admin') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" class="btn btn-primary margin20" value="Добавить" />

                        <input type="hidden" name="handler" value="add" />
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
                    remote: '?handler=checkEmail'
                },
                name: {
                    required: true
                },
                userId: {
                    remote: '?handler=checkUserId'
                },
                password: {
                    required: true,
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
                    required: "Введите пароль",
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