<?php
/**
 * @var \Dspbee\Core\Request $request
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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_imdb">
                                    IMDB ID &nbsp;
                                    <a href="#" target="_blank" data-id="id_imdb" class="link"><em class="fa fa-external-link"></em></a>
                                </label>
                                <input type="text" name="id_imdb" id="id_imdb" value="<?= $item->id_imdb() ?>" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_kp">
                                    KP ID &nbsp;
                                    <a href="#" target="_blank" data-id="id_kp" class="link"><em class="fa fa-external-link"></em></a>
                                </label>
                                <input type="text" name="id_kp" id="id_kp" value="<?= $item->id_kp() ?>" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_kt">
                                    KT ID &nbsp;
                                    <a href="#" target="_blank" data-id="id_kt" class="link"><em class="fa fa-external-link"></em></a>
                                </label>
                                <input type="text" name="id_kt" id="id_kt" value="<?= $item->id_kt() ?>" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_rk">
                                    RK ID &nbsp;
                                    <a href="#" target="_blank" data-id="id_rk" class="link"><em class="fa fa-external-link"></em></a>
                                </label>
                                <input type="text" name="id_rk" id="id_rk" value="<?= $item->id_rk() ?>" readonly="readonly" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br />
                    <form method="post">
                        <div class="form-group">
                            <label for="type">Парсер</label>
                            <select name="type" id="type">
                                <option value="imdb">IMDB</option>
                                <option value="kt">KT</option>
                                <option value="kp">KP</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" name="id" value="" id="id" class="form-control" placeholder="" />
                        </div>

                        <input type="submit" value="Запустить" class="btn btn-primary" />

                        <input type="hidden" name="handler" value="parse" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
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
    })
</script>