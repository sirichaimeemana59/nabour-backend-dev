    <style>
        .options {
            padding: 20px;
            background-color: rgba(191, 191, 191, 0.15);
            margin-top: 20px;
        }

        .option {
            margin-top: 10px;
        }

        .caption {
            font-size: 18px;
            font-weight: 500;
        }

        .option > span {
            margin-right: 10px;
        }

        .option > .dx-widget {
            display: inline-block;
            vertical-align: middle;
        }
        #chart_bar {
            height: 440px;
        }
    </style>

    <div class="row search_year_lead" style="display: none">
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row" style="align: left;">
                            <label class="col-sm-9 control-label">ปี</label>
                                <div class="col-sm-2">
                                    <select name="year" id="" class="form-control">
                                       @foreach($year as $key => $value)
                                            <option value="{!! $value !!}">{!! $value !!}</option>
                                       @endforeach
                                    </select>
                                </div>
                            {{--<button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>--}}
                            <button type="button" class="btn btn-secondary p-search-property-chart" id="p-search-property-chart">{!! trans('messages.search') !!}</button>
                        </div>
                    </form>
                </div>
    </div>

    <div class="row search_year_quotation" style="display: none">
        <div class="panel-body search-form">
            <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                <div class="row" style="align: left;">
                    <label class="col-sm-9 control-label">ปี</label>
                    <div class="col-sm-2">
                        <select name="year" id="" class="form-control">
                            @foreach($year as $key => $value)
                                <option value="{!! $value !!}">{!! $value !!}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--<button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>--}}
                    <button type="button" class="btn btn-secondary p-search-quotation-chart" id="p-search-quotation-chart">{!! trans('messages.search') !!}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row search_year_sum" style="display: none">
        <div class="panel-body search-form">
            <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                <div class="row" style="align: left;">
                    <label class="col-sm-9 control-label">ปี</label>
                    <div class="col-sm-2">
                        <select name="target" id="" class="form-control">
                            @foreach($year as $key => $value)
                                <option value="{!! $value !!}">{!! $value !!}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--<button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>--}}
                    <button type="button" class="btn btn-secondary p-search-quotation-sum-year" id="p-search-quotation-sum-year">{!! trans('messages.search') !!}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default chart_bar" style="display: none;">
        <div class="panel-body">
            <div class="row">
                <div class="dx-viewport demo-container">
                    <div id="chart_bar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default chart_line" style="display: none;">
        <div class="panel-heading">
            <span id="per"></span>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-2">
                    <p class="text-medium">Detail.</p>
                    <div class="col-sm-12">
                        <p class="text-lg"><span id="total_lead">0</span></p>
                    </div>
                    <div class="col-sm-12">
                        <p class="text-lg"><span id="total_customer">0</span></p>
                    </div>
                    <br><br><br><br><br><br>
                    <div class="text-secondary" id="per_" style="color: #1bc634;font-size: 45px;">0</div>
                </div>
                <div class="col-sm-2">
                    <div id="reqs-per-second" style="height: 150px;"></div>
                </div>
                <div class="col-sm-8">
                    <div id="chart"></div>
                    {{--<div id="types"></div>--}}
                </div>
            </div>

        </div>
    </div>

    {{--chart Quotation/contract--}}
    <div class="panel panel-default chart_line_quotation" style="display: none;">
        <div class="panel-heading">
            <span id="per-line-quotation"></span>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-2">
                    <p class="text-medium">Detail.</p>
                    <div class="col-sm-12">
                        <p class="text-lg"><span id="total_lead_quotation">0</span></p>
                    </div>
                    <div class="col-sm-12">
                        <p class="text-lg"><span id="total_customer_quotation">0</span></p>
                    </div>
                    <br><br><br><br><br><br>
                    <div class="text-secondary" id="per_quotation" style="color: #1bc634;font-size: 45px;">0</div>
                </div>
                <div class="col-sm-2">
                    <div id="reqs-per-second-quotation" style="height: 150px;"></div>
                </div>
                <div class="col-sm-8">
                    <div id="chart_quotation"></div>
                    {{--<div id="types"></div>--}}
                </div>
            </div>

        </div>
    </div>






