@extends('base-admin')
@section('content')
    <?php
    /* $lang = App::getLocale();
     $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    //dd($quotation);
    ?>
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">เอกสารสัญญา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>Service</li>
                <li class="active">
                    <strong>เอกสารสัญญา</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($quotation1->latest_sale->role==1)
                        <h3 class="panel-title">รายละเอียด Lead</h3>
                    @else
                        <h3 class="panel-title">รายละเอียด Customer</h3>
                    @endif
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {!!$quotation1->latest_lead->firstname ."   ". $quotation1->latest_lead->lastname!!} </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร :  {!!$quotation1->latest_lead->phone!!}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  {!!$quotation1->latest_lead->email!!}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  {!!$quotation1->latest_sale->name!!}</label>
                            </div>
                            <div class="form-group">
                                <?php
                                //dd($quotation1);
                                $price=$quotation1->grand_total_price==0?$quotation1->grand_total_price:$quotation1->product_price_with_vat;
                                ?>
                                <label class="col-sm-6 control-label" for="field-1">ราคาสุทธิ :  {!!$price!!}</label>
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-info btn-primary action-float-right" href="{!! url('service/contract/sign/quotation/'.$contract->id.'/'.$contract->latest_quotation->id) !!}" target="_blank"><i class="fa fa-print"> </i> พิมพ์เอกสารสัญญา</a>
    {{--content--}}
    @if(Auth::user()->role !=2)
            {!! Form::model($contract,array('url' => array('service/contract/sign/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
        @else
            {!! Form::model($contract,array('url' => array('service/sales/contract/sign/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขข้อมูลสัญญา</h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">&ndash;</span>
                            <span class="expand-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">เลขที่สัญญา</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="{!! $contract->id !!}">
                            <input class="form-control" name="contract_code" type="text" readonly value="{!! $contract->contract_code !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="quotation_id" type="text" readonly value="{!! $contract->latest_quotation->quotation_code !!}">
                            <input class="form-control" name="quotation_id1" type="hidden" readonly value="{!! $contract->quotation_id !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ประเภทสัญญา</label>
                        <div class="col-sm-10">
                            {!! Form::select('contract_type',unserialize(constant('CONTRACT_TYPE')),null,array('class'=>'form-control','required','value'=>'1')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปแบบการชำระเงิน</label>
                        <div class="col-sm-10">
                            {!! Form::select('payment_term_type',unserialize(constant('PAYMENT_TERM_TYPE')),null,array('class'=>'form-control','required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">วันที่ทำสัญญา</label>
                        <div class="col-sm-10">
                            <input class="form-control datepicker" data-language="th" data-format="yyyy-mm-dd" name="start_date" type="text" required value="{!! $contract->start_date !!}" >
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label class="col-sm-2 control-label">ระยะเวลาสัญญา</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="contract[contract_length]">
                                <option value="1">1 เดือน</option>
                                <option value="2">2 เดือน</option>
                                <option value="3">3 เดือน</option>
                                <option value="4">4 เดือน</option>
                                <option value="5">5 เดือน</option>
                                <option value="6">6 เดือน</option>
                                <option value="7">7 เดือน</option>
                                <option value="8">8 เดือน</option>
                                <option value="9">9 เดือน</option>
                                <option value="10">10 เดือน</option>
                                <option value="11">11 เดือน</option>
                                <option value="12">1 ปี</option>
                            </select>
                        </div>
                    </div>--}}
                    {{--<div class="form-group">
                        <label class="col-sm-2 control-label">แพ็กเกจ</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="contract[package]">
                                <option value="">กรุณาเลือก Package</option>
                                --}}{{--@foreach($package as $pac)--}}{{--
                                --}}{{--<option value="{{$pac->id}}">{{$pac->name}}</option>--}}{{--
                                --}}{{--@endforeach--}}{{--
                            </select>
                        </div>
                    </div>--}}
                    {{-- <div class="form-group">
                         <label class="col-sm-2 control-label">ระยะเวลาแถมฟรี</label>
                         <div class="col-sm-10">
                             <select class="form-control" name="contract[free]"><option value="0">ไม่มีการแถม</option><option value="1">1 เดือน</option><option value="2">2 เดือน</option><option value="3">3 เดือน</option><option value="4">4 เดือน</option><option value="5">5 เดือน</option><option value="6">6 เดือน</option><option value="7">7 เดือน</option><option value="8">8 เดือน</option><option value="9">9 เดือน</option><option value="10">10 เดือน</option><option value="11">11 เดือน</option><option value="12">1 ปี</option></select>
                         </div>
                     </div>--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">วันที่สิ้นสุดสัญญา</label>
                        <div class="col-sm-10">
                            <input class="form-control datepicker" data-language="th" required data-format="yyyy-mm-dd" name="end_date" type="text" value="{!! $contract->end_date !!}" >
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label class="col-sm-2 control-label">วันที่ส่งมอบข้อมูล login</label>
                        <div class="col-sm-10">
                            <input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_delivery_date]" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">วันที่ใช้งานจริง</label>
                        <div class="col-sm-10">
                            <input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_used_date]" type="text">
                        </div>
                    </div>--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ผู้ทำสัญญา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="person_name" type="text" required value="{!! $contract->person_name !!}" >
                        </div>
                    </div>
                    <input type="hidden" name="sales_id" value="{!! $quotation1->sales_id !!}">
                    <input type="hidden" name="customer_id" value="{!! $quotation1->lead_id !!}">
                    <input type="hidden" name="price" value="{!! $price !!}">

                    {{--@foreach ($max_cus as $row)--}}
                    <?php
                    if(!empty($max_cus)){
                        $cut_c=substr($max_cus,2);
                        $sum_c=$cut_c+1;
                        $new_id="0000".$sum_c;
                        $count=strlen($new_id);
                        if($count>5){
                            $count_c=$count-5;
                            $cut_new_id=substr($new_id,$count_c);
                            $cus="NB".$cut_new_id;
                        }else{
                            $cus="NB".$new_id;
                        }
                    }else{
                        $cus="NB00001";
                    }
                    ?>
                    {{--@endforeach--}}
                    {{--{{$cus}}--}}
                    {{--<input type="text" name="contract[customer_id]" value="{{$cus}}">--}}
                    {{--<div class="form-group">
                        <label class="col-sm-2 control-label">ข้อมูลเพิ่มเติม</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="contract[remark]" cols="50" rows="10"></textarea>
                        </div>
                    </div>--}}

                    <div style="text-align: right">
                        <button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
         <div class="col-sm-12">
             <div class="panel panel-default text-right">
                 <a class="btn btn-gray" href="{{url('root/admin/property/list')}}">Cancel</a>
                 {!! Form::button('Create Property',['class'=>'btn btn-primary','id'=>'submit-form']) !!}
             </div>
         </div>
     </div>--}}
    {!! Form::close(); !!}
    {{--endcontent--}}

@endsection
@section('script')
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-vehicle.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-search-form.js')!!}"></script>
    <script type="text/javascript">
        // Override
        function validateForm () {
            $("#p_form").validate({
                rules: {
                    name_lead    : 'required',
                    detail_lead  : 'required',
                },
                errorPlacement: function(error, element) { element.addClass('error'); }
            });
        }

        if($('#p_form').valid() ) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $('#p_form').submit();
        } else {
            var top_;
            if(!$('#p_form').valid()) top_ = $('.error').first().offset().top;
            else top_ = $('#prop_list').offset().top;
            $('html,body').animate({scrollTop: top_-100}, 1000);
        }
    </script>
@endsection