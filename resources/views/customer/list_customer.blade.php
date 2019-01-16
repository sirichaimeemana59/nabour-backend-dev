@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">รายการลูกค้า</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Customer</a></li>
                <li class="active">
                    <strong>List Customer</strong>
                </li>
            </ol>
        </div>
    </div>

    {{-- //search --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.search') !!}</h3>
                </div>
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row">
                            {{--<div class="col-sm-3 block-input">--}}
                            {{--<input class="form-control" size="25" placeholder="รหัสลูกค้า" name="customer">--}}
                            {{--</div>--}}
                            <div class="col-sm-3 block-input">
                                <input class="form-control" size="25" placeholder="{!! trans('messages.name') !!}" name="name">
                            </div>

                            <div class="col-sm-3 block-input">
                                <input class="form-control" size="25" placeholder="ชื่อบริษัท" name="company_name">
                            </div>

                            {{--<div class="col-sm-3">--}}
                            {{--{!! Form::select('province', $provinces,null,['id'=>'property-province','class'=>'form-control']) !!}--}}
                            {{--</div>--}}

                            <div class="col-sm-3">
                                <select name="sale_id" id="" class="form-control" required>
                                    <option value="">กรุณาเลือกพนักงานขาย</option>
                                    @foreach($sale as $srow)
                                        <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                {!! Form::select('province', $provinces,null,['id'=>'property-province','class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                {!! Form::select('channel_id',unserialize(constant('LEADS_SOURCE')),null,array('class'=>'form-control','placeholder'=>'แหล่งที่มา')) !!}
                            </div>

                            <div class="col-sm-3">
                                {!! Form::select('type_id',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','placeholder'=>'ประเภท')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                @if(Auth::user()->role !=2)
                                    <button type="button" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>
                                @else
                                    <button type="button" class="btn btn-secondary p-search-property-sale">{!! trans('messages.search') !!}</button>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--end search--}}
    <button type="button" class="btn btn-info btn-primary action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> เพิ่ม Customer</button>

    {{--content--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">รายงานลูกค้า</h3>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('customer.list_customer_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}

    {{--insert--}}
    <div class="modal fade" id="modal-lead" role="dialog" >
        <div class="modal-dialog modal-lg" style="width: 85%; height: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">เพิ่ม Customer</h4>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->role !=2)
                        {!! Form::model(null,array('url' => array('customer/Customer_form/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                    @else
                        {!! Form::model(null,array('url' => array('customer/sales/Customer_form/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อ</label>
                        <div class="col-sm-4">
                            <input class="form-control" name="firstname" id="firstname" type="text" required>
                        </div>

                        <label class="col-sm-2 control-label">นามสกุล</label>
                        <div class="col-sm-4">
                            <input class="form-control" name="lastname" type="text" required>
                        </div>

                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">เบอร์โทร</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="phone" type="text" required>
                            </div>

                            <label class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="email" type="text" required>
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">แหล่งที่มา</label>
                        <div class="col-sm-4">
                            {!! Form::select('channel',unserialize(constant('LEADS_SOURCE')),null,array('class'=>'form-control','required')) !!}
                        </div>
                        <label class="col-sm-2 control-label">ประเภท</label>
                        <div class="col-sm-4">
                            {!! Form::select('type',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','required')) !!}
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">พนักงานขาย</label>
                            <div class="col-sm-4">
                                @if(Auth::user()->role !=2)
                                    <select name="sale_id" id="" class="form-control" required>
                                        <option value="">กรุณาเลือกพนักงานขาย</option>
                                        @foreach($sale as $srow)
                                            <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="sale_id" id="" class="form-control"  disabled="true">
                                        <option value="">กรุณาเลือกพนักงานขาย</option>
                                        @foreach($sale as $_srow)
                                            <?php
                                            $select=$_srow->id==Auth::user()->id?"selected":"";
                                            ?>
                                            <option value="{!!$_srow->id!!}" {!! $select !!}>{!!$_srow->name!!}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <input type="hidden" name="sales_status" value="0">
                            <label class="col-sm-2 control-label">ชื่อบริษัท</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="company_name" type="text" required>
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-4">
                            <input class="form-control" name="address" type="text" required>
                        </div>

                        <label class="col-sm-2 control-label">จังหวัด</label>
                        <div class="col-sm-4">
                            {!! Form::select('province', $provinces,null,['id'=>'property-province','class'=>'form-control']) !!}
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="postcode" type="text" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
                </div>
                {!!Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end insert--}}

    {{--update --}}
    <div class="modal fade" id="edit-customer" role="dialog" >
        <div class="modal-dialog modal-lg" style="width: 85%; height: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">แก้ไข Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="lead-content2" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">กำลังค้นหาข้อมูล...</span>
                </div>
            </div>
        </div>
    </div>
    {{--end update --}}

    {{--delete--}}
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ลบข้อมูล Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role !=2)
                                    {!! Form::model(null,array('url' => array('customer/Customer_form/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('customer/sales/Customer_form/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @endif
                                    <br>
                                <input type="hidden" name="id2" id="id2">
                                <div style="text-align: center;">
                                    <img src="https://cdn3.iconfinder.com/data/icons/tango-icon-library/48/edit-delete-512.png" alt="" width="50%">
                                    <br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" >ลบ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end delete--}}

    {{--cancel--}}
    <div class="modal fade" id="delete1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">คืนสถานะ Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                {!! Form::model(null,array('url' => array('customer/Customer_form/check'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                <br>
                                <input type="hidden" name="id3" id="id3">
                                <div style="text-align: center;">
                                    <img src="https://cdn1.iconfinder.com/data/icons/jetflat-multimedia-vol-4/90/0042_089_check_well_ready_okey-512.png" alt="" width="50%">
                                    <br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" >เปิดใช้</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end cancel--}}
@endsection

@section('script')
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/nabour-search-form.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
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

        $('.p-search-property').on('click',function () {
            propertyPage (1);
        });

        $('.p-search-property-sale').on('click',function () {
            propertyPageSale (1);
        });

        //update
        $('#panel-lead-list').on('click','.edit-customer' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#lead-content2').empty();
            //console.log();
            $.ajax({
                url : $('#root-url').val()+"/customer/list_update_customer",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#lead-content2').html(r);
                },
                error : function () {

                }
            })
        });
        //end update

        //update sale
        $('#panel-lead-list').on('click','.edit-customer-detail' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#lead-content2').empty();
            //console.log();
            $.ajax({
                url : $('#root-url').val()+"/customer/sales/list_update_customer",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#lead-content2').html(r);
                },
                error : function () {

                }
            })
        });
        //end update sale

        if($('#p_form').valid() && allGood ) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $('#p_form').submit();
        } else {
            var top_;
            if(!$('#p_form').valid()) top_ = $('.error').first().offset().top;
            else top_ = $('#prop_list').offset().top;
            $('html,body').animate({scrollTop: top_-100}, 1000);
        }

        function mate_del(id) {
            document.getElementById("id2").value = id;
        }

        function mate_del3(id) {
            document.getElementById("id3").value = id;
        }



        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/customer/customer/list",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

        function propertyPageSale (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/customer/sales/customer/list",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

    </script>
@endsection