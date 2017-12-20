<?php
/**
 * @var \Kinomania\Control\Check\Check $check
 * @var string $mysqlInfo
 * @var string $staticServer
 */
?>

<!-- extends base.html.php -->

<style>
    .form-horizontal .control-label {
        padding-top: 0 !important;
    }

   footer {
        position: fixed !important;
        bottom: 0 !important;
       z-index: 999 !important;
    }
</style>

<div class="content-heading">
    Проверка системы
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="panel-bottom">
	                    <form method="post" class="form-horizontal">
	                        <input type="submit" value="Сбросить ssi_cache" class="btn btn-warning" />
	                        <input type="hidden" name="handler" value="resetSsiCache" />
	                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>