<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Soundtrack\Track $item
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Редактировать саундтрек</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="author">
                        Автор
                    </label>
                    <input type="text" name="author" id="author" value="<?= $item->author() ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">
                        Название
                    </label>
                    <input type="text" name="name" id="name" value="<?= $item->name() ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="time">
                        Продолжительность
                    </label>
                    <input type="text" name="time" id="time" value="<?= $item->time() ?>" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Сохранить" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="id" value="<?= $item->id() ?>" />
            <input type="hidden" name="handler" value="edit" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.saveScrollPosition').on("submit", function() {
            $.cookie("scroll", $(document).scrollTop(), { path: '/' });
        });
    });
</script>
