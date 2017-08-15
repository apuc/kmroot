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
 * @var \Kinomania\Control\Video\Trailer $item
 * @var array $typeList
 * @var bool $encode
 * @var string $name_origin
 * @var string $name_ru
 */
?>


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