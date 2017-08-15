<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Log\Item $item
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Подробности лога</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Дата</label>
                        <input type="text" value="<?= $item->date() ?>" readonly="readonly" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Маршрут</label>
                        <input type="text" value="<?= $item->route() ?>" readonly="readonly" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Обработчик</label>
                        <input type="text" value="<?= $item->handler() ?>" readonly="readonly" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Комментарий</label>
                        <input type="text" value="<?= $item->comment() ?>" readonly="readonly" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>POST данные</label>
                        <pre>
<?php print_r($item->data()) ?>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>