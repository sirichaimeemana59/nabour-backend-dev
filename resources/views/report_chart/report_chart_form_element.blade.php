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

    <div class="panel panel-default chart-none" style="display: none; text-align: center;">
        <div class="panel-body">
            <div class="row">
                {!! trans('messages.feesBills.not_found_report') !!}
            </div>
        </div>
    </div>







