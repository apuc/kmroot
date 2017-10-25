<?php
/**
 * @var $id integer
 * @var $cityId integer
 * @var $img
 * @var $film array
 * @var $dataFrom array
 */
?>
<strong class="film__name">
	<?= $film['Name'] ?>
</strong>
<strong class="film__date">
	Даты:
</strong>
<div class="film__dates">
	<?php foreach ($dataFrom as $date):?>
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
			<p><b>Год выпуска:</b> <?= ($film['Year']) ? $film['Year'] : '' ?></p>
			<p><b>Страна:</b> <?= ($film['Country']) ? $film['Country'] : ''?></p>
			<p><b>Жанр:</b> <?= ($film['Genre']) ? $film['Genre'] : ''  ?></p>
<!--			<p><b>Актеры:</b> --><?//= ($film['Cast']) ? $film['Cast'] : '' ?><!--</p>-->
			<p><b>Описание:</b> <?= ($film['Description']) ? $film['Description'] : '' ?></p>
			<p><b>Продолжительность:</b> <?= ($film['Duration']) ? $film['Duration'] : '' ?></p>
			<p><b>Премьера(РФ):</b> <?= ($film['ReleaseDate']) ? $film['ReleaseDate'] : ''?></p>
	</div>
	<div class="cinemas">
		<strong>Кинотеатры:</strong>
	    <table class="table inside-film">
	        <tbody class="film__table">
	        <?php foreach ($films_place as $item): ?>
	            <tr>
	                <td valign="bottom" style="padding-bottom: 15px; padding-left: 15px;">
	                    <span class="anchor-cube">
	                    </span>
	                    <?= $item->Name ?>
	                </td>
	                <td class="film-session" id="cinema-<?= $item->ObjectID ?>">
	                    <a href="#" class="showSession" data-obj-id="<?= $item->ObjectID ?>" data-film-id="<?= $id ?>">Сеансы</a>
	                </td>
	            </tr>
	        <?php endforeach; ?>
	        </tbody>
	    </table>
	</div>
</div>
<div id="result"></div>