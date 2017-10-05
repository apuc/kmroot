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
	$('.select2').select2();
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
							   /*$t = new ExtraList();
							   $t = $t->get_trailers();
							   $w = new ExtraList();
							   $w = $w->get_wallpaper();*/
                               ?>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
	                                        <!--<select class="js-example-basic-multiple" multiple="multiple" name="film_new[]">-->
	                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
		                                        <option selected="selected">Alabama</option>
		                                        <?php foreach($n as $item => $key):?>
		                                            <option value="<?=$item;?>"><?=$key?></option>
		                                        <?php endforeach;?>
	                                        </select>
                                            <?php if (isset($list->film_new()[$i -1])): ?>
	                                            <input name="film_new[]" type="text" value="<?= $list->film_new()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
	                                            <input name="film_new[]" type="text" value="" class="form-control">
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
                                    <th>Новинки трейлеров</th>
                                </tr>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <tr>
                                        <td>
                                            <?= $i ?>.
                                        </td>
                                        <td>
	                                        <?php if (isset($list->trailer_new()[$i -1])): ?>
	                                            <input selected="selected" type="text"  name="trailer_new[]" value="<?= $list->trailer_new()[$i -1] ?>" class="form-control">
	                                        <?php else: ?>
	                                            <input type="text" value=""  name="trailer_new[]" class="form-control">
	                                        <?php endif;?>
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
                                            <?php if (isset($list->wallpaper_new()[$i -1])): ?>
	                                            <input type="text" name="wallpaper_new[]"  value="<?= $list->wallpaper_new()[$i -1] ?>" class="form-control">
                                            <?php else: ?>
	                                            <input type="text" value="" name="wallpaper_new[]" class="form-control">
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