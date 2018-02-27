<?php
/**
 * @var array $categoryList
 * @var array $news
 * @var array $page
 * @var $itemCount
 * @var $category
 * @var object $pagination
 */
?>
<!-- extends base.html.php -->
<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<link rel="stylesheet" href="/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

<div class="content-heading">
   Публикации
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
	                <form method="get" action="new">
		                <div class="form-group">
			                <label for="year">Поиск новости</label>
			                <input type="text" name="category" value="" id="category" class="form-control" placeholder="Введите название публикации или ID">
		                </div>
		                <input type="submit" value="Найти" class="btn btn-primary">
	                </form><br>
                    <form method="get" action="news">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select id="source" name="category" class="newsFilter chosen-select input-md form-control">
                                        <option value="">Все</option>
                                        <?php foreach ($categoryList as $name): ?>
                                            <option <?php if ($category == $name): ?> selected="selected" <?php endif ?> value="<?= $name ?>"><?= $name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="submit" class="btn btn-primary margin20" value="Поиск">
                            </div>
                        </div>
                    </form>
                    <hr style="margin-top: 11px; margin-bottom: 41px;" />
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Название</th>
                            <th>Количество просмотров</th>
                        </tr>
                        </thead>
	                    <tbody>
	                    <?php foreach ($news as $item):?>
		                    <tr>
			                    <th><?= $item['id']; ?></th>
			                    <th><?= $item['publish']; ?></th>
			                    <th><?= $item['category']; ?></th>
			                    <th><?= $item['title']; ?></th>
			                    <th><?= $item['view']; ?></th>
		                    </tr>
	                    <?php endforeach;?>
	                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $pagination?>

