$.fn.dataTableExt.oPagination.listbox = {
	/*
	 * Function: oPagination.listbox.fnInit
	 * Purpose:  Initalise dom elements required for pagination with listbox input
	 * Returns:  -
	 * Inputs:   object:oSettings - dataTables settings object
	 *             node:nPaging - the DIV which contains this pagination control
	 *             function:fnCallbackDraw - draw function which must be called on update
	 */
	"fnInit": function (oSettings, nPaging, fnCallbackDraw) {
		var nInput = document.createElement('select');
		var pPInput = document.createElement('a');
		var nPInput = document.createElement('a');
        $(nInput).addClass('form-control');
		if (oSettings.sTableId !== '') {
			nPaging.setAttribute('id', oSettings.sTableId + '_paginate');
		}
        $(pPInput).attr({
            'class' : 'btn btn-white prev-page',
            'href':'javascript:'
        }).html($('#lang_prev').val());

        $(nPInput).attr({
            'class' : 'btn btn-white next-page',
            'href':'javascript:'
        }).html($('#lang_next').val())
        
        $(nPaging).addClass('text-right');
        nPaging.appendChild(pPInput);		
		nPaging.appendChild(nInput);
        nPaging.appendChild(nPInput);
		$(nInput).change(function (e) {
			if (this.value === "" || this.value.match(/[^0-9]/)) { 
				return;
			}
            setOption (this.value);
		}); 
		
		$(pPInput).bind('mousedown', function (e) {
			e.preventDefault();
            var page = $(this).attr('data-page');
			setOption (page);
        });

		$(nPInput).bind('mousedown', function () {
            var page = $(this).attr('data-page');
			setOption (page);
        });

        function setOption (page) {
            var iNewStart = oSettings._iDisplayLength * (page - 1);
			if (iNewStart > oSettings.fnRecordsDisplay()) {
				oSettings._iDisplayStart = (Math.ceil((oSettings.fnRecordsDisplay() - 1) / oSettings._iDisplayLength) - 1) * oSettings._iDisplayLength;
				fnCallbackDraw(oSettings);
				return;
			}
			oSettings._iDisplayStart = iNewStart;
			fnCallbackDraw(oSettings);
        }
	},
	 
	/*
	 * Function: oPagination.listbox.fnUpdate
	 * Purpose:  Update the listbox element
	 * Returns:  -
	 * Inputs:   object:oSettings - dataTables settings object
	 *             function:fnCallbackDraw - draw function which must be called on update
	 */
	"fnUpdate": function (oSettings, fnCallbackDraw) {
		if (!oSettings.aanFeatures.p) {
			return;
		}
		var iPages = Math.ceil((oSettings.fnRecordsDisplay()) / oSettings._iDisplayLength);
		var iCurrentPage = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1; /* Loop over each instance of the pager */
		var an = oSettings.aanFeatures.p;
        if(iCurrentPage == 1) {
            $(an).find('.prev-page').hide();
        } else {
            $(an).find('.prev-page').show();
        }

        if(iCurrentPage == iPages) {
            $(an).find('.next-page').hide();
        } else {
            $(an).find('.next-page').show();
        }
        $(an).find('.prev-page').attr('data-page',(iCurrentPage-1));
        $(an).find('.next-page').attr('data-page',(iCurrentPage+1));

		for (var i = 0, iLen = an.length; i < iLen; i++) {
			var inputs = an[i].getElementsByTagName('select');
			var elSel = inputs[0];
			if(elSel.options.length != iPages) {
				elSel.options.length = 0; //clear the listbox contents
				for (var j = 0; j < iPages; j++) { //add the pages
					var oOption = document.createElement('option');
					oOption.text = j + 1;
					oOption.value = j + 1;
					try {
						elSel.add(oOption, null); // standards compliant; doesn't work in IE
					} catch (ex) {
						elSel.add(oOption); // IE only
					}
				}
			}
		  elSel.value = iCurrentPage;
		}
	}
};