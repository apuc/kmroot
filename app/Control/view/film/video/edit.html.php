<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Video\Trailer $item
 * @var array $typeList
 * @var bool $encode
 * @var string $name_origin
 * @var string $name_ru
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    img {
        max-width: 400px;
    }
    .value {
        margin-left: 7px;
    }
    label a {
        font-weight: normal;
    }
</style>

<div class="content-heading">
    Редактировать трейлер <a href="<?= $request->makeUrl('film/video?id=' . $item->filmId()) ?>/" class="btn btn-default">Назад</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <form id="fileForm">
                        <label for="file">
                            Изображение
                            <?php if (!empty($name_origin)): ?>
                                &nbsp;
                                <a href="http://images.google.ru/images?hl=en&q=<?= $name_origin ?>" target="_blank">Google</a>
                                &nbsp;
                                <a href="http://images.yandex.ru/yandsearch?rpt=image&text=<?= $name_origin ?>" target="_blank">Яндекс</a>
                            <?php else: ?>
                                &nbsp;
                                <a href="http://images.google.ru/images?hl=en&q=<?= $name_ru ?>" target="_blank">Google</a>
                                &nbsp;
                                <a href="http://images.yandex.ru/yandsearch?rpt=image&text=<?= $name_ru ?>" target="_blank">Яндекс</a>
                            <?php endif ?>
                        </label>
                        <div id="fileNew" style="display: none;">
                            <input type="text" name="url" id="fileUrl" class="form-control" placeholder="Ссылка на изображение" />
                            <br />
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 5px;">
                                    <input type="file" name="file" id="file" data-buttonText="Выберите файл" data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle"> &nbsp;
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
                        </div>
                        <div id="fileDelete" style="display: none;">
                            <img id="fileImg" src="<?= $item->imageSrc() ?>" data-src="<?= $item->imageSrc(true) ?>" />
                            &nbsp;
                            <button type="button" data-id="<?= $item->id() ?>" data-toggle="modal" data-target="#modalWindow" data-backdrop="static" class="modalBtn btn btn-primary" style="margin-top:10px">Редактировать</button>
                            &nbsp;
                            <input id="fileDeleteBtn" type="button" value="Удалить" class="btn btn-danger" style="margin-top:10px" />
                        </div>
                        <input type="hidden" name="entityId" id="entityId" value="<?= $item->id() ?>" />
                        <input type="hidden" name="extension" id="extension" value="<?= $item->image() ?>" />
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
                    <form method="post" id="validateForm" class="saveScrollPosition">
                        <div class="form-group">
                            <label for="type">
                                Тип
                            </label>
                            <select name="type" id="type" class="form-control">
                                <?php foreach ($typeList as $id => $name): ?>
                                    <option <?php if ($id == $item->type()): ?> selected="selected" <?php endif ?> value="<?= $id ?>"><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br />
                            <a href="#" class="value" data-value="2">Трейлер</a>
                            <a href="#" class="value" data-value="1">Тизер</a>
                            <a href="#" class="value" data-value="34">Трейлер (рус.)</a>
                            <a href="#" class="value" data-value="71">Эпизод (актерский)</a>
                        </div>
                        <div class="form-group">
                            <label for="status">
                                Вывод на сайте
                            </label>
                            <select name="status" id="status" class="chosen-select form-control">
                                <option value="hide">Нет</option>
                                <option <?php if ('show' == $item->status()): ?> selected="selected" <?php endif; ?> value="show">Да</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_main">
                                Архив
                            </label>
                            <select name="no_main" id="no_main" class="form-control">
                                <option value="false">Нет</option>
                                <option <?php if ('true' == $item->no_main()): ?> selected="selected" <?php endif ?> value="true">Да</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="local">
                                Локализованый
                            </label>
                            <select name="local" id="local" class="form-control">
                                <option value="no">Нет</option>
                                <option <?php if ('yes' == $item->local()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="popular">
                                Популярные
                            </label>
                            <select name="popular" id="popular" class="form-control">
                                <option value="no">Нет</option>
                                <option <?php if ('yes' == $item->popular()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Дата публикации</label>
                            <div id="datetimepicker" class="col-lg-3 input-group date">
                                <input name="date" id="date" value="<?= $item->date() ?>" type="text" class="form-control">
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                            </div>
                        </div>

                        <br />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <?php foreach ($item->personList() as $id => $name): ?>
                                        <a href="<?= $request->makeUrl('/person/edit?id=' . $id) ?>/"><?= $name ?></a> &nbsp;
                                    <?php endforeach; ?>
                                </div>
                                <br />
                                <div class="input-group">
                                        <span class="input-group-btn">
                                            <a href="#" data-id="<?= $item->id() ?>" data-toggle="modal" data-target="#modalWindow" class="personBtn btn btn-default">персоны</a>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <br />

                        <a href="<?= $request->makeUrl('film/video?id=' . $item->filmId()) ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" class="btn btn-primary margin20" value="Сохранить" />

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="filmId" value="<?= $item->filmId() ?>" />
                        <input type="hidden" name="handler" value="edit" />
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
                    <label for="file">
                        Загрузка видео
                    </label>
                    <div>
                        <?php if (!$encode): ?>
                            <form method="post" enctype="multipart/form-data">
                                <table class="table table-responsive">
                                    <tr>
                                        <td style="border: 0">
                                            <textarea rows="5" name="url" class="form-control note-editor" placeholder="Ссылка на видео"></textarea>
                                            <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0">
                                            <input type="file" name="fileList[]" data-buttonText="Выберите файл" data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle">
                                            <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0">
                                            <button type="submit" class="btn btn-success">Загрузить</button>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name="extension" id="extension" value="" />
                                <input type="hidden" name="id" id="id" value="<?= $item->id() ?>" />
                                <input type="hidden" name="handler" value="load" />
                            </form>
                        <?php endif; ?>
                    </div>
                    <br />
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <td>hd480</td>
                                <td>640x480</td>
                                <td>480p</td>
                                <td id="hd480">
                                    <?php if (!empty($item->hd480())): ?>
                                        <?php if ($encode): ?>
                                            <span class="label label-success">Кодирование</span>
                                        <?php else: ?>
                                            <span class="label label-success">Есть</span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <span class="label label-inverse">Отсутсвует</span>
                                    <?php endif; ?>
                                </td>
                                <td id="a_hd480">
                                    <?php if (!$encode && !empty($item->hd480())): ?>
                                        <a href="<?= $item->fileSrc() ?>.480.mp4/" target="_blank">Видео</a>
                                    <?php endif ?>
                                </td>
                                <td id="d_hd480">
                                    <?php if (!$encode && !empty($item->hd480())): ?>
                                        <form method="post" style="display: inline-block;">
                                            <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить видео `hd480`?">Удалить</button>
                                            <input type="hidden" name="id" value="<?= $item->id() ?>"> <input type="hidden" name="hd" value="480"> <input type="hidden" name="handler" value="delete">
                                        </form>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td>hd720</td>
                                <td>1280x720</td>
                                <td>720p</td>
                                <td id="hd720">
                                    <?php if (!empty($item->hd720())): ?>
                                        <?php if ($encode): ?>
                                            <span class="label label-success">Кодирование</span>
                                        <?php else: ?>
                                            <span class="label label-success">Есть</span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <span class="label label-inverse">Отсутсвует</span>
                                    <?php endif; ?>
                                </td>
                                <td id="a_hd720">
                                    <?php if (!$encode && !empty($item->hd720())): ?>
                                        <a href="<?= $item->fileSrc() ?>.720.mp4/" target="_blank">Видео</a>
                                    <?php endif; ?>
                                </td>
                                <td id="d_hd720">
                                    <?php if (!$encode && !empty($item->hd720())): ?>
                                        <form method="post" style="display: inline-block;">
                                            <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить видео `hd720`?">Удалить</button>
                                            <input type="hidden" name="id" value="<?= $item->id() ?>"> <input type="hidden" name="hd" value="720"> <input type="hidden" name="handler" value="delete">
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>hd1080</td>
                                <td>1920x1080</td>
                                <td>1080p</td>
                                <td id="hd1080">
                                    <?php if (!empty($item->hd1080())): ?>
                                        <?php if ($encode): ?>
                                            <span class="label label-success">Кодирование</span>
                                        <?php else: ?>
                                            <span class="label label-success">Есть</span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <span class="label label-inverse">Отсутсвует</span>
                                    <?php endif; ?>
                                </td>
                                <td id="a_hd1080">
                                    <?php if (!$encode && !empty($item->hd1080())): ?>
                                        <a href="<?= $item->fileSrc() ?>.1080.mp4/" target="_blank">Видео</a>
                                    <?php endif; ?>
                                </td>
                                <td id="d_hd1080">
                                    <?php if (!$encode && !empty($item->hd1080())): ?>
                                        <form method="post" style="display: inline-block;">
                                            <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить видео `hd1080`?">Удалить</button>
                                            <input type="hidden" name="id" value="<?= $item->id() ?>"> <input type="hidden" name="hd" value="1080"> <input type="hidden" name="handler" value="delete">
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php if ($encode): ?>
                        <div role="alert" class="alert alert-warning">
                            <strong>Warning!</strong> Запущенно кодирование ново загруженных видео, процесс может занимать до 10 минут.
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>

<script type="text/javascript">
    function callCrop() {
        var id = <?= $item->id() ?>;
        window.photoId = id;
        $.ajax({
            url : '<?= $request->makeUrl('film/video/edit?handler=cropModal&id=') ?>' + id,
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
    }
    <!-- include js/upload.js -->
    $(document).ready(function(){
        UPLOAD.init({
            callback: callCrop
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.value').click(function(e){
            e = e || window.event;
            var id = $(this).attr('data-value');
            $('#type').val(id);
            $('select').trigger("chosen:updated");
            e.preventDefault();
            return true;
        });
        
        $('.personBtn').click(function(){
            var id = $(this).attr('data-id');
            window.photoId = id;
            $.ajax({
                url : '<?= $request->makeUrl('film/video/edit?handler=person&id=') ?>' + id,
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

        $('.modalBtn').click(function(){
            callCrop();
        });

        $('#datetimepicker').datetimepicker({
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash'
            },
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
