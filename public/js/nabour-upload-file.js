$(function () {
    var root = $('#root-url').val();
    var i = 0;
    $('#attachment').dropzone({
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
            $('#previews').append($entry);
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


            var isImage = 0;
            if(xhr.mime === "image/jpeg" || xhr.mime === "image/png" || xhr.mime === "image/gif"){
                isImage = 1;
            }

            console.log(xhr);
            // $('.save-show').hide();
            // console.log('aa');

            if(isImage) {
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
                    $('<input>').attr({'type':'hidden','name':'attachment['+i+'][isImage]','value':isImage})
                );

            if(!isImage)  file.entry.append(fileNameLabel);

            removeButton.on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                _this.removeFile(file);
                $(this).parent().remove();
            });
            i++;
            imgAppend.load(function () {
                $( window ).resize();
            });

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
});

function checkIsImage(xhr) {
    console.log(xhr);
    //return xhr.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
}
