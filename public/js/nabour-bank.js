$(window).load( function () {
    var root = $('#root-url').val();
    var tmp ;
    var validEditForm;

    var selectOpt = {
        allowClear: true,
        minimumResultsForSearch: -1,
        formatResult: function(state)
        {
            return '<div style="padding:4px 0px;"><div style="background:url('+root+'/images/bank/' + state.id + '_mini-logo.png) no-repeat center center;background-size:100%;display:inline-block;position:relative;width:30px;height:30px;margin-right: 10px;top:2px;float:left;"></div>' 
                    + "<span style='line-height:30px;'>"+state.text+"</span><div style='clear:both;'</div></div>";
        }
    };
    var rules = {
                account_type    : "required",
                account_name    : "required",
                account_number  : "required",
                account_branch  : "required"
            };

    $("#modal-add-bank-form .account-type").selectBoxIt().on('open', function(){
            $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
        });
    
    $("#modal-add-bank-form .bank-list").select2(selectOpt).on('select2-open', function() {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });

    var validAddForm = $('#modal-add-bank-form .bank-form').validate({
            rules: rules,
            errorPlacement: function(error, element) {}
    });

    //var validEditForm;

    $('#submit-add-form-btn').on('click',function (){
        validAddForm.form();
        var good = validateInputForm('#modal-add-bank-form');
        if(validAddForm.valid() && good) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $('#modal-add-bank-form .bank-form').submit();
        } 
    });

    
    $('#submit-edit-form-btn').on('click',function (){
        validEditForm.form();
        var good = validateInputForm('#modal-edit-bank-form');
        if(validEditForm.valid() && good) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $('#modal-edit-bank-form .bank-form').submit();
        }
    });

    $('.edit-bank').on('click', function (){
        this_ =  $(this);
        this_.html('<i class="fa-spin fa-spinner"></i>');
        var bid = $(this).data('bid');
        $.ajax({
            url: root+"/admin/property/bank/getform",
            method: "POST",
            data: ({bid:bid}),
            dataType: "html",
            success: function (h) {
                $('#modal-edit-bank-form .modal-body').html(h);
                $('#modal-edit-bank-form').modal('show');
                validEditForm = $('#modal-edit-bank-form .bank-form').validate({
                        rules: rules,
                        errorPlacement: function(error, element) {}
                });
                $("#modal-edit-bank-form .account-type").selectBoxIt().on('open', function(){
                        $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
                });
                $("#modal-edit-bank-form .bank-list").select2(selectOpt).on('select2-open', function() {
                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                this_.html('<i class="fa-pencil"></i>');
            }
        });
    });
    
    $('.delete-bank').on('click', function (){
        tmp = $(this);
        $('#modal-confirm-delete-bank').modal('show');
    });

    $('#submit-delete').on('click', function () {
        var _this = $(this);
        _this.attr('disabled',true).prepend('<i class="fa-spin fa-spinner"></i> ');
        $.ajax({
            url:root+'/admin/property/bank/delete',
            method: "POST",
            data: ({bid:tmp.data('bid')}),
            dataType: "json",
            success : function (r) {
                if(r.result) {
                    $('#modal-confirm-delete-bank').modal('hide');
                    tmp.parent().parent().fadeOut(500,function () { 
                        $(this).remove(); 
                        if($('#tb-bank-list td').length == 0) {
                            $('#tb-bank-list').hide();
                            $('.empty-bank').show();
                        }
                    })
                }
                $('#submit-delete').removeAttr('disabled').find('.fa-spin').remove();
            }
        })
    })

     function validateInputForm (parent) {
        var valid = true;
             if($(parent+' .bank-list :selected').val() == "") {
                valid = false;
                $(parent+' .select2-container').addClass('error');
            } else {
                $(parent+' .select2-container').removeClass('error');
            }

            if($(parent+' .account-type :selected').val() == 0) {
                valid = false;
                $(parent+' .selectboxit').addClass('error');
            } else {
                $(parent+' .selectboxit').removeClass('error');
            }
            return valid;
        }
});