function makeUploadNabourPostAttachZone (target) {
    var root = $('#root-url').val();
    var i = 0;
    $(target).dropzone({
        maxFiles: 3,
        maxFilesize: 5,
        url: root+'/upload-file',
        acceptedFiles: ".png, .jpg, .jpeg, .pdf",
        init : function () { },
        addedfile: function(file)
        {
            $entry = $('<div>').attr({'class':'preview-img-item'}).append(
                $('<div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div>')
            );
            file.entry = $entry;
            file.progressBar = $entry.find('.progress-bar');
            file.p_progressBar = $entry.find('.progress');
            $('#previews-attachment').append($entry);
        },
        uploadprogress: function(file, progress, bytesSent)
        {
            file.progressBar.width(progress + '%');
        },

        success: function(file,xhr)
        {
            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');
            file.p_progressBar.hide();
            var removeButton = $('<span>').attr({'class':'remove-img-preview'}).html('&times');
            var _this = this;

            if(xhr.isImage) {
                imgAppend = $('<img>').attr({'src':root+"/upload_tmp/"+xhr.name,'width':'80px'});
            } else {
                imgAppend = $('<img>').attr({'src':root+"/images/file.png",'width':'80px'});
                fileNameLabel = $('<span>').attr('class','file-label').html(xhr.oldname);
            }
            file.entry.prepend(imgAppend).append( removeButton ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][name]','value':xhr.name})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][mime]','value':xhr.mime})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][originalName]','value':xhr.oldname})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][isImage]','value':xhr.isImage})
            );

            if(!xhr.isImage)  file.entry.append(fileNameLabel);

            removeButton.on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.removeFile(file);
                $(this).parent().remove();
            });
            i++;
            imgAppend.load(function () {
                $( window ).resize();
            })
        },
        error: function(file)
        {
            if(file.accepted) {
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                this.removeFile(file);
            } else {
                $('#previews-attachment').children(':last').remove();
            }
        }
    });
}

function makeUploadNabourPostImageZone (target) {
    var root = $('#root-url').val();
    var i = 0;
    $(target).dropzone({
        maxFiles: 1,
        maxFilesize: 5,
        url: root+'/upload-file',
        acceptedFiles: ".png, .jpg, .jpeg",
        addedfile: function(file)
        {
            $entry = $('<div>').attr({'class':'preview-img-item'}).append(
                $('<div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div>')
            );
            file.entry = $entry;
            file.progressBar = $entry.find('.progress-bar');
            file.p_progressBar = $entry.find('.progress');
            $('#-img').append($entry);
        },
        uploadprogress: function(file, progress, bytesSent)
        {
            file.progressBar.width(progress + '%');
        },

        success: function(file,xhr)
        {
            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');
            file.p_progressBar.hide();
            var removeButton = $('<span>').attr({'class':'remove-img-preview'}).html('&times');
            var _this = this;
            var img = $('<img>').attr({'src':root+"/upload_tmp/"+xhr.name,'width':'80px'});
            file.entry.prepend(
                img
            ).append( removeButton ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][name]','value':xhr.name})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][mime]','value':xhr.mime})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][originalName]','value':xhr.oldname})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][isImage]','value':xhr.isImage})
            );
            removeButton.on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.removeFile(file);
                $(this).parent().remove();
            });
            img.load(function () {
                $( window ).resize();
            })
            i++;
        },
        error: function(file)
        {
            if(file.accepted) {
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                this.removeFile(file);
            } else {
                $('#previews-img').children(':last').remove();
            }
        }
    });
}

function makeUploadNabourPostAttachZoneEdit (target) {
    var root = $('#root-url').val();
    var i = 0;
    var count = $('#previews-edit-form .preview-img-item').length;
    $(target).dropzone({
        maxFiles: 3,
        maxFilesize: 5,
        url: root+'/upload-file',
        acceptedFiles: ".png, .jpg, .jpeg, .pdf",
        init : function () { },
        addedfile: function(file)
        {
            count = $('#previews-edit-form .preview-img-item').length;
            if( count < 3 ) {
                $entry = $('<div>').attr({'class': 'preview-img-item'}).append(
                    $('<div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div>')
                );
                file.entry = $entry;
                file.progressBar = $entry.find('.progress-bar');
                file.p_progressBar = $entry.find('.progress');
                $('#previews-attachment-edit').append($entry);
            }else {
                this.removeFile(file);
            }
        },
        uploadprogress: function(file, progress, bytesSent)
        {
            file.progressBar.width(progress + '%');
        },

        success: function(file,xhr)
        {
            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');
            file.p_progressBar.hide();
            var removeButton = $('<span>').attr({'class':'remove-img-preview'}).html('&times');
            var _this = this;

            if(xhr.isImage) {
                imgAppend = $('<img>').attr({'src':root+"/upload_tmp/"+xhr.name,'width':'80px'});
            } else {
                imgAppend = $('<img>').attr({'src':root+"/images/file.png",'width':'80px'});
                fileNameLabel = $('<span>').attr('class','file-label').html(xhr.oldname);
            }
            file.entry.prepend(imgAppend).append( removeButton ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][name]','value':xhr.name})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][mime]','value':xhr.mime})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][originalName]','value':xhr.oldname})
            ).append(
                $('<input>').attr({'type':'hidden','name':'attachment['+i+'][isImage]','value':xhr.isImage})
            );

            if(!xhr.isImage)  file.entry.append(fileNameLabel);

            removeButton.on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.removeFile(file);
                $(this).parent().remove();
            });
            i++;
            imgAppend.load(function () {
                $( window ).resize();
            })
        },
        error: function(file)
        {
            if(file.accepted) {
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                this.removeFile(file);
            } else {
                $('#previews-attachment-edit').children(':last').remove();
            }
        }
    });
}

function makeUploadNabourPostImageZoneEdit (target) {
    var root = $('#root-url').val();
    var i = 0;
    var count = $('#previews-edit-form .preview-img-item').length;
    $(target).dropzone({
        maxFiles: 1,
        maxFilesize: 5,
        url: root+'/upload-file',
        acceptedFiles: ".png, .jpg, .jpeg",
        addedfile: function(file)
        {
            count = $('#previews-edit-form .preview-img-item').length;
            if( count < 1 ) {
                $entry = $('<div>').attr({'class': 'preview-img-item'}).append(
                    $('<div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div>')
                );
                file.entry = $entry;
                file.progressBar = $entry.find('.progress-bar');
                file.p_progressBar = $entry.find('.progress');
                $('#previews-img-edit').append($entry);
            }else {
                this.removeFile(file);
            }
        },
        uploadprogress: function(file, progress, bytesSent)
        {
            file.progressBar.width(progress + '%');
        },

        success: function(file,xhr)
        {
            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');
            file.p_progressBar.hide();
            var removeButton = $('<span>').attr({'class':'remove-img-preview'}).html('&times');
            var _this = this;
            var img = $('<img>').attr({'src':root+"/upload_tmp/"+xhr.name,'width':'80px'});
            file.entry.prepend(
                img
            ).append( removeButton ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][name]','value':xhr.name})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][mime]','value':xhr.mime})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][originalName]','value':xhr.oldname})
            ).append(
                $('<input>').attr({'type':'hidden','name':'img-nb-file['+i+'][isImage]','value':xhr.isImage})
            );
            removeButton.on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.removeFile(file);
                $(this).parent().remove();
            });
            img.load(function () {
                $( window ).resize();
            })
            i++;
        },
        error: function(file)
        {
            if(file.accepted) {
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                this.removeFile(file);
            } else {
                $('#previews-img-edit').children(':last').remove();
            }
        }
    });
}
