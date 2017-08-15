<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Video\Trailer $item
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
    Видео `<?= $item->name() ?>` <a href="<?= $request->makeUrl('film/video?id=' . $item->filmId()) ?>/" class="btn btn-default">Назад</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <label for="file">
                        Загрузка видео
                    </label>
                    <div>
                        <form method="post" enctype="multipart/form-data">
                            <table class="table table-responsive">
                                <tr>
                                    <td style="border: 0">
                                        <textarea rows="5" name="url" id="fileUrl" class="form-control note-editor" placeholder="Ссылка на видео"></textarea>
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0">
                                        <input type="file" name="fileList[]" id="file" data-buttonText="Выберите файл" data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle">
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0">
                                        <button type="submit" id="fileBtn" class="btn btn-success">Загрузить</button>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="extension" id="extension" value="" />
                            <input type="hidden" name="id" id="id" value="<?= $item->id() ?>" />
                            <input type="hidden" name="handler" value="load" />
                        </form>
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
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <td>4:3</td>
                                    <td>SD</td>
                                    <td>640x480</td>
                                    <td>480p</td>
                                    <td>no</td>
                                    <td>delete</td>
                                </tr>
                                <tr>
                                    <td>16:9</td>
                                    <td>HD</td>
                                    <td>1280x720</td>
                                    <td>720p</td>
                                    <td>no</td>
                                    <td>delete</td>
                                </tr>
                                <tr>
                                    <td>16:9</td>
                                    <td>fullHD</td>
                                    <td>1920x1080</td>
                                    <td>1080p</td>
                                    <td>no</td>
                                    <td>delete</td>
                                </tr>
                            </table>
                        </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>

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