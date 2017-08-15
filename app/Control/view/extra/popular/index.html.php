<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Popular\Item $list
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }
    .dataTables_wrapper table tr td {
        border: 0;
    }
</style>

<div class="content-heading">
    Популярное
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <div class="dataTables_wrapper">
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Обои фильмов</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->film_wallpaper()[$i -1])): ?>
                                                <input type="text" name="film_wallpaper[]" value="<?= $list->film_wallpaper()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="film_wallpaper[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                            <br />
                            <br />
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Обои актеров</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->person_wallpaper_actors()[$i -1])): ?>
                                                <input type="text" name="person_wallpaper_actors[]" value="<?= $list->person_wallpaper_actors()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="person_wallpaper_actors[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                            <br />
                            <br />
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Обои актрис</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->person_wallpaper_actresses()[$i -1])): ?>
                                                <input type="text" name="person_wallpaper_actresses[]" value="<?= $list->person_wallpaper_actresses()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="person_wallpaper_actresses[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                            <br />
                            <br />
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Фотографии</th>
                                </tr>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->person_photo()[$i -1])): ?>
                                                <input type="text" name="person_photo[]" value="<?= $list->person_photo()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="person_photo[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                            <br />
                            <br />
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Постеры</th>
                                </tr>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->film_poster()[$i -1])): ?>
                                                <input type="text" name="film_poster[]" value="<?= $list->film_poster()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="film_poster[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                            <br />
                            <br />
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th>Кастинг промо</th>
                                </tr>
                                <tr>
                                    <td>
                                        ID персоны.
                                    </td>
                                    <td>
                                        <?php if (isset($list->casting_promo()[0])): ?>
                                            <input type="text" name="casting_promo[]" value="<?= $list->casting_promo()[0] ?>" class="form-control">
                                        <?php else: ?>
                                            <input type="text" name="casting_promo[]" value="" class="form-control">
                                        <?php endif ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br />
                        <input type="hidden" name="handler" value="edit" />
                        <input type="submit" class="btn btn-primary" value="Сохранить" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>