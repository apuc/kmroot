<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 * @var string $parserType
 * @var \Kinomania\Control\Film\Parse\Item $source
 * @var \Kinomania\Control\Film\Parse\Item $parsed
 */
?>
<!-- extends base.html.php -->

<style>
    .wd {
        width: 200px !important;
    }
</style>
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">

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
    Парсинг

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
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <colgroup>
                                    <col width="50px" />
                                    <col width="150px" />
                                    <col width="auto" />
                                    <col width="auto" />
                                </colgroup>
                                <tr>
                                    <th>Заменить текущее</th>
                                    <th>Тип</th>
                                    <th>Текущее</th>
                                    <th>Парсер</th>
                                </tr>

                                <?php if ('kt' != $parserType): ?>
                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="image" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Изображение
                                        </td>
                                        <td>
                                            <img width="200px" src="<?= $source->image() ?>" />
                                        </td>
                                        <td>
                                            <img width="200px" src="<?= $parsed->image() ?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="year" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Год
                                        </td>
                                        <td>
                                            <?= $source->year() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->year() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="name_origin" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Название ориг.
                                        </td>
                                        <td>
                                            <?= $source->name_origin() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->name_origin() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="name_ru" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Название рус.
                                        </td>
                                        <td>
                                            <?= $source->name_ru() ?>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="type" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Тип
                                        </td>
                                        <td>
                                            <?= $source->type() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->type() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="country" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Страна
                                        </td>
                                        <td>
                                            <?= implode('<br />', $source->country()) ?>
                                        </td>
                                        <td>
                                            <?= implode('<br />', $parsed->country()) ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="genre" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Жанр
                                        </td>
                                        <td>
                                            <?= implode('<br />', $source->genre()) ?>
                                        </td>
                                        <td>
                                            <?= implode('<br />', $parsed->genre()) ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="runtime" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Продолжительность
                                        </td>
                                        <td>
                                            <?= $source->runtime() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->runtime() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="imdb" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Рейтинг
                                        </td>
                                        <td>
                                            <?= $source->imdb() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->imdb() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="imdb_count" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Рейтинг, кол-во голосов
                                        </td>
                                        <td>
                                            <?= $source->imdb_count() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->imdb_count() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="budget" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Бюджет
                                        </td>
                                        <td>
                                            <?= $source->budget() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->budget() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="premiere_world" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Премьера мир
                                        </td>
                                        <td>
                                            <?= $source->premiere_world() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->premiere_world() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="premiere_usa" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Премьера США
                                        </td>
                                        <td>
                                            <?= $source->premiere_usa() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->premiere_usa() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="premiere_ru" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Премьера Россия
                                        </td>
                                        <td>
                                            <?= $source->premiere_ru() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->premiere_ru() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="limit_us" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Американский рейтинг
                                        </td>
                                        <td>
                                            <?= $source->limit_us() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->limit_us() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="series_count" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Эпизодов
                                        </td>
                                        <td>
                                            <?= $source->series_count() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->series_count() ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <input type="checkbox" name="year_finish" value="on">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            Год финиш
                                        </td>
                                        <td>
                                            <?= $source->year_finish() ?>
                                        </td>
                                        <td>
                                            <?= $parsed->year_finish() ?>
                                        </td>
                                    </tr>
                                <?php endif ?>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="cast" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Актёры [<?= count($parsed->cast()) ?>]
                                    </td>
                                    <td>
                                        <?php foreach ($source->cast() as $id => $name): ?>
                                            <?php if (!isset($parsed->cast()[$id])): ?>
                                                <?= $name ?> <br />
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td>
                                        <?php foreach ($parsed->cast() as $id => $name): ?>
                                            <?php if (!isset($source->cast()[$id])): ?>
                                                <label class="checkbox-inline c-checkbox">
                                                    <input type="checkbox" name="castList[]" value="<?= $id ?>">
                                                    <span class="fa fa-check"></span>
                                                </label>
                                                <?= $name[0] ?> <br />
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </td>
                                </tr>

                                <?php foreach ($source->crew() as $type => $crew): ?>
                                    <tr>
                                        <td>
                                            <label class="checkbox-inline c-checkbox">
                                                <?php if ('Режиссер' == $type): ?>
                                                    <input type="checkbox" name="crew_director" value="on">
                                                <?php elseif ('Сценарист' == $type): ?>
                                                    <input type="checkbox" name="crew_script" value="on">
                                                <?php elseif ('Продюсер' == $type): ?>
                                                    <input type="checkbox" name="crew_producer" value="on">
                                                <?php elseif ('Оператор' == $type): ?>
                                                    <input type="checkbox" name="crew_operator" value="on">
                                                <?php elseif ('Композитор' == $type): ?>
                                                    <input type="checkbox" name="crew_composer" value="on">
                                                <?php endif ?>
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <?= $type ?> [<?= count($parsed->crew()[$type]) ?>]
                                        </td>
                                        <td>
                                            <?php foreach ($crew as $id => $name): ?>
                                                <?php if (!isset($parsed->crew()[$type][$id])): ?>
                                                    <?= $name ?> <br />
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <?php foreach ($parsed->crew()[$type] as $id => $name): ?>
                                                <?php if (!isset($source->crew()[$type][$id])): ?>
                                                    <label class="checkbox-inline c-checkbox">
                                                        <input type="checkbox" name="crewList[]" value="<?= $id ?>">
                                                        <span class="fa fa-check"></span>
                                                    </label>
                                                    <?= $name[0] ?> <br />
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <br />
                        <input type="hidden" name="handler" value="edit" />
                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="parserType" value="<?= $parserType ?>" />
                        <input type="hidden" name="data" value="<?= base64_encode(gzdeflate(serialize($parsed))); ?>" />
                        <input type="submit" class="btn btn-primary" value="Сохранить" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>