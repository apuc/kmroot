<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Award\Item $award
 * @var \Kinomania\Control\Award\Nomination\Item $nomination
 * @var array $list
 */
?>

<!-- extends base.html.php -->

<div class="content-heading">
    Номинации `<?= $award->name_ru() ?>`
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <?php if (0 == $nomination->id()): ?>
                        <form method="post" id="validateForm">
                            <div class="form-group">
                                <label for="name_ru">
                                    Русское название
                                </label>
                                <input type="text" name="name_ru" id="name_ru" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name_en">
                                    Английское название
                                </label>
                                <input type="text" name="name_en" id="name_en" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type">
                                    Тип
                                </label>
                                <select name="type" id="type" class="chosen-select form-control">
                                    <option selected="selected" value="person_film">Человек и фильм</option>
                                    <option value="film">Только фильм</option>
                                </select>
                            </div>

                            <a href="<?= $request->makeUrl('award') ?>/" class="btn btn-default">Назад</a>
                            <input type="submit" class="btn btn-primary margin20" value="Добавить" />

                            <input type="hidden" name="awardId" value="<?= $award->id() ?>" />
                            <input type="hidden" name="handler" value="add" />
                        </form>
                    <?php else: ?>
                        <form method="post" id="validateForm">
                            <div class="form-group">
                                <label for="name_ru">
                                    Русское название
                                </label>
                                <input type="text" name="name_ru" id="name_ru" value="<?= $nomination->name_ru() ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name_en">
                                    Английское название
                                </label>
                                <input type="text" name="name_en" id="name_en" value="<?= $nomination->name_en() ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type">
                                    Тип
                                </label>
                                <select name="type" id="type" class="chosen-select form-control">
                                    <option <?php if ('person_film' == $nomination->type()): ?> selected="selected" <?php endif ?> value="person_film">Человек и фильм</option>
                                    <option <?php if ('film' == $nomination->type()): ?> selected="selected" <?php endif ?> value="film">Только фильм</option>
                                </select>
                            </div>

                            <a href="<?= $request->makeUrl('award') ?>/" class="btn btn-default">Назад</a>
                            <input type="submit" class="btn btn-primary margin20" value="Сохранить" />

                            <input type="hidden" name="id" value="<?= $nomination->id() ?>" />
                            <input type="hidden" name="awardId" value="<?= $award->id() ?>" />
                            <input type="hidden" name="handler" value="edit" />
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (count($list)): ?>
<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-responsive">
                            <colgroup>
                                <col width="auto" />
                                <col width="auto" />
                                <col width="auto" />
                                <col width="100px" />
                                <col width="200px" />
                            </colgroup>
                            <tr style="background-color: #ffffff">
                                <th>ID</th>
                                <th>Русское название</th>
                                <th>Английское название</th>
                                <th>Тип</th>
                                <th></th>
                            </tr>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td><?= $item->id() ?></td>
                                    <td><?= $item->name_ru() ?></td>
                                    <td><?= $item->name_en() ?></td>
                                    <td>
                                        <?php if ('person_film' == $item->type()): ?>
                                            <span class="label label-purple">Человек и фильм</span>
                                        <?php else: ?>
                                            <span class="label label-success">Только фильм</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('award/nomination?id=' . $award->id() . '&nominationId=' . $item->id()) ?>/">Редактировать</a> &nbsp;
                                        <form method="post" class="saveScrollPosition" style="display: inline-block;">
                                            <input type="submit" class="btn btn-xs btn-danger delConfirm" data-title="Удалить номинацию `<?= $item->name_ru() ?>`?" value="Удалить" />
                                            <input type="hidden" name="id" value="<?= $item->id() ?>" />
                                            <input type="hidden" name="awardId" value="<?= $award->id() ?>" />
                                            <input type="hidden" name="handler" value="delete" />
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

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
        <?php if (0 == $nomination->id()): ?>
        $("#validateForm").validate({
            rules: {
                name_ru: {
                    required: true,
                    remote: '?handler=checkName&awardId=<?= $award->id() ?>'
                }
            },
            messages: {
                name_ru: {
                    required: "Введите короткое название",
                    remote: "Такое название уже занято"
                }
            }
        });
        <?php else: ?>
        $("#validateForm").validate({
            rules: {
                name_ru: {
                    required: true,
                    remote: '?handler=checkNameEdit&awardId=<?= $award->id() ?>&nominationId=<?= $nomination->id() ?>'
                }
            },
            messages: {
                name_ru: {
                    required: "Введите короткое название",
                    remote: "Такое название уже занято"
                }
            }
        });
        <?php endif ?>
    });
</script>