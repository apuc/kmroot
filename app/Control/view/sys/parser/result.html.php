<?php
/**
 * @var string $url
 * @var array $error
 * @var array $data
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Отлакдка парсера / Результат</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <h4><?= $url ?></h4>
                    <pre><?php print_r($error) ?></pre>
                    <pre><?php print_r($data) ?></pre>
                </div>
            </div>
        </div>
    </div>
</div>