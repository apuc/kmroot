<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Filmography\ItemCrew $item
 */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Редактировать <?= $item->type() ?>а</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="filmId">
                        ID фильма
                    </label>
                    <input type="text" name="filmId" id="filmId" value="<?= $item->filmId() ?>" class="form-control film_input">
                </div>
                <div class="form-group">
                    <label for="description">
                        Описание
                    </label>
                    <input type="text" name="description" id="description" value="<?= $item->description() ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="year">
                        Года
                    </label>
                    <input type="text" name="year" id="year" value="<?= $item->year() ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="episodes">
                        Эпизодов
                    </label>
                    <input type="text" name="episodes" id="episodes" value="<?= $item->episodes() ?>" class="form-control">
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
                <input type="submit" value="Сохранить" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="personId" value="<?= $item->personId() ?>" />
            <input type="hidden" name="id" value="<?= $item->id() ?>" />
            <input type="hidden" name="handler" value="editCrew" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        filmComplete();

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
