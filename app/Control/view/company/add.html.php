<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить компанию</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" name="name" value="" id="name" class="form-control" placeholder="Название" />
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


<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                name: {
                    required: true,
                    remote: '?handler=checkName'
                }
            },
            messages: {
                name: {
                    required: "Введите название",
                    remote: "Такое название уже имеется"
                }
            }
        });
    });
</script>