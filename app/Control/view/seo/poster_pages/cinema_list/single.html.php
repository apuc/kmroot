<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:23
 * @var $options \Kinomania\System\Options\Options
 * @var $get array
 */
use Kinomania\System\Data\Genre;
?>
<!-- extends base.html.php -->
<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<style>
    .link {
        position: relative;
        top: 1px;
    }
    .dataTables_wrapper table tr td {
        border: 0;
    }
</style>

<div class="content-heading">
    Настройка СЕО для страницы списка кинотеатров города
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div>
                        {city} - текущий город пользователя
                    </div>
                    <form method="post">
                        <div class="dataTables_wrapper">
                            <table class="table table-responsive">
                                <colgroup>
                                    <col width="50px">
                                    <col width="auto">
                                </colgroup>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>
                                        <input type="text" name="title" value="<?= $options->get('seo_poster_pages_cinema_list_title') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>
                                        <input type="text" name="description" value="<?= $options->get('seo_poster_pages_cinema_list_description') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keywords</td>
                                    <td>
                                        <input type="text" name="keywords" value="<?= $options->get('seo_poster_pages_cinema_list_keywords') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>H1</td>
                                    <td>
                                        <input type="text" name="h1" value="<?= $options->get('seo_poster_pages_cinema_list_h1') ?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Text</td>
                                    <td>
                                        <textarea name="text" id="text" class="htmlEdit_text form-control"><?= $options->get('seo_poster_pages_cinema_list_text') ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br />
                        <input type="hidden" name="handler" value="save" />
                        <input type="submit" class="btn btn-primary" value="Сохранить" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/cms/_js/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function(){
        tinymce.init({
            selector: ".htmlEdit_text",
            theme: "modern",
            menubar:false,
            statusbar: false,
            plugins: [
                "advlist autolink lists link charmap hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "paste textcolor"
            ],
            toolbar1: "undo redo | pastetext | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code ",
            height: 300,
            language:'ru',
            extended_valid_elements: 'span[*],div[*],p[*],areatext[*],',
            setup:function(ed) {
                ed.on('change', function(e) {
                    window.unsaved = true;
                });
            }
        });

        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });

        $('.modalBtn').click(function(){
            callCrop();
        });
    });
</script>