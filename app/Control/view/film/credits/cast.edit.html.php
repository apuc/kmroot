<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Filmography\ItemCast $item
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Редактировать актёра</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="personId">
                        ID актёра
                    </label>
                    <input type="text" name="personId" id="personId" value="<?= $item->personId() ?>" class="form-control person_input">
                </div>
                <div class="form-group">
                    <label for="role_ru">
                        Русское название роли
                    </label>
                    <input type="text" name="role_ru" id="role_ru" value="<?= $item->role_ru() ?>"" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role_en">
                        Английское название роли
                    </label>
                    <input type="text" name="role_en" id="role_en" value="<?= $item->role_en() ?>"" class="form-control">
                </div>
                <div class="form-group">
                    <label for="voice">
                        Озвучка
                    </label>
                    <select name="voice" id="voice" class="form-control">
                        <option value="no">Нет</option>
                        <option <?php if ('yes' == $item->voice()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="uncredited">
                        Не указан в титрах
                    </label>
                    <select name="uncredited" id="uncredited" class="form-control">
                        <option value="no">Нет</option>
                        <option <?php if ('yes' == $item->uncredited()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="self">
                        Играет сам себя
                    </label>
                    <select name="self" id="self" class="form-control">
                        <option value="no">Нет</option>
                        <option <?php if ('yes' == $item->self()): ?> selected="selected" <?php endif ?> value="yes">Да</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">
                        Года
                    </label>
                    <input type="text" name="year" id="year" value="<?= $item->year() ?>"" class="form-control">
                </div>
                <div class="form-group">
                    <label for="episodes">
                        Эпизодов
                    </label>
                    <input type="text" name="episodes" id="episodes" value="<?= $item->episodes() ?>"" class="form-control">
                </div>
                <div class="form-group">
                    <label for="note">
                        Примечание
                    </label>
                    <input type="text" name="note" id="note" value="<?= $item->note() ?>"" class="form-control">
                </div>
                <div class="form-group">
                    <label for="note">
                        Источник
                    </label>
                    <div class="source-role <?= $item->source() ?>">
                        <input type="hidden" name="source" id="source" value="<?= $item->source() ?>" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Сохранить" class="btn btn-primary" />
            </div>

            <input type="hidden" name="id" value="<?= $item->id() ?>" />
            <input type="hidden" name="handler" value="editCast" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){        
        personComplete();
        
        var index = 0;
        var list = ['manual', 'kinoteatr', 'imdb', 'movie_credits', 'profile'];
        $(document).on('click', '.source-role', function(){
            var source = $(this).attr('class').split(' ');
            source = source[source.length - 1];
            index = list.indexOf(source);
            if (-1 == index) {
                index = 0;
            }
            $(this).removeClass(list[index]);
            index += 1;
            if (4 < index) {
                index = 0;
            }
            $(this).addClass(list[index]);
            $('#source').val(list[index]);
        });

        
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