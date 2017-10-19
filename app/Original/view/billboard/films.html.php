<strong style="font-size: 34px;">Фильмы г.
<?= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<div id="block" >
    <table class="table">
        <thead>
        <tr>
            <td><strong>Фильмы:</strong></td>
        </tr>
        </thead>
        <tbody class="film__table">
        <?php foreach ($films as $film):?>
            <tr>
                <td valign="bottom">
                    <span class="anchor-cube">
                    </span>
                        <a data-id="<?=$film->ObjectID?>" data-name="<?=$film->Name?>" href="#" id="film">
	                        <?=$film->Name?>
                        </a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>