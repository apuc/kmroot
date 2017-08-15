<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Admin\Group\Item $group
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Редактировать группу</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" value="<?= $group->name() ?>" id="name" class="form-control" placeholder="Название группы" />
                        </div>

                        <a href="<?= $request->makeUrl('sys/group') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" value="Сохранить" class="btn btn-primary margin20" />

                        <input type="hidden" name="id" value="<?= $group->id() ?>" />
                        <input type="hidden" name="handler" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#validateForm").validate({
            rules: {
                name: {
                    required: true,
                    remote: '?handler=checkName&id=<?= $group->id() ?>'
                }
            },
            messages: {
                name: {
                    required: "Введите название группы",
                    remote: "Группа с таким именем уже имеется"
                }
            }
        });
    });
</script>