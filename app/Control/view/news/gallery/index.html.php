<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\News\Item $item
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
<link rel="stylesheet" href="/vendor/cms/cropper/dist/cropper.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }

    img {
        max-width: 400px;
    }
    label a {
        font-weight: normal;
    }
</style>

<div class="content-heading">
    Галереи статьи `<?= $item->title() ?>`
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/<?= $item->link() ?>/<?= $item->id() ?>/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/<?= $item->link() ?>/<?= $item->id() ?>/" target="_blank" class="smaller">На сайте</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- include news/menu.html.php -->
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
                <div class="panel-body">
                    <form method="post">
                       <button class="btn btn-primary">Добавить</button>
                        <input type="hidden" name="id" value="<?= $item->id() ?>" />
                        <input type="hidden" name="handler" value="add" />
                    </form>
                    <br />
                    <?php if (count($list)): ?>
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $gallery): ?>
                                        <tr>
                                            <td>
                                                Галерея #<?= $gallery['id'] ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($gallery['image'])): ?>
                                                    <img src="<?= $gallery['image'] ?>" style="max-width: 320px" />
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <form method="post" class="saveScrollPosition">
                                                    <div class="input-group">
                                                        <input type="text" name="trailerId" class="form-control" value="<?= $gallery['trailerId'] ?>" placeholder="ID трейлера">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-default">Сохранить</button>
                                                        </span>
                                                    </div>
                                                    <br />
                                                    <input type="hidden" name="id" value="<?= $gallery['id'] ?>" />
                                                    <input type="hidden" name="handler" value="trailer" />
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-xs" href="<?= $request->makeUrl('/news/gallery/content') ?>?id=<?= $gallery['id'] ?>&newsId=<?= $item->id() ?>/">Редактировать</a> &nbsp;
                                                <form method="post" style="display: inline-block;">
                                                    <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить галерею `<?= $gallery['id'] ?>`?">Удалить</button>
                                                    <input type="hidden" name="id" value="<?= $gallery['id'] ?>">
                                                    <input type="hidden" name="newsId" value="<?= $item->id() ?>">
                                                    <input type="hidden" name="handler" value="delete">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

   