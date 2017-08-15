<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Frame\Item $item
 * @var array $personList
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Связанные персоны</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <select name="personList[]" multiple class="chosen-select form-control">
                        <?php foreach ($personList as $id => $name): ?>
                            <option <?php if (isset($item->personList()[$id])): ?> selected="selected" <?php endif ?> value="<?= $id ?>"><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Сохранить изменения" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="id" value="<?= $item->id() ?>" />
            <input type="hidden" name="handler" value="person" />
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