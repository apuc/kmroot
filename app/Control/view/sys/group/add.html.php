<?php
/**
 * @var \Dspbee\Core\Request $request
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Добавить группу</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post" id="validateForm">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" value="" id="name" class="form-control" placeholder="Название группы" />
                        </div>

                        <a href="<?= $request->makeUrl('sys/group') ?>/" class="btn btn-default">Назад</a>
                        <input type="submit" value="Добавить" class="btn btn-primary margin20" />

                        <input type="hidden" name="handler" value="add" />
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
                    remote: '?handler=checkName'
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