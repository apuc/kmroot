<?php
/**
 * @var \Kinomania\Control\Check\Check $check
 * @var string $mysqlInfo
 * @var string $staticServer
 */
?>

<!-- extends base.html.php -->

<style>
    .form-horizontal .control-label {
        padding-top: 0 !important;
    }

   footer {
        position: fixed !important;
        bottom: 0 !important;
       z-index: 999 !important;
    }
</style>

<div class="content-heading">
    Проверка системы
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="panel-bottom">
                    <form method="post" class="form-horizontal">
                        <input type="submit" value="Сбросить opcache" class="btn btn-warning" />
                        <input type="hidden" name="handler" value="resetOpCache" />
                    </form>
                        <br />
                    <form method="post" class="form-horizontal">
                        <input type="submit" value="Сбросить кеш шаблонов" class="btn btn-warning" />
                        <input type="hidden" name="handler" value="resetTemplate" />
                    </form>
                    </div>
                    <br />
                    <br  />
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Сервер</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ОС</label>
                                <div class="col-sm-10">
                                    <?= PHP_OS ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Время</label>
                                <div class="col-sm-10">
                                    <?= date(DATE_ATOM) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Статика</label>
                                <div class="col-sm-10">
                                    <?= $staticServer ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>PHP</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Версия</label>
                                <div class="col-sm-10">
                                    <?= phpversion() ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">post_max_size</label>
                                <div class="col-sm-10">
                                    <?= ini_get('post_max_size') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">upload_max_filesize</label>
                                <div class="col-sm-10">
                                    <?= ini_get('upload_max_filesize') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">max_file_uploads</label>
                                <div class="col-sm-10">
                                    <?= ini_get('max_file_uploads') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">max_input_vars</label>
                                <div class="col-sm-10">
                                    <?= ini_get('max_input_vars') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">allow_url_fopen</label>
                                <div class="col-sm-10">
                                    <?= ini_get('allow_url_fopen') ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>PHP модули</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">mysqli</label>
                                <div class="col-sm-10">
                                    <?php if ($check->php()->mysql()): ?>
                                        <span class="label bg-success">установлен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отсутствует</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">xml</label>
                                <div class="col-sm-10">
                                    <?php if ($check->php()->xml()): ?>
                                        <span class="label bg-success">установлен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отсутствует</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">mbstring</label>
                                <div class="col-sm-10">
                                    <?php if ($check->php()->mbstring()): ?>
                                        <span class="label bg-success">установлен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отсутствует</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">curl</label>
                                <div class="col-sm-10">
                                    <?php if ($check->php()->curl()): ?>
                                        <span class="label bg-success">установлен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отсутствует</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">gd</label>
                                <div class="col-sm-10">
                                    <?php if ($check->php()->gd()): ?>
                                        <span class="label bg-success">установлен</span>
                                    <?php else: ?>
                                        <span class="label bg-danger">отсутствует</span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>MySQL</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Версия</label>
                                <div class="col-sm-10">
                                    <?= $mysqlInfo ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Файловая система</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Control/view/_cache</label>
                                <div class="col-sm-10">
                                    <?php $rights = $check->pathRights('app/Control/view/_cache') ?>
                                    <?php if (empty($rights)): ?>
                                        <span class="label bg-danger">путь не существует</span>
                                    <?php else: ?>
                                        <?= $rights ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Original/view/_cache</label>
                                <div class="col-sm-10">
                                    <?php $rights = $check->pathRights('app/Original/view/_cache') ?>
                                    <?php if (empty($rights)): ?>
                                        <span class="label bg-danger">путь не существует</span>
                                    <?php else: ?>
                                        <?= $rights ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>