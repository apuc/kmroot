<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">
    Рекламные блоки
    <a href="<?= $request->makeUrl('extra/design/add') ?>/" class="btn btn-primary btn-sm margin20">Добавить</a>
</div>


<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /**
                         * @var \Kinomania\Control\Design\Item $item
                         */
                        ?>
                        <?php foreach ($list as $item): ?>
                            <tr>
                                <td><?= $item->date() ?></td>
                                <td><?= $item->name() ?></td>
                                <td>
                                    <?php if ('show' == $item->status()): ?>
                                        <span class="label bg-success">активен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отключен</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('extra/design/edit') ?>?id=<?= $item->id() ?>/">Редактировать</a> &nbsp;
                                    <form method="post" style="display: inline-block;">
                                        <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить редизайн `<?= $item->name() ?>`?">Удалить</button>
                                        <input type="hidden" name="id" value="<?= $item->id() ?>">
                                        <input type="hidden" name="handler" value="delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>