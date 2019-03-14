    // start chart lead and customer
    $('.lead_set').on('click',function () {
        $('.chart').hide();
    });

    $('.quotation_set').on('click',function () {
        $('.chart').hide();
    });

    $('.quotation_sum_set').on('click',function () {
        $('.chart').hide();
    });

    $('.target_set').on('click',function () {
        $('.chart').hide();
    });


    $(function () {
        $("#name").select2({
            placeholder: "{{ trans('messages.unit_number') }}",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    $(function () {
        $("#sale_id").select2({
            placeholder: "{{ trans('messages.unit_number') }}",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    $(function () {
        $("#name1").select2({
            placeholder: "{{ trans('messages.unit_number') }}",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    $(function () {
        $("#sale_id1").select2({
            placeholder: "{{ trans('messages.unit_number') }}",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    $(function () {
        $("#year").select2({
            placeholder: "{{ trans('messages.unit_number') }}",
            allowClear: true,
            dropdownAutoWidth: true
        });
    });

    function numberWithCommas(number) {
        if(number == null){
            number = 0;
        }else{
            number = number;
        }
        var parts = number.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    $(document).ready(function () {
        $('.reset-s-btn').on('click',function () {
            $(this).closest('form').find("input").val("");
            $(this).closest('form').find("select option:selected").removeAttr('selected');
            $('#name1').select2("val", "");
            $('#sale_id1').select2("val", "");
        });

        $('.reset-s-btn-quotation').on('click',function () {
            $(this).closest('form').find("input").val("");
            $(this).closest('form').find("select option:selected").removeAttr('selected');
            $('#name').select2("val", "");
            $('#sale_id').select2("val", "");
        });


        $('#p-search-property').on('click', function () {
            if ($("select[name=year]").valid()) {
                //alert('aaa');
                $('#ie-search-from-date,#ie-search-to-date').removeClass('error');
                if (!$(this).is(':disabled')) {
                    var _this = $(this);
                    _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                    _this.attr('disabled');
                    $('#chart-year').css('opacity', '0.6');
                    var parent_ = $(this).parents('form');
                    var data = parent_.serialize();
                    //alert(data);
                    $.ajax({
                        url: $('#root-url').val() + "/report_quotation/ratio/report/date",
                        data: data,
                        dataType: "json",
                        method: 'post',
                        success: function (h) {
                            //alert('yes');
                            var leads = 0, customer = 0;
                            for (var i = 0; i < h.leads.length; i++) {
                                leads += h.leads[i] << 0;
                            }
                            for (var x = 0; x < h.customer.length; x++) {
                                customer += h.customer[x] << 0;
                            }
                            if (leads != 0 || customer != 0) {
                                renderGraph(h);
                                $('.chart-none').hide();
                                //console.log('yes');
                            } else {
                                //console.log('noo');
                                $('.chart').show();
                                $('.chart-none').show();
                                $('.chart_line').hide();
                            }
                            _this.removeAttr('disabled').find('i').remove();
                        }
                    });
                }
            }
        });

        $('#p-search-property-chart').on('click', function () {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled');
            $('#chart-year').css('opacity', '0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            //alert(data);
            $.ajax({
                url: $('#root-url').val() + "/report_quotation/ratio/report/date",
                data: data,
                dataType: "json",
                method: 'post',
                success: function (h) {
                    renderGraph(h);
                    _this.removeAttr('disabled').find('i').remove();
                }
            });
        });

        $('#p-search-quotation').on('click', function () {
            if ($("select[name=year1]").valid()) {
                if (!$(this).is(':disabled')) {
                    var _this = $(this);
                    _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                    _this.attr('disabled');
                    $('#chart_quotation').css('opacity', '0.6');
                    var parent_ = $(this).parents('form');
                    var data = parent_.serialize();
                    //alert(data);
                    $.ajax({
                        url: $('#root-url').val() + "/report_quotation/ratio/report/quotation",
                        data: data,
                        dataType: "json",
                        method: 'post',
                        success: function (h) {
                            var approved = 0, _approved = 0;

                            for (var i = 0; i < h.approved.length; i++) {
                                approved += h.approved[i] << 0;
                            }
                            for (var x = 0; i < h._approved.length; x++) {
                                _approved += h._approved[x] << 0;
                            }
                            if (approved != 0 || _approved != 0) {
                                renderGraph_quotation(h);
                                $('.chart-none').hide();
                            } else {
                                $('.chart-none').show();
                                $('.chart_line_quotation').hide();
                                $('.chart').show();
                            }
                            _this.removeAttr('disabled').find('i').remove();
                        }
                    });
                }
            }
        });

        $('#p-search-quotation-chart').on('click', function () {
            if (!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#chart_quotation').css('opacity', '0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                //alert(data);
                $.ajax({
                    url: $('#root-url').val() + "/report_quotation/ratio/report/quotation",
                    data: data,
                    dataType: "json",
                    method: 'post',
                    success: function (h) {
                        renderGraph_quotation(h);
                        _this.removeAttr('disabled').find('i').remove();
                    }
                });
            }
        });

        $('#p-search-quotation-sum').on('click', function () {
            //alert('bbb');
            if (!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#chart-year').css('opacity', '0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                //alert(data);
                $.ajax({
                    url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/sum",
                    data: data,
                    dataType: "json",
                    method: 'post',
                    success: function (h) {
                        var approved=0,_approved = 0;

                        for (var i = 0; i < h.approved.length; i++) {
                            approved += h.approved[i] << 0;
                        }
                        for (var x = 0; x < h._approved.length; x++) {
                            _approved += h._approved[x] << 0;
                        }
                        if(approved !=0 || _approved !=0){
                            renderGraph_quotation_sum(h);
                            $('.chart-none').hide();
                        }else{
                            $('.chart-none').show();
                            $('.chart_bar').hide();
                            $('.chart').show();
                        }
                        _this.removeAttr('disabled').find('i').remove();
                    }
                });
            }
        });

        $('#p-search-quotation-sum-year').on('click', function () {
            //alert('aa');
            if (!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#chart-year').css('opacity', '0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                //alert(data);
                $.ajax({
                    url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/sum",
                    data: data,
                    dataType: "json",
                    method: 'post',
                    success: function (h) {
                        renderGraph_quotation_sum(h);
                        _this.removeAttr('disabled').find('i').remove();
                    }
                });
            }
        });

        $('#p-search-budget').on('click', function () {
            if ($("select[name=year_target]").valid() && $("select[name=target]").valid()) {
                if (!$(this).is(':disabled')) {
                    var _this = $(this);
                    _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                    _this.attr('disabled');
                    $('#chart-year').css('opacity', '0.6');
                    var parent_ = $(this).parents('form');
                    var data = parent_.serialize();
                    //alert(data);
                    $.ajax({
                        url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/budget",
                        data: data,
                        dataType: "json",
                        method: 'post',
                        success: function (h) {
                            var approved = 0, _approved = 0;

                            for (var i = 0; i < h.approved.length; i++) {
                                approved += h.approved[i] << 0;
                            }
                            for (var x = 0; i < h._approved.length; x++) {
                                _approved += h._approved[x] << 0;
                            }
                            if (approved != 0 || _approved != 0) {
                                renderGraph_target(h);
                                $('.chart-none').hide();
                                //$('#chart_target').show();
                            } else {
                                $('.chart-none').show();
                                //$('#chart_target').hide();
                                $('.chart_target_detail').hide();
                                $('.chart').show();
                            }

                            _this.removeAttr('disabled').find('i').remove();
                        }
                    });
                }
            }
        });

        // start chart lead and customer

        function renderGraph (h) {
            $('.chart').show();
            $('.search_year_lead').show();
            $('.search_year_quotaion').hide();
            $('.search_year_sum').hide();
            $('.chart_line').show();
            $('.chart_bar').hide();
            $('.chart_target').hide();
            $('.chart_target_detail').hide();
            $('.chart_line_quotation').hide();

            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var rDataSource = [];
            var leads=0,customer = 0;
            var text_ = " ";

            for (var i = 0; i < h.leads.length; i++) {
                leads += h.leads[i] << 0;
            }
            for (var x = 0; x < h.customer.length; x++) {
                customer += h.customer[x] << 0;
            }

            var per = ((customer/(leads+customer))*100).toFixed(2);

            if(per == 'Infinity'){
                per = 0;
            }else{
                per = per;
            }

            $.each(h.leads, function (i,v) {
                if(h.leads) {
                    rDataSource.push({type:month[i],value:v,number:h.customer[i]});
                }
            });
            //console.log(per);

            text_ = "Leads/Customer Ratio in " + Math.ceil(per) + "%";

            $('#chart').dxChart('instance').option('dataSource', rDataSource);
            $('#chart').dxChart('instance').render();

            $('#reqs-per-second').dxCircularGauge('instance').option('value', Math.ceil(per));
            $('#reqs-per-second').dxCircularGauge('instance').render();

            $('#chart').dxChart('instance').option('title', text_);
            $('#chart').dxChart('instance').render();

            $('#per').html("Leads/Customer Ratio in " + Math.ceil(per) + "%");
            // text ="Leads/Customer Ratio in " + per + "%";
            $('#per_').html(Math.ceil(per)+"%");
            $('#total_lead').html("Total Leads is. " + leads);
            $('#total_customer').html("Total Customer is. " + customer);
        }

        jQuery(document).ready(function($)
        {

            if( ! $.isFunction($.fn.dxChart))
                return;

            var gaugesPalette = ['#8dc63f', '#40bbea', '#ffba00', '#cc3f44'];

            // Requests per second gauge
            $('#reqs-per-second').dxCircularGauge({
                scale: {
                    startValue: 0,
                    endValue: 200,
                    majorTick: {
                        tickInterval: 50
                    }
                },
                rangeContainer: {
                    palette: 'pastel',
                    width: 3,
                    ranges: [
                        {
                            startValue: 0,
                            endValue: 50,
                            color: gaugesPalette[0]
                        }, {
                            startValue: 50,
                            endValue: 100,
                            color: gaugesPalette[1]
                        }, {
                            startValue: 100,
                            endValue: 150,
                            color: gaugesPalette[2]
                        }, {
                            startValue: 150,
                            endValue: 200,
                            color: gaugesPalette[3]
                        }
                    ],
                },
                value: per,
                valueIndicator: {
                    offset: 10,
                    color: '#2c2e2f',
                    spindleSize: 12
                }
            });
        });
        var dataSource = [];
        var text_ = '';
        var series_name =[];

        $(function(){
            $("#chart").dxChart({
                palette: "Violet",
                dataSource: dataSource,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "line"
                },
                margin: {
                    bottom: 20
                },
                argumentAxis: {
                    valueMarginsEnabled: false,
                    discreteAxisDivisionMode: "crossLabels",
                    grid: {
                        visible: true
                    }
                },
                series: [
                    { valueField: "value", name: "Leads" },
                    { valueField: "number", name: "Customer" },
                ],
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center",
                    itemTextPosition: "bottom"
                },
                title: {
                    text: text_,
                },
                "export": {
                    enabled: true
                },
                tooltip: {
                    enabled: true,
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText
                        };
                    }
                }
            }).dxChart("instance");
        });

        // stop chart lead and customer

        // start chart quotation and contract

        function renderGraph_quotation (h) {
            $('.chart_line_quotation').show();
            $('.chart').show();
            $('.search_year_quotation').show();
            $('.search_year_lead').hide();
            $('.search_year_sum').hide();
            $('.chart_line').hide();
            $('.chart_bar').hide();
            $('.chart_target').hide();
            $('.chart_target_detail').hide();
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

            var dataSource_quotation = [];
            var text_ = '';
            var approved=0,_approved = 0;

            for (var i = 0; i < h.approved.length; i++) {
                approved += h.approved[i] << 0;
            }
            for (var x = 0; x < h._approved.length; x++) {
                _approved += h._approved[x] << 0;
            }

            var total_quotation = approved+_approved;
            var per = ((approved/total_quotation)*100).toFixed(2);

            $.each(h.approved, function (i,v) {
                        dataSource_quotation.push({type:month[i],value:v,number:h._approved[i]});
            });

            console.log(dataSource_quotation);
            text_ ="Quotation/Contract Ratio in " + Math.ceil(per) + "%";

            $('#chart_quotation').dxChart('instance').option('dataSource', dataSource_quotation);
            $('#chart_quotation').dxChart('instance').render();

            $('#reqs-per-second-quotation').dxCircularGauge('instance').option('value', Math.ceil(per));
            $('#reqs-per-second-quotation').dxCircularGauge('instance').render();

            $('#chart_quotation').dxChart('instance').option('title', text_);
            $('#chart_quotation').dxChart('instance').render();

            $('#per-line-quotation').html("Quotation/Contract Ratio in " + Math.ceil(per) + "%");
            $('#per_quotation').html(Math.ceil(per)+"%");
            $('#total_lead_quotation').html("Quotation Approved " + approved);
            $('#total_customer_quotation').html("Quotation Non-Approved " + _approved);
        }

        jQuery(document).ready(function($)
        {

            if( ! $.isFunction($.fn.dxChart))
                return;

            var gaugesPalette = ['#8dc63f', '#40bbea', '#ffba00', '#cc3f44'];

            // Requests per second gauge
            $('#reqs-per-second-quotation').dxCircularGauge({
                scale: {
                    startValue: 0,
                    endValue: 200,
                    majorTick: {
                        tickInterval: 50
                    }
                },
                rangeContainer: {
                    palette: 'pastel',
                    width: 3,
                    ranges: [
                        {
                            startValue: 0,
                            endValue: 50,
                            color: gaugesPalette[0]
                        }, {
                            startValue: 50,
                            endValue: 100,
                            color: gaugesPalette[1]
                        }, {
                            startValue: 100,
                            endValue: 150,
                            color: gaugesPalette[2]
                        }, {
                            startValue: 150,
                            endValue: 200,
                            color: gaugesPalette[3]
                        }
                    ],
                },
                value: per,
                valueIndicator: {
                    offset: 10,
                    color: '#2c2e2f',
                    spindleSize: 12
                }
            });
        });


        var dataSource_quotation = [];
        var text_ = '';
        var series_name =[];

        $(function(){
            $("#chart_quotation").dxChart({
                palette: "Violet",
                dataSource: dataSource_quotation,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "line"
                },
                margin: {
                    bottom: 20
                },
                argumentAxis: {
                    valueMarginsEnabled: false,
                    discreteAxisDivisionMode: "crossLabels",
                    grid: {
                        visible: true
                    }
                },
                series: [
                    { valueField: "value", name: "Quotation_Approved" },
                    { valueField: "number", name: "Quotation_Non_Approved" },
                ],
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center",
                    itemTextPosition: "bottom"
                },
                title: {
                    text: text_,
                },
                "export": {
                    enabled: true
                },
                tooltip: {
                    enabled: true,
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText
                        };
                    }
                }
            }).dxChart("instance");
        });

// stop chart quotation and contract

        //start chart bar quotation/contract
        function renderGraph_quotation_sum (h) {
            console.log(h._approved);
            $('.chart').show();
            $('.search_year_quotation').hide();
            $('.search_year_lead').hide();
            $('.search_year_sum').show();
            $('.chart_line').hide();
            $('.chart_bar').show();
            $('.chart_target').hide();
            $('.chart_target_detail').hide();
            $('.chart_line_quotation').hide();
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

            var dataSource_bar = [];
            var text_ = '';
            var approved=0,_approved = 0;

            for (var i = 0; i < h.approved.length; i++) {
                approved += h.approved[i] << 0;
            }
            for (var x = 0; x < h._approved.length; x++) {
                _approved += h._approved[x] << 0;
            }


            $.each(h.approved, function (i,v) {
                    var con_ = h._approved[i];
                    dataSource_bar.push({type:month[i],value:parseInt(v),number:parseInt(con_)});
            });

            //console.log(dataSource_bar);

            text_ ="Quotation/Contract";

            $('#chart_bar').dxChart('instance').option('dataSource', dataSource_bar);
            $('#chart_bar').dxChart('instance').render();

            $('#chart_bar').dxChart('instance').option('title', text_);
            $('#chart_bar').dxChart('instance').render();

        }


        var dataSource_bar = [];

        $(function(){
            $("#chart_bar").dxChart({
                dataSource: dataSource_bar,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "bar",
                    hoverMode: "allArgumentPoints",
                    selectionMode: "allArgumentPoints",
                    label: {
                        visible: true,
                        format: {
                            type: "fixedPoint",
                            precision: 0
                        }
                    }
                },
                series: [
                    { valueField: "value", name: "Quotation_Approved" },
                    { valueField: "number", name: "Quotation_Non_Approved" }
                ],
                title: text_,
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center"
                },
                "export": {
                    enabled: true
                },
                onPointClick: function (e) {
                    e.target.select();
                }
            });
        });

//stop chart bar quotation/contract

        //Start Tar Get Quotation_Contract
        function renderGraph_target (h) {
            $('.chart').hide();
            $('.search_year_lead').hide();
            $('.search_year_quotaion').hide();
            $('.search_year_sum').hide();
            $('.chart_line').hide();
            $('.chart_bar').hide();
            $('.chart_target').show();
            $('.chart_target_detail').show();
            $('.chart_line_quotation').hide();

            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

            var dataSource_target = [];

            var approved=0,_approved = 0;

            for (var i = 0; i < h.approved.length; i++) {
                approved += h.approved[i] << 0;
            }
            for (var x = 0; x < h._approved.length; x++) {
                _approved += h._approved[x] << 0;
            }

            $.each(h.approved, function (i,v) {
                    var con_ = h._approved[i];
                    dataSource_target.push({type:month[i],value:parseInt(v),number:parseInt(con_),target:parseInt(h._target[i])});
            });

            console.log(dataSource_target);

            $('#chart_target').dxChart('instance').option('dataSource', dataSource_target);
            $('#chart_target').dxChart('instance').render();

            $('#total_lead1').html("Quotation Approved " + numberWithCommas(approved) + "  บาท");
            $('#total_customer1').html("Quotation Non-Approved " + numberWithCommas(_approved) + "  บาท");

            //console.log(dataSource_target);
        }

        $(function(){
            $("#chart_target").dxChart({
                palette: "Violet",
                dataSource: dataSource_target,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "line"
                },
                margin: {
                    bottom: 20
                },
                argumentAxis: {
                    valueMarginsEnabled: false,
                    discreteAxisDivisionMode: "crossLabels",
                    grid: {
                        visible: true
                    }
                },
                series: [
                    { valueField: "value", name: "Quotation_Approved" },
                    { valueField: "target", name: "Goal",color: "#ff0000" },
                    { valueField: "number", name: "Quotation_Non-Approved" },
                ],
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center",
                    itemTextPosition: "bottom"
                },
                title: {
                    text: "Target Quotation/Contract",
                    subtitle: {
                        text: "(Millions of Tons, Oil Equivalent)"
                    }
                },
                "export": {
                    enabled: true
                },
                tooltip: {
                    enabled: true,
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText
                        };
                    }
                }
            }).dxChart("instance");
        });

        var dataSource_target = [];

//Stop Tar Get Quotation_Contract

    })









