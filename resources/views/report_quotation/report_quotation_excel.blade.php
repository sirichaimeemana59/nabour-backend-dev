@extends('blank')
@section('content')

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <tr>
        <td colspan="5" style="text-align: center;font-weight: bold;"><h3>รายงานใบเสนอราคาที่ออกจากระบบ</h3></td>
    </tr>
    <table>
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
            <td colspan="4" style="font-weight: bold;text-align: right;">รวมสุทธิ</td>
            <td style="text-align: right; font-weight: bold;">{!! number_format($total,2) !!} บาท</td>
        </tr>
    </table>
@endsection
