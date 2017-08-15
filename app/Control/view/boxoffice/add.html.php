<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<style>
    label.error {
        position: absolute;
        top: 35px;
    }
</style>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить викенд</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select name="type" id="type" class="form-control">
                        <option value="russia">Россия</option>
                        <option value="usa">США</option>
                        <option value="cis">СНГ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" value="http://www.kinometro.ru/box/show/region/ruonly/" id="url" class="form-control" placeholder="URL для парсинга" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Добавить" class="btn btn-primary" />
            </div>
            <input type="hidden" name="handler" value="add" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#type', function() {
            var type = $(this).val();
            console.log(type);
            switch (type) {
                case 'russia':
                    $('#url').val('http://www.kinometro.ru/box/show/region/ruonly/');
                    break;
                case 'cis':
                    $('#url').val('http://www.kinometro.ru/box');
                    break;
                default:
                    $('#url').val('');
            }
        });

        $("#validateForm").validate({
            rules: {
                url: {
                    required: true
                }
            },
            messages: {
                url: {
                    required: "Введите URL для парсинга"
                }
            }
        });
    });
</script>