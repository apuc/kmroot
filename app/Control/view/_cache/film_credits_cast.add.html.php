<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var int $filmId
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить актёра</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="personId">
                        ID актёра
                    </label>
                    <input type="text" name="personId" id="personId" value="" class="form-control person_input">
                </div>
                <div class="form-group">
                    <label for="role_ru">
                        Русское название роли
                    </label>
                    <input type="text" name="role_ru" id="role_ru" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role_en">
                        Английское название роли
                    </label>
                    <input type="text" name="role_en" id="role_en" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="voice">
                        Озвучка
                    </label>
                    <select name="voice" id="voice" class="form-control">
                        <option value="no">Нет</option>
                        <option value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="uncredited">
                        Не указан в титрах
                    </label>
                    <select name="uncredited" id="uncredited" class="form-control">
                        <option value="no">Нет</option>
                        <option value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="self">
                        Играет сам себя
                    </label>
                    <select name="self" id="self" class="form-control">
                        <option value="no">Нет</option>
                        <option value="yes">Да</option>
                    </select>
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
                <div class="form-group">
                    <label for="note">
                        Примечание
                    </label>
                    <input type="text" name="note" id="note" value="" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Добавить" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="filmId" value="<?= $filmId ?>" />
            <input type="hidden" name="handler" value="addCast" />
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
