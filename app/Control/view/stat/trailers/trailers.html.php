<?php
/**
 * @var array $trailers
 * @var array $page
 * @var $itemCount
 * @var object $pagination
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Статистика просмотров трейлеров</div>

<div class="row">
	<p>
		<form method="get" action="trailer">
			<div class="form-group">
				<label for="year">Поиск трейлера</label>
				<input type="text" name="film" value="" id="film" class="form-control" placeholder="Введите название фильма или ID">
			</div>
			<input type="submit" value="Найти" class="btn btn-primary">
		</form>
	</p>
	
	<div class="col-lg-10 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-wrapper">
				<div class="panel-body">
					<table id="dataTable" class="table table-striped table-bordered">
						<thead>
						<tr>
							<th>ID</th>
							<th>Название</th>
							<th>Дата добавления</th>
							<th>Количество просмотров</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($trailers as $item):?>
							<tr>
								<th><?= $item['filmId']; ?></th>
								<th><?= $item['name_ru']; ?></th>
								<th><?= $item['date']; ?></th>
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
