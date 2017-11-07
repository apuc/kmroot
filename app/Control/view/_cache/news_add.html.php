<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $categoryList
 */
?>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="validateForm">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Добавить статью</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Заголовок</label>
                    <input type="text" name="title" value="" id="title" class="form-control" placeholder="Заголовок" />
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select id="category" name="category">
                        <?php foreach ($categoryList as $category): ?>
                            <option value="<?= $category ?>"><?= $category ?></option>
                        <?php endforeach; ?>
                    </select>
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
                title: {
                    required: true,
                    remote: '?handler=checkTitle'
                }
            },
            messages: {
                title: {
                    required: "Введите заголовок",
                    remote: "Такой заголовок уже есть у другой новости"
                }
            }
        });
    });
</script>