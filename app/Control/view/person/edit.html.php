<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Person\Item $item
 */
use Kinomania\System\Config\Server;
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">

<style>
    .link {
        position: relative;
        top: 1px;
    }
    #educationTable tr td, #theaterTable tr td {
        max-width: 260px;
    }
    .tokenfield .token .token-label {
        max-width: 300px !important;
    }
    label a {
        font-weight: normal;
    }
    img {
        max-width: 400px;
    }
</style>

<div class="content-heading">
    Редактировать персону
    &nbsp; &nbsp;
    <a href="<?= Server::DEMO ?>/people/<?= $item->id() ?>/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= Server::MAIN ?>/people/<?= $item->id() ?>/" target="_blank" class="smaller">На сайте</a>
    &nbsp;
    <a href="#" target="_blank" class="smaller pull-right" id="modalBtn" data-toggle="modal" data-target="#modalWindow">Влить</a>

    <small>
        <?php if (!empty($item->name_origin())): ?>
            <?= $item->name_origin() ?>
            <?php if (!empty($item->name_ru())): ?>
                /
            <?php endif ?>
        <?php endif ?>
        <?= $item->name_ru() ?>
    </small>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- include person/menu.html.php -->
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
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_imdb">
                                        IMDB ID &nbsp;
                                        <a href="#" target="_blank" data-id="id_imdb" class="link"><em class="fa fa-external-link"></em></a>
                                    </label>
                                    <input type="text" name="id_imdb" id="id_imdb" value="<?= $item->id_imdb() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_kp">
                                        KP ID &nbsp;
                                        <a href="#" target="_blank" data-id="id_kp" class="link"><em class="fa fa-external-link"></em></a>
                                    </label>
                                    <input type="text" name="id_kp" id="id_kp" value="<?= $item->id_kp() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_kt">
                                        KT ID &nbsp;
                                        <a href="#" target="_blank" data-id="id_kt" class="link"><em class="fa fa-external-link"></em></a>
                                    </label>
                                    <input type="text" name="id_kt" id="id_kt" value="<?= $item->id_kt() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id_rk">
                                        RK ID &nbsp;
                                        <a href="#" target="_blank" data-id="id_rk" class="link"><em class="fa fa-external-link"></em></a>
                                    </label>
                                    <input type="text" name="id_rk" id="id_rk" value="<?= $item->id_rk() ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" style="padding-left: 0;">
                            <label for="check" class="control-label">Статус проверки</label>
                            <div class="form-group">
                                <select name="check" id="check" class="form-control">
                                    <option value="">Нет</option>
                                    <option <?php if ('profile' == $item->check()): ?> selected="selected" <?php endif ?> value="profile">Проверена анкета</option>
                                    <option <?php if ('parser' == $item->check()): ?> selected="selected" <?php endif ?> value="parser">Проверен парсер</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">
                                Примечание
                            </label>
                            <textarea rows="5" name="note" id="note" class="form-control note-editor"><?= $item->note() ?></textarea>
                        </div>

                        <div class="form-group">
                            <a href="<?= $request->makeUrl('person') ?>/" class="btn btn-default">Назад</a>
                            <input type="submit" class="btn btn-primary margin20" value="Сохранить" />
                        </div>

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="editSys" />
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
                    <form id="fileForm">
                        <label for="file">
                            Изображение
                            <?php if (!empty($item->name_origin())): ?>
                                &nbsp;
                                <a href="http://images.google.ru/images?hl=en&q=<?= $item->name_origin() ?>/" target="_blank">Google</a>
                                &nbsp;
                                <a href="http://images.yandex.ru/yandsearch?rpt=image&text=<?= $item->name_origin() ?>/" target="_blank">Яндекс</a>
                            <?php else: ?>
                                &nbsp;
                                <a href="http://images.google.ru/images?hl=en&q=<?= $item->name_ru() ?>/" target="_blank">Google</a>
                                &nbsp;
                                <a href="http://images.yandex.ru/yandsearch?rpt=image&text=<?= $item->name_ru() ?>/" target="_blank">Яндекс</a>
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
                    <form method="post" id="validationForm" class="save form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Вывод на сайте</label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control">
                                        <?php if ('new' == $item->status()): ?>
                                            <option value="new">Скрыто (новый)</option>
                                        <?php else: ?>
                                            <option value="hide">Скрыто</option>
                                        <?php endif ?>
                                        <option <?php if ('show' == $item->status()): ?> selected="selected" <?php endif ?> value="show">Опубликовано</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_origin" class="col-sm-2 control-label">
                                    Иностранное имя
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_origin" id="name_origin" value="<?= $item->name_origin() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_ru" class="col-sm-2 control-label">
                                    Русское имя
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_ru" id="name_ru" value="<?= $item->name_ru() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="search" class="col-sm-2 control-label">
                                    Дополнительные поисковые слова
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="search" id="search" value="<?= $item->search() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sex" class="col-sm-2 control-label">Пол</label>
                                <div class="col-sm-9">
                                    <select name="sex" id="sex">
                                        <option value="">Неизвестно</option>
                                        <option <?php if ('male' == $item->sex()): ?> selected="selected" <?php endif; ?> value="male">Мужчина</option>
                                        <option <?php if ('female' == $item->sex()): ?> selected="selected" <?php endif; ?> value="female">Женщина</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="origin" class="col-sm-2 control-label">Национальность</label>
                                <div class="col-sm-9">
                                    <select name="origin" id="origin">
                                        <option value="">Неизвестно</option>
                                        <option <?php if ('ru' == $item->origin()): ?> selected="selected" <?php endif; ?> value="ru">Русский</option>
                                        <option <?php if ('foreign' == $item->origin()): ?> selected="selected" <?php endif; ?> value="foreign">Иностранец</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Профессия</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="actor" id="actor" <?php if ('yes' == $item->actor()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Актер
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="director" id="director" <?php if ('yes' == $item->director()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Режисер
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="screenwriter" id="screenwriter" <?php if ('yes' == $item->screenwriter()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Сценарист
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="producer" id="producer" <?php if ('yes' == $item->producer()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Продюсер
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="composer" id="composer" <?php if ('yes' == $item->composer()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Композитор
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input name="operator" id="operator" <?php if ('yes' == $item->operator()): ?> checked="checked" <?php endif ?> type="checkbox">
                                                <span class="fa fa-check"></span>
                                                Оператор
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday" class="col-sm-4 control-label">
                                            Дата рождения
                                        </label>
                                        <div class="col-sm-7">
                                            <div class="input-group date datePicker">
                                                <input type="text" name="birthday" id="birthday" value="<?= $item->birthday() ?>" class="form-control">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="death" class="col-sm-3 control-label">
                                            Дата смерти
                                        </label>
                                        <div class="col-sm-7">
                                            <div class="input-group date datePicker">
                                                <input type="text" name="death" id="death" value="<?= $item->death() ?>" class="form-control">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthplace_en" class="col-sm-4 control-label">
                                            Место рождения
                                        </label>
                                        <div class="col-sm-7">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon">англ</span>
                                                <input type="text" name="birthplace_en" id="birthplace_en" value="<?= $item->birthplace_en() ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthplace_ru" class="col-sm-3 control-label">
                                            Место рождения
                                        </label>
                                        <div class="col-sm-7">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon">рус</span>
                                                <input type="text" name="birthplace_ru" id="birthplace_ru" value="<?= $item->birthplace_ru() ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="height" class="col-sm-2 control-label">
                                    Рост
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="height" id="height" value="<?= $item->height() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="match" class="col-sm-2 control-label">
                                    Семейное положение
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="match" id="match" value="<?= $item->match() ?>" placeholder="ID персоны в системе" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    &nbsp;
                                </label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-primary" value="Сохранить" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="biography">Биография</label>
                                    <textarea name="biography" id="biography" class="htmlEdit_text form-control"><?= $item->biography() ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Образование &nbsp;
                                <input type="button" data-toggle="modal" data-target="#educationModal" class="btn btn-xs btn-info" value="Добавить">
                            </legend>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="educationTable" class="table table-responsive table-striped">
                                        <thead style="display: none;">
                                        <th>Университет</th>
                                        <th>Факультет</th>
                                        <th>Мастерская</th>
                                        <th>Год начала</th>
                                        <th>Год окончания</th>
                                        <th>Комментарий</th>
                                        <th></th>
                                        <th></th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <input type="hidden" name="education" id="education" value="<?= $item->education() ?>" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                Работа в театре &nbsp;
                                <input type="button" data-toggle="modal" data-target="#theaterModal" class="btn btn-xs btn-info" value="Добавить">
                            </legend>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="theaterTable" class="table table-responsive table-striped">
                                        <thead style="display: none;">
                                        <th>Театр</th>
                                        <th>Спектакли</th>
                                        <th>Год начала</th>
                                        <th>Год окончания</th>
                                        <th></th>
                                        <th></th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <input type="hidden" name="theater" id="theater" value="<?= $item->theater() ?>" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="award" class="col-sm-2 control-label">
                                    Премии
                                </label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="award" id="award" class="form-control note-editor"><?= $item->award() ?></textarea>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="info" class="col-sm-2 control-label">
                                    Дополнительная информация
                                </label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="info" id="info" class="form-control note-editor"><?= $item->info() ?></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <a href="<?= $request->makeUrl('person') ?>/" class="btn btn-default">Назад</a>
                                <input type="submit" class="btn btn-primary margin20" value="Сохранить" />
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="eavStore" id="eavStore" value="" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                    <br />
                    <br />
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
            url : '<?= $request->makeUrl('person/crop?id=') ?>' + id,
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
    });
</script>


<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script src="/vendor/cms/jquery-ui/ui/core.js"></script>
<script src="/vendor/cms/jquery-ui/ui/widget.js"></script>
<script src="/vendor/cms/jquery-ui/ui/mouse.js"></script>
<script src="/vendor/cms/jquery-ui/ui/sortable.js"></script>
<script src="/vendor/cms/jquery-ui/ui/position.js"></script>
<script src="/vendor/cms/jquery-ui/ui/menu.js"></script>
<script src="/vendor/cms/jquery-ui/ui/autocomplete.js"></script>
<script src="/vendor/cms/chosen_v1.2.0/chosen.order.jquery.min.js"></script>

<script src="/vendor/cms/bootstrap-tagsinput/typehead.js"></script>
<script src="/vendor/cms/tokenfield/bootstrap-tokenfield.min.js"></script>

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<script src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script src="/vendor/cms/_js/tinymce/tinymce.min.js"></script>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalBtn').click(function(){
            $.ajax({
                url : '<?= $request->makeUrl('person/merge?toId=' . $item->id()) ?>',
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
    });
</script>

<script>
    $(document).ready(function(){
        $('.modalBtn').click(function(){
            callCrop();
        });
        
        /**
         * Date
         */
        $('.datePicker').datetimepicker({
            locale: 'ru',
            format: "DD.MM.YYYY"
        });

        /**
         * Delete referrer.
         */
        var meta = document.createElement('meta');
        meta.name = "referrer";
        meta.content = "no-referrer";
        document.getElementsByTagName('head')[0].appendChild(meta);

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
            height: 570,
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

        $('.link').click(function(){
            var site = $(this).attr('data-id');
            var id = '';
            switch (site) {
                case 'id_imdb':
                    site = 'http://imdb.com';
                    id = $('#id_imdb').val();
                    if ('' != id) {
                        site += '/name/nm' + id;
                    }
                    break;
                case 'id_kt':
                    site = 'http://www.kino-teatr.ru';
                    id = $('#id_kt').val();
                    if ('' != id) {
                        site += '/kino/acter/' + id;
                    }
                    break;
                case 'id_rk':
                    site = 'http://ruskino.ru';
                    id = $('#id_rk').val();
                    if ('' != id) {
                        site += '/art/' + id;
                    }
                    break;
                case 'id_kp':
                    site = 'https://www.kinopoisk.ru';
                    id = $('#id_kp').val();
                    if ('' != id) {
                        site += '/name/' + id + '/';
                    } else {
                        <?php if (!empty($item->name_origin())): ?>
                        site += "/index.php?first=no&what=&kp_query=<?= $item->name_origin() ?>";
                        <?php endif ?>
                    }
                    break;
                default:
                    return false;
            }
            $(this).attr('href', site);
        });
    });
</script>