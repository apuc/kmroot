<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $getParameter
 * @var string $from
 * @var string $to
 * @var int $adminId
 * @var int $objId
 * @var array $adminList
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

<div class="content-heading">
    Журнал
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="get" id="dateForm">
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
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select id="adminId" name="adminId" class="newsFilter chosen-select input-md form-control">
                                        <option value="">Все</option>
                                        <?php foreach ($adminList as $id => $name): ?>
                                            <option <?php if ($adminId == $id): ?> selected="selected" <?php endif ?> value="<?= $id ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="button" class="btn btn-default" value="Очистить" id="clean" style="left:-1px;position: relative;">
                                    <input type="submit" class="btn btn-primary margin20" value="Применить">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" name="objId" id="objId" value="<?= $objId ?>" placeholder="ID объекта" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">

                            </div>
                        </div>
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
                    <div class="dataTables_wrapper">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Администратор</th>
                                <th>Маршрут</th>
                                <th>Действие</th>
                                <th>Статус</th>
                                <th>Комментарий</th>
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

    $('#clean').click(function(){
        document.getElementById('from').value = '';
        document.getElementById('to').value = '';
        document.getElementById('adminId').value = '';
        $('#dateForm').submit();
    });


</script>

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
            localStorage.setItem('adminLog', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('adminLog'));
            } catch (e) {}
        },
        "order": [[0, "desc"]],
        "paging":   true,
        "ordering": true,
        "bFilter": false,
        "aoColumns": [
            null,
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    if ('AJAX' == full[8]) {
                        return full[2];
                    }
                    if (0 == full[7]) {
                        return '<a href="/control/' + full[2] + '/">' + full[2] + '</a>';
                    }
                    return '<a href="/control/' + full[2] + '?id=' + full[7] + '/">' + full[2] + '</a>';
                }
            },
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    switch (full[4]) {
                        case '1':
                            return '<span class="label label-danger">ошибка</span>';
                            break;
                    }
                    return '<span class="label label-success">ok</span>';
                }

            },
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function (data, type, full) {
                    return '<a class="btn btn-info btn-xs btn-labeled" href="<?= $request->makeUrl('sys/log/detail?id=') ?>' + full[6] + '/" target="_blank"><span class="btn-label"><i class="fa fa-external-link"></i></span>Подробнее</a> &nbsp;';
                }
            }
        ],
        "info":     true,
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: '?handler=getList<?= $getParameter ?>',
            pages: 5 // number of pages to cache
        }),
        "autoWidth": false,
        oLanguage: {
            sSearch:      'Поиск по email:',
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