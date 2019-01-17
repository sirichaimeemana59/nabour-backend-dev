@extends('blank')
@section('content')

    <?php
    $channel1=unserialize(constant('LEADS_SOURCE'));
    $type1=unserialize(constant('LEADS_TYPE'));
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        /*.table-border {color: black; border-collapse: collapse; solid-opacity: 1;}*/
    </style>

    <tr>
        <td colspan="5" style="text-align:center;font-weight: bold;"><h3>สถิติการเปลี่ยนจาก Leads เป็นลูกค้า</h3></td>
    </tr>

    <tr>
        <td colspan="5" style="text-align:center;">
            @if(!empty($from))
                <h4 class="panel-title">ผลการค้นหาระหว่างวันที่ {!! localDate($from) !!}  ถึง  {!! localDate($to) !!}</h4>
            @endif

            @if(!empty($channel))
                <h4 class="panel-title">ผลการค้นหาจากแหล่งที่มา :
                    @foreach ($channel1 as $key => $value)
                        @if($channel == $key)
                            {!! $value !!}
                        @endif
                    @endforeach
                </h4>
            @endif

            @if(!empty($type))
                <h4 class="panel-title">ผลการค้นหาจากประเภท :
                    @foreach ($type1 as $key => $value)
                        @if($type == $key)
                            {!! $value !!}
                        @endif
                    @endforeach
                </h4>
            @endif
        </td>
    </tr>

    <table style="border-collapse: collapse;solid:1px; color: black;">
        <thead>
        <tr>
            <th style="text-align: center">เลขที่</th>
            <th style="text-align: center">วันที่สร้าง</th>
            <th style="text-align: center">ชื่อ - สกุล</th>
            <th style="text-align: center">สถานะ</th>
            <th style="text-align: center">พนักงานขาย</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $count=0;
        ?>
        @foreach($p_rows as $row)
            <tr>
                <td style="text-align: center;">{!! $i !!}</td>
                <td>{!! localDate($row->created_at) !!}</td>
                <td>{!! $row->firstname !!}  {!! $row->lastname !!}</td>
                <?php
                $status_=$row->role==1?"Customer":"Leads";
                if($row->role==1){
                    $count++;
                }
                ?>
                <td>{!! $status_ !!}</td>
                <td>{!! $row->latest_sale->name !!}</td>
            </tr>
            <?php
            $i++;
            ?>
        @endforeach
        <tr>
            <td colspan="3" style="font-weight: bold; text-align: right;">รวม</td>
            <td style="font-weight: bold; text-align: right;">{!! $i-1 !!}</td>
            <td style="font-weight: bold;">คน</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; text-align: right;">เป็นลูกค้า</td>
            <td style="font-weight: bold; text-align: right;">{!! $count !!}</td>
            <td style="font-weight: bold;">คน</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; text-align: right;">คิดเป็น</td>
            <td style="font-weight: bold; text-align: right;">{!! number_format(($count/$i)*100,2) !!}</td>
            <td style="font-weight: bold; text-align: left">%</td>
        </tr>
        </tbody>
    </table>

@endsection
