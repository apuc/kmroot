<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">

<div class="content-heading">
    Список администраторов
    <a href="<?= $request->makeUrl('sys/admin/add') ?>/" class="btn btn-primary btn-sm margin20">Добавить</a>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Имя</th>
                                <th>Группа</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/vendor/cms/datatables-colvis/js/dataTables.colVis.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrap.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrapPagination.js"></script>
<script>
    <!-- include js/dataTables.js -->
</script>

<script type="text/javascript">
    var dTable = $('#dataTable').dataTable({
        "bStateSave": true,
        stateSaveCallback: function (settings, data){
            localStorage.setItem('adminStorage', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('adminStorage'));
            } catch (e) {}
        },
        "order": [[0, "desc"]],
        "paging":   true,
        "ordering": true,
        "bFilter": true,
        "aoColumns": [
            null,
            {"orderable": false},
            {"orderable": false},
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    switch (full[4]) {
                        case 'banned':
                            return '<span class="label label-danger">заблокирован</span>';
                            break;
                    }
                    return '<span class="label label-success">активен</span>';
                }

            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    if ('banned' == full[4]) {
                        return '<a class="btn btn-success btn-xs" href="<?= $request->makeUrl('sys/admin/rights?id=') ?>' + full[0] + '/">Права доступа</a> &nbsp;' +
                            '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('sys/admin/edit?id=') ?>' + full[0] + '/">Редактировать</a> &nbsp;' +
                            '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить администратора `' + full[1] + '`?">Удалить</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="delete" />' +
                            '</form> &nbsp;&nbsp;' +
                            '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-success btn-xs activeConfirm" data-title="Разблокировать администратора `' + full[1] + '`?">Разблокировать</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="unblock" />' +
                            '</form>';
                    } else {
                        return '<a class="btn btn-success btn-xs" href="<?= $request->makeUrl('sys/admin/rights?id=') ?>' + full[0] + '/">Права доступа</a> &nbsp;' +
                            '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('sys/admin/edit?id=') ?>' + full[0] + '/">Редактировать</a> &nbsp;' +
                            '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить администратора `' + full[1] + '`?">Удалить</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="delete" />' +
                            '</form> &nbsp;&nbsp;' +
                            '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-warning btn-xs activeConfirm" data-title="Заблокировать администратора `' + full[1] + '`?">Заблокировать</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="block" />' +
                            '</form>';
                    }
                }
            }
        ],
        "info":     true,
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: '?handler=getList',
            pages: 5 // number of pages to cache
        }),
        "autoWidth": false,
        oLanguage: {
            sSearch:      'Email начинается на:',
            sZeroRecords:      'Ничего не найдено',
            sInfo:      'Показано с _START_ по _END_, всего _TOTAL_',
            sLengthMenu:  '_MENU_',
            sProcessing: '<div class="ball-clip-rotate-multiple" style="margin-top: 60px;"><div></div><div></div></div>'
        }
    }).fnSetFilteringDelay(1000);

    function dataTableCallback(){
        var info = dTable.api().page.info();
        if (info['page'] > info['pages']) {
            dTable.api().page('first');
            dTable.fnDraw();
        }
    }
</script>