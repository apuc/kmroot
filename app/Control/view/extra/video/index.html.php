<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
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
    Типы видео
    <button type="button" id="add" data-toggle="modal" data-target="#modalWindow" class="btn btn-primary btn-sm margin20">Добавить</button>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <?php if (count($list)): ?>
                        <div class="dataTables_wrapper">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Название</th>
                                    <th></th>
                                </tr>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Film\Soundtrack\Dir $dir
                                 */
                                ?>
                                <?php foreach ($list as $id => $name): ?>
                                    <tr>
                                        <td><?= $name ?></td>
                                        <td>
                                            <a href="#" data-id="<?= $id ?>" class="btn btn-info btn-xs editType">Редактировать</a> &nbsp;
                                            <form method="post" style="display: inline-block;">
                                                <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить тип `<?= $name ?>`?">Удалить</button>
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <input type="hidden" name="handler" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add').click(function(){
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('extra/video/add') ?>',
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
                },
                timeout: 5000
            });
        });

        $('.editType').click(function(e){
            e = e || window.event;
            e.preventDefault();

            var id = $(this).attr('data-id');
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('extra/video/edit?id=') ?>' + id,
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
                },
                timeout: 5000
            });

            return false;
        });
    });
</script>


