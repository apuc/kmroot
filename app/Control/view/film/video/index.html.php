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
    Видео
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/film/<?= $item->id() ?>/trailers/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/film/<?= $item->id() ?>/trailers/" target="_blank" class="smaller">На сайте</a>

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
                                    <th></th>
                                    <th>Тип</th>
                                    <th>Вывод на сайте</th>
                                    <th>Локализованый</th>
                                    <th>В популярное</th>
                                    <th>Архив</th>
                                    <th></th>
                                </tr>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Video\Trailer $trailer
                                 */
                                ?>
                                <?php foreach ($list as $trailer): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($trailer->image())): ?>
                                                <img width="80px;" src="<?= $trailer->imageSrc() ?>" />
                                            <?php else: ?>
                                                <img width="80px" src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nl_nopic.jpg' ?>" />
                                            <?php endif ?>
                                        </td>
                                        <td><?= $trailer->name() ?></td>
                                        <td>
                                            <?php if ('show' == $trailer->status()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ('yes' == $trailer->local()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ('yes' == $trailer->popular()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ('true' == $trailer->no_main()): ?>
                                                <span class="label bg-success">да</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">нет</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('/film/video/edit') ?>?id=<?= $trailer->id() ?>/">Редактировать</a> &nbsp;
                                            <form method="post" style="display: inline-block;">
                                                <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить трейлер `<?= $trailer->name() ?>`?">Удалить</button>
                                                <input type="hidden" name="id" value="<?= $trailer->id() ?>">
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

<script type="text/javascript" src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add').click(function(){
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('film/video/add?filmId=' . $item->id()) ?>',
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
