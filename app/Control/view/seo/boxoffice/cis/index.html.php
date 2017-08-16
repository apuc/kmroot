<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:23
 * @var $options \Kinomania\System\Options\Options
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
    Настройка СЕО для страницы сборы в СНГ
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <div class="dataTables_wrapper">
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>
                                        <input type="text" name="title" value="<?= $options->get('seo_boxoffice_cis_title') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>
                                        <input type="text" name="description" value="<?= $options->get('seo_boxoffice_cis_description') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keywords</td>
                                    <td>
                                        <input type="text" name="keywords" value="<?= $options->get('seo_boxoffice_cis_keywords') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>H1</td>
                                    <td>
                                        <input type="text" name="h1" value="<?= $options->get('seo_boxoffice_cis_h1') ?>" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br />
                        <input type="hidden" name="handler" value="save" />
                        <input type="submit" class="btn btn-primary" value="Сохранить" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
