<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var int $filmId
 * @var array $typeList
 */
?>

<style>
    .value {
        margin-left: 7px;
    }
</style>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить видео</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="type">
                        Тип
                    </label>
                    <select name="type" id="type" class="form-control">
                        <?php foreach ($typeList as $id => $name): ?>
                            <option value="<?= $id ?>"><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <a href="#" class="value" data-value="2">Трейлер</a>
                    <a href="#" class="value" data-value="1">Тизер</a>
                    <a href="#" class="value" data-value="34">Трейлер (рус.)</a>
                    <a href="#" class="value" data-value="71">Эпизод (актерский)</a>
                </div>
                <div class="form-group">
                    <label for="local">
                        Локализованый
                    </label>
                    <select name="local" id="local" class="form-control">
                        <option value="no">Нет</option>
                        <option value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="popular">
                        Популярные
                    </label>
                    <select name="popular" id="popular" class="form-control">
                        <option value="no">Нет</option>
                        <option value="yes">Да</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Добавить" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="filmId" value="<?= $filmId ?>" />
            <input type="hidden" name="handler" value="add" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.value').click(function(e){
            e = e || window.event;
            var id = $(this).attr('data-value');
            $('#type').val(id);
            $('select').trigger("chosen:updated");
            e.preventDefault();
            return true;
        });
    });
</script>
