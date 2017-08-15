<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Design\Item $item
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">
    Редактировать редизайн &nbsp; <a href="<?= $request->makeUrl('extra/design') ?>/" class="btn btn-default">Назад</a>
</div>


<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="status">
                                Статус
                            </label>
                            <select name="status" id="status" class="chosen-select form-control">
                                <option <?php if ('hide' == $item->status()): ?> selected="selected" <?php endif; ?> value="hide">Отключен</option>
                                <option <?php if ('show' == $item->status()): ?> selected="selected" <?php endif; ?> value="show">Активен</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Название
                            </label>
                            <input type="text" name="name" id="name" value="<?= $item->name() ?>" class="form-control">
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="pre_roll">
                                Полный путь к mp4 преролла
                            </label>
                            <textarea rows="2" name="pre_roll" id="pre_roll" class="form-control note-editor"><?= $item->pre_roll() ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pre_roll_link">
                                Ссылка преролла
                            </label>
                            <textarea rows="2" name="pre_roll_link" id="pre_roll_link" class="form-control note-editor"><?= $item->pre_roll_link() ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="path_css">
                                Путь к css
                            </label>
                            <textarea rows="2" name="path_css" id="path_css" class="form-control note-editor"><?= $item->path_css() ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="includes">
                                Инклуды
                            </label>
                            <textarea rows="5" name="includes" id="includes" class="form-control note-editor"><?= $item->includes() ?></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="html_header">
                                Шапка
                            </label>
                            <textarea rows="8" name="html_header" id="html_header" class="form-control note-editor"><?= $item->html_header() ?></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="center_banner">
                                Центарльный
                            </label>
                            <textarea rows="8" name="center_banner" id="center_banner" class="form-control note-editor"><?= $item->center_banner() ?></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="right_banner">
                                Правый верхний
                            </label>
                            <textarea rows="8" name="right_banner" id="right_banner" class="form-control note-editor"><?= $item->right_banner() ?></textarea>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="html_footer">
                                Правый нижний
                            </label>
                            <textarea rows="8" name="html_footer" id="html_footer" class="form-control note-editor"><?= $item->html_footer() ?></textarea>
                        </div>
                        <br />
                        
                        <a href="<?= $request->makeUrl('extra/design') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" class="btn btn-primary margin20" value="Сохранить" />

                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Введите название"
                }
            }
        });
    });
</script>
