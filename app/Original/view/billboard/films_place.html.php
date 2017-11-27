<?php
/**
 * @var $id integer
 * @var $cityId integer
 * @var $img
 * @var $film array
 * @var $dataFrom array
 * @var $curDate array
 */
?>
<strong class="film__name">
	<?= $film['Name'] ?>
</strong>
<strong class="film__date">
	Даты:
</strong>
<div class="film__dates">
	<?php foreach ($dataFrom as $key => $date):?>
		<span id="film_sessions" class="film-session" data-date="<?= $date?>" data-id="<?= $film['ObjectID']?>"><a href="#"> <?= $date?></a></span>
	<?php endforeach;?>
</div>
<!--<span class="cinemas"></span>-->
<div id="block" class="film-block">
	<div class="film_desc">
		<?php if($film['HorizonalThumbnail']):?>
			<img class="cinema-img" src="<?=$film['HorizonalThumbnail']?>" alt="">
		<?php else:?>
			<span><b>Нет фото</b></span>
		<?php endif;?>
		<?php ?>
			<p><?= ($film['Year']) ? "<b>Год выпуска: </b>".  $film['Year'] : '' ?></p>
			<p><?= ($film['Country']) ? "<b>Страна: </b>". $film['Country'] : ''?></p>
			<p><?= ($film['Genre']) ? "<b>Жанр:</b>". $film['Genre'] : ''  ?></p>
<!--			<p><b>Актеры:</b> --><?//= ($film['Cast']) ? $film['Cast'] : '' ?><!--</p>-->
			<p><?= ($film['Description']) ? "<b>Описание: </b>". $film['Description'] : '' ?></p>
			<p><?= ($film['Duration']) ? "<b>Продолжительность: </b>". $film['Duration'] : '' ?></p>
			<p><?= ($film['ReleaseDate']) ? "<b>Премьера(РФ): </b>". $film['ReleaseDate'] : ''?></p>
	</div>
	<div class="cinemas" data-date="<?=$curDate?>">
		<strong>Кинотеатры:</strong>
	    <table class="table inside-film">
	        <tbody class="film__table">
	        <?php foreach ($films_place as $item): ?>
		        <tr>
	                <td valign="center" style="padding-bottom: 15px; padding-left: 15px;">
	                    <span class="anchor-cube">
	                    </span>
	                    <?= $item->Name ?>
	                </td>
	                <td class="film-session" id="cinema-<?= $item->ObjectID ?>">
	                    <a href="#" class="showSession" data-obj-id="<?= $item->ObjectID ?>" data-film-id="<?= $id ?>" data-date="<?=$curDate?>">Сеансы</a>
	                </td>
	            </tr>
	        <?php endforeach; ?>
	        </tbody>
	    </table>
	</div>
</div>