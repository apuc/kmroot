<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var int $filmId
 * @var string $type
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить <?= $type ?>а</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="personId">
                        ID персоны
                    </label>
                    <input type="text" name="personId" id="personId" value="" class="form-control person_input">
                </div>
                <div class="form-group">
                    <label for="description">
                        Описание
                    </label>
                    <input type="text" name="description" id="description" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="year">
                        Года
                    </label>
                    <input type="text" name="year" id="year" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="episodes">
                        Эпизодов
                    </label>
                    <input type="text" name="episodes" id="episodes" value="" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Добавить" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="type" value="<?= $type ?>" />
            <input type="hidden" name="filmId" value="<?= $filmId ?>" />
            <input type="hidden" name="handler" value="addCrew" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        personComplete();
        
        $('.saveScrollPosition').on("submit", function() {
            $.cookie("scroll", $(document).scrollTop(), { path: '/' });
        });
        
        $("#validateForm").validate({
            rules: {
                personId: {
                    required: true
                }
            },
            messages: {
                personId: {
                    required: "Введите ID персоны"
                }
            }
        });
    });
</script>
