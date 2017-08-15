<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 */
?>

<!-- extends base.html.php -->

<div class="content-heading">
    Премии
    <a href="<?= $request->makeUrl('award/add') ?>/" class="btn btn-primary btn-sm margin20">Добавить</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-responsive">
                            <tr style="background-color: #ffffff">
                               <th>ID</th>
                               <th>Русское название</th>
                               <th>Английское название</th>
                               <th>Тип</th>
                               <th></th>
                            </tr>
                            <tr></tr>
                            <?php
                            /**
                             * @var \Kinomania\Control\Award\Item $item
                             */
                            ?>
                            <?php foreach ($list as $item): ?>
                                <tr id="<?= $item->code() ?>">
                                    <td><?= $item->id() ?></td>
                                    <td><?= $item->name_ru() ?></td>
                                    <td><?= $item->name_en() ?></td>
                                    <td>
                                        <?php if ('award' == $item->type(1)): ?>
                                            <span class="label bg-green">Премия</span>
                                        <?php elseif ('festival' == $item->type(1)): ?>
                                            <span class="label label-purple">Фестиваль</span>
                                        <?php else: ?>
                                            <span class="label bg-yellow">Скрыто</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('award/nomination?id=' . $item->id()) ?>/">Номинации</a> &nbsp;
                                        <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('award/edit?id=' . $item->id()) ?>/">Редактировать</a> &nbsp;
                                        <form method="post" style="display: inline-block;">
                                            <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить награду `<?= $item->name_ru() ?>`?">Удалить</button>
                                            <input type="hidden" name="id" value="<?= $item->id() ?>" />
                                            <input type="hidden" name="handler" value="delete" />
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="50%">
                                        <?php foreach ($item->yearList() as $year): ?>
                                            <a href="<?= $request->makeUrl('award/year/' . $item->id() . '/' . $year) ?>">
                                                <?= $year ?>
                                            </a>
                                        <?php endforeach; ?>
                                        <br />
                                        <form method="post" class="saveScrollPosition">
                                            <div class="input-group">
                                                <input type="text" name="year" class="form-control" placeholder="Введите год">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">Добавить</button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="awardId" value="<?= $item->id() ?>" />
                                            <input type="hidden" name="handler" value="addYear" />
                                        </form>
                                        <br />
                                        <br />
                                        <br />
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>