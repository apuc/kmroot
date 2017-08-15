<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Soundtrack\Dir $item
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    img {
        max-width: 400px;
    }
    .badTrack {
        background-color: rgba(255, 0, 0, 0.12);
    }
</style>

<div class="content-heading">
    Коллекция `<?= $item->name() ?>` <a href="<?= $request->makeUrl('film/sound?id=' . $item->filmId()) ?>/" class="btn btn-default">Назад</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <form id="fileForm">
                        <label for="file">
                            MP3 саундтреки
                        </label>
                        <div id="fileNew">
                            <textarea rows="5" name="url" id="fileUrl" class="form-control note-editor" placeholder="Список ссылок на треки"></textarea>
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

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <?php if (count($list)): ?>
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>
                                        <label class="checkbox-inline c-checkbox">
                                            <input id="selectAll" type="checkbox">
                                            <span class="fa fa-check" title="Отметить все"></span>
                                        </label>
                                    </th>
                                    <th>Автор</th>
                                    <th>Название</th>
                                    <th>Длительность</th>
                                    <th></th>
                                </tr>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Film\Soundtrack\Track $track
                                 */
                                ?>
                                <?php foreach ($list as $track): ?>
                                    <tr <?php if ('00:00' == $track->time()): ?> class=badTrack <?php endif ?>>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="id_<?= $track->id() ?>" class="idList" type="checkbox" name="idList[]" value="<?= $track->id() ?>">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td><?= $track->author() ?></td>
                                        <td><?= $track->name() ?></td>
                                        <td><?= $track->time() ?></td>
                                        <td>
                                            <a class="btn btn-info btn-xs editTrack" data-id="<?= $track->id() ?>" href="#">Редактировать</a> &nbsp;
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>
                                        <br />
                                        <label class="checkbox-inline c-checkbox">
                                            <input id="selectAll_bottom" type="checkbox">
                                            <span class="fa fa-check" title="Отметить все"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <br />
                                        <form method="post" id="delete">
                                            <input type="submit" name="block" value="Удалить" class="btn btn-sm btn-danger delConfirm" data-title="Удалить выбранное" style="position: relative; top: -7px;" />
                                        </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>

                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <!-- include js/upload.js -->
    $(document).ready(function(){
        UPLOAD.init({
            maxSize: 20971520
        });
    });
</script>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.editTrack').click(function(e){
            e = e || window.event;
            e.preventDefault();

            var id = $(this).attr('data-id');
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('film/sound/track/edit?id=') ?>' + id,
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

            return false;
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