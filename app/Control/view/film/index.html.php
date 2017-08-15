<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Dspbee\Bundle\Common\Bag\GetBag $get
 */
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
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
    Фильмы
    <button type="button" id="modalBtn" data-toggle="modal" data-target="#modalWindow" class="btn btn-primary btn-sm margin20">Добавить</button>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="dataTables_wrapper">
                        <form method="get">
                            <div class="form-group">
                                <label for="year">Год</label>
                                <input type="text" name="year" value="<?= $get->fetch('year') ?>" id="year" class="form-control" placeholder="Введите год фильма" />
                            </div>

                            <input type="submit" value="Найти" class="btn btn-primary" />
                        </form>
                        <br />
                        <table id="dataTable" class="table table-striped table-bordered">
                            <colgroup>
                                <col width="120px" />
                                <col width="90px" />
                                <col width="90px" />
                                <col width="auto" />
                                <col width="90px" />
                                <col width="300px" />
                            </colgroup>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Год</th>
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
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalBtn').click(function(){
            $.ajax({
                url : '<?= $request->makeUrl('film/add') ?>',
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
    var dTable = $('#dataTable').dataTable({
        "paging":   true,
        "ordering": true,
        "order": [[0, "desc"]],
        "bFilter": true,
        "aoColumns": [
            {
                "mRender": function (data, type, full) {
                    return '<a href="<?= Server::DEMO ?>/film/' + full[0] + '/" target="_blank" class="link"><em class="fa fa-external-link"></em></a> &nbsp; ' + full[0]
                }
            },
            {
                "orderable": false,
                "mRender": function (data, type, full) {
                    if ('' == full[1]) {
                        return '';
                    }
                    return '<img width="50px;" src="' + full[1] + '" />'
                }
            },
            {
                "orderable": true
            },
            {
                "orderable": false
            },
            {
                "orderable": false,
                "mRender": function (data, type, full) {
                    switch (full[4]) {
                        case 'show':
                            return '<span class="label bg-success">да</span>';
                            break;
                        case 'new':
                            return '<span class="label bg-purple">скрыт (новый)</span>';
                            break;
                        default:
                            return '<span class="label bg-yellow">скрыт</span>';
                    }
                }
            },
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    full[3] = full[3].replace('<br />', ' ');
                    var content = '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('film/edit?id=') ?>' + full[0] + '/">Подробнее</a> &nbsp;' +
                        '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить фильм `' + full[3] + '`?">Удалить</button>' +
                        '<input type="hidden" name="id" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="delete" />' +
                        '</form> &nbsp;&nbsp;';

                    return content;
                }
            }
        ],
        "info":     true,
        "processing": true,
        "serverSide": true,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 0 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 0, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 0 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        },
        "ajax": $.fn.dataTable.pipeline( {
            url: '?handler=getList&year=<?= $get->fetch('year') ?>',
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

    function dataTableCallback(){
        var info = dTable.api().page.info();
        if (info['page'] > info['pages']) {
            dTable.api().page('first');
            dTable.fnDraw();
        }
    }
</script>