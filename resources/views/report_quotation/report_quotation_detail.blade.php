@extends('base-admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">รวมยอดสุทธิใบเสนอราคา</h3>
            </div>
            <div class="panel-body">
                <div class="tab-pane active" id="member-list">
                    <div id="member-list-content">
                        {{--content--}}
                        <div class="form-group">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="text-align: center;">ชื่อ - สกุล</th>
                                    <th style="text-align: center;">รวม</th>
                                    <th style="text-align: center;">VAT</th>
                                    <th style="text-align: center;">รวมสุทธิ</th>
                                </tr>
                                <?php
                                    $total =0;
                                ?>
                                @foreach($quotation as $row)
                                    <tr>
                                        <td>{!! $row->latest_lead->firstname !!}  {!! $row->latest_lead->lastname !!}</td>
                                        <td style="text-align: right;">{!! number_format($row->sum_total,2) !!} บาท</td>
                                        <td style="text-align: right;">{!! number_format($row->sum_vat,2) !!} บาท</td>
                                        <td style="text-align: right;">{!! number_format($row->sum,2) !!} บาท</td>
                                    </tr>
                                    <?php
                                        $total += $row->sum;
                                    ?>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="font-weight: bold;">รวมสุทธิ</td>
                                    <td style="text-align: right; font-weight: bold;">{!! number_format($total,2) !!} บาท</td>
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
@endsection
