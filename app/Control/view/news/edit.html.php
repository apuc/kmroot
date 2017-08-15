<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\News\Item $item
 * @var array $list
 * @var array $awardList
 * @var array $categoryList
 * @var array $adminList
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }

    img {
        max-width: 400px;
    }
    label a {
        font-weight: normal;
    }
</style>

<div class="content-heading">
    Редактировать статью
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/<?= $item->link() ?>/<?= $item->id() ?>/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/<?= $item->link() ?>/<?= $item->id() ?>/" target="_blank" class="smaller">На сайте</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- include news/menu.html.php -->
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
                            Изображение
                            <?php if (!empty($item->title())): ?>
                                &nbsp;
                                <a href="http://images.google.ru/images?hl=en&q=<?= $item->title() ?>/" target="_blank">Google</a>
                                &nbsp;
                                <a href="http://images.yandex.ru/yandsearch?rpt=image&text=<?= $item->title() ?>/" target="_blank">Яндекс</a>
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
                    <form method="post">
                        <div class="form-group">
                            <label for="category">Категория</label>
                            <select id="category" name="category">
                                <?php foreach ($categoryList as $category): ?>
                                    <option <?php if ($item->category() == $category): ?> selected="selected" <?php endif ?> value="<?= $category ?>"><?= $category ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Сохранить" />
                        </div>

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="changeCategory" />
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
                <div class="panel-body">
                    <form method="post" id="validationForm" class="save">
                        <fieldset>
                            <div class="form-group">
                                <label for="status">Вывод на сайте</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="hide">Скрыто</option>
                                    <option <?php if ('show' == $item->status()): ?> selected="selected" <?php endif ?> value="show">Опубликовано</option>
                                </select>
                            </div>
                            <?php if ('Рецензии' == $item->category()): ?>
                                <div class="form-group">
                                    <label for="filmId">ID фильма на сайте</label>
                                    <input type="text" name="filmId" value="<?= $item->filmId() ?>" id="filmId" class="form-control" placeholder="ID фильма" />
                                </div>
                            <?php endif ?>
                            <?php if ('Фестивали и премии' == $item->category()): ?>
                                <div class="form-group">
                                    <label for="title_short">Фестиваль, премия</label>
                                    <select name="title_short" id="title_short" class="form-control">
                                        <option value="">Выберите тип премии</option>
                                        <?php foreach ($awardList as $name): ?>
                                            <option <?php if ($item->title_short() == $name): ?> selected="selected" <?php endif ?> value="<?= $name ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="authorId">Автор</label>
                                <select id="authorId" name="authorId">
                                    <?php foreach ($adminList as $userId => $name): ?>
                                        <option <?php if ($item->authorId() == $userId): ?> selected="selected" <?php endif ?> value="<?= $userId ?>"><?= $name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postDate">Дата публикации</label>
                                <div id="datetimepicker" class="col-lg-3 input-group date">
                                    <input name="postDate" id="postDate" value="<?= $item->publish() ?>" type="text" class="form-control">
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="center">В центре внимания</label>
                                <select name="center" id="center" class="form-control">
                                    <option value="no">Нет</option>
                                    <option <?php if ('yes' == $item->center()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="popular">Популярные материалы</label>
                                <select name="popular" id="popular" class="form-control">
                                    <option value="no">Нет</option>
                                    <option <?php if ('yes' == $item->popular()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Теги
                                </label>
                                <input type="text" id="autoTag" name="tag" value="<?= $item->tag() ?>" class="form-control">
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input type="text" name="title" value="<?= $item->title() ?>" id="title" class="form-control" placeholder="Заголовок" />
                            </div>
                            <div class="form-group">
                                <label for="titleHtml">Заголовок HTML</label>
                                <input type="text" name="titleHtml" value="<?= $item->title_html() ?>" id="titleHtml" class="form-control" placeholder="Заголовок HTML" />
                            </div>
                            <div class="form-group">
                                <label for="titleHtml">Meta Description</label>
                                <input type="text" name="metaDescription" value="<?= $item->meta_description() ?>" id="metaDescription" class="form-control" placeholder="Meta Description" />
                            </div>
                        </fieldset>
                        <br />
                        <div class="form-group">
                            <label for="anons">Анонс</label>
                            <textarea name="anons" id="anons" class="htmlEdit form-control"><?= $item->anons() ?></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="text">Текст</label>
                            <textarea name="text" id="text" class="htmlEdit_text form-control"><?= $item->text() ?></textarea>
                        </div>

                        <br />
                        <div class="form-group">
                            <a href="<?= $request->makeUrl('news') ?>/" class="btn btn-default">Назад</a>
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

<form id="uploadForm" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
    <input id="uploadFile" name="fileList[]" type="file" />
</form>

<script type="text/javascript" src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/cms/_js/tinymce/tinymce.min.js"></script>
<script src="/vendor/cms/bootstrap-tagsinput/typehead.js"></script>
<script src="/vendor/cms/tokenfield/bootstrap-tokenfield.min.js"></script>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>

<script type="text/javascript">
    function callCrop() {
        var id = <?= $item->id() ?>;
        window.photoId = id;
        $.ajax({
            url : '<?= $request->makeUrl('news/crop?id=') ?>' + id,
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

<script>
    $(document).ready(function(){
        $('.modalBtn').click(function(){
            callCrop();
        });

        /**
         * Delete referrer.
         */
        var meta = document.createElement('meta');
        meta.name = "referrer";
        meta.content = "no-referrer";
        document.getElementsByTagName('head')[0].appendChild(meta);

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

        tinymce.PluginManager.add('gallery', function(editor, url) {
            editor.addButton('gallery', {
                text: 'Галереи',
                icon: false,
                onclick: function() {
                    // Open window
                    editor.windowManager.open({
                        title: 'Вставить галерею',
                        body: [
                            {type: 'listbox', name: 'title', label: 'Галерея',values : [
                                { text: 'Выберите галерею', value: '' },
                                <?php foreach($list as $gallery): ?>
                                { text: '#<?= $gallery['id'] ?> <?= $gallery['image'] ?>', value: '<?= $gallery['id'] ?>' },
                                <?php endforeach; ?>
                            ]}
                        ],
                        onsubmit: function(e) {
                            // Insert content when the window form is submitted
                            if (1 < e.data.title.length) {
                                editor.insertContent('#{gellary=' + e.data.title + '}');
                            }
                        }
                    });

                    window.once = true;
                    setTimeout(function(){
                        $('.mce-listbox button').click(function () {
                            if (window.once) {
                                window.once = false;
                                setTimeout(function () {
                                    $('.mce-text').each(function () {
                                        var html = $(this).text();
                                        if (-1 !== html.indexOf('#')) {
                                            html = html.split(' ');
                                            if ('' != html[1]) {
                                                $(this).html(html[0] + ' &nbsp; <img width="120" src="' + html[1] + '" style="width: 120px;" />');
                                            } else {
                                                $(this).html(html[0]);
                                            }
                                        }
                                    })
                                }, 100);
                            }
                        });
                    }, 100);
                }
            });
        });

        tinymce.init({
            selector: ".htmlEdit",
            relative_urls: false,
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
            height: 370,
            language:'ru',
            extended_valid_elements: 'span[*],div[*],p[*],areatext[*],',
            setup:function(ed) {
                ed.on('change', function(e) {
                    window.unsaved = true;
                });
            }
        });
        tinymce.init({
            selector: ".htmlEdit_text",
            relative_urls: false,
            theme: "modern",
            menubar:false,
            statusbar: false,
            plugins: [
                "advlist autolink lists link charmap hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime image media nonbreaking save table contextmenu directionality",
                "paste textcolor gallery"
            ],
            toolbar1: "insertfile undo redo | styleselect | pastetext blockquote | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image media gallery code",
            height: 600,
            language:'ru',
            extended_valid_elements: 'span[*],div[*],p[*],areatext[*],',
            file_browser_callback: function(field_name, url, type, win) {
                window._FIELD_NAME_ = field_name;
                $('#uploadFile').click();
            },
            setup : function(editor) {
                editor.on('change', function(e) {
                    window.unsaved = true;
                });
                editor.on('KeyDown', function (e) {
                    if ((e.keyCode == 8 || e.keyCode == 46) && editor.selection) { // delete & backspace keys
                        var selectedNode = editor.selection.getNode(); // get the selected node (element) in the editor
                        if (selectedNode && selectedNode.nodeName == 'IMG') {
                            $.ajax({
                                url : '?handler=deleteFile',
                                type: "POST",
                                data : {"file": selectedNode.src},
                                success:function() {
                                }
                            });
                        }
                    }
                });
            }
        });

        $('#uploadFile').change(function(){
            var fd = new FormData();
            fd.append('fileList[]', $('#uploadFile')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: '?handler=uploadFile',
                data: fd,
                processData: false,
                contentType: false,
                success: function(path) {
                    $('#' + window._FIELD_NAME_).val(path);
                    $('#uploadFile').val('');
                }
            });
        });

        setInterval(function(){
            var anons = tinymce.get('anons').getContent();
            var text = tinymce.get('text').getContent();
            
            var fd = new FormData();
            fd.append('id', <?= $item->id() ?>);
            fd.append('anons', anons);
            fd.append('text', text);

            $.ajax({
                url: '?handler=save',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success:function(data) {
                },
                error: function(jqXHR, textStatus, errorThrown) {
                },
                timeout: 5000
            });
        }, 7000);

        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });


        var citynames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '?handler=getTag',
                filter: function(list) {
                    return $.map(list, function(cityname) {
                        return { name: cityname }; });
                }
            }
        });
        citynames.initialize();

        $('#autoTag').tokenfield({
            autocomplete: {
                source: "?handler=getTag",
                minLength: 2
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
        });
    });
</script>


<script src="/vendor/cms/jquery-ui/ui/core.js"></script>
<script src="/vendor/cms/jquery-ui/ui/widget.js"></script>
<script src="/vendor/cms/jquery-ui/ui/position.js"></script>
<script src="/vendor/cms/jquery-ui/ui/menu.js"></script>
<script src="/vendor/cms/jquery-ui/ui/autocomplete.js"></script>
<script type="text/javascript">
    //$("#autoTag").autocomplete({
     //   source: "?handler=getTag",
      //  minLength: 2
    //});
</script>