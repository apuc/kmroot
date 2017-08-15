<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 * @var \Kinomania\Control\Film\Boxoffice\Item $gross
 */
?>
<!-- extends base.html.php -->

<style>
    .wd {
        width: 200px !important;
    }
</style>
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">

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
    Сборы

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
                            <!-- include film/menu.html.php -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <form method="post" id="validateForm" class="saveScrollPosition">
                        <div class="form-group">
                            <label for="world" class="col-sm-11">
                                Сборы в мире
                            </label>
                            <div class="input-group m-b col-sm-11">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="world" id="world" value="<?= $gross->world() ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ru" class="col-sm-11">
                                Сборы в России
                            </label>
                            <div class="input-group m-b col-sm-11">
                                <input type="text" name="ru" id="ru" value="<?= $gross->ru() ?>" class="form-control">
                                <span class="input-group-addon">руб.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usa" class="col-sm-11">
                                Сборы в США
                            </label>
                            <div class="input-group m-b col-sm-11">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="usa" id="usa" value="<?= $gross->usa() ?>" class="form-control">
                            </div>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Сохранить" />

                        <input type="hidden" name="filmId" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>