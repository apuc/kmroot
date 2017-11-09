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
 * @var array $trailers
 * @var array $page
 * @var $itemCount
 * @var object $pagination
 */
?>


<div class="content-heading">Статистика просмотров трейлеров</div>

<div class="row">
	<p>
		<form method="get" action="trailer">
			<div class="form-group">
				<label for="year">Поиск трейлера</label>
				<input type="text" name="film" value="" id="film" class="form-control" placeholder="Введите название фильма или ID">
			</div>
			<input type="submit" value="Найти" class="btn btn-primary">
		</form>
	</p>
	
	<div class="col-lg-10 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-wrapper">
				<div class="panel-body">
					<table id="dataTable" class="table table-striped table-bordered">
						<thead>
						<tr>
							<th>ID</th>
							<th>Название</th>
							<th>Дата добавления</th>
							<th>Количество просмотров</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($trailers as $item):?>
							<tr>
								<th><?= $item['filmId']; ?></th>
								<th><?= $item['name_ru']; ?></th>
								<th><?= $item['date']; ?></th>
								<th><?= $item['view']; ?></th>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $pagination?>

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