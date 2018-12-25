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
                                    <td style="text-align: right;">{!! number_format($_total,2) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="font-weight: bold;">ส่วนลด</td>
                                    <td style="text-align: right;">{!! number_format($quotation->discount,2) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="font-weight: bold;">Vat</td>
                                    <td style="text-align: right;">{!! number_format($quotation->product_vat,2)!!}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="font-weight: bold;">รวมสุทธิ์</td>
                                    <td style="text-align: right;">{!! number_format($quotation->product_price_with_vat,2)!!}</td>
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
