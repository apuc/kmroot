var UPLOAD = {
    buttonId: 'fileBtn',
    fileId: 'file',
    fileFormId: 'fileForm',
    entityId: 'entityId',
    extensionId: 'extension',
    maxSize: 5242880,
    fileUrl: 'fileUrl',
    fileImg: 'fileImg',
    fileDeleteBtn: 'fileDeleteBtn',
    callback: function(){ return false; },
    init: function(settings) {
        if (undefined === settings) {
            settings = {};
        }

        if (settings.hasOwnProperty('buttonId')) {
            this.buttonId = settings.buttonId;
        }

        if (settings.hasOwnProperty('fileId')) {
            this.fileId = settings.fileId;
        }

        if (settings.hasOwnProperty('fileFormId')) {
            this.fileFormId = settings.fileFormId;
        }

        if (settings.hasOwnProperty('entityId')) {
            this.entityId = settings.entityId;
        }

        if (settings.hasOwnProperty('fileUrl')) {
            this.fileUrl = settings.fileUrl;
        }

        if (settings.hasOwnProperty('fileImg')) {
            this.fileImg = settings.fileImg;
        }
        
        if (settings.hasOwnProperty('maxSize')) {
            this.maxSize = settings.maxSize;
        }
        
        if (settings.hasOwnProperty('extensionId')) {
            this.extensionId = settings.extensionId;
        }

        if (settings.hasOwnProperty('fileDeleteBtn')) {
            this.fileDeleteBtn = settings.fileDeleteBtn;
        }
        
        if (settings.hasOwnProperty('callback')) {
            this.callback = settings.callback;
        }

        $('#' + this.buttonId).click(UPLOAD.load);
        $('#' + this.fileDeleteBtn).click(UPLOAD.delete);

        if ('' != $('#fileImg').attr('src')) {
            $('#fileNew').hide();
            $('#fileDelete').show();
        } else {
            $('#fileNew').show();
            $('#fileDelete').hide();
        }
    },
    load: function (){
        $('.progress').fadeIn();

        var fd = new FormData();
        fd.append('id', $('#' + UPLOAD.entityId).val());
        fd.append('url', $('#' + UPLOAD.fileUrl).val());
        var length = $('#' + UPLOAD.fileId)[0].files.length;
        for(var i = 0; i < length; i++){
            fd.append("fileList[]", $('#' + UPLOAD.fileId)[0].files[i]);
        }

        if ('' == $('#' + UPLOAD.fileUrl).val() && 0 === $('#' + UPLOAD.fileId)[0].files.length) {
            $("#progressbar").css('width', '0%');
            $('.progress').fadeOut();
            $('#' + UPLOAD.fileFormId).trigger('reset');
            $["notify"]('Добавьте файл или укажите URL', 'danger');
        } else {
            if (0 < UPLOAD.maxSize && undefined !== $('#' + UPLOAD.fileId)[0].files[0] && UPLOAD.maxSize < $('#' + UPLOAD.fileId)[0].files[0].size) { // 5m
                $("#progressbar").css('width', '0%');
                $('.progress').fadeOut();
                $('#' + UPLOAD.fileFormId).trigger('reset');
                $["notify"]('Недопустимый размер файла', 'danger');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '?handler=upload',
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', UPLOAD.progressHandle, false);
                        }
                        return myXhr;
                    },
                    success: function (data) {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        if ('true' == data.redirect) {
                            document.location.reload();
                        } else {
                            switch (data.er) {
                                case 0:
                                    var src = $('#' + UPLOAD.fileImg).attr('data-src');
                                    src = src.split('.');
                                    src.pop();
                                    src = src.join('.');
                                    $('#' + UPLOAD.fileImg).attr('src', src + '.' + data.ex + '?' + Math.random());
                                    $('#' + UPLOAD.extensionId).val(data.ex);
                                    $('#fileNew').hide();
                                    $('#fileDelete').show();
                                    UPLOAD.callback();
                                    break;
                                case 1:
                                    $["notify"]('Недопустимый формат файла', 'danger');
                                    break;
                                case 2:
                                    $["notify"]('Недопустимый размер файла', 'danger');
                                    break;
                                case 3:
                                    $["notify"]('Ошибка в ссылке на файл', 'danger');
                                    break;
                                case 6:
                                    $["notify"]('Недопустимое разрешение файла', 'danger');
                                    break;
                                default:
                                    $["notify"]('Не удалось загрузить файл', 'danger');
                            }
                        }
                    },
                    error: function () {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $["notify"]('Не удалось загрузить файл', 'danger');
                    },
                    timeout: 20000
                });
            }
        }
    },
    delete: function() {
        swal({
            title: 'Удалить?',
            text: '',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Да, удалить",
            cancelButtonText: "Отмена",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $('.progress').fadeIn();

                var fd = new FormData();
                fd.append('id', $('#' + UPLOAD.entityId).val());
                fd.append('extension', $('#' + UPLOAD.extensionId).val());

                $.ajax({
                    type: 'POST',
                    url: '?handler=delete',
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) {
                            myXhr.upload.addEventListener('progress', UPLOAD.progressHandle, false);
                        }
                        return myXhr;
                    },
                    success: function (data) {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $('#fileNew').show();
                        $('#fileDelete').hide();
                    },
                    error: function () {
                        $("#progressbar").css('width', '0%');
                        $('.progress').fadeOut();
                        $('#' + UPLOAD.fileFormId).trigger('reset');
                        $["notify"]('Не удалось удалить файл', 'danger');
                    },
                    timeout: 20000
                });
            }
        });
    },
    progressHandle: function(e) {
        if (e.lengthComputable) {
            var val = (e.loaded / e.total) * 100;
            $("#progressbar").css('width', val + '%');
        }
    }
};