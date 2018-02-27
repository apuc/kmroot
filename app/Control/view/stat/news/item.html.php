<?php
/**
 * @var array $new
 */
?>
<!-- extends base.html.php -->

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
						<?php if($new):?>
							<?php foreach ($new as $item):?>
								<tr>
									<th><?= $item['id']; ?></th>
									<th><?= $item['publish']; ?></th>
									<th><?= $item['category']; ?></th>
									<th><?= $item['title']; ?></th>
									<th><?= $item['view']; ?></th>
								</tr>
							<?php endforeach;?>
						<?php else:?>
							По Вашему запросу ничего не найдено!
						<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

