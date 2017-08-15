<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $getParameter
 * @var string $from
 * @var string $to
 * @var array $categoryList
 * @var string $category
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

<div class="content-heading">
    Статьи
    <button type="button" id="modalBtn" data-toggle="modal" data-target="#modalWindow" class="btn btn-primary btn-sm margin20">Добавить</button>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="get" id="filterForm">
                        <div class="row">
                            <div class="col-lg-3">
                                <div id="startdate" class="form-group input-group date">
                                    <input type="text" name="from" id="from" value="<?= $from ?>" class="form-control" placeholder="С даты" />
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div id="enddate" class="form-group input-group date">
                                    <input type="text" name="to" id="to" value="<?= $to ?>" class="form-control" placeholder="По дату" />
                                     <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                     </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select id="source" name="category" class="newsFilter chosen-select input-md form-control">
                                        <option value="">Все</option>
                                        <?php foreach ($categoryList as $name): ?>
                                            <option <?php if ($category == $name): ?> selected="selected" <?php endif ?> value="<?= $name ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="button" class="btn btn-default" value="Очистить" id="clean" style="left:-1px;position: relative;">
                                <input type="submit" class="btn btn-primary margin20" value="Применить">
                            </div>
                        </div>
                    </form>
                    <hr style="margin-top: 11px; margin-bottom: 41px;" />
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Название</th>
                            <th>Вывод</th>
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

<script src="/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script src="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
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
            document.getElementById('source').value = '';
            $('#filterForm').submit();
        });

        $('#modalBtn').click(function(){
            $.ajax({
                url : '<?= $request->makeUrl('news/add') ?>',
                type: "GET",
                success:function(data) {
                    $('#modalWindow').html(data).modal({});
                    $(':file').filestyle();
                    (function(window, document, $, undefined){
                        $(function(){
                            $('select').chosen({disable_search_threshold: 10});
                        });
                    })(window, document, window.jQuery);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error: " + textStatus + ' ' + errorThrown);
                }
            });
        });
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
    $('#dataTable').dataTable({
        "bStateSave": true,
        stateSaveCallback: function (settings, data){
            localStorage.setItem('newsStorage', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('newsStorage'));
            } catch (e) {}
        },
        "order": [[0, "desc"]],
        "paging":   true,
        "ordering": true,
        "bFilter": true,
        "aoColumns": [
            {
                "mRender": function (data, type, full) {
                    var news = ['Новости кино', 'Зарубежные сериалы', 'Российские сериалы', 'Арткиномания', 'Фестивали и премии'];
                    if (-1 != news.indexOf(full[2])) {
                        return '<a href="<?= \Kinomania\System\Config\Server::DEMO ?>/news/' + full[0] + '/" target="_blank" class="link"><em class="fa fa-external-link"></em></a> &nbsp; ' + full[0]
                    } else {
                        return '<a href="<?= \Kinomania\System\Config\Server::DEMO ?>/article/' + full[0] + '/" target="_blank" class="link"><em class="fa fa-external-link"></em></a> &nbsp; ' + full[0]
                    }
                }
            },
            {"orderable": false},
            {"orderable": false},
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    switch (full[4]) {
                        case 'show':
                            return '<span class="label label-success">да</span>';
                            break;
                    }
                    return '<span class="label label-danger">скрыт</span>';
                }

            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    return '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('news/edit?id=') ?>' + full[0] + '/">Редактировать</a> &nbsp;' +
                        '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить новость `' + full[3] + '`?">Удалить</button>' +
                        '<input type="hidden" name="id" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="delete" />' +
                        '</form>';
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
            sSearch:      'ID или название:',
            sZeroRecords:      'Ничего не найдено',
            sInfo:      'Показано с _START_ по _END_, всего _TOTAL_',
            sLengthMenu:  '_MENU_',
            sProcessing: '<div class="ball-clip-rotate-multiple" style="margin-top: 60px;"><div></div><div></div></div>'
        }
    }).fnSetFilteringDelay(1000);

    $('.newsFilter ').change(function(){
        $('#filterForm').submit();
    })
</script>