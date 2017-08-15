<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 * @var array $castList
 * @var array $crewList
 * @var array $crewTuple
 */
?>
<!-- extends base.html.php -->

<link rel="stylesheet" href="/vendor/cms/tokenfield/bootstrap-tokenfield.min.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }
    #educationTable tr td, #theaterTable tr td {
        max-width: 260px;
    }
    .tokenfield .token .token-label {
        max-width: 300px !important;
    }
</style>

<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    tr.placeholder {

    }

    tr.placeholder:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border: 5px solid transparent;
        border-left-color: red;
        margin-top: -5px;
        left: 25px;
        border-right: none;
    }
    
</style>

<div class="content-heading">

    <?php if (!empty($item->image())): ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= $item->imageSmallSrc() ?>" width="50" style="max-height:74px;" />
        </div>
    <?php else: ?>
        <div class="pull-left" style="position: relative; top: -18px; padding-right: 10px;">
            <img src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nof.jpg' ?>" width="50" style="max-height:74px;" />
        </div>
    <?php endif; ?>
    Фильмография
    &nbsp; &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::DEMO ?>/film/<?= $item->id() ?>/people/" target="_blank" class="smaller">Демо</a>
    &nbsp;
    <a href="<?= \Kinomania\System\Config\Server::MAIN ?>/film/<?= $item->id() ?>/people/" target="_blank" class="smaller">На сайте</a>

    <small>
        <?php if (!empty($item->name_origin())): ?>
            <?= $item->name_origin() ?>
            <?php if (!empty($item->name_ru())): ?>
                /
            <?php endif ?>
        <?php endif ?>
        <?= $item->name_ru() ?>
    </small>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- include film/menu.html.php -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="modal-body">
                    <div class="pull-right">
                        <a href="#Director">Режиссер</a>
                        <a href="#Scenario" style="margin-left: 10px">Сценарист</a>
                        <a href="#Producer" style="margin-left: 10px">Продюсер</a>
                        <a href="#Operator" style="margin-left: 10px">Оператор</a>
                        <a href="#Composer" style="margin-left: 10px">Композитор</a>
                    </div>
                    <div class="dataTables_wrapper">
                        <table class="table table-striped table-bordered table-hover sortCast">
                            <colgroup>
                                <col width="55px;" />
                                <col width="350px" />
                                <col width="300px" />
                                <col width="78px" />
                                <col width="65px" />
                                <col width="auto" />
                            </colgroup>
                            <caption>
                                <h4>
                                    Актёры &nbsp;
                                    <button data-toggle="modal" data-target="#modalWindow" id="addCast" class="btn btn-xs btn-primary">Добавить</button>
                                </h4>
                            </caption>
                            <tbody>
                            <?php
                            /**
                             * @var \Kinomania\Control\Film\Filmography\ItemCast $cast
                             */
                            ?>
                            <?php foreach ($castList as $cast): ?>
                                <tr data-id="<?= $cast->id() ?>">
                                    <td>
                                        <?php if (!empty($cast->image())): ?>
                                            <img width="50px;" class="lazy" data-original="<?= $cast->imageSrc() ?>" src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nop.jpg' ?>" />
                                        <?php else: ?>
                                            <img width="50px" src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nop.jpg' ?>" />
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a href="<?= $request->makeUrl('person/edit?id=' . $cast->personId()) ?>">
                                            <?= $cast->name_ru() ?>
                                            <?php if (!empty($cast->name_ru()) && !empty($cast->name_origin())): ?>
                                                /
                                            <?php endif ?>
                                            <?php if (empty($cast->name_ru())): ?>
                                                <?= $cast->name_origin() ?>
                                            <?php else: ?>
                                                <small><?= $cast->name_origin() ?></small>
                                            <?php endif ?>
                                        </a>

                                        <br />

                                        <?= $cast->role_ru() ?>
                                        <?php if (!empty($cast->role_ru()) && !empty($cast->role_en())): ?>
                                            ,
                                        <?php endif ?>
                                        <?php if (empty($cast->role_ru())): ?>
                                            <?= $cast->role_en() ?>
                                        <?php else: ?>
                                            <small><?= $cast->role_en() ?></small>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?= $cast->note() ?>
                                    </td>
                                    <td>
                                        <?php if ('show' == $cast->status()): ?>
                                            <span class="label bg-success">опубликован</span>
                                        <?php elseif ('new' == $cast->status()): ?>
                                            <span class="label bg-purple">скрыт (новый)</span>
                                        <?php else: ?>
                                            <span class="label bg-danger">скрыт</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <div class="source-role <?= $cast->source() ?>" style="cursor: default;">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" data-id="<?= $cast->id() ?>" data-toggle="modal" data-target="#modalWindow" class="editCast btn btn-primary btn-xs">Редактировать</button>
                                        <form method="post" class="saveScrollPosition">
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить актёра `<?= $cast->name_ru() ?> <?= $cast->name_origin() ?>` из фильмографии?">Удалить</button>
                                            <input type="hidden" name="id" value="<?= $cast->id() ?>" />
                                            <input type="hidden" name="handler" value="deleteCast" />
                                            </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <br />

                    <?php foreach ($crewList as $type => $crew): ?>
                        <div class="dataTables_wrapper" id="<?= $crewTuple[$type] ?>">
                            <table class="table table-striped table-bordered table-hover sort<?= $crewTuple[$type] ?>">
                                <colgroup>
                                    <col width="55px;" />
                                    <col width="350px" />
                                    <col width="300px" />
                                    <col width="78px" />
                                    <col width="65px" />
                                    <col width="auto" />
                                </colgroup>
                                <caption>
                                    <h4>
                                        <?= $type ?> &nbsp;
                                        <button data-toggle="modal" data-target="#modalWindow" data-type="<?= $type ?>" class="btn btn-xs btn-primary addCrew">Добавить</button>
                                    </h4>
                                </caption>
                                <tbody>
                                <?php
                                /**
                                 * @var \Kinomania\Control\Film\Filmography\ItemCrew $crewItem
                                 */
                                ?>
                                <?php foreach ($crew as $crewItem): ?>
                                    <tr data-id="<?= $crewItem->id() ?>">
                                        <td>
                                            <?php if (!empty($crewItem->image())): ?>
                                                <img width="50px;" height="66" class="lazy" data-original="<?= $crewItem->imageSrc() ?>" src="//:0" />
                                            <?php else: ?>
                                                <img width="50px" height="66" src="<?= \Kinomania\System\Config\Server::STATIC[0] . '/app/img/content/nop.jpg' ?>" />
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a href="<?= $request->makeUrl('person/edit?id=' . $crewItem->personId()) ?>">
                                                <?= $crewItem->name_ru() ?>
                                                <?php if (!empty($crewItem->name_ru()) && !empty($crewItem->name_origin())): ?>
                                                    /
                                                <?php endif ?>
                                                <?php if (empty($crewItem->name_ru())): ?>
                                                    <?= $crewItem->name_origin() ?>
                                                <?php else: ?>
                                                    <small><?= $crewItem->name_origin() ?></small>
                                                <?php endif ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $crewItem->description() ?>
                                        </td>
                                        <td>
                                            <?php if ('show' == $crewItem->status()): ?>
                                                <span class="label bg-success">опубликован</span>
                                            <?php elseif ('new' == $crewItem->status()): ?>
                                                <span class="label bg-purple">скрыт (новый)</span>
                                            <?php else: ?>
                                                <span class="label bg-danger">скрыт</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="source-role <?= $crewItem->source() ?>" style="cursor: default;">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" data-id="<?= $crewItem->id() ?>" data-toggle="modal" data-target="#modalWindow" class="editCrew btn btn-primary btn-xs">Редактировать</button>
                                            <form method="post" class="saveScrollPosition">
                                                &nbsp;&nbsp;
                                                <button type="submit" class="btn btn-danger btn-xs delConfirm" data-title="Удалить <?= $type ?>а `<?= $crewItem->name_ru() ?> <?= $crewItem->name_origin() ?>` из фильмографии?">Удалить</button>
                                                <input type="hidden" name="id" value="<?= $crewItem->id() ?>" />
                                                <input type="hidden" name="handler" value="deleteCrew" />
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <br />
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery-ui/ui/core.js"></script>
<script src="/vendor/cms/_js/jquery-ui/ui/widget.js"></script>
<script src="/vendor/cms/_js/jquery-ui/ui/progressbar.js"></script>
<script src="/vendor/cms/_js/jquery-sortable/source/js/jquery-sortable-min.js"></script>

<script src="/vendor/cms/jquery-ui/ui/mouse.js"></script>
<script src="/vendor/cms/jquery-ui/ui/sortable.js"></script>
<script src="/vendor/cms/jquery-ui/ui/position.js"></script>
<script src="/vendor/cms/jquery-ui/ui/menu.js"></script>
<script src="/vendor/cms/jquery-ui/ui/autocomplete.js"></script>
<script src="/vendor/cms/chosen_v1.2.0/chosen.order.jquery.min.js"></script>

<script src="/vendor/cms/bootstrap-tagsinput/typehead.js"></script>
<script src="/vendor/cms/tokenfield/bootstrap-tokenfield.min.js"></script>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/vendor/cms/jquery/jquery.lazyload.min.js"></script>

<script>
    function personComplete()
    {
        $('.person_input').tokenfield({
            createTokensOnBlur: true,
            autocomplete: {
                source: "?handler=getPerson",
                minLength: 1
            }
        }).on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens');
            $.each(existingTokens, function(index, token) {
                if (token.value === event.attrs.value) {
                    event.preventDefault();
                }
            });
        });
    }
    $(document).ready(function(){
        
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });

        var Table = $('.sortCast').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = Table.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=castOrder',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });

        var TableDirector = $('.sortDirector').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = TableDirector.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=orderCrew',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });
        var TableScenario = $('.sortScenario').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = TableScenario.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=orderCrew',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });
        var TableProducer = $('.sortProducer').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = TableProducer.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=orderCrew',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });
        var TableOperator = $('.sortOperator').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = TableOperator.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=orderCrew',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });
        var TableComposer = $('.sortComposer').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            handle: 'tr img',
            placeholder: '<tr class="placeholder"/>',
            onDrop: function(item, container, _super){
                var data = TableComposer.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');

                _super(item);

                $.ajax({
                    url : '?handler=orderCrew',
                    type: "POST",
                    data : 'data=' + jsonString,
                    dataType: "json",
                    success:function(data) {

                    }
                });
            },
            tolerance: 6,
            distance: 10
        });

        $('#addCast').click(function(){
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('film/credits/add?filmId=' . $item->id()) ?>',
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
        $('.addCrew').click(function(){
            var type = $(this).attr('data-type');
            $('#modalWindow').html('');
            $.ajax({
                url : '<?= $request->makeUrl('film/credits/add/crew?filmId=' . $item->id()) ?>&type=' + type,
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

        $('.editCast').click(function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url : '<?= $request->makeUrl('film/credits/edit?') ?>id=' + id,
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
        $('.editCrew').click(function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url : '<?= $request->makeUrl('film/credits/edit?handler=crew&') ?>id=' + id,
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
    })
</script>