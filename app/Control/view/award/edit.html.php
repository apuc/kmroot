<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Award\Item $item
 */
?>

<!-- extends base.html.php -->

<div class="content-heading">
    Редактировать премию
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="code">
                                Короткое название
                            </label>
                            <input type="text" name="code" id="code" value="<?= $item->code() ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name_ru">
                                Русское название
                            </label>
                            <input type="text" name="name_ru" id="name_ru" value="<?= $item->name_ru() ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name_en">
                                Английское название
                            </label>
                            <input type="text" name="name_en" id="name_en" value="<?= $item->name_en() ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="type">
                                Тип
                            </label>
                            <select name="type" id="type" class="chosen-select form-control">
                                <option <?php if ('award' == $item->type(1)): ?> selected="selected" <?php endif; ?> value="award">Кинопремия</option>
                                <option <?php if ('festival' == $item->type(1)): ?> selected="selected" <?php endif; ?> value="festival">Кинофестиваль</option>
                                <option <?php if ('hidden' == $item->type(1)): ?> selected="selected" <?php endif; ?> value="hidden">Скрыт</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">
                                Описание
                            </label>
                            <textarea rows="5" name="description" id="description" class="form-control note-editor"><?= $item->description() ?></textarea>
                        </div>


                        <a href="<?= $request->makeUrl('award') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" class="btn btn-primary margin20" value="Сохранить" />

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery.validator.addMethod(
        'regexp',
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                code: {
                    required: true,
                    regexp: /^[a-z0-9]+$/u,
                    remote: '?handler=checkCode&id=<?= $item->id() ?>'
                },
                name_ru: {
                    required: true
                }
            },
            messages: {
                code: {
                    required: "Введите короткое название",
                    regexp: 'Недопустимые символы',
                    remote: "Такое название уже занято"
                },
                name_ru: {
                    required: "Введите название"
                }
            }
        });
    });
</script>