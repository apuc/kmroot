<?php
/**
 * @var $id integer
 * @var $cityId integer
 * @var $curDate
 * @var $dataFrom array
 */
?>
<strong style="font-size: 34px;">
	<?= $name;?>
    <!--	г.-->
    <? //= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong><br><br>
<strong class="film__date">
	Даты:
</strong>
<div class="film__dates">
	<?php foreach ($dataFrom as $key => $date):?>
		<span id="film_sessions" class="film-session" data-name="<?= $name?>" data-date="<?= $date?>" data-id="<?= $id?>"><a href="#"> <?= $date?></a></span>
	<?php endforeach;?>
</div>
<div class="cinemas" data-date="<?=$curDate?>"></div>
<div id="block">
    <table class="table">
        <thead>
        <tr>
            <td><strong>Кинотеатры:</strong></td>
        </tr>
        </thead>
        <tbody class="film__table">
        <?php foreach ($films_place as $item): ?>
            <tr>
                <td valign="bottom" style="padding-bottom: 15px;">
                    <span class="anchor-cube">
                    </span>
                    <?= $item->Name ?>
                </td>
                <td class="film-session" id="cinema-<?= $item->ObjectID ?>">
                    <a href="#" class="showSession" data-obj-id="<?= $item->ObjectID ?>" data-film-id="<?= $id ?>" data-date="<?= $curDate?>">Сеансы</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>