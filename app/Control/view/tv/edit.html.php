<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 * @var \Kinomania\Control\Tv\Chanel $item
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">TV программа, <?= $item->chanel() ?>, <?= $item->date() ?></div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th>Время</th>
                                <th>Название</th>
                                <th></th>
                            </tr>
                            <?php
                            /**
                             * @var \Kinomania\Control\Tv\Program $item
                             */
                            ?>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td><?= $item->time() ?></td>
                                    <td><?= $item->name() ?></td>
                                    <td>
                                        <?php if (0 < $item->filmId()): ?>
                                            <a href="<?= $request->makeUrl('film/edit?id=' . $item->filmId()) ?>/"><em class="fa fa-external-link"></em></a>
                                            <br />
                                        <?php endif; ?>
                                        <form method="post" class="saveScrollPosition">
                                            <div class="input-group">
                                                <input type="text" name="filmId" class="form-control" placeholder="ID фильма" <?php if (0 < $item->filmId()): ?> value="<?= $item->filmId() ?>" <?php endif ?>>
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-default">Сохранить</button>
                                                    </span>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $item->id() ?>" />
                                            <input type="hidden" name="handler" value="editFilmId" />
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