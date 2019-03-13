@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">รายการ Lead</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Leads</a></li>
                <li class="active">
                    <strong>List Leads</strong>
                </li>
            </ol>
        </div>
    </div>

    {{-- //search --}}
    {{--{!! Auth::user()->role !!}--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.search') !!}</h3>
                </div>
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-3 block-input">
                                <input class="form-control" size="25" placeholder="{!! trans('messages.name') !!}" name="name">
                            </div>

                            <div class="col-sm-3">
                                <select name="sale_id" id="sale_id" class="form-control" required>
                                    <option value="">กรุณาเลือกพนักงานขาย</option>
                                    @foreach($sale as $srow)
                                        <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                {!! Form::select('status_leads',unserialize(constant('status_leads')),null,array('class'=>'form-control','required')) !!}
                            </div>

                            <div class="col-sm-3">
                                {!! Form::select('type_property',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','required')) !!}
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                @if(Auth::user()->role !=2)
                                    <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                    <button type="button" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>
                                @else
                                    <button type="reset" class="btn btn-white reset-s-btn1">{!! trans('messages.reset') !!}</button>
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
    <button type="button" class="btn btn-info btn-primary action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> เพิ่ม Lead</button>

    {{--content--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">รายงาน Lead</h3>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('lead.list_lead_element')
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
                    <h4 class="modal-title">เพิ่ม Lead</h4>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->role ==2)
                        {!! Form::model(null,array('url' => array('customer/sales/Lead_form/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                    @else
                        {!! Form::model(null,array('url' => array('customer/Lead_form/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
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
                                    <select name="sale_id" id="sale_id1" class="form-control" required>
                                        <option value="">กรุณาเลือกพนักงานขาย</option>
                                        @foreach($sale as $srow)
                                            <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="sale_id" id="sale_id2" class="form-control"  disabled="true">
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
                            <select name="province" id="province" class="form-control" required>
                                <option value="">กรุณาเลือกจังหวัด</option>
                                @foreach($provinces as $row)
                                    <option value="{!!$row->code!!}">{!!$row->name_th!!}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="edit-lead" role="dialog" >
        <div class="modal-dialog modal-lg" style="width: 85%; height: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">แก้ไข Lead</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="lead-content1" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">กำลังค้นหาข้อมูล...</span>
                </div>
            </div>
        </div>
    </div>
    {{--end update --}}

    {{--view --}}
    <div class="modal fade" id="view-lead" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">รายละเอียด Lead</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="lead-view" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">กำลังค้นหาข้อมูล...</span>
                </div>
            </div>
        </div>
    </div>
    {{--end view --}}

    {{--view sales--}}
    <div class="modal fade" id="view-lead-sales" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">รายละเอียด Lead</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="view-leadsales" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">กำลังค้นหาข้อมูล...</span>
                </div>
            </div>
        </div>
    </div>
    {{--end view sales--}}

    {{--delete--}}
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ลบข้อมูล Lead</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role ==2)
                                    {!! Form::model(null,array('url' => array('customer/sales/Lead_form/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('customer/Lead_form/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}

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

    {{--Note--}}
    <div class="modal fade" id="note">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">บันทึกการติดตามผล</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role ==2)
                                    {!! Form::model(null,array('url' => array('customer/sales/Lead_form/note'),'class'=>'form-horizontal','id'=>'note')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('customer/Lead_form/note'),'class'=>'form-horizontal','id'=>'note')) !!}

                                @endif
                                <br>
                                <input type="hidden" name="note_id" id="note_id">
                                <div style="text-align: center;">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">หมายเหตุ</label>
                                        <div class="col-sm-4">
                                            <textarea name="note_detail" id="note_detail" cols="50" rows="10" required></textarea>
                                        </div>
                                    </div>
                                    <br><br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg save-note" name="submit" >บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end note--}}


    {{--Demo Property_sales--}}
    <div class="modal fade" id="demo_sale">
        {!! Form::open(['url'=>'sales/property/assign','class'=>'form-horizontal','id'=>'assign-demo-form']) !!}
        {!! Form::hidden('lead_id', null, array('id' => 'lead_id')) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-paper-plane"></i> ส่งข้อมูลให้นิติบุคคลทดลองใช้งาน </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">ชื่อผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('name',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">ชื่อหมู่บ้าน/โครงการ</label>
                                <div class="col-md-8">
                                    <select name="property" id="property_id" class="form-control" required>
                                        <option value="">กรุณาเลือกนิติบุคคล</option>
                                        @foreach($property as &$prow)
                                            <option value="{!! $prow->property['id'] !!}">{!! $prow->property['property_name_th']." ".$prow->property['property_name_en'] !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">อีเมลผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('email',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">เบอร์โทรผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('tel',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="botton" class="btn btn-default" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                    <button type="botton" class="btn btn-primary click-load" id="">{!! trans('messages.save') !!}</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    {{--end Demo Property_sales--}}

    @if(Auth::user()->role !=2)
    {{--Demo Property--}}
    <div class="modal fade" id="demo">
        {!! Form::open(['url'=>'admin/property/assign','class'=>'form-horizontal','id'=>'assign-demo-form1']) !!}
        {!! Form::hidden('lead_id', null, array('id' => 'lead_id1')) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-paper-plane"></i> ส่งข้อมูลให้นิติบุคคลทดลองใช้งาน </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">ชื่อผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('name',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">ชื่อผู้ติดต่อนิติบุคคลทดลองใช้</label>
                                <div class="col-md-8">{!! Form::text('property_test_name',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">ชื่อหมู่บ้าน/โครงการ</label>
                                <div class="col-md-8">
                                    <select name="property" id="property_id1" class="form-control" required>
                                        <option value="">กรุณาเลือกนิติบุคคล</option>
                                        @foreach($property_demo as &$_prow)
                                            <option value="{!! $_prow->property['id'] !!}">{!! $_prow->property['property_name_th']." ".$_prow->property['property_name_en'] !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">อีเมลผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('email',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="control-label col-md-4">เบอร์โทรผู้ติดต่อ</label>
                                <div class="col-md-8">{!! Form::text('tel',null,['class'=>'form-control']) !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="botton" class="btn btn-default" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                    <button type="botton" class="btn btn-primary click-load" id="">{!! trans('messages.save') !!}</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    {{--end Demo Property--}}
    @endif
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
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript">

        $("#p_form").validate({
            rules: {
                firstname  	: 'required',
                lastname 	: 'required',
                phone 	    : 'required',
                email 	    : 'required',
                channel  	: 'required',
                type 	    : 'required',
                sale_id 	        : 'required',
                company_name 	    : 'required',
                address 	        : 'required',
                province  	        : 'required',
                postcode 	        : 'required'
            },
            errorPlacement: function(error, element) { element.addClass('error'); }
        });

        $("#note").validate({
            rules: {
                note_detail        : 'required'
            },
            errorPlacement: function(error, element) { element.addClass('error'); }
        });

        $('#change-active-status-btn').on('click', function () {
            if($("#p_form").valid()) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $("#p_form").submit();
            }
        });

        $('.save-note').on('click', function () {
            if($("#note").valid()) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $("#note").submit();
            }
        });

        $(function () {
            $("#property_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#property_id1").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#sale_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#sale_id1").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#sale_id2").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#province").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

            $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
                var data_id = '';
                if (typeof $(this).data('id') !== 'undefined') {

                    data_id = $(this).data('id');
                    //console.log(data_id);
                }

                $('#lead_id').val(data_id);
                $('#lead_id1').val(data_id);
            });


        $(function () {
            $("#property_id1").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#property_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#province_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $("#province_id_sale").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

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

        $('.reset-s-btn').on('click',function () {
           $(this).closest('form').find("input").val("");
           $(this).closest('form').find("select option:selected").removeAttr('selected');
            propertyPage (1);
        });

        $('.reset-s-btn1').on('click',function () {
           $(this).closest('form').find("input").val("");
           $(this).closest('form').find("select option:selected").removeAttr('selected');
           propertyPageSale (1);
        });

        //update
        $('#panel-lead-list').on('click','.edit-lead' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#lead-content1').empty();
            //console.log();
            $.ajax({
                url : $('#root-url').val()+"/customer/list_update_lead",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#lead-content1').html(r);
                },
                error : function () {

                }
            })
        });
        //end update

        //update sale
        $('#panel-lead-list').on('click','.edit-lead-detail' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#lead-content1').empty();
            //console.log();
            $.ajax({
                url : $('#root-url').val()+"/customer/sales/list_update_lead",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#lead-content1').html(r);
                },
                error : function () {

                }
            })
        });
        //end update sale

        function mate_del(id) {
            document.getElementById("id2").value = id;
        }

        // function mate_demo_sale(lead_id,sales_id) {
        //     document.getElementById("lead_id").value = lead_id;
        //     document.getElementById("sales_id").value = sales_id;
        // }

        function mate_demo(lead_id,sales_id) {
            document.getElementById("lead_id1").value = lead_id;
            document.getElementById("sales_id1").value = sales_id;
        }

        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/customer/leads/list",
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
                url     : $('#root-url').val()+"/customer/sales/leads/list",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

        $('.note').on('click',function(){
            var id = $(this).data('id');
            var note_detail =  $(this).data('detail');
           //alert(id);
            $('#note_id').val(id);
            $('#note').modal('show');
            $('#note_detail').val(note_detail);
        })


        $('#panel-lead-list').on('click','.view',function (){
            var id = $(this).data('id');
            $('.v-loading').show();
            $('#lead-view').empty();
            //console.log(5555);
            $.ajax({
                url    : $('#root-url').val()+"/customer/view/detail/leads",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#lead-view').html(r);
                },
                error : function () {

                }
            })
        });

        $('#panel-lead-list').on('click','.view_sales',function (){
            //alert('aaa');
            var id = $(this).data('id');
            $('.v-loading').show();
            $('#view-leadsales').empty();
            //console.log(4444);
            $.ajax({
                url    : $('#root-url').val()+"/customer/view/detail/leads/sales",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#view-leadsales').html(r);
                },
                error : function () {

                }
            })
        });
    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection