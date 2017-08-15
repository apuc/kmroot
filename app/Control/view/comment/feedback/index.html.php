<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Dspbee\Bundle\Common\Bag\GetBag $get
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }
</style>

<div class="content-heading">
    Отзывы
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="get" id="searchForm">
                        <div class="form-group">
                            <label for="type">Тип</label>
                            <select name="type" id="type" class="form-control">
                                <option <?php if ('hide' == $get->fetch('type', 'hide')): ?> selected="selected" <?php endif ?> value="hide">Новые</option>
                                <option <?php if ('show' == $get->fetch('type')): ?> selected="selected" <?php endif ?> value="show">Опубликованные</option>
                            </select>
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
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Дата</th>
                            <th>Пользователь</th>
                            <th>Текст</th>
                            <th></th>
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
    $('#type').change(function(){
        $('#searchForm').submit();
    });
    var dTable = $('#dataTable').dataTable({
        "bStateSave": true,
        stateSaveCallback: function (settings, data){
            localStorage.setItem('reviewStorage', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('reviewStorage'));
            } catch (e) {}
        },
        "paging":   true,
        "ordering": true,
        "order": [[0, "desc"]],
        "bFilter": false,
        "aoColumns": [
            {
                "mRender": function (data, type, full) {
                    return '<a href="/film/' + full[4] + '/reviews/" target="_blank" class="link"><em class="fa fa-external-link"></em></a> &nbsp; ' + full[0]
                }
            },
            {
                "orderable": false
            },
            {
                "orderable": false,
                "mRender": function (data, type, full) {
                    if (0 == full[2]) {
                        return full[5];
                    } else {
                        return '<a href="/user/' + full[5] + '/" target="_blank">' + full[5] + '</a>';
                    }
                }
            },
            {
                "orderable": false
            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    <?php if ('show' !== $get->fetch('type')): ?>
                    var content = '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-success btn-xs">Опубликовать</button>' +
                        '<input type="hidden" name="id" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="approve" />' +
                        '</form>';
                    <?php else: ?>
                    var content = 'Опубликовано';
                    <?php endif ?>

                    return content;
                }
            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    var content = '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить рецензию?">Удалить</button>' +
                        '<input type="hidden" name="id" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="delete" />' +
                        '</form>';

                    return content;
                }
            }
        ],
        "info":     true,
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: '?handler=getList&type=<?= $get->fetch('type', 'hide') ?>',
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


