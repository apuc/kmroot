<?php
/**
 * @var $id integer
 * @var $cityId integer
 */
?>
<strong style="font-size: 34px;"><?= $name ?>
    <!--	г.-->
    <? //= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
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
                <td id="cinema-<?= $item->ObjectID ?>">
                    <a href="#" class="showSession" data-obj-id="<?= $item->ObjectID ?>" data-film-id="<?= $id ?>">Сеансы</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>