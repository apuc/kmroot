<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 03.10.2017
 * Time: 12:43
 */
?>

<!-- extends base.html.php -->
<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }

    .dataTables_wrapper table tr td {
        border: 0;
    }
</style>

<div class="content-heading">
    Выберите страницу
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <div class="dataTables_wrapper">
                            <table class="table table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Ссылка на раздел</th>
                                    <th>Действия</th>
                                </tr>
                                <?php $i=1; ?>
                                <?php foreach (\Kinomania\System\Data\Genre::RU as $key => $item): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $item ?></td>
                                        <td><a href="http://www.kinomania.ru/genres/films?genre=<?= $key ?>" target="_blank">Ссылка</a></td>
                                        <td><a href="/control/seo/genre/single?slug=<?= $key ?>" class="btn btn-info">Редактировать</a></td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

