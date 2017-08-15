<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">TV программа</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" class="form-horizontal">
                        <input type="submit" value="Сбросить" class="btn btn-warning" />
                        <input type="hidden" name="handler" value="reset" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th>Дата</th>
                                <th>Канал</th>
                                <th></th>
                            </tr>
                            <?php
                            /**
                             * @var \Kinomania\Control\Tv\Chanel $item
                             */
                            ?>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td><?= $item->date() ?></td>
                                    <td><?= $item->chanel() ?></td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('tv/edit?id=' . $item->id()) ?>/">Подробнее</a>
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