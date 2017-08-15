<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">

<div class="content-heading">
    Список пользователей
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        <input type="submit" value="Экспорт в XML" class="btn btn-primary" />
                        <input type="hidden" name="handler" value="export" />
                    </form>
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
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Рецензии</th>
                            <th>Отзывы</th>
                            <th>Комментарии</th>
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

<script src="/vendor/cms/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/vendor/cms/datatables-colvis/js/dataTables.colVis.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrap.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrapPagination.js"></script>
<script>
    <!-- include js/dataTables.js -->
</script>

<script type="text/javascript">
    $('#dataTable').dataTable({
        "bStateSave": true,
        stateSaveCallback: function (settings, data){
            localStorage.setItem('userStorage', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('userStorage'));
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
            {
                "orderable": false

            },
            {
                "orderable": false
            },
            {
                "orderable": false
            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    switch (full[6]) {
                        case 'new':
                            return '<span class="label bg-yellow">неактивен</span>';
                            break;
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
                    var content = '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('user/edit?id=') ?>' + full[0] + '/">Редактировать</a> &nbsp;' +
                        '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить пользователя `' + full[1] + '`?">Удалить</button>' +
                        '<input type="hidden" name="id" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="delete" />' +
                        '</form> &nbsp;&nbsp;';

                    if ('banned' == full[6]) {
                        content += '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-success btn-xs activeConfirm" data-title="Разблокировать пользователя `' + full[1] + '`?">Разблокировать</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="unblock" />' +
                            '</form>';
                    } else if ('new' == full[6]) {
                        content += '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-green btn-xs activeConfirm" data-title="Активировать пользователя `' + full[1] + '`?">Активировать</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="activate" />' +
                            '</form>';
                    } else {
                        content += '<form method="post" style="display: inline-block;">' +
                            '<button type="submit" class="btn btn-warning btn-xs activeConfirm" data-title="Заблокировать пользователя `' + full[1] + '`?">Заблокировать</button>' +
                            '<input type="hidden" name="id" value="' + full[0] + '" />' +
                            '<input type="hidden" name="handler" value="block" />' +
                            '</form>';
                    }

                    return content;
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
        oLanguage: {
            sSearch: 'Поиск по ID, логин, email:',
            sZeroRecords: 'Ничего не найдено',
            sInfo: 'Показано с _START_ по _END_ из _TOTAL_',
            sLengthMenu: '_MENU_',
            sProcessing: '<div class="ball-clip-rotate-pulse" style="margin-top: 55px;"><div></div><div></div></div>'
        }
    }).fnSetFilteringDelay(1000);
</script>