<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Person\Item $item
 * @var \Kinomania\Control\Person\Casting\Item $casting
 * @var array $companyList
 */
use Kinomania\System\Config\Server;
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
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
</style>

<div class="content-heading">
    <?php if (!empty($item->image())): ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= $item->imageSmallSrc() ?>" width="50" style="max-height:74px;" />
        </div>
    <?php else: ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nof.jpg' ?>" width="50" style="max-height:74px;" />
        </div>
    <?php endif; ?>

    Кастинг
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
                    <form method="post" id="validationForm" class="save form-horizontal">
                        <fieldset>
                            <legend>Характеристики</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="height" class="col-sm-3 control-label">
                                            Рост
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="height" id="height" value="<?= $casting->height() ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight" class="col-sm-3 control-label">
                                            Вес
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="weight" id="weight" value="<?= $casting->weight() ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color_hair" class="col-sm-3 control-label">
                                            Цвет волос
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="color_hair" id="color_hair" class="chosen-select form-control">
                                                <option value="">Неизвестно</option>
                                                <?php foreach (\Kinomania\System\Data\Hair::COLOR as $elem): ?>
                                                    <option <?php if ($casting->color_hair() == $elem): ?> selected="selected" <?php endif ?> value="<?= $elem ?>"><?= $elem ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color_eyes" class="col-sm-3 control-label">
                                            Цвет глаз
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="color_eyes" id="color_eyes" class="chosen-select form-control">
                                                <option value="">Неизвестно</option>
                                                <?php foreach (\Kinomania\System\Data\Eyes::COLOR as $elem): ?>
                                                    <option <?php if ($casting->color_eyes() == $elem): ?> selected="selected" <?php endif ?> value="<?= $elem ?>"><?= $elem ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="sex" class="col-sm-2 control-label">Пол</label>
                                <div class="col-sm-9">
                                    <select name="sex" id="sex">
                                        <option value="">Неизвестно</option>
                                        <option <?php if ('male' == $casting->sex()): ?> selected="selected" <?php endif; ?> value="male">Мужчина</option>
                                        <option <?php if ('female' == $casting->sex()): ?> selected="selected" <?php endif; ?> value="female">Женщина</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birthday" class="col-sm-2 control-label">
                                    Дата рождения
                                </label>
                                <div class="col-sm-4 col-lg-2">
                                    <div class="input-group date datePicker">
                                        <input type="text" name="birthday" id="birthday" value="<?= $casting->birthday() ?>" class="form-control">
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="castingId" class="col-sm-2 control-label">
                                    Кастинг компания
                                </label>
                                <div class="col-sm-9">
                                    <select name="castingId" id="castingId" class="chosen-select form-control">
                                        <option value="">Отсутствует</option>
                                        <?php foreach ($companyList as $id => $name): ?>
                                            <option <?php if ($casting->castingId() == $id): ?> selected="selected" <?php endif ?> value="<?= $id ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ethnic" class="col-sm-2 control-label">
                                    Этнотип
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="ethnic" name="ethnic" value="<?= $casting->ethnic() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sport" class="col-sm-2 control-label">
                                    Спорт
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="sport" name="sport" value="<?= $casting->sport() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="language" class="col-sm-2 control-label">
                                    Иностранные языки
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="language" name="language" value="<?= $casting->language() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="music_instrument" class="col-sm-2 control-label">
                                    Музыкальные инструменты
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="music_instrument" name="music_instrument" value="<?= $casting->music_instrument() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dance" class="col-sm-2 control-label">
                                    Танцы
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="dance" name="dance" value="<?= $casting->dance() ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sing" class="col-sm-2 control-label">
                                    Пение
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" id="sing" name="sing" value="<?= $casting->sing() ?>" class="form-control">
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="<?= $request->makeUrl('person') ?>/" class="btn btn-default">Назад</a>
                                <input type="submit" class="btn btn-primary margin20" value="Сохранить" />
                            </div>
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

<script>
    $(document).ready(function(){
        /**
         * Autocomplete
         */
        $('#ethnic').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getEthnic",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value) {
                    event.preventDefault();
                }
            });
        });

        $('#sport').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getSport",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value) {
                    event.preventDefault();
                }
            });
        });

        $('#language').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getLanguage",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
        });

        $('#music_instrument').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getMusicInstrument",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
        });

        $('#dance').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getDance",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
        });

        $('#sing').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getSing",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
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
                    }
                    break;
                default:
                    return false;
            }
            $(this).attr('href', site);
        });
    });
</script>