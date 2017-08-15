<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $typeList
 * @var \Kinomania\Control\Company\Item $item
 */
use Kinomania\System\Config\Server;
?>
<!-- extends base.html.php -->
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    img {
        max-width: 400px;
    }
</style>

<div class="content-heading">
    Редактировать компанию
    &nbsp; &nbsp;
    <a href="<?= Server::DEMO ?>company/<?= $item->id() ?>/" class="smaller" target="_blank">Демо</a>
    &nbsp;
    <a href="<?= Server::MAIN ?>company/<?= $item->id() ?>/" class="smaller" target="_blank">На сайте</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <form id="fileForm">
                        <div class="form-group">
                            <label for="file">Изображение</label>
                            <div id="fileNew" style="display: none;">
                                <input type="text" name="url" id="fileUrl" class="form-control" placeholder="Ссылка на изображение" />
                                <br />
                                <div class="row">
                                    <div class="col-md-4" style="padding-right: 5px;">
                                        <input type="file" name="file" id="file" data-buttonText="Выберите файл" data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle"> &nbsp;
                                    </div>
                                    <div class="col-md-1" style="padding-left: 0;">
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
                                <input id="fileDeleteBtn" type="button" value="Удалить" class="btn btn-danger"  style="margin-top:10px" />
                            </div>
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
                    <form method="post" id="validationForm" class="save">
                        <div class="form-group">
                            <label for="status">Вывод на сайте</label>
                            <select name="status" id="status" class="form-control">
                                <option value="hide">Скрыто</option>
                                <option <?php if ('show' == $item->status()): ?> selected="selected" <?php endif ?> value="show">Опубликовано</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Тип</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Неизвестно</option>
                                <?php foreach ($typeList as $type): ?>
                                    <option <?php if ($item->type() == $type): ?> selected="selected" <?php endif ?> value="<?= $type ?>"><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" value="<?= $item->name() ?>" id="name" class="form-control" placeholder="Название" />
                        </div>
                        <div class="form-group">
                            <label for="short_name">Короткое название</label>
                            <input type="text" name="short_name" value="<?= $item->short_name() ?>" id="short_name" class="form-control" placeholder="Короткое название" />
                        </div>
                        <div class="form-group">
                            <label for="kinometro">Кинометро ID</label>
                            <input type="text" name="kinometro" value="<?= $item->kinometro() ?>" id="kinometro" class="form-control" placeholder="Кинометро ID" />
                        </div>
                        <div class="form-group">
                            <label for="site">Сайт</label>
                            <div class="input-group m-b">
                                            <span class="input-group-addon">
                                                <a href="#" target="_blank" class="link"><em class="fa fa-external-link"></em></a>
                                            </span>
                                <input type="text" name="site" value="<?= $item->site() ?>" id="site" class="form-control" placeholder="Сайт" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">
                                        Телефон
                                    </label>
                                    <input type="text" name="phone" value="<?= $item->phone() ?>" id="phone" class="form-control" placeholder="Телефон">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fax">
                                        Факс
                                    </label>
                                    <input type="text" name="fax" value="<?= $item->fax() ?>" id="fax" class="form-control" placeholder="Факс">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text">О компании</label>
                            <textarea name="text" id="text" class="htmlEdit_text form-control"><?= $item->text() ?></textarea>
                        </div>
                        <div class="form-group">
                            <a href="<?= $request->makeUrl('company') ?>/" class="btn btn-default">Назад</a>
                            <input type="submit" class="btn btn-primary margin20" value="Сохранить" />
                        </div>
                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function callCrop() {
        var id = <?= $item->id() ?>;
        window.photoId = id;
        $.ajax({
            url : '<?= $request->makeUrl('company/crop?id=') ?>' + id,
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
        UPLOAD.init();

        /**
         * Delete referrer.
         */
        var meta = document.createElement('meta');
        meta.name = "referrer";
        meta.content = "no-referrer";
        document.getElementsByTagName('head')[0].appendChild(meta);

        $('.link').click(function(){
            var site = $('#site').val();
            var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
            if(pattern.test(site)) {
                site = site.replace('http://', '');
                $(this).attr('href', 'http://' + site);
            } else {
                $["notify"]('Введите валидный адрес сайта', 'danger');
                $('#site').focus();
                return false;
            }
        });
    });
</script>

<script src="/vendor/cms/_js/tinymce/tinymce.min.js"></script>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>

<script>
    $(document).ready(function(){
        tinymce.init({
            selector: ".htmlEdit_text",
            theme: "modern",
            menubar:false,
            statusbar: false,
            plugins: [
                "advlist autolink lists link charmap hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "paste textcolor"
            ],
            toolbar1: "undo redo | pastetext | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code ",
            height: 300,
            language:'ru',
            extended_valid_elements: 'span[*],div[*],p[*],areatext[*],',
            setup:function(ed) {
                ed.on('change', function(e) {
                    window.unsaved = true;
                });
            }
        });

        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });

        $('.modalBtn').click(function(){
            callCrop();
        });
    });
</script>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validationForm").validate({
            rules: {
                name: {
                    required: true,
                    remote: '?handler=checkName&id=<?= $item->id() ?>'
                }
            },
            messages: {
                name: {
                    required: "Введите название",
                    remote: "Такое название уже имеется"
                }
            }
        });
    });
</script>