$(function () {
	$.validator.addMethod("notEqual", function(value, element, param) {
	  return this.optional(element) || value != param;
	});

    $.validator.addMethod("checkIsCM", function(value, element) {
      var type = $("select[name='type']").val();
         if( $.inArray(type,[1,2]) && value == 0 ){ return false; }
         else { return true; }
    });

	$('#v-type').on('change',function () {
		if($(this).val() == 1 || $(this).val() == 2 ) {
			var fn = function () {
				$('#specific_brand').show();
				$('#other_brand').hide();
			}
			getVehicleMake($(this).val(),'#s_brand_input',fn);

		} else {
			$('#specific_brand').hide();
			$('#other_brand').show();
		}
	})

	$('#sv-type').on('change',function () {
		if($(this).val() == 1 || $(this).val() == 2 ) {

			var fn = function () {
				$('#specific_brand_search').show();
				$('#other_brand_search').hide();
			}

			getVehicleMake($(this).val(),'#s_brand_search_input',fn);

		} else {
			$('#specific_brand_search').hide();
			$('#other_brand_search').show();
		}
	})

    function getVehicleMake(type,target, fn) {
    	$.ajax({
            url : $('#root-url').val()+"/data/vehicle/make",
            method : 'post',
            dataType: 'json',
            data : ({'type':type}),
            success: function (r) {
            	$(target).html('');
            	var toAppend = "";
                $.each(r,function(i,o){
		           toAppend += '<option value="'+i+'">'+o+'</option>';
		         });
         		$(target).append(toAppend);
         		fn();
				if ( $(target).selectBoxIt().data("selectBox-selectBoxIt") ) {
					$(target).selectBoxIt().data("selectBox-selectBoxIt").refresh();
				}

            },
            error : function () {

            }
        })
    }
})
