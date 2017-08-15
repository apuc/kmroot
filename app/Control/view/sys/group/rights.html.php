<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Admin\Group\Item $group
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Права доступа группы `<?= $group->name() ?>`</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <label class="checkbox-inline c-checkbox">
                                            <input id="selectAll" type="checkbox">
                                            <span class="fa fa-check" title="Отметить все"></span>
                                        </label>
                                    </th>
                                    <th>Маршрут</th>
                                    <th>Заголовок</th>
                                    <th>Доступ</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /**
                                     * @var \Kinomania\Control\Package\Item $item
                                     */
                                    ?>
                                    <?php foreach ($list as $item): ?>
                                        <tr>
                                            <td>
                                                <label class="checkbox-inline c-checkbox">
                                                    <input id="id_<?= $item->id() ?>" class="idRoute" type="checkbox" name="routeList[]" value="<?= $item->route() ?>">
                                                    <span class="fa fa-check"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label for="id_<?= $item->id() ?>">
                                                    <?= $item->route() ?>
                                                </label>
                                            </td>
                                            <td>
                                                <label for="id_<?= $item->id() ?>">
                                                    <?= $item->title() ?>
                                                </label>
                                            </td>
                                            <td>
                                                <?php if (is_null($item->access())): ?>
                                                    <span class="label label-default">не задан</span>
                                                <?php else: ?>
                                                    <?php if ($item->access()): ?>
                                                        <span class="label label-success">разрешен</span>
                                                    <?php else: ?>
                                                        <span class="label label-danger">запрещен</span>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td>
                                                <label class="checkbox-inline c-checkbox">
                                                    <input id="selectAll_bottom" type="checkbox">
                                                    <span class="fa fa-check" title="Отметить все"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="submit" name="unblock" value="Разрешить" class="btn btn-success" />
                                                <input type="submit" name="block" value="Заблокировать" class="btn btn-danger" />
                                                <input type="submit" name="clear" value="Очистить" class="btn btn-default" />
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="groupId" value="<?= $group->id() ?>" />
                        <input type="hidden" name="handler" value="change" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    td label {
        font-weight: normal;
    }
    table tbody tr:last-child td {
        border: 0;
    }
</style>

<script>
    $(document).ready(function(){
        $('#selectAll').click(function(){
            var status = $('#selectAll').prop('checked');
            $('.idRoute').prop('checked', status);
            $('#selectAll_bottom').prop('checked', status);
        });
        $('#selectAll_bottom').click(function(){
            var status = $('#selectAll_bottom').prop('checked');
            $('.idRoute').prop('checked', status);
            $('#selectAll').prop('checked', status);
        });
    });
</script>