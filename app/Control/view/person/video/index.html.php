<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Person\Item $item
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">
    <?php if (!empty($item->image())): ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= $item->imageSmallSrc() ?>" width="50" style="max-height:74px;" />
        </div>
    <?php else: ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nof.jpg' ?>" width="50" style="max-height:74px;" />
        </div>
    <?php endif; ?>
    Видео

    <small>
        <?php if (!empty($item->name_origin())): ?>
            <?= $item->name_origin() ?>
            <?php if (!empty($item->name_ru())): ?>
                /
            <?php endif ?>
        <?php endif ?>
        <?= $item->name_ru() ?>
    </small>
</div>


<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- include person/menu.html.php -->
                        </div>
                    </div>
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
                    <div class="modal-body">
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>ID</th>
                                    <th>Фильм</th>
                                    <th>Тип</th
                                </tr>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Person\Video\Item $item
                                 */
                                ?>
                                <?php foreach ($list as $item): ?>
                                    <tr>
                                        <td><?= $item->id() ?></td>
                                        <td>
                                            <a href="<?= $request->makeUrl('film/edit?id=' . $item->filmId()) ?>">
                                                <?= $item->name() ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= $request->makeUrl('film/video?id=' . $item->filmId()) ?>">
                                                <?= $item->type() ?>
                                            </a>
                                        </td
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