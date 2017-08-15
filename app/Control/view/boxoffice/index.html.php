<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Dspbee\Bundle\Common\Bag\GetBag $get
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">

<div class="content-heading">
    Сборы, бокс-офис
    <button type="button" id="modalBtn" data-toggle="modal" data-target="#modalWindow" class="btn btn-primary btn-sm margin20">Добавить</button>
    &nbsp; &nbsp;
    <a href="http://www.kinometro.ru/box/show/region/ruonly//" class="smaller" target="_blank">Россия</a>
    &nbsp;
    <a href="http://www.kinometro.ru/box/" class="smaller" target="_blank">СНГ</a>
    &nbsp;
    <a href="http://www.boxofficemojo.com/weekend//" class="smaller" target="_blank">США</a>
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
                                <option value="">Все</option>
                                <option <?php if ($get->fetch('type') == 'russia'): ?> selected="selected" <?php endif ?> value="russia">Россия</option>
                                <option <?php if ($get->fetch('type') == 'cis'): ?> selected="selected" <?php endif ?> value="cis">СНГ</option>
                                <option <?php if ($get->fetch('type') == 'usa'): ?> selected="selected" <?php endif ?> value="usa">США</option>
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
                    <div class="dataTables_wrapper">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Дата начала</th>
                                    <th>Дата окончания</th>
                                    <th>Тип</th>
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

<script src="/vendor/cms/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/vendor/cms/datatables-colvis/js/dataTables.colVis.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrap.js"></script>
<script src="/vendor/cms/datatable-bootstrap/js/dataTables.bootstrapPagination.js"></script>
<script>
    <!-- include js/dataTables.js -->
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalBtn').click(function(){
            $.ajax({
                url : '<?= $request->makeUrl('boxoffice/add') ?>',
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

<script type="text/javascript">
    $(document).ready(function(){        
        /**
         * Delete referrer.
         */
        var meta = document.createElement('meta');
        meta.name = "referrer";
        meta.content = "no-referrer";
        document.getElementsByTagName('head')[0].appendChild(meta);
    });

    $('#type').change(function(){
        $('#searchForm').submit();
    });
    var dTable = $('#dataTable').dataTable({
        "bStateSave": true,
        stateSaveCallback: function (settings, data){
            localStorage.setItem('boxofficeStorage', JSON.stringify(data));
        },
        stateLoadCallback: function (){
            try {
                return JSON.parse(localStorage.getItem('boxofficeStorage'));
            } catch (e) {}
        },
        "paging":   true,
        "ordering": true,
        "order": [[0, "desc"]],
        "bFilter": false,
        "aoColumns": [
            null,
            {"orderable": false},
            {"orderable": false},
            {
                "orderable": false,
                "mRender": function(data, type, full) {
                    var content = '<a class="btn btn-info btn-xs" href="<?= $request->makeUrl('boxoffice/edit?id=') ?>' + full[0] + '/">Редактировать</a> &nbsp;' +
                        '<form method="post" style="display: inline-block;">' +
                        '<button type="submit" class="btn btn-danger btn-xs activeConfirm" data-title="Удалить викенд `' + full[1] + '`?">Удалить</button>' +
                        '<input type="hidden" name="date_from" value="' + full[0] + '" />' +
                        '<input type="hidden" name="handler" value="delete" />' +
                        '</form> &nbsp;&nbsp;';

                    return content;
                }
            }
        ],
        "info":     true,
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: '?handler=getList&type=<?= $get->fetch('type') ?>',
            pages: 5 // number of pages to cache
        }),
        "autoWidth": false,
        oLanguage: {
            sSearch:      '',
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