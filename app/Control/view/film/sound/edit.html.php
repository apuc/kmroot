<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Soundtrack\Dir $item
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    img {
        max-width: 400px;
    }
</style>

<div class="content-heading">
    Редактировать коллекцию саундтректов
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <form id="fileForm">
                        <label for="file">
                            Изображение
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
                            <button type="button" data-id="<?= $item->id() ?>" data-toggle="modal" data-target="#modalWindow" class="modalBtn btn btn-primary" style="margin-top:10px">Редактировать</button>
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
                            <label for="name">
                                Название
                            </label>
                            <input type="text" name="name" id="name" value="<?= $item->name() ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="year">
                                Год выпуска
                            </label>
                            <input type="text" name="year" id="year" value="<?= $item->year() ?>" class="form-control">
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
                            <label for="popular">
                                В популярное
                            </label>
                            <select name="popular" id="popular" class="chosen-select form-control">
                                <option value="no">Нет</option>
                                <option <?php if ('yes' == $item->status()): ?> selected="selected" <?php endif; ?> value="yes">Да</option>
                            </select>
                        </div>


                        <a href="<?= $request->makeUrl('film/sound?id=' . $item->filmId()) ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" class="btn btn-primary margin20" value="Сохранить" />

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>
<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    function callCrop() {
        var id = <?= $item->id() ?>;
        window.photoId = id;
        $.ajax({
            url : '<?= $request->makeUrl('film/sound/edit?handler=cropModal&id=') ?>' + id,
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
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.modalBtn').click(function(){
            callCrop();
        });

        $("#validateForm").validate({
            rules: {
                name: {
                    required: true
                },
                year: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Введите название"
                },
                year: {
                    required: "Введите год"
                }
            }
        });
    });
</script>
