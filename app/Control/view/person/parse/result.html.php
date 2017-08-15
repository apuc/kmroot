<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $parserType
 * @var \Kinomania\Control\Person\Item $item
 * @var \Kinomania\Control\Person\Parse\Item $source
 * @var \Kinomania\Control\Person\Parse\Item $parsed
 * @var array $list
 */
?>
<!-- extends base.html.php -->

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
                                        <img src="<?= $source->image() ?>" />
                                    </td>
                                    <td>
                                        <img src="<?= $parsed->image() ?>" />
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
                                            <input type="checkbox" name="sex" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Пол
                                    </td>
                                    <td>
                                        <?= $source->sex() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->sex() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="birthday" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Дата рождения
                                    </td>
                                    <td>
                                        <?= $source->birthday() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->birthday() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="death" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Дата смерти
                                    </td>
                                    <td>
                                        <?= $source->death() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->death() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="birthplace_en" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Место рождения ориг.
                                    </td>
                                    <td>
                                        <?= $source->birthplace_en() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->birthplace_en() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="birthplace_ru" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Место рождения рус.
                                    </td>
                                    <td>
                                        <?= $source->birthplace_ru() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->birthplace_ru() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="height" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Рост
                                    </td>
                                    <td>
                                        <?= $source->height() ?>
                                    </td>
                                    <td>
                                        <?= $parsed->height() ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="checkbox-inline c-checkbox">
                                            <input type="checkbox" name="cast" value="on">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </td>
                                    <td>
                                        Актёр [<?= count($parsed->cast()) ?>]
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
                                                <?php if (empty($name[0])): ?>
                                                    <?= $name[8] ?? '' ?> <br />
                                                <?php else: ?>
                                                    <?= $name[0] ?> <br />
                                                <?php endif ?>
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
                                                    <?php if (empty($name[0])): ?>
                                                        <?= $name[8] ?? '' ?> <br />
                                                    <?php else: ?>
                                                        <?= $name[0] ?> <br />
                                                    <?php endif ?>
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