<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?php
/**
 * @var string $title
 */
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?= $title ?></title>
<!-- =============== VENDOR STYLES ===============-->
<!-- FONT AWESOME-->
<link rel="stylesheet" href="/vendor/cms/fontawesome/css/font-awesome.min.css">
<!-- SIMPLE LINE ICONS-->
<link rel="stylesheet" href="/vendor/cms/simple-line-icons/css/simple-line-icons.css">
<!-- ANIMATE.CSS-->
<link rel="stylesheet" href="/vendor/cms/animate.css/animate.min.css">
<!-- WHIRL (spinners)-->
<link rel="stylesheet" href="/vendor/cms/whirl/dist/whirl.css">
<!-- SWEET ALERT-->
<link rel="stylesheet" href="/vendor/cms/sweetalert/dist/sweetalert.css">
<!-- =============== PAGE VENDOR STYLES ===============-->
<link rel="stylesheet" href="/vendor/cms/loaders.css/loaders.css">
<!-- CHOSEN-->
<link rel="stylesheet" href="/vendor/cms/chosen_v1.2.0/chosen.min.css">
<!-- =============== BOOTSTRAP STYLES ===============-->
<link rel="stylesheet" href="/vendor/cms/_css/bootstrap.css">
<!-- =============== APP STYLES ===============-->
<link rel="stylesheet" href="/vendor/cms/_css/app.css">
<link rel="stylesheet" href="/vendor/cms/_css/theme.css">

</head>
<body class="layout-fixed">
<div class="wrapper">
    <header class="topnavbar-wrapper">
        <nav role="navigation" class="navbar topnavbar">
            <div class="navbar-header">
                <a href="/" target="_blank" class="navbar-brand">
                    <div class="brand-logo">
                        &nbsp; KINOMANIA &nbsp;
                    </div>
                    <div class="brand-logo-collapsed">
                        &nbsp; KM &nbsp;
                    </div>
                </a>
            </div>

            <div class="nav-wrapper">
                <ul class="nav navbar-nav" style="margin-left: 6px;">
                    <li>
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"></em>
                        </a>
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                            <em class="fa fa-navicon"></em>
                        </a>
                    </li>
                    <li>
                        <a href="/control/sys/admin/profile" title="Профиль">
                            <em class="icon-user"></em>
                        </a>
                    </li>
                    <li>
                        <a href="/control/quit" title="Выход">
                            <em class="icon-lock"></em>
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li class="visible-lg">
                        <a href="#" data-toggle-fullscreen="">
                            <em class="fa fa-expand"></em>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="search" action="search.html" class="navbar-form">
                <div class="form-group has-feedback">
                    <input type="text" placeholder="Поиск по сайту" class="form-control">
                    <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
                </div>
                <button type="submit" class="hidden btn btn-default">Submit</button>
            </form>
        </nav>
    </header>

    <aside class="aside">
        <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
                <?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $menu
 */
?>
<ul class="nav">
    <?= $menu ?>
</ul>
            </nav>
        </div>
    </aside>


    <!-- =============== VENDOR SCRIPTS ===============-->
    <script src="/vendor/cms/modernizr/modernizr.js"></script>
    <script src="/vendor/cms/jquery/dist/jquery.js"></script>
    <script src="/vendor/cms/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/vendor/cms/jQuery-Storage-API/jquery.storageapi.js"></script>
    <script src="/vendor/cms/jquery.easing/js/jquery.easing.js"></script>
    <script src="/vendor/cms/animo.js/animo.js"></script>
    <script src="/vendor/cms/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/vendor/cms/screenfull/dist/screenfull.js"></script>
    <script src="/vendor/cms/bootstrap-filestyle/src/bootstrap-filestyle.js"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <script src="/vendor/cms/chosen_v1.2.0/chosen.jquery.min.js"></script>
    <script src="/vendor/cms/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
    <script>
        !function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof exports?require("jquery"):jQuery)}(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function o(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(c," ")),u.json?JSON.parse(e):e}catch(n){}}function t(n,o){var i=u.raw?n:r(n);return e.isFunction(o)?o(i):i}var c=/\+/g,u=e.cookie=function(r,c,f){if(void 0!==c&&!e.isFunction(c)){if(f=e.extend({},u.defaults,f),"number"==typeof f.expires){var a=f.expires,d=f.expires=new Date;d.setTime(+d+864e5*a)}return document.cookie=[n(r),"=",i(c),f.expires?"; expires="+f.expires.toUTCString():"",f.path?"; path="+f.path:"",f.domain?"; domain="+f.domain:"",f.secure?"; secure":""].join("")}for(var p=r?void 0:{},s=document.cookie?document.cookie.split("; "):[],m=0,x=s.length;x>m;m++){var v=s[m].split("="),k=o(v.shift()),l=v.join("=");if(r&&r===k){p=t(l,c);break}r||void 0===(l=t(l))||(p[k]=l)}return p};u.defaults={},e.removeCookie=function(n,o){return void 0===e.cookie(n)?!1:(e.cookie(n,"",e.extend({},o,{expires:-1})),!e.cookie(n))}});
    </script>
    <script>
        $(':file').filestyle({buttonText: "Выберите файл"});
        (function(window, document, $, undefined){
            $(function(){
                $('select').chosen({disable_search_threshold: 10});
            });
        })(window, document, window.jQuery);
    </script>
    <!-- =============== APP SCRIPTS ===============-->
    <script src="/vendor/cms/_js/app.js"></script>
    <!-- Alert-->
    <script>
        var alert = $.cookie('__alert__');
        if ('undefined' !== typeof alert && alert.trim()) {
            var color = alert.split('|');
            var message = color[0];
            var type = 'info';
            color = color[1];
            switch (color) {
                case 'red':
                    type = 'danger';
                    break;
                case 'green':
                    type = 'success';
                    break;
                default:
                    break;
            }
            $.removeCookie('__alert__', { path: '/' });
            $["notify"](message, type);
        }
        function delConfirmInit()
        {
            $('.delConfirm').on('click', function(e) {
                window.delConfirmE = this;
                e.preventDefault();

                var title = $(this).attr('data-title');
                var text = $(this).attr('data-text');

                swal({
                    title: title,
                    text: text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Да, удалить",
                    cancelButtonText: "Отмена",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        $(window.delConfirmE).parent().submit();
                    }
                });
            });
        }
        function confirmInit()
        {
            $('.confirm').on('click', function(e) {
                window.delConfirmE = this;
                e.preventDefault();

                var title = $(this).attr('data-title');
                var text = $(this).attr('data-text');

                swal({
                    title: title,
                    text: text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Да, изменить",
                    cancelButtonText: "Отмена",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        $(window.delConfirmE).parent().submit();
                    }
                });
            });
        }

        $(document).ready(function(){
            window.unsaved = false;
            $(window).bind('beforeunload', function() {
                if(window.unsaved){
                    return "Возможно Вы внесли измения на странице";
                }
            });
            $('.save').submit(function(){
                window.unsaved = false;
            });
            $("form.save :input, form.save select, form.save textarea").change(function() {
                window.unsaved = true;
            });

            delConfirmInit();
            confirmInit();
            checkNew();
            setInterval(checkNew, 12000);

            if (null !== $.cookie("scroll")) {
                setTimeout(function(){
                    $(document).scrollTop($.cookie("scroll"));
                    $.removeCookie('scroll', { path: '/' });
                }, 100);
            }
            $('.saveScrollPosition').on("submit", function() {
                $.cookie("scroll", $(document).scrollTop(), { path: '/' });
            });
        });

        function checkNew() {
            $.ajax({
                method: "post",
                url: "<?= $request->makeUrl('index') ?>?handler=getNew",
                success: function(data) {
                    data = JSON.parse(data);

                    if (0 == data.comment) {
                        $('#commentLabel').hide();
                    } else {
                        $('#commentLabel').html(data.comment).show();
                    }
                }
            });
        }
    </script>


    <section>
        <div class="content-wrapper animated fadeInLeft">
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
                            <?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\News\Item $item
 */
?>

<style>
    .menu a {
        margin-top: 2px;
    }
</style>
<div class="menu">
    <a href="<?= $request->makeUrl('news/edit?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'news/edit')): ?> active <?php endif ?>">Основное</a>
    &nbsp;
    <a href="<?= $request->makeUrl('news/gallery?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'news/gallery')): ?> active <?php endif ?>">Галерея</a>
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
    var UPLOAD = {
    buttonId: 'fileBtn',
    fileId: 'file',
    fileFormId: 'fileForm',
    entityId: 'entityId',
    extensionId: 'extension',
    maxSize: 5242880,
    fileUrl: 'fileUrl',
    fileImg: 'fileImg',
    fileDeleteBtn: 'fileDeleteBtn',
    callback: function(){ return false; },
    init: function(settings) {
        if (undefined === settings) {
            settings = {};
        }

        if (settings.hasOwnProperty('buttonId')) {
            this.buttonId = settings.buttonId;
        }

        if (settings.hasOwnProperty('fileId')) {
            this.fileId = settings.fileId;
        }

        if (settings.hasOwnProperty('fileFormId')) {
            this.fileFormId = settings.fileFormId;
        }

        if (settings.hasOwnProperty('entityId')) {
            this.entityId = settings.entityId;
        }

        if (settings.hasOwnProperty('fileUrl')) {
            this.fileUrl = settings.fileUrl;
        }

        if (settings.hasOwnProperty('fileImg')) {
            this.fileImg = settings.fileImg;
        }
        
        if (settings.hasOwnProperty('maxSize')) {
            this.maxSize = settings.maxSize;
        }
        
        if (settings.hasOwnProperty('extensionId')) {
            this.extensionId = settings.extensionId;
        }

        if (settings.hasOwnProperty('fileDeleteBtn')) {
            this.fileDeleteBtn = settings.fileDeleteBtn;
        }
        
        if (settings.hasOwnProperty('callback')) {
            this.callback = settings.callback;
        }

        $('#' + this.buttonId).click(UPLOAD.load);
        $('#' + this.fileDeleteBtn).click(UPLOAD.delete);

        if ('' != $('#fileImg').attr('src')) {
            $('#fileNew').hide();
            $('#fileDelete').show();
        } else {
            $('#fileNew').show();
            $('#fileDelete').hide();
        }
    },
    load: function (){
        $('.progress').fadeIn();

        var fd = new FormData();
        fd.append('id', $('#' + UPLOAD.entityId).val());
        fd.append('url', $('#' + UPLOAD.fileUrl).val());
        var length = $('#' + UPLOAD.fileId)[0].files.length;
        for(var i = 0; i < length; i++){
            fd.append("fileList[]", $('#' + UPLOAD.fileId)[0].files[i]);
        }

        if ('' == $('#' + UPLOAD.fileUrl).val() && 0 === $('#' + UPLOAD.fileId)[0].files.length) {
            $("#progressbar").css('width', '0%');
            $('.progress').fadeOut();
            $('#' + UPLOAD.fileFormId).trigger('reset');
            $["notify"]('Добавьте файл или укажите URL', 'danger');
        } else {
            if (0 < UPLOAD.maxSize && undefined !== $('#' + UPLOAD.fileId)[0].files[0] && UPLOAD.maxSize < $('#' + UPLOAD.fileId)[0].files[0].size) { // 5m
                $("#progressbar").css('width', '0%');
                $('.progress').fadeOut();
                $('#' + UPLOAD.fileFormId).trigger('reset');
                $["notify"]('Недопустимый размер файла', 'danger');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '?handler=upload',
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', UPLOAD.progressHandle, false);
                        }
                        return myXhr;
                    },
                    success: function (data) {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        if ('true' == data.redirect) {
                            document.location.reload();
                        } else {
                            switch (data.er) {
                                case 0:
                                    var src = $('#' + UPLOAD.fileImg).attr('data-src');
                                    src = src.split('.');
                                    src.pop();
                                    src = src.join('.');
                                    $('#' + UPLOAD.fileImg).attr('src', src + '.' + data.ex + '?' + Math.random());
                                    $('#' + UPLOAD.extensionId).val(data.ex);
                                    $('#fileNew').hide();
                                    $('#fileDelete').show();
                                    UPLOAD.callback();
                                    break;
                                case 1:
                                    $["notify"]('Недопустимый формат файла', 'danger');
                                    break;
                                case 2:
                                    $["notify"]('Недопустимый размер файла', 'danger');
                                    break;
                                case 3:
                                    $["notify"]('Ошибка в ссылке на файл', 'danger');
                                    break;
                                case 6:
                                    $["notify"]('Недопустимое разрешение файла', 'danger');
                                    break;
                                default:
                                    $["notify"]('Не удалось загрузить файл', 'danger');
                            }
                        }
                    },
                    error: function () {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $["notify"]('Не удалось загрузить файл', 'danger');
                    },
                    timeout: 20000
                });
            }
        }
    },
    delete: function() {
        swal({
            title: 'Удалить?',
            text: '',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да, удалить",
            cancelButtonText: "Отмена",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $('.progress').fadeIn();

                var fd = new FormData();
                fd.append('id', $('#' + UPLOAD.entityId).val());
                fd.append('extension', $('#' + UPLOAD.extensionId).val());

                $.ajax({
                    type: 'POST',
                    url: '?handler=delete',
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', UPLOAD.progressHandle, false);
                        }
                        return myXhr;
                    },
                    success: function (data) {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $('#fileNew').show();
                        $('#fileDelete').hide();
                    },
                    error: function () {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $["notify"]('Не удалось удалить файл', 'danger');
                    },
                    timeout: 20000
                });
            }
        });
    },
    progressHandle: function(e) {
        if (e.lengthComputable) {
            var val = (e.loaded / e.total) * 100;
            $("#progressbar").css('width', val + '%');
        }
    }
};
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
        </div>
    </section>

    <button type="button" data-notify="" data-message="" data-options="{&quot;status&quot;:&quot;success&quot;}" id="__green_alert" style="display:none;"></button>

    <footer>
        &copy; kinomania, 2000
    </footer>
</div>
<div id="modalWindow" tabindex="-1" role="dialog" aria-labelledby="Modal window" aria-hidden="true" class="modal fade"></div>
<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>

<?php if (in_array($request->route(), ['person/edit'])): ?>
    <div id="educationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="educationForm">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="myModalLabel" class="modal-title">Образование</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="university">
                            Университет
                        </label>
                        <input type="text" name="university" id="university" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="department">
                            Факультет
                        </label>
                        <input type="text" name="department" id="department" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="studio">
                            Мастерская
                        </label>
                        <input type="text" name="studio" id="studio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="year_start">
                            Год начала
                        </label>
                        <div class="input-group date yearPicker">
                            <input type="text" name="year_start" id="year_start" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year_end">
                            Год окончания
                        </label>
                        <div class="input-group date yearPicker">
                            <input type="text" name="year_end" id="year_end" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">
                            Комментарий
                        </label>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                    <button type="button" id="educationBtn" class="btn btn-primary">Добавить</button>
                </div>

                <input type="hidden" name="previousValue" id="previousValue" value="" />
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.yearPicker').datetimepicker({
        locale: 'ru',
        format: "YYYY",
        viewMode: 'years'
    });

    $('#university').tokenfield({
        limit: 1,
        createTokensOnBlur: true,
        autocomplete: {
            source: "?handler=getUniversity",
            minLength: 1
        }
    }).on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });

    $('#department').tokenfield({
        limit: 1,
        createTokensOnBlur: true,
        autocomplete: {
            source: "?handler=getDepartment",
            minLength: 1
        }
    }).on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });

    $('#studio').tokenfield({
        limit: 1,
        createTokensOnBlur: true,
        autocomplete: {
            source: "?handler=getStudio",
            minLength: 1
        }
    }).on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });

    $(document).ready(function(){
        var data = $('#education').val();
        if ('' != data) {
            data = data.split('_;_');
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    var item = data[key].split('_:_');
                    if (6 == item.length) {
                        $('#educationTable thead').show();
                        var html = '<td>' + item[0] + '</td><td>' + item[1] + '</td><td>' + item[2] + '</td><td>' + item[3] + '</td><td>' + item[4] + '</td><td>' + item[5] + '</td><td><button data-value="' + data[key] + '" type="button" class="btn btn-info btn-xs editEducation"><em class="fa fa-edit"></em></button></td><td><button data-value="' + data[key] + '" type="button" class="btn btn-danger btn-xs activeConfirm deleteEducation" data-title="Удалить?"><em class="fa fa-remove"></em></button></td>';
                        $('#educationTable tbody').append('<tr>' + html + '</tr>');
                    }
                }
            }
        }
        educationEditInit();
        educationDeleteConfirmInit();

        $('#educationBtn').click(function(){
            if ('' != $('#university').val() || '' != $('#department').val() || '' != $('#studio').val()) {
                $('#university').val($('#university').val().replace(/"/g, '\''));
                $('#department').val($('#department').val().replace(/"/g, '\''));
                $('#studio').val($('#studio').val().replace(/"/g, '\''));
                $('#year_start').val($('#year_start').val().replace(/"/g, '\''));
                $('#year_end').val($('#year_end').val().replace(/"/g, '\''));
                $('#comment').val($('#comment').val().replace(/"/g, '\''));
                
                var valueList = $('#education').val().split('_;_');
                var value = $('#university').val() + '_:_' + $('#department').val() + '_:_' + $('#studio').val() + '_:_' + $('#year_start').val() + '_:_' + $('#year_end').val() + '_:_' + $('#comment').val();
                var html = '<td>' + $('#university').val() + '</td><td>' + $('#department').val() + '</td><td>' + $('#studio').val() + '</td><td>' + $('#year_start').val() + '</td><td>' + $('#year_end').val() + '</td><td>' + $('#comment').val() + '</td><td><button data-value="' + value + '" type="button" class="btn btn-info btn-xs editEducation"><em class="fa fa-edit"></em></button></td><td><button data-value="' + value + '" type="button" class="btn btn-danger btn-xs activeConfirm deleteEducation" data-title="Удалить?"><em class="fa fa-remove"></em></button></td>';
                var previousValue = $('#previousValue').val();
                if ('' != previousValue) {
                    var index = valueList.indexOf(previousValue);
                    valueList[index] = value;
                    $(window.editEducationE).parent().parent().html(html);
                } else {
                    valueList.push(value);
                    $('#educationTable tbody').append('<tr>' + html + '</tr>');
                }
                $('#educationTable thead').show();


                $('#education').val(valueList.join('_;_'));
                educationDeleteConfirmInit();
                educationEditInit();

                $('#university').tokenfield('setTokens', []);
                $('#university').val('');
                $('#department').tokenfield('setTokens', []);
                $('#department').val('');
                $('#studio').tokenfield('setTokens', []);
                $('#studio').val('');
                $('#year_start').val('');
                $('#year_end').val('');
                $('#comment').val('');
                $('#previousValue').val('');
            }

            $('#educationModal').modal('hide');
        })
    });

    $('#educationModal').on('hidden.bs.modal', function () {
        $('#university').tokenfield('setTokens', []);
        $('#university').val('');
        $('#department').tokenfield('setTokens', []);
        $('#department').val('');
        $('#studio').tokenfield('setTokens', []);
        $('#studio').val('');
        $('#year_start').val('');
        $('#year_end').val('');
        $('#comment').val('');
        $('#previousValue').val('');
        $('#educationBtn').text('Добавить');
    });

    function educationEditInit()
    {
        $('.editEducation').click(function(){
            window.editEducationE = this;
            $('#educationModal').modal('show');
            var value = $(window.editEducationE).attr('data-value');
            $('#previousValue').val(value);

            value = value.split('_:_');

            $('#university').tokenfield('setTokens', [value[0]]);
            $('#department').tokenfield('setTokens', [value[1]]);
            $('#studio').tokenfield('setTokens', [value[2]]);
            $('#year_start').val(value[3]);
            $('#year_end').val(value[4]);
            $('#comment').val(value[5]);

            $('#educationBtn').text('Сохранить');
        })
    }

    function educationDeleteConfirmInit()
    {
        $('.activeConfirm').on('click', function(e) {
            window.deleteEducationE = this;
            e.preventDefault();

            var title = $(this).attr('data-title');
            var text = $(this).attr('data-text');

            swal({
                title: title,
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Да",
                cancelButtonText: "Отмена",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var value = $(window.deleteEducationE).attr('data-value');
                    var valueList = $('#education').val().split('_;_');
                    var index = valueList.indexOf(value);
                    valueList.splice(index, 1);
                    $('#education').val(valueList.join('_;_'));
                    $(window.deleteEducationE).parent().parent().remove();
                    if ('' == $('#education').val()) {
                        $('#educationTable thead').hide();
                    }
                }
            });
        });
    }
</script>
    <div id="theaterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="theaterForm">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="myModalLabel" class="modal-title">Работа в театре</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="theatre">
                            Театр
                        </label>
                        <input type="text" name="theatre" id="theatre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="spectacle">
                            Спектакли
                        </label>
                        <textarea rows="5" name="spectacle" id="spectacle" class="form-control note-editor"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="year_start">
                            Год начала
                        </label>
                        <div class="input-group date yearPicker">
                            <input type="text" name="theater_year_start" id="theater_year_start" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year_end">
                            Год окончания
                        </label>
                        <div class="input-group date yearPicker">
                            <input type="text" name="theater_year_end" id="theater_year_end" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">
                            Комментарий
                        </label>
                        <input type="text" name="theater_comment" id="theater_comment" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                    <button type="button" id="theaterBtn" class="btn btn-primary">Добавить</button>
                </div>

                <input type="hidden" name="previousTheaterValue" id="previousTheaterValue" value="" />
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.yearPicker').datetimepicker({
        locale: 'ru',
        format: "YYYY",
        viewMode: 'years'
    });

    $('#theatre').tokenfield({
        limit: 1,
        createTokensOnBlur: true,
        autocomplete: {
            source: "?handler=getTheatre",
            minLength: 1
        }
    }).on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });

    $(document).ready(function(){
        var data = $('#theater').val();
        if ('' != data) {
            data = data.split('_;_');
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    var item = data[key].split('_:_');
                    if (5 == item.length) {
                        $('#theaterTable thead').show();
                        var html = '<td>' + item[0] + '</td><td>' + item[1] + '</td><td>' + item[2] + '</td><td>' + item[3] + '</td><td>' + item[4] + '</td><td><button data-value="' + data[key] + '" type="button" class="btn btn-info btn-xs editTheater"><em class="fa fa-edit"></em></button></td><td><button data-value="' + data[key] + '" type="button" class="btn btn-danger btn-xs activeConfirm theaterActiveConfirm deleteTheater" data-title="Удалить?"><em class="fa fa-remove"></em></button></td>';
                        $('#theaterTable tbody').append('<tr>' + html + '</tr>');
                    }
                }
            }
        }
        theaterDeleteConfirmInit();
        theaterEditInit();

        $('#theaterBtn').click(function(){
            if ('' != $('#theatre').val() || '' != $('#spectacle').val()) {
                $('#theatre').val($('#theatre').val().replace(/"/g, '\''));
                $('#spectacle').val($('#spectacle').val().replace(/"/g, '\''));
                $('#theater_year_start').val($('#theater_year_start').val().replace(/"/g, '\''));
                $('#theater_year_end').val($('#theater_year_end').val().replace(/"/g, '\''));
                $('#theater_comment').val($('#theater_comment').val().replace(/"/g, '\''));

                var valueList = $('#theater').val().split('_;_');
                var value = $('#theatre').val() + '_:_' + $('#spectacle').val() + '_:_' + $('#theater_year_start').val() + '_:_' + $('#theater_year_end').val() + '_:_' + $('#theater_comment').val();
                var html = '<td>' + $('#theatre').val() + '</td><td>' + $('#spectacle').val() + '</td><td>' + $('#theater_year_start').val() + '</td><td>' + $('#theater_year_end').val() + '</td><td>' + $('#theater_comment').val() + '</td><td><button data-value="' + value + '" type="button" class="btn btn-info btn-xs editTheater"><em class="fa fa-edit"></em></button></td><td><button data-value="' + value + '" type="button" class="btn btn-danger btn-xs theaterActiveConfirm deleteTheater" data-title="Удалить?"><em class="fa fa-remove"></em></button></td>';
                var previousTheaterValue = $('#previousTheaterValue').val();
                if ('' != previousTheaterValue) {
                    var index = valueList.indexOf(previousTheaterValue);
                    valueList[index] = value;
                    $(window.editTheaterE).parent().parent().html(html);
                } else {
                    valueList.push(value);
                    $('#theaterTable tbody').append('<tr>' + html + '</tr>');
                }
                $('#theaterTable thead').show();


                $('#theater').val(valueList.join('_;_'));
                theaterDeleteConfirmInit();
                theaterEditInit();

                $('#theatre').tokenfield('setTokens', []);
                $('#theatre').val('');
                $('#spectacle').val('');
                $('#theater_year_start').val('');
                $('#theater_year_end').val('');
                $('#theater_comment').val('');
                $('#previousTheaterValue').val('');
            }

            $('#theaterModal').modal('hide');
        })
    });

    $('#theaterModal').on('hidden.bs.modal', function () {
        $('#theatre').tokenfield('setTokens', []);
        $('#theatre').val('');
        $('#spectacle').val('');
        $('#theater_year_start').val('');
        $('#theater_year_end').val('');
        $('#theater_comment').val('');
        $('#previousTheaterValue').val('');
        $('#theaterBtn').text('Добавить');
    });

    function theaterEditInit()
    {
        $('.editTheater').click(function(){
            window.editTheaterE = this;
            $('#theaterModal').modal('show');
            var value = $(window.editTheaterE).attr('data-value');
            $('#previousTheaterValue').val(value);

            value = value.split('_:_');

            $('#theatre').tokenfield('setTokens', [value[0]]);
            $('#spectacle').val(value[1]);
            $('#theater_year_start').val(value[2]);
            $('#theater_year_end').val(value[3]);
            $('#theater_comment').val(value[4]);

            $('#theaterBtn').text('Сохранить');
        })
    }

    function theaterDeleteConfirmInit()
    {
        $('.theaterActiveConfirm').on('click', function(e) {
            window.deleteTheaterE = this;
            e.preventDefault();

            var title = $(this).attr('data-title');
            var text = $(this).attr('data-text');

            swal({
                title: title,
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Да",
                cancelButtonText: "Отмена",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var value = $(window.deleteTheaterE).attr('data-value');
                    var valueList = $('#theater').val().split('_;_');
                    var index = valueList.indexOf(value);
                    valueList.splice(index, 1);
                    $('#theater').val(valueList.join('_;_'));
                    $(window.deleteTheaterE).parent().parent().remove();
                    if ('' == $('#theater').val()) {
                        $('#theaterTable thead').hide();
                    }
                }
            });
        });
    }
</script>
<?php endif ?>
</body>
</html>