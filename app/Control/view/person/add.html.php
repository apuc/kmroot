<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>

<style>
    label.error, #errorText {
        position: absolute;
        top: 37px;
        left: 57px;
    }
</style>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить персону</h4>
            </div>

            <div role="tabpanel">
                <!-- Nav tabs-->
                <ul role="tablist" class="nav nav-tabs">
                    <li role="presentation" class="active">
                        <a href="#auto" aria-controls="auto" role="tab" data-toggle="tab">Парсить</a>
                    </li>
                    <li role="presentation">
                        <a href="#manual" aria-controls="manual" role="tab" data-toggle="tab">Вручную</a>
                    </li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                    <div id="auto" role="tabpanel" class="tab-pane active">
                        <div class="modal-body">
                            <div class="ball-clip-rotate-multiple" id="load" style="display:none; left:50%;margin-top: 55px;padding-bottom: 55px;"><div></div><div></div></div>
                            <div class="form-group">
                                <label for="imdbId">IMDB ID</label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        nm
                                    </span>
                                    <input type="text" name="imdbId" value="" id="imdbId" class="form-control" placeholder="IMDB ID" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="manual" role="tabpanel" class="tab-pane">
                        <div class="form-group">
                            <label for="name_ru">Имя</label>
                            <div class="input-group col-lg-12">
                                <input type="text" name="name_ru" value="" id="name_ru" class="form-control" placeholder="Имя на русском" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Добавить" id="btnAdd" class="btn btn-primary" />
            </div>
            <input type="hidden" name="handler" value="add" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                imdbId: {
                    required: true
                },
                name_ru: {
                    required: true
                }
            },
            messages: {
                imdbId: {
                    required: "Введите ID персоны"
                },
                name_ru: {
                    required: "Введите имя персоны на русском"
                }
            },
            submitHandler: function() {
                $('#load').fadeIn();
                $('.form-group').fadeOut();
                $('#btnAdd').fadeOut();
                $('#btnClose').fadeOut();

                $.ajax({
                    url : '?handler=add',
                    type: "POST",
                    data : 'imdbId=' + $('#imdbId').val() + '&name_ru=' + $('#name_ru').val() + '&year=' + $('#year').val(),
                    dataType: "json",
                    success:function(data) {
                        setTimeout(function(){
                            if ('' != data.error) {
                                $('#modalWindow').modal('toggle');
                                $('#load').fadeOut();
                                $('.form-group').fadeIn();
                                $('#btnAdd').fadeIn();
                                $('#btnClose').fadeIn();
                                switch (data.error) {
                                    case 1:
                                        $["notify"]('Такой IMDB ID уже зарегистрирован', 'danger');
                                        break;
                                    case 2:
                                        $["notify"]('Ошибка при парсинге, проверьте логи парсера', 'danger');
                                        break;
                                    default:
                                        $["notify"]('Ошибка при парсинге', 'danger');
                                }
                            } else {
                                document.location = '/control/person/edit?id=' + data.id;
                            }
                        }, 500);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        setTimeout(function(){
                            $.cookie('__alert__', 'Ошибка|red', { expires: 1, path: '/' });
                            document.location.reload();
                        }, 500);
                    },
                    timeout: 30000
                });
            }
        });
    });
</script>