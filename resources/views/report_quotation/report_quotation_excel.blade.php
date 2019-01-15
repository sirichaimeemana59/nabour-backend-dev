@extends('excel')
@section('content')
    <?php
//    $vehicle_type = unserialize(constant('VEHICLE_TYPE_'.strtoupper(App::getLocale())));
    ?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, td, th {
            border: 1px solid black;
        }
        td{
            text-align: right;
            font-size: 16px;
        }
        .head{
            text-align: center;
            font-size: 18px;
        }
    </style>
    <tr>
        <td colspan="5" style="text-align:center;font-size:20px">รายงานยานพาหนะ</td>
    </tr>
    <table class="table table-bordered table-striped">
        <tr>
            <th style="text-align: center;">ชื่อ - สกุล</th>
            <th style="text-align: center;">ใบเสนอราคา</th>
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
                <td style="text-align: right;">{!! $row->count !!} ใบ</td>
                <td style="text-align: right;">{!! number_format($row->sum_total,2) !!} บาท</td>
                <td style="text-align: right;">{!! number_format($row->sum_vat,2) !!} บาท</td>
                <td style="text-align: right;">{!! number_format($row->sum,2) !!} บาท</td>
            </tr>
            <?php
            $total += $row->sum;
            ?>
        @endforeach
        <tr>
            <td colspan="4" style="font-weight: bold;">รวมสุทธิ</td>
            <td style="text-align: right; font-weight: bold;">{!! number_format($total,2) !!} บาท</td>
        </tr>
    </table>
@endsection



