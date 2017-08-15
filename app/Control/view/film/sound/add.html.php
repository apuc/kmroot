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
                <h4 id="myModalLabel" class="modal-title">Добавить коллекцию</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">
                        Название
                    </label>
                    <input type="text" name="name" id="name" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="year">
                        Год выпуска
                    </label>
                    <input type="text" name="year" id="year" value="" class="form-control">
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
        $('.saveScrollPosition').on("submit", function() {
            $.cookie("scroll", $(document).scrollTop(), { path: '/' });
        });

        $("#validateForm").validate({
            rules: {
                name: {
                    required: true
                },
                year: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Введите название"
                },
                year: {
                    required: "Введите год"
                }
            }
        });
    });
</script>
