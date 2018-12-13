<?php
    //dump($quotation->toArray());
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">บริการ</h3>
            </div>
            <div class="panel-body">
                <div class="tab-pane active" id="member-list">
                    <div id="member-list-content">
                        {{--content--}}
                        <div class="form-group">
                            <table class="table table-hover">
                                <tr>
                                    <th>บริการ</th>
                                    <th>โครงการ</th>
                                    <th>จำนวนหน่วย</th>
                                    <th>ราคา</th>
                                    <th>รวม</th>
                                </tr>
                                <?php
                                    $_total=0;
                                ?>
                            @foreach($quotation_service as $row)
                                    <tr>
                                        <td>{!! $row->lastest_package->name !!}</td>
                                        <td style="text-align: center;">{!! number_format($row->project_package,0)!!}</td>
                                        <td style="text-align: center;">{!! number_format($row->month_package,0)!!}</td>
                                        <td style="text-align: center;">{!! number_format($row->unit_package,0)!!}</td>
                                        <td style="text-align: center;">{!! number_format($row->total_package,0)!!}</td>
                                    </tr>
                                <?php
                                    $_total += $row->total_package;
                                    ?>
                            @endforeach
                                <tr>
                                    <td colspan="4" style="font-weight: bold;">รวม</td>
                                    <td style="text-align: center;">{!! number_format($_total,2) !!}</td>
                                </tr>
                            </table>
                        </div>
                        {{--endcontent--}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{--///////////////////////--}}

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Package</h3>
            </div>
            <div class="panel-body">
                <div class="tab-pane active" id="member-list">
                    <div id="member-list-content">
                        {{--content--}}
                        <div class="form-group">
                            <table class="table table-hover">
                                <tr>
                                    <th>Package</th>
                                    <th>โครงการ</th>
                                    <th>เดือน</th>
                                    <th>ราคา</th>
                                    <th>รวม</th>
                                </tr>
                                <?php
                                $total=0;
                                $discount=0;
                                $vat=0;
                                ?>
                                @foreach($quotation as $row)
                                    <tr>
                                        <td width="55%">{!! $row->lastest_package->name !!}</td>
                                        <td style="text-align: center;">{!! number_format($row->product_amount,0)!!}</td>
                                        <td style="text-align: center;">{!! number_format($row->month_package,0)!!}</td>
                                        <?php
                                            $price=$row->lastest_package->price_with_vat!=0?$row->lastest_package->price_with_vat:$row->lastest_package->price;
                                            $sum_package=$price*$row->product_amount*$row->month_package;
                                            ?>
                                        <td style="text-align: center;">{!! number_format($price,0)!!}</td>
                                        <td style="text-align: center;">{!! number_format($sum_package,0)!!}</td>
                                    </tr>
                                    <?php
                                    $total += $row->product_price_with_vat;
                                    $discount +=$row->discount;
                                    $vat +=$row->product_vat;
                                    ?>
                                @endforeach
                                <tr>
                                    <td colspan="4" style="font-weight: bold;">รวม</td>
                                    <td style="text-align: center;">{!! number_format($sum_package,2) !!}</td>
                                </tr>
                            </table>
                        </div>
                        {{--endcontent--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--///////////////////--}}
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">รวมค่าบริการ</h3>
            </div>
            <div class="panel-body">
                <div class="tab-pane active" id="member-list">
                    <div id="member-list-content">
                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sub Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sub_total" id="sub_total" readonly value="{!!number_format($_total+$sum_package,2)!!}">
                                </div>
                            </div>
                                <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Discount</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="discount" id="discount" readonly type="text" value="{!! $discount !!}">
                                </div>
                            </div>
                                <br>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Vat 7%</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="vat" id="vat" type="text" readonly value="{!! number_format($vat,2)  !!}">
                                </div>
                            </div>
                                <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Grand Total</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="grand_total" id="grand_total1" type="text" readonly value="{!! number_format($_total+$sum_package+$vat,2)  !!}">
                                    <br>
                                    {{--<input type="text" name="test" id="test">--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
