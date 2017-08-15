<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\News\Item $item
 * @var int $id
 */
?>
<!-- extends base.html.php -->

<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    tr.placeholder {

    }

    tr.placeholder:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border: 5px solid transparent;
        border-left-color: red;
        margin-top: -5px;
        left: 25px;
        border-right: none;
    }

</style>

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }

    img {
        max-width: 500px;
    }
    label a {
        font-weight: normal;
    }
</style>

<div class="content-heading">
    Изображения галереи #<?= $id ?> &nbsp; <a href="<?= $request->makeUrl('news/gallery?id=' . $item->id()) ?>/" class="btn btn-default">Назад</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                .menu a {
                                    margin-top: 2px;
                                }
                            </style>
                            <div class="menu">
                                <a href="<?= $request->makeUrl('news/edit?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'news/edit')): ?> active <?php endif ?>">Основное</a>
                            </div>
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
                        <input type="hidden" name="entityId" id="entityId" value="<?= $id ?>" />
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
                        <table class="table sortGallery">
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
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            /**
                             * @var \Kinomania\Control\Person\Photo\Item $item
                             */
                            ?>
                            <?php foreach ($list as $key => $image): ?>
                                <tr data-id="<?= $key ?>">
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input id="id_<?= $key ?>" class="idList" type="checkbox" name="idList[]" value="<?= $key ?>">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <?= $key ?>
                                    </td>
                                    <td>
                                        <img src="<?= $image ?>" class="person_photo" />
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" data-id="<?= $key ?>" data-toggle="modal" data-target="#modalWindow" data-backdrop="static" class="modalBtn btn btn-primary btn-xs">редактировать фото</button>
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
                                    <form method="post" id="delete">
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

<script src="/vendor/cms/_js/jquery-ui/ui/core.js"></script>
<script src="/vendor/cms/_js/jquery-ui/ui/widget.js"></script>
<script src="/vendor/cms/_js/jquery-ui/ui/progressbar.js"></script>
<script src="/vendor/cms/_js/jquery-sortable/source/js/jquery-sortable-min.js"></script>

<script type="text/javascript">
    <!-- include js/upload.js -->
    $(document).ready(function(){
        UPLOAD.init();
    });
</script>
<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var Table = $('.sortGallery').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = Table.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=order',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });

        $('.modalBtn').click(function(){
            var id = $(this).attr('data-id');
            window.photoId = id;
            $.ajax({
                url : '<?= $request->makeUrl('news/gallery/crop?id=') ?>' + id,
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
        $('#delete').on('submit', function(){
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