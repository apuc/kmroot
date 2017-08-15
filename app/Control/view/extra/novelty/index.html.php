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
    Новинки фильмов
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
                                    <th></th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
                                            <?php if (isset($list->film_new()[$i -1])): ?>
                                                <input type="text" name="film_new[]" value="<?= $list->film_new()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
                                                <input type="text" name="film_new[]" value="" class="form-control">
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
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