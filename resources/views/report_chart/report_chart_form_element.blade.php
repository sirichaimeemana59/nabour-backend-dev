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
    </style>

    <script>

        </script>
    <?php
//    $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
//    $month_count = count($month);
//    for ($i=1;$i<=$month_count;$i++){
//        echo "{
//                                country: $month[$i],
//                                leads: 59.8,
//                                customer: 937.6,
//                            }";
//    }
    ?>
    <div class="row">
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

    <div class="panel panel-default">
        <div class="panel-heading">
            Leads/Customer Ratio in <span id="per"></span>%
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-2">
                    <p class="text-medium">Detail.</p>
                    <div class="col-sm-12">
                        <p class="text-lg">Total Leads is. <span id="total_lead">0</span></p>
                    </div>
                    <div class="col-sm-12">
                        <p class="text-lg">Total Customer is. <span id="total_customer">0</span></p>
                    </div>
                    <br><br><br>
                    <div class="text-secondary" id="per_" style="color: #1bc634;font-size: 55px;">0</div>
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


