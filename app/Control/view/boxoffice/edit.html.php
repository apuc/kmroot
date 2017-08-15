<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 * @var \Kinomania\Control\Boxoffice\Item $item
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Сборы</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Дата с</th>
                                <th>Дата по</th>
                                <th>Пред. неделя</th>
                                <th>ID фильма</th>
                                <th>Фильм</th>
                                <th>Нед.</th>
                                <th>К/т</th>
                                <th>Касса уикенда</th>
                                <th>Общая касса</th>
                                <th>Зритель уикенда</th>
                                <th>Общий зритель</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item->date_from() ?>
                                        </td>
                                        <td>
                                            <?= $item->date_to() ?>
                                        </td>
                                        <td>
                                            <?= $item->previous() ?>
                                        </td>
                                        <td>
                                            <?php if (0 < $item->filmId()): ?>
                                                <a href="<?= $request->makeUrl('film/edit?id=' . $item->filmId()) ?>/"><em class="fa fa-external-link"></em></a>
                                                <br />
                                            <?php endif; ?>
                                            <form method="post" class="saveScrollPosition">
                                                <div class="input-group">
                                                    <input type="text" name="filmId" class="form-control" placeholder="Введите ID фильма" <?php if (0 < $item->filmId()): ?> value="<?= $item->filmId() ?>" <?php endif ?>>
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-default">Сохранить</button>
                                                    </span>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $item->id() ?>" />
                                                <input type="hidden" name="handler" value="editFilmId" />
                                            </form>
                                        </td>
                                        <td>
                                            <?= $item->name_ru() ?> <br />
                                            <?= $item->name_origin() ?>
                                        </td>
                                        <td>
                                            <?= $item->week() ?>
                                        </td>
                                        <td>
                                            <?= $item->copy() ?>
                                        </td>
                                        <td>
                                            <?php if ('usa' == $item->type()): ?>
                                                <?= $item->gross() ?>
                                            <?php else: ?>
                                                <?= $item->gross_rub() ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ('usa' == $item->type()): ?>
                                                <?= $item->gross_total() ?>
                                            <?php else: ?>
                                                <?= $item->gross_total_rub() ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?= $item->views() ?>
                                        </td>
                                        <td>
                                            <?= $item->views_total() ?>
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
</div>