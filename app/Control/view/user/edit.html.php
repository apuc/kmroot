<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\User\Item $user
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Редактировать пользователя</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <fieldset class="panel-body">
                    <form method="post" id="validateForm">
                        <fieldset>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" name="id" value="<?= $user->id() ?>" id="id" class="form-control" readonly="readonly" />
                                </div>
                                <div class="form-group">
                                    <label for="registration">Дата регистрации</label>
                                    <input type="text" name="registration" value="<?= $user->registration() ?>" id="registration" class="form-control" readonly="readonly" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="<?= $user->email() ?>" id="email" class="form-control" placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" value="<?= $user->name() ?>" id="name" class="form-control" placeholder="Имя" />
                                </div>
                                <div class="form-group">
                                    <label for="surname">Фамилия</label>
                                    <input type="text" name="surname" value="<?= $user->surname() ?>" id="surname" class="form-control" placeholder="Фамилия" />
                                </div>
                                <div class="form-group">
                                    <label for="sex">Пол</label>
                                    <select name="sex">
                                        <option value="">Неизвестно</option>
                                        <option <?php if ('Мужчина' == $user->sex()): ?> selected="selected" <?php endif ?> value="male">Мужчина</option>
                                        <option <?php if ('Женщина' == $user->sex()): ?> selected="selected" <?php endif ?> value="female">Женщина</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">Город</label>
                                    <input type="text" name="city" value="<?= $user->city() ?>" id="city" class="form-control" placeholder="Город" />
                                </div>
                                <div class="form-group">
                                    <label for="about">О себе</label>
                                    <textarea rows="5" name="about" id="about" class="form-control note-editor"><?= $user->about() ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="interest">Интересы</label>
                                    <textarea rows="5" name="interest" id="interest" class="form-control note-editor"><?= $user->interest() ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Дата рождения</label>
                                    <div id="datePicker" class="input-group date">
                                        <input type="text" name="birthday" value="<?= $user->birthday(false) ?>" id="birthday" class="form-control" placeholder="День рождения">
                                         <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                         </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="vk">Страница Vkontakte</label>
                                    <input type="text" name="vk" value="<?= $user->vk() ?>" id="vk" class="form-control" placeholder="Vkontakte" />
                                </div>
                                <div class="form-group">
                                    <label for="fb">Страница Facebook</label>
                                    <input type="text" name="fb" value="<?= $user->fb() ?>" id="fb" class="form-control" placeholder="Facebook" />
                                </div>
                                <div class="form-group">
                                    <label for="ok">Страница Odnoklasniki</label>
                                    <input type="text" name="ok" value="<?= $user->ok() ?>" id="ok" class="form-control" placeholder="Odnoklasniki" />
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Страница Twitter</label>
                                    <input type="text" name="twitter" value="<?= $user->twitter() ?>" id="twitter" class="form-control" placeholder="Twitter" />
                                </div>
                                <div class="form-group">
                                    <label for="googlePlus">Страница Google Plus</label>
                                    <input type="text" name="googlePlus" value="<?= $user->googlePlus() ?>" id="googlePlus" class="form-control" placeholder="Google Plus" />
                                </div>
                                <div class="form-group">
                                    <label for="liveJournal">Страница LiveJournal</label>
                                    <input type="text" name="liveJournal" value="<?= $user->liveJournal() ?>" id="liveJournal" class="form-control" placeholder="LiveJournal" />
                                </div>
                                <div class="form-group">
                                    <label for="tg">Страница telegram</label>
                                    <input type="text" name="tg" value="<?= $user->tg() ?>" id="tg" class="form-control" placeholder="Telegram" />
                                </div>
                                <div class="form-group">
                                    <label for="myMail">Страница myMail</label>
                                    <input type="text" name="myMail" value="<?= $user->myMail() ?>" id="myMail" class="form-control" placeholder="myMail" />
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Страница instagram</label>
                                    <input type="text" name="instagram" value="<?= $user->instagram() ?>" id="instagram" class="form-control" placeholder="instagram" />
                                </div>
                                <div class="form-group">
                                    <label for="icq">ICQ</label>
                                    <input type="text" name="icq" value="<?= $user->icq() ?>" id="icq" class="form-control" placeholder="ICQ" />
                                </div>
                                <div class="form-group">
                                    <label for="skype">Skype</label>
                                    <input type="text" name="skype" value="<?= $user->skype() ?>" id="skype" class="form-control" placeholder="Skype" />
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" name="password" value="" id="password" class="form-control" placeholder="Оставьте пустым если не хотите изменять пароль" />
                                </div>
                                <div class="form-group">
                                    <label for="password_re">Пароль еще раз</label>
                                    <input type="password" name="password_re" value="" id="password_re" class="form-control" />
                                </div>
                            </div>
                        </fieldset>

                        <a href="<?= $request->makeUrl('user') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" value="Сохранить" class="btn btn-primary margin20" />

                        <input type="hidden" name="id" value="<?= $user->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<script src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datePicker').datetimepicker({
            format: "DD.MM.YYYY"
        });
        
        $("#validateForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: '?handler=checkEmail&id=<?= $user->id() ?>'
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