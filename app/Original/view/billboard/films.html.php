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
    </table>
	<div style="width: 100%">
	    <?php foreach ($films as $film):?>
	        <div style="
    float: left;
    position: relative;
    width: 30%;
    height: 230px;
    margin: 1.66%;">
	            <div style="overflow: hidden; position: relative; width: 230px; height: 135px;" >
	                <img style="max-width: 100%; object-fit: contain; top: 20%; transform: translateY(-50%);
    position: absolute;
    left: 0;" src="<?=$film->Thumbnail?>">
	            </div>
	            <p><?=$film->Genre?></p>
	                <a data-id="<?=$film->ObjectID?>" data-name="<?=$film->Name?>" href="#" id="film">
	                    <?=$film->Name?>
	                </a>
	            <p>Премьера(РФ): <?=$film->ReleaseDate?></p>
	        </div>
	    <?php endforeach;?>
	</div>
</div>
<!--End Ticket widget-->
