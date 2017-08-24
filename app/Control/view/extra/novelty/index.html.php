<?php

/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Popular\Item $list
 */

use Kinomania\System\Extra\ExtraList;


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
<script type="text/javascript">
	$(".js-example-basic-multiple").select2();
</script>

<div class="content-heading">
    Новинки (популярное)
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
                                    <th>Новинки фильмов</th>
                                </tr>
                               <?php
                                    $n = new ExtraList();
                                    $n = $n->get_new_films();
                                    $t = new ExtraList();
                                    $t = $t->get_trailers();
                                    $w = new ExtraList();
                                    $w = $w->get_wallpaper();
                               ?>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
	                                        <select class="js-example-basic-multiple" multiple="multiple" name="film_new[]">
	                                            <?php if (isset($list->film_new()[$i -1])): ?>
		                                                <option selected="selected" type="text" value="<?= $list->film_new()[$i -1] ?>" class="form-control"><?= $list->film_new()[$i -1] ?></option>
													<?php foreach($n as $item => $key):?>
		                                                <option type="text" name="film_new[]" value="<?=$item?>" class="form-control"><?=$key;?></option>
		                                            <?php endforeach;?>
	                                            <?php else: ?>
		                                                <option selected="selected" type="text" value="" class="form-control">Выберите из списка</option>
	                                            <?php endif ?>
	                                        </select>
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
                                    <th>Новинки трейлеров</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
	                                        <select class="js-example-basic-multiple" multiple="multiple" name="trailer_new[]">
	                                            <?php if (isset($list->trailer_new()[$i -1])): ?>
		                                            <option selected="selected" type="text"  value="<?= $list->trailer_new()[$i -1] ?>" class="form-control"><?= $list->trailer_new()[$i -1] ?></option>
													<?php foreach($t as $item => $key ):?>
			                                            <option type="text"  value="<?=$item?>" class="form-control"><?=$key;?></option>
													<?php endforeach;?>
	                                            <?php else: ?>
		                                            <option type="text" value="" class="form-control"></option>
	                                            <?php endif ?>
	                                        </select>
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
                                    <th>Новинки обоев</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
	                                        <select class="js-example-basic-multiple" multiple="multiple" name="wallpaper_new[]">
	                                            <?php if (isset($list->wallpaper_new()[$i -1])): ?>
		                                            <option selected="selected" type="text" selected="selected"  value="<?= $list->wallpaper_new()[$i -1] ?>" class="form-control"><?= $list->wallpaper_new()[$i -1] ?></option>
													<?php foreach($w as $item => $key):?>
			                                            <option type="text" value="<?=$item?>" class="form-control"><?=$key;?></option>
													<?php endforeach;?>
	                                            <?php else: ?>
													<?php foreach($w as $item => $key):?>
		                                                <option type="text" value="$item" class="form-control"><?=$key;?></option>
		                                            <? endforeach;?>
	                                            <?php endif ?>
	                                        </select>
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