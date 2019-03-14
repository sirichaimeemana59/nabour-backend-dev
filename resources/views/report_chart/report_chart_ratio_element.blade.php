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

<div class="panel panel-default lead">

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <p class="text-medium">Detail.</p>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_lead_ratio">0</span></p>
                </div>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_customer_ratio">0</span></p>
                </div>
                <br><br><br><br><br><br>
                <div class="text-secondary" id="per_ratio" style="color: #1bc634;font-size: 45px;">0</div>
            </div>
            <div class="col-sm-2">
                <div id="reqs-per-second-ratio" style="height: 150px;"></div>
            </div>
            <div class="col-sm-8">
                <div id="chart_ratio"></div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default chart-none-lead" style="display: none; text-align: center;">
    <div class="panel-body">
        <div class="row">
            {!! trans('messages.feesBills.not_found_report') !!}
        </div>
    </div>
</div>
{{--stop lead/customer ratio--}}

{{--start quotation/contract ratio--}}
<div class="panel panel-default quotation">
    <div class="panel-heading">
        <span id="per"></span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <p class="text-medium">Detail.</p>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_quotation_app">0</span></p>
                </div>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_quotation_nonapp">0</span></p>
                </div>
                <br><br><br><br><br><br>
                <div class="text-secondary" id="per_quotation" style="color: #1bc634;font-size: 45px;">0</div>
            </div>
            <div class="col-sm-2">
                <div id="reqs-per-second-quotation" style="height: 150px;"></div>
            </div>
            <div class="col-sm-8">
                <div id="chart_quotation_ratio"></div>
                {{--<div id="types"></div>--}}
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default chart-none-quotation" style="display: none; text-align: center;">
    <div class="panel-body">
        <div class="row">
            {!! trans('messages.feesBills.not_found_report') !!}
        </div>
    </div>
</div>
{{--stop quotation/contract ratio--}}

{{--start quotation/contract ratio bar--}}
<div class="panel panel-default quotation-bar">
    <div class="panel-heading">
        <span id="per"></span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="dx-viewport demo-container">
                            <div id="chart_bar_ratio"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default chart-none-quotation-bar" style="display: none; text-align: center;">
    <div class="panel-body">
        <div class="row">
            {!! trans('messages.feesBills.not_found_report') !!}
        </div>
    </div>
</div>
{{--stop quotation/contract ratio bar--}}

{{--start target quotation ratio--}}
<form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
    <div class="row">
        <label class="col-sm-3 control-label">ราคา :</label>
        <div class="col-sm-2">
            <select name="target_ratio" id="" class="form-control" required>
                <option value="">Budget</option>
                @for($i=10000;$i<=9000000;$i+=10000)
                    <option value="{!! $i !!}">{!! number_format($i) !!}</option>
                @endfor
            </select>
        </div>

        <label class="col-sm-1 control-label">ปี</label>
        <div class="col-sm-2">
            <select name="year_target" id="" class="form-control" required>
                <option value="">กรุณาเลือกปี</option>
                @foreach($year as $key => $value)
                    <?php
                    $date=date("Y-m-d");
                    $cut_year=explode("-",$date);
                    $new_year=$cut_year[0]+543;
                    $select=$value==$new_year?"selected":"";
                    ?>
                    <option value="{!! $value !!}"{!! $select !!}>{!! $value !!}</option>
                @endforeach
            </select>
        </div>

        <button type="button" class="btn btn-secondary p-search-budget-ratio" id="p-search-budget-ratio">{!! trans('messages.search') !!}</button>
    </div>
</form>

<div class="panel panel-default">
    <div class="panel-heading">
        {{--<span id="per-ratio-lead"></span>--}}
    </div>
    <br>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <p class="text-medium">Detail.</p>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_target_leads"></span></p>
                </div>
                <div class="col-sm-12">
                    <p class="text-lg"><span id="total_target_customer"></span></p>
                </div>
            </div>
            <div class="col-sm-8">
                <div id="chart_ratio_target"></div>
                {{--<div id="types"></div>--}}
            </div>
        </div>
    </div>
</div>
{{--stop target quotation ratio--}}

<div class="panel panel-default chart-none" style="display: none; text-align: center;">
    <div class="panel-body">
        <div class="row">
            {!! trans('messages.feesBills.not_found_report') !!}
        </div>
    </div>
</div>








































































































































































































































