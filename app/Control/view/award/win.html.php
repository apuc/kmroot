<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Award\Item $award
 * @var int $year
 * @var array $list
 * @var array $set
 * @var string $from
 * @var string $to
 */
?>

<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<style>
    small {
        font-size: 0.6em;
        color: #737373;
        top: -10px;
        left: 2px;
        position: relative;
    }
</style>

<div class="content-heading">
    <?= $award->name_ru() ?> <?= $year ?> &nbsp;
    <form method="post" style="display: inline-block; position: relative; top: -1px;">
        <input type="submit" class="btn btn-xs btn-danger delConfirm" data-title="Удалить <?= $year ?> год?" value="Удалить" />
        <input type="hidden" name="year" value="<?= $year ?>" />
        <input type="hidden" name="awardId" value="<?= $award->id() ?>" />
        <input type="hidden" name="handler" value="deleteAwardYear" />
    </form>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div id="startdate" class="form-group input-group date">
                                    <input type="text" name="from" id="from" value="<?= $from ?>" class="form-control">
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div id="enddate" class="form-group input-group date">
                                    <input type="text" name="to" id="to" value="<?= $to ?>" class="form-control">
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Сохранить" />

                        <input type="hidden" name="year" value="<?= $year ?>" />
                        <input type="hidden" name="awardId" value="<?= $award->id() ?>" />
                        <input type="hidden" name="handler" value="editDate" />
                    </form>
                    <br />
                    <br />

                    <p>
                        Указывайте ID фильмов и актёров в системе, а не их IMDB номера.
                    </p>
                    <br />
                    <div class="dataTables_wrapper">
                        <?php
                        /**
                         * @var \Kinomania\Control\Award\Nomination\Item $item
                         */
                        ?>
                        <?php foreach ($list as $item): ?>
                            <fieldset id="set_<?= $item->id() ?>">
                                <legend>
                                    <?= $item->name_ru() ?>
                                    <br />
                                    <small><?= $item->name_en() ?></small>
                                </legend>


                                <div class="row" style="margin-top: -12px; margin-bottom: -8px;">
                                    <div class="col-lg-2">
                                        <p class="lead">Победитель</p>
                                    </div>
                                </div>
                                <?php if ('person_film' == $item->type()): ?>
                                    <div class="row">
                                        <form method="post" class="saveScrollPosition">
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <input type="text" name="personId" class="form-control" value="<?php if (isset($set[$item->id()]['winner'][0])) { echo $set[$item->id()]['winner'][0]->personId(); } ?>" placeholder="Введите ID человека">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-default">Сохранить</button>
                                                    </span>
                                                </div>
                                                <?php if (isset($set[$item->id()]['winner'][0])): ?>
                                                    <a href="<?= $request->makeUrl('person/edit?id=' . $set[$item->id()]['winner'][0]->personId()) ?>" target="_blank">
                                                        <?php if (!empty($set[$item->id()]['winner'][0]->personName_ru())): ?>
                                                            <?= $set[$item->id()]['winner'][0]->personName_ru() ?>
                                                        <?php else: ?>
                                                            <?= $set[$item->id()]['winner'][0]->personName_origin() ?>
                                                        <?php endif ?>
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <input type="text" name="filmId" class="form-control" value="<?php if (isset($set[$item->id()]['winner'][0])) { echo $set[$item->id()]['winner'][0]->filmId(); } ?>" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                </div>
                                                <?php if (isset($set[$item->id()]['winner'][0])): ?>
                                                    <a href="<?= $request->makeUrl('film/edit?id=' . $set[$item->id()]['winner'][0]->filmId()) ?>" target="_blank">
                                                        <?php if (!empty($set[$item->id()]['winner'][0]->filmName_ru())): ?>
                                                            <?= $set[$item->id()]['winner'][0]->filmName_ru() ?>
                                                        <?php else: ?>
                                                            <?= $set[$item->id()]['winner'][0]->filmName_origin() ?>
                                                        <?php endif ?>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (isset($set[$item->id()]['winner'][0])): ?>
                                                    <input type="hidden" name="setId" value="<?= $set[$item->id()]['winner'][0]->id() ?>" />
                                                <?php else: ?>
                                                    <input type="hidden" name="setId" value="0" />
                                                <?php endif ?>
                                                <input type="hidden" name="nominationId" value="<?= $item->id() ?>" />
                                                <input type="hidden" name="handler" value="editWin" />
                                            </div>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <form method="post" class="saveScrollPosition">
                                                <div class="input-group">
                                                    <input type="text" name="filmId" class="form-control" value="<?php if (isset($set[$item->id()]['winner'][0])) { echo $set[$item->id()]['winner'][0]->filmId(); } ?>" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                </div>
                                                <?php if (isset($set[$item->id()]['winner'][0])): ?>
                                                    <a href="<?= $request->makeUrl('film/edit?id=' . $set[$item->id()]['winner'][0]->filmId()) ?>" target="_blank">
                                                        <?php if (!empty($set[$item->id()]['winner'][0]->filmName_ru())): ?>
                                                            <?= $set[$item->id()]['winner'][0]->filmName_ru() ?>
                                                        <?php else: ?>
                                                            <?= $set[$item->id()]['winner'][0]->filmName_origin() ?>
                                                        <?php endif ?>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (isset($set[$item->id()]['winner'][0])): ?>
                                                    <input type="hidden" name="setId" value="<?= $set[$item->id()]['winner'][0]->id() ?>" />
                                                <?php else: ?>
                                                    <input type="hidden" name="setId" value="0" />
                                                <?php endif ?>
                                                <input type="hidden" name="nominationId" value="<?= $item->id() ?>" />
                                                <input type="hidden" name="handler" value="editWin" />
                                            </form>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <br />


                                <div class="row" style="margin-bottom: -8px;">
                                    <div class="col-lg-2">
                                        <p class="lead">Номинанты</p>
                                    </div>
                                </div>
                                <?php if (isset($set[$item->id()]['nominee'])): ?>
                                    <?php if ('person_film' == $item->type()): ?>
                                        <?php
                                        /**
                                         * @var \Kinomania\Control\Award\Set\Item $nominee
                                         */
                                        ?>
                                        <?php foreach ($set[$item->id()]['nominee'] as $nominee): ?>
                                            <div class="row">
                                                <form method="post" class="saveScrollPosition">
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <input type="text" name="personId" class="form-control" value="<?= $nominee->personId() ?>" placeholder="Введите ID человека">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                        </div>
                                                        <a href="<?= $request->makeUrl('person/edit?id=' . $nominee->personId()) ?>" target="_blank">
                                                            <?php if (!empty($nominee->personName_ru())): ?>
                                                                <?= $nominee->personName_ru() ?>
                                                            <?php else: ?>
                                                                <?= $nominee->personName_origin() ?>
                                                            <?php endif ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="input-group">
                                                            <input type="text" name="filmId" class="form-control" value="<?= $nominee->filmId() ?>" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                        </div>
                                                        <a href="<?= $request->makeUrl('film/edit?id=' . $nominee->filmId()) ?>" target="_blank">
                                                            <?php if (!empty($nominee->filmName_ru())): ?>
                                                                <?= $nominee->filmName_ru() ?>
                                                            <?php else: ?>
                                                                <?= $nominee->filmName_origin() ?>
                                                            <?php endif ?>
                                                        </a>
                                                        <input type="hidden" name="setId" value="<?= $nominee->id() ?>" />
                                                        <input type="hidden" name="handler" value="editNominee" />
                                                    </div>
                                                </form>
                                                <div class="col-lg-2">
                                                    <form method="post" class="saveScrollPosition">
                                                        <button type="submit" class="btn btn-danger delConfirm" data-title="Удалить номинанта `<?= $nominee->personId() ?>`?">Удалить</button>
                                                        <input type="hidden" name="setId" value="<?= $nominee->id() ?>" />
                                                        <input type="hidden" name="handler" value="deleteNominee" />
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <br />
                                    <?php else: ?>
                                        <?php
                                        /**
                                         * @var \Kinomania\Control\Award\Set\Item $nominee
                                         */
                                        ?>
                                        <?php foreach ($set[$item->id()]['nominee'] as $nominee): ?>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <form method="post" class="saveScrollPosition">
                                                        <div class="input-group">
                                                            <input type="text" name="filmId" class="form-control" value="<?= $nominee->filmId() ?>" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                        </div>
                                                        <a href="<?= $request->makeUrl('film/edit?id=' . $nominee->filmId()) ?>" target="_blank">
                                                            <?php if (!empty($nominee->filmName_ru())): ?>
                                                                <?= $nominee->filmName_ru() ?>
                                                            <?php else: ?>
                                                                <?= $nominee->filmName_origin() ?>
                                                            <?php endif ?>
                                                        </a>
                                                        <input type="hidden" name="setId" value="<?= $nominee->id() ?>" />
                                                        <input type="hidden" name="handler" value="editNominee" />
                                                    </form>
                                                </div>
                                                <div class="col-lg-2">
                                                    <form method="post" class="saveScrollPosition">
                                                        <button type="submit" class="btn btn-danger delConfirm" data-title="Удалить номинанта `<?= $nominee->filmId() ?>`?">Удалить</button>
                                                        <input type="hidden" name="setId" value="<?= $nominee->id() ?>" />
                                                        <input type="hidden" name="handler" value="deleteNominee" />
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <br />
                                    <?php endif ?>

                                <?php endif ?>



                                <?php if ('person_film' == $item->type()): ?>
                                    <div class="row">
                                        <form method="post" class="saveScrollPosition">
                                            <div class="col-lg-5">
                                                <input type="text" name="personId" class="form-control" placeholder="Введите ID человека">
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <input type="text" name="filmId" class="form-control" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                                        </span>
                                                </div>
                                                <input type="hidden" name="nominationId" value="<?= $item->id() ?>" />
                                                <input type="hidden" name="handler" value="add" />
                                            </div>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <form method="post" class="saveScrollPosition">
                                                <div class="input-group">
                                                    <input type="text" name="filmId" class="form-control" placeholder="Введите ID фильма">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                                        </span>
                                                </div>
                                                <input type="hidden" name="nominationId" value="<?= $item->id() ?>" />
                                                <input type="hidden" name="handler" value="add" />
                                            </form>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </fieldset>
                            <br />
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#startdate').datetimepicker({
            format: "YYYY-MM-DD"
        });
        $('#enddate').datetimepicker({
            format: "YYYY-MM-DD"
        });
    });


</script>