<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 * @var array $list
 * @var array $personList
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
    Обои
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/film/<?= $item->id() ?>/wallpapers/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/film/<?= $item->id() ?>/wallpapers/" target="_blank" class="smaller">На сайте</a>

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
                    <form id="fileForm">
                        <label for="file">
                            Изображения
                        </label>
                        <div id="fileNew">
                            <textarea rows="5" name="url" id="fileUrl" class="form-control note-editor" placeholder="Список ссылок на изображения"></textarea>
                            <br />
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 5px;">
                                    <input type="file" name="file" id="file" multiple="multiple" data-buttonText="Выберите файлы" data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle"> &nbsp;
                                </div>
                                <div class="col-md-1">
                                    <button type="button" id="fileBtn" class="btn btn-success">Загрузить</button> &nbsp;
                                </div>
                                <div class="col-md-7" style="height: 21px;">
                                    <div class="progress" style="display: none;">
                                        <div role="progressbar" id="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;" class="progress-bar progress-bar-purple progress-bar-striped">
                                            <span class="sr-only">100% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div id="fileDelete" style="display: none;">
                                <img id="fileImg" src="" data-src="" />
                                &nbsp;
                                <input id="fileDeleteBtn" type="button" value="Удалить" class="btn btn-danger" />
                            </div>
                        </div>
                        <input type="hidden" name="entityId" id="entityId" value="<?= $item->id() ?>" />
                        <input type="hidden" name="extension" id="extension" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (count($list)): ?>
    <div class="row">
        <div class="col-lg-10 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="modal-body">
                        <table class="table">
                            <colgroup>
                                <col width="10px" />
                                <col width="100px" />
                                <col width="200px" />
                                <col width="auto" />
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-inline c-checkbox">
                                        <input id="selectAll" type="checkbox">
                                        <span class="fa fa-check" title="Отметить все"></span>
                                    </label>
                                </th>
                                <th>
                                    <form method="post" class="deleteSelected">
                                        <input type="submit" name="block" value="Удалить" class="btn btn-sm btn-danger delConfirm" data-title="Удалить выбранное" style="position: relative; top: -7px;" />
                                    </form>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            /**
                             * @var \Kinomania\Control\Film\Frame\Item $item
                             */
                            ?>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input id="id_<?= $item->id() ?>" class="idList" type="checkbox" name="idList[]" value="<?= $item->id() ?>">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <?= $item->id() ?>
                                    </td>
                                    <td>
                                        <a href="<?= $item->imageSrc() ?>" target="_blank">
                                            <img class="lazy" data-original="<?= $item->imageResizeSrc() ?>" src="//:0" />
                                        </a>
                                        <br />
                                        <?= $item->width() ?> x <?= $item->height() ?>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form method="post" class="">
                                                    <div class="input-group">
                                                        <?php foreach ($item->personList() as $id => $name): ?>
                                                            <a href="<?= $request->makeUrl('/person/edit?id=' . $id) ?>/"><?= $name ?></a> &nbsp;
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <br />
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a href="#" data-id="<?= $item->id() ?>" data-toggle="modal" data-target="#modalWindow" style="left: 10px;" class="personBtn btn btn-default">персоны</a>
                                                        </span>
                                                    </div>
                                                    <br />
                                                    <input type="hidden" name="id" value="<?= $item->id() ?>" />
                                                    <input type="hidden" name="handler" value="edit" />
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" data-id="<?= $item->id() ?>" data-toggle="modal" data-target="#modalWindow" class="modalBtn btn btn-primary btn-xs">редактировать фото</button>
                                            </div>
                                        </div>
                                        <br />
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>
                                    <label class="checkbox-inline c-checkbox">
                                        <input id="selectAll_bottom" type="checkbox">
                                        <span class="fa fa-check" title="Отметить все"></span>
                                    </label>
                                </td>
                                <td>
                                    <form method="post" class="deleteSelected">
                                        <input type="submit" name="block" value="Удалить" class="btn btn-sm btn-danger delConfirm" data-title="Удалить выбранное" style="position: relative; top: -7px;" />
                                    </form>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<script type="text/javascript">
    <!-- include js/upload.js -->
    $(document).ready(function(){
        UPLOAD.init();
    });
</script>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>
<script type="text/javascript" src="/vendor/cms/jquery/jquery.lazyload.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        $('.modalBtn').click(function(){
            var id = $(this).attr('data-id');
            window.photoId = id;
            $.ajax({
                url : '<?= $request->makeUrl('film/wallpaper?id=') ?>' + id,
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
                }
            });
        });

        $('.personBtn').click(function(){
            var id = $(this).attr('data-id');
            window.photoId = id;
            $.ajax({
                url : '<?= $request->makeUrl('film/wallpaper?handler=person&id=') ?>' + id,
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
                }
            });
        });

        $('#selectAll').click(function(){
            var status = $('#selectAll').prop('checked');
            $('.idList').prop('checked', status);
            $('#selectAll_bottom').prop('checked', status);
        });
        $('#selectAll_bottom').click(function(){
            var status = $('#selectAll_bottom').prop('checked');
            $('.idList').prop('checked', status);
            $('#selectAll').prop('checked', status);
        });
        $('.deleteSelected').on('submit', function(){
            var idList = [];
            $('input:checkbox.idList').each(function () {
                if (true == $(this).prop('checked')) {
                    idList.push($(this).val());
                }
            });
            idList = idList.join(',');
            window.idList = idList;

            var fd = new FormData();
            fd.append('id', 1);
            fd.append('idList', idList);
            $.ajax({
                type: 'POST',
                url: '?handler=delete',
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function () {
                    $.cookie('__alert__', 'Файлы удалены|green', { expires: 1, path: '/' });
                    location.reload();
                },
                error: function () {
                    $["notify"]('Не удалось удалить файлы', 'danger');
                }
            });

            return false;
        });
    });
</script>