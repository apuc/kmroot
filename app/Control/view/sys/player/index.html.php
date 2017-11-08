<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $routeList
 * @var $player
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Выбор плеера</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
	            <div class="panel-body">
		            <form method="post">
                        <div class="form-group">
                            <label for="type">Плеер</label>
                            <select name="player" id="player">
	                            <option selected value="<?= $player?>">Текущий плеер <?= $player?></option>
                                <option value="js">JS</option>
                                <option value="viqeo">Viqeo</option>
                            </select>
                        </div>
	                    
                        <input type="submit" value="Включить" class="btn btn-primary" />

                        <input type="hidden" name="handler" value="player" />
                        <input type="hidden" name="local" value="false" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>