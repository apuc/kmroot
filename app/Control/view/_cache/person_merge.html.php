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
                <h4 id="myModalLabel" class="modal-title">Добавить информацию</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="imdbId">ID персоны</label>
                    <div class="input-group m-b">
                        <input type="text" name="personId" value="" id="personId" class="form-control" placeholder="Укажите ID персоны" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Слить" id="btnAdd" class="btn btn-primary" />
            </div>
            <input type="hidden" name="toId" value="<?= $toId ?>" />
            <input type="hidden" name="handler" value="merge" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                filmId: {
                    required: true
                }
            },
            messages: {
                filmId: {
                    required: "Введите ID персоны"
                }
            }
        });
    });
</script>