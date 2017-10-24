<?php
/**
 * @var $id integer
 * @var $cityId integer
 * @var $img
 */
?>
<strong style="font-size: 34px;"><?= $name ?>
    <!--	г.-->
    <? //= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<span class="cinemas"><strong>Кинотеатры:</strong></span>
<div id="block" class="film-block">
	<?php if($img):?>
		<img class="cinema-img" src="<?=$img?>" alt="">
	<?php else:?>
		<span><b>Нет фото</b></span>
	<?php endif;?>
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