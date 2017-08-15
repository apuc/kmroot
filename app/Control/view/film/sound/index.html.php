<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
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
    Саундтреки
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/film/<?= $item->id() ?>/soundtracks/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/film/<?= $item->id() ?>/soundtracks/" target="_blank" class="smaller">На сайте</a>

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
                    <button data-toggle="modal" data-target="#modalWindow" id="add" class="btn btn-xs btn-primary">Добавить</button>
                    <br />
                    <br />
                    <?php if (count($list)): ?>
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Название</th>
                                    <th>Вывод на сайте</th>
                                    <th>В популярное</th>
                                    <th></th>
                                </tr>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Film\Soundtrack\Dir $dir
                                 */
                                ?>
                                <?php foreach ($list as $dir): ?>
                                    <tr>
                                        <td><?= $dir->name() ?></td>
                                        <td>
                                            <?php if ('show' == $dir->status()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ('yes' == $dir->popular()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-yellow">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('/film/sound/edit') ?>?id=<?= $dir->id() ?>/">Редактировать</a> &nbsp;
                                            <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('/film/sound/track') ?>?id=<?= $dir->id() ?>/">Саундтреки</a> &nbsp;
                                            <form method="post" style="display: inline-block;">
                                                <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить коллекцию `<?= $dir->name() ?>`?">Удалить</button>
                                                <input type="hidden" name="id" value="<?= $dir->id() ?>">
                                                <input type="hidden" name="extension" value="jpeg">
                                                <input type="hidden" name="handler" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add').click(function(){
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('film/sound/add?filmId=' . $item->id()) ?>',
                type: "GET",
                success:function(data) {
                    $('#modalWindow').html(data).modal({});
                    $(':file').filestyle();
                    (function(window, document, $, undefined){
                        $(function(){
                            $('select').chosen({disable_search_threshold: 10});
                        });
                    })(window, document, window.jQuery);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error: " + textStatus + ' ' + errorThrown);
                },
                timeout: 5000
            });
        });
    });
</script>
