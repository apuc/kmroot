<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 * @var array $companyList
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
    .delCompany {
        position: relative;
        top: 4px;
    }
    img {
        max-width: 400px;
    }
    label a {
        font-weight: normal;
    }
</style>

<div class="content-heading">
    Редактировать фильм
    &nbsp; &nbsp;
    <a href="<?= Server::DEMO ?>/film/<?= $item->id() ?>/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= Server::MAIN ?>/film/<?= $item->id() ?>/" target="_blank" class="smaller">На сайте</a>
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
                            <!-- include film/menu.html.php -->
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
                            <a href="<?= $request->makeUrl('film') ?>/" class="btn btn-default">Назад</a>
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
                                    Оригинальное имя
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
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="countries" class="col-sm-2 control-label">
                                    Страны
                                </label>
                                <div class="col-sm-9">
                                    <select name="countries" id="countries" multiple="multiple" class="chosen-select form-control">
                                        <?php foreach (\Kinomania\System\Data\Country::RU as $code => $name): ?>
                                            <option value="<?= $code ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="country" id="countryList" value="<?= $item->country() ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="genres" class="col-sm-2 control-label">
                                    Жанры
                                </label>
                                <div class="col-sm-9">
                                    <select name="genres" id="genres" multiple="multiple" class="chosen-select form-control">
                                        <?php foreach (\Kinomania\System\Data\Genre::RU as $code => $name): ?>
                                            <option value="<?= $code ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="genre" id="genreList" value="<?= $item->genre() ?>" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="budget" class="col-sm-11">
                                        Бюджет
                                    </label>
                                    <div class="input-group m-b col-sm-11">
                                        <span class="input-group-addon">млн $</span>
                                        <input type="text" name="budget" id="budget" value="<?= $item->budget() ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="premiere_world" class="col-sm-11">
                                        Премьера в мире
                                    </label>
                                    <div class="input-group datePicker col-sm-11">
                                        <input type="text" name="premiere_world" id="premiere_world" value="<?= $item->premiere_world() ?>" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="premiere_ru" class="col-sm-11">
                                        Премьера в РФ
                                    </label>
                                    <div class="input-group datePicker col-sm-11">
                                        <input type="text" name="premiere_ru" id="premiere_ru" value="<?= $item->premiere_ru() ?>" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="premiere_usa" class="col-sm-11">
                                        Премьера в США
                                    </label>
                                    <div class="input-group datePicker col-sm-11">
                                        <input type="text" name="premiere_usa" id="premiere_usa" value="<?= $item->premiere_usa() ?>" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">
                                    Сериал
                                </label>
                                <div class="col-sm-9">
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Нет</option>
                                        <option <?php if ('series_ru' == $item->type()): ?> selected="selected" <?php endif ?> value="series_ru">Русский</option>
                                        <option <?php if ('series' == $item->type()): ?> selected="selected" <?php endif ?> value="series">Иностранный</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="arthouse" class="col-sm-2 control-label">
                                    Артхаус
                                </label>
                                <div class="col-sm-9">
                                    <select name="arthouse" id="arthouse" class="form-control">
                                        <option value="no">Нет</option>
                                        <option <?php if ('yes' == $item->arthouse()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                                    </select>
                                </div>
                            </div>

                            <br />
                            <div class="form-group">
                                <label for="limit_us" class="col-sm-2 control-label">
                                    Возрастной ценз USA
                                </label>
                                <div class="col-sm-9">
                                    <select name="limit_us" id="limit_us" class="form-control">
                                        <option value="">Неопределено</option>
                                        <option <?php if ('G' == $item->limit_us()): ?> selected="selected" <?php endif ?> value="G">G</option>
                                        <option <?php if ('PG' == $item->limit_us()): ?> selected="selected" <?php endif ?> value="PG">PG</option>
                                        <option <?php if ('PG-13' == $item->limit_us()): ?> selected="selected" <?php endif ?> value="PG-13">PG-13</option>
                                        <option <?php if ('R' == $item->limit_us()): ?> selected="selected" <?php endif ?> value="R">R</option>
                                        <option <?php if ('NC-17' == $item->limit_us()): ?> selected="selected" <?php endif ?> value="NC-17">NC-17</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="limit_ru" class="col-sm-2 control-label">
                                    Возрастной ценз РФ
                                </label>
                                <div class="col-sm-9">
                                    <select name="limit_ru" id="limit_ru" class="form-control">
                                        <option value="">Неопределено</option>
                                        <option <?php if ('0' == $item->limit_ru()): ?> selected="selected" <?php endif ?> value="0">0+</option>
                                        <option <?php if ('6' == $item->limit_ru()): ?> selected="selected" <?php endif ?> value="6">6+</option>
                                        <option <?php if ('12' == $item->limit_ru()): ?> selected="selected" <?php endif ?> value="12">12+</option>
                                        <option <?php if ('16' == $item->limit_ru()): ?> selected="selected" <?php endif ?> value="16">16+</option>
                                        <option <?php if ('18' == $item->limit_ru()): ?> selected="selected" <?php endif ?> value="18">18+</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year" class="col-sm-12">
                                        Год выпуска
                                    </label>
                                    <div class="input-group yearPicker col-sm-11">
                                        <input type="text" name="year" id="year" value="<?= $item->year() ?>" class="form-control">
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="runtime" class="col-sm-12">
                                        Длительность, мин
                                    </label>
                                    <div class="input-group col-sm-11">
                                        <input type="text" name="runtime" id="runtime" value="<?= $item->runtime() ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="season_count" class="col-sm-12">
                                        Сезонов
                                    </label>
                                    <div class="input-group col-sm-11">
                                        <input type="text" name="season_count" id="season_count" value="<?= $item->season_count() ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="series_count" class="col-sm-12">
                                        Серий
                                    </label>
                                    <div class="input-group col-sm-11">
                                        <input type="text" name="series_count" id="series_count" value="<?= $item->series_count() ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="year_finish" class="col-sm-12">
                                        Год финиш
                                    </label>
                                    <div class="input-group yearPicker col-sm-11">
                                        <input type="text" name="year_finish" id="year_finish" value="<?= $item->year_finish() ?>" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="concern" class="col-sm-2 control-label">
                                    Компании
                                </label>
                                <div  id="companyList" class="col-sm-9">
                                    <?php
                                    /**
                                     * @var \Kinomania\Control\Film\Company\Item $company
                                     */
                                    ?>
                                    <?php $companyCount = 1; ?>
                                    <?php foreach ($companyList as $company): ?>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <select name="concern_type_<?= $companyCount ?>" id="concern" class="form-control">
                                                    <?php foreach (\Kinomania\System\Data\Company::CONCERN as $name): ?>
                                                        <option <?php if ($company->type() == $name): ?> selected="selected" <?php endif ?> value="<?= $name ?>"><?= $name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text" name="concern_name_<?= $companyCount ?>" value="<?= $company->name() ?>" class="form-control concern_name" placeholder="Название компании" />
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="button" class="btn btn-xs btn-danger delCompany" value="удалить" />
                                            </div>
                                        </div>
                                        <br />
                                        <?php $companyCount++ ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                        <input type="button" id="addCompany" class="btn btn-xs btn-primary" value="добавить" />
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group col-sm-12">
                                <label for="preview">Описание</label>
                                <textarea name="preview" id="preview" class="htmlEdit_text form-control"><?= $item->preview() ?></textarea>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group col-sm-12">
                                <label for="fact">Факты</label>
                                <textarea name="fact" id="fact" class="htmlEdit_text form-control"><?= $item->fact() ?></textarea>
                            </div>
                        </fieldset>

                        <div class="form-group col-sm-12">
                            <a href="<?= $request->makeUrl('film') ?>/" class="btn btn-default">Назад</a>
                            <input type="submit" class="btn btn-primary margin20" value="Сохранить" />
                        </div>

                        <br />
                        <br />
                        
                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="eavStore" id="eavStore" value="" />
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
            url : '<?= $request->makeUrl('film/crop?id=') ?>' + id,
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

<script src="/vendor/cms/jquery-ui/ui/core.js"></script>
<script src="/vendor/cms/jquery-ui/ui/widget.js"></script>
<script src="/vendor/cms/jquery-ui/ui/mouse.js"></script>
<script src="/vendor/cms/jquery-ui/ui/sortable.js"></script>
<script src="/vendor/cms/chosen_v1.2.0/chosen.order.jquery.min.js"></script>

<script type="text/javascript" src="/vendor/cms/cropper/dist/cropper.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalBtn').click(function(){
            $.ajax({
                url : '<?= $request->makeUrl('film/merge?toId=' . $item->id()) ?>',
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

<script type="text/javascript">
    function regCompanyAuto() {
        $('.concern_name').autocomplete({
            source: "?handler=getCompany",
            minLength: 2
        });

        $('.delCompany').click(function(){
            $(this).parent().parent().remove();
        });
    }
    $(document).ready(function() {
        $('.modalBtn').click(function(){
            callCrop();
        });

        regCompanyAuto();
        window.counter = <?= $companyCount ?>;
        $('#addCompany').click(function(){
            $('#companyList').append('<div class="row">' +
                '<div class="col-lg-5">' +
                '<select name="concern_type_' + window.counter + '" class="form-control">' +
                <?php foreach (\Kinomania\System\Data\Company::CONCERN as $name): ?>
                '<option value="<?= $name ?>"><?= $name ?></option>' +
                <?php endforeach; ?>
                '</select>' +
                '</div>' +
                '<div class="col-lg-5">' +
                '<input type="text" name="concern_name_' + window.counter + '" value="" class="form-control concern_name" placeholder="Название компании" />' +
                '</div>' +
                '<div class="col-lg-2">' +
                '<input type="button" class="btn btn-xs btn-danger delCompany" value="удалить" />' +
                '</div>' +
                '</div><br />');
            $('select').chosen({disable_search_threshold: 10});
            window.counter++;
            regCompanyAuto();
        });
        $('.delCompany').click(function(){
            $(this).parent().parent().remove();
        });

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
            height: 370,
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
                        site += '/title/tt' + id;
                    }
                    break;
                case 'id_kt':
                    site = 'http://www.kino-teatr.ru';
                    id = $('#id_kt').val();
                    if ('' != id) {
                        site += '/kino/movie/' + id + '/annot/';
                    }
                    break;
                case 'id_rk':
                    site = 'http://ruskino.ru';
                    id = $('#id_rk').val();
                    if ('' != id) {
                        site += '/mov/' + id;
                    }
                    break;
                case 'id_kp':
                    site = 'https://www.kinopoisk.ru';
                    id = $('#id_kp').val();
                    if ('' != id) {
                        site += '/film/' + id + '/';
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

        $('.yearPicker').datetimepicker({
            locale: 'ru',
            format: "YYYY",
            viewMode: 'years'
        });
        $(".yearPicker").on("dp.show", function(e) { $(e.target).data("DateTimePicker").viewMode("years"); })

        $('#countries').change(function(){
            setTimeout(function(){
                setCountryList();
            }, 250);

        });
        $("#countries_chosen ul").sortable({
            update: setCountryList
        });
        $('#countries').setSelectionOrder($('#countryList').val().split(','), true);

        $('#genres').change(function(){
            setTimeout(function(){
                setGenreList();
            }, 250);
        });
        $("#genres_chosen ul").sortable({
            update: setGenreList
        });
        $('#genres').setSelectionOrder($('#genreList').val().split(','), true);
    });

    function setCountryList() {
        $('#countryList').val($('#countries').getSelectionOrder());
    }
    function setGenreList() {
        $('#genreList').val($('#genres').getSelectionOrder());
    }
</script>