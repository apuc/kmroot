<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $routeList
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Отлакдка парсера</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <form method="post">
                        
                        <div class="form-group">
                            <label for="type">Парсер</label>
                            <select name="type" id="type">
                                <option value="imdb_film">IMDB фильм</option>
                                <option value="kt_film">KT фильм</option>
                                <option value="kp_film">KP фильм</option>
                                <option value="imdb_person">IMDB персона</option>
                                <option value="kt_person">KT персона</option>
                                <option value="kp_person">KP персона</option>
                                <option value="kinometro_ru">Кинометро</option>
                                <option value="mojo">Mojo</option>
                                <option value="tv">VseTV программа</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="url">URL / ID</label>
                            <input type="text" name="url" value="" id="url" class="form-control" placeholder="" />
                        </div>

                        <input type="submit" value="Запустить" class="btn btn-primary" />

                        <input type="hidden" name="handler" value="parse" />
                        <input type="hidden" name="local" value="false" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>