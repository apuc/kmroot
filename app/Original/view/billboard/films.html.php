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
	<div  style="width: 100%">
	    <?php foreach ($films as $film):?>
	        <div style="float: left; position: relative;  width: 30%; height: 235px; margin: 1.66%;">
	            <a style="text-decoration: none;" data-id="<?=$film->ObjectID?>" data-name="<?=$film->Name?>" href="#" id="film">
		            <div style="overflow: hidden; position: relative; width: 230px; height: 135px;" >
	                    <img style="max-width: 100%; object-fit: contain; top: 20%; transform: translateY(-50%);
    position: absolute;
    left: 0;" src="<?=$film->Thumbnail?>">
	                 </div>
		            <p style="margin-top: 10px;">
			            <?=$film->Genre?>
		            </p>
		                <span style="font-weight: bold; color: #000;" >
		                    <?=$film->Name?>
		                </span>
		            <p style="margin-top: 10px; color: #000;">Премьера(РФ): <?=$film->ReleaseDate?></p>
	            </a>
	        </div>
	    <?php endforeach;?>
	</div>
</div>
<!--End Ticket widget-->
