<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 */
?>

<style>
    label.error, #errorText {
        position: absolute;
        top: 37px;
        left: 57px;
    }
    .img-container img {
        max-width: 100%;
    }
</style>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post" id="formCrop" class="saveScrollPosition">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Закрыть" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabel" class="modal-title">Кропинг фотографии <span id="crop_width"></span><span id="crop_height"></span></h4>
            </div>
            <div class="modal-body">
                <div id="warning">

                </div>
                <div class="row">
                    <div class="img-container mb-lg" style="max-height: none;">
                        <img id="cropImage" src="<?= $item->imageSrc() ?>?<?= mt_rand(0, 9999999) ?>"
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="btnClose" class="btn btn-default">Закрыть</button>
                <input type="submit" value="Сохранить изменения" id="btnAdd" class="btn btn-primary" />
            </div>

            <input type="hidden" name="id" id="photoId" value="0" />
            <input type="hidden" name="crop" id="crop" value="0" />
            <input type="hidden" name="extension" id="extension" value="<?= $item->image() ?>" />
            <input type="hidden" name="handler" value="crop" />
        </form>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#photoId').val(window.photoId);

        var img = new Image();
        img.onload = function() {
            if (320 >= this.width) {
                $('#warning').html('<div role="alert" class="alert alert-warning">Дальнейшее уменьшение изображения может ухудшить его качество</div>');
            }
        };
        img.src = $("#cropImage").attr('src');

        $("#formCrop").submit(function(){
            var fd = new FormData();
            fd.append('id', $('#photoId').val());
            fd.append('crop', $('#crop').val());
            fd.append('extension', $('#extension').val());

            $.ajax({
                url: '?handler=crop',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success:function(data) {
                    if (1 == data.er) {
                        $["notify"]('Не удалось изменить изображение', 'danger');
                    } else {
                        $.cookie('__alert__', 'Изображение изменено|green', { expires: 1, path: '/' });
                        location.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $["notify"]('Не удалось изменить изображение', 'danger');
                }
            });

            return false;
        });

    });

    (function(window, document, $, undefined) {
        setTimeout(function(){
            $(function() {
                if(! $.fn.cropper ) return;

                var $image = $('.img-container > img'),
                    $dataX = $('#dataX'),
                    $dataY = $('#dataY'),
                    $dataHeight = $('#dataHeight'),
                    $dataWidth = $('#dataWidth'),
                    $dataRotate = $('#dataRotate'),
                    options = {
                        cropBoxResizable: true,
                        crop: function(data) {
                            $('#crop').val(data.x + ':' + data.y + ':' + data.width + ':' + data.height);
                            $dataX.val(Math.round(data.x));
                            $dataY.val(Math.round(data.y));
                            $dataHeight.val(Math.round(data.height));
                            $dataWidth.val(Math.round(data.width));
                            $dataRotate.val(Math.round(data.rotate));

                            $('#crop_width').html(Math.round(data.width) + 'x');
                            $('#crop_height').html(Math.round(data.height));
                        }
                    };

                $image.cropper(options);

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();

            });
        }, 500);
    })(window, document, window.jQuery);
</script>