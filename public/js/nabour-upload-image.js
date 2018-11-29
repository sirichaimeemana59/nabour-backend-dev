function makeUploadZone (target,preview) {
    if(!preview) preview = '#previews';
    var root = $('#root-url').val();
    var i = 0;
    $(target).dropzone({
        maxFiles: 3,
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
            $(preview).append($entry);
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
                    $('<input>').attr({'type':'hidden','name':'attachment['+i+'][name]','value':xhr.name})
                ).append(
                    $('<input>').attr({'type':'hidden','name':'attachment['+i+'][mime]','value':xhr.mime})
                ).append(
                    $('<input>').attr({'type':'hidden','name':'attachment['+i+'][originalName]','value':xhr.oldname})
                ).append(
                    $('<input>').attr({'type':'hidden','name':'attachment['+i+'][isImage]','value':xhr.isImage})
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
                $('#previews').children(':last').remove();
            }
        }
    });
}

function makeUploadNabourPostZone (target) {
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
            $('#previews-img').append($entry);
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
