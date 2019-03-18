@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">แก้ไขข้อมูลลูกค้า</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Customer</a></li>
                <li class="active">
                    <strong>แก้ไขข้อมูลลูกค้า</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขข้อมูลลูกค้า</h3>
                </div>
                <div class="panel-body">
                    @if(Auth::user()->role !=2)
                        {!! Form::model(null,array('url' => array('customer/Customer_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                    @else
                        {!! Form::model(null,array('url' => array('customer/sales/Customer_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                    @endif

                        <div class="form-group">
                            <input type="hidden" name="customer_id" value="{!!$customer->id!!}">
                            <label class="col-sm-2 control-label">ชื่อ</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="firstname" id="firstname" type="text" required value="{!!$customer->firstname!!}">
                            </div>

                            <label class="col-sm-2 control-label">นามสกุล</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="lastname" type="text" required value="{!!$customer->lastname!!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">เบอร์โทร</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="phone" type="text" required value="{!!$customer->phone!!}">
                            </div>

                            <label class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="email" type="text" required value="{!!$customer->email!!}">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">แหล่งที่มา</label>
                            <div class="col-sm-4">
                                {!! Form::select('channel',unserialize(constant('LEADS_SOURCE')),$customer->channel,array('class'=>'form-control','required')) !!}
                            </div>

                            <label class="col-sm-2 control-label">ประเภท</label>
                            <div class="col-sm-4">
                                {!! Form::select('type',unserialize(constant('LEADS_TYPE')),$customer->type,array('class'=>'form-control','required')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">พนักงานขาย</label>
                            <div class="col-sm-4">
                                @if(Auth::user()->role !=2)
                                    <select name="sale_id" id="" class="form-control" required>
                                        <option value="">กรุณาเลือกพนักงานขาย</option>
                                        @foreach($sale as $srow)
                                            <?php
                                            $_select=$srow->id==$customer->sale_id?"selected":"";
                                            ?>
                                            <option value="{!!$srow->id!!}" {!! $_select !!}>{!!$srow->name!!}</option>
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

                            <label class="col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="address" type="text" required value="{!!$customer->address !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">จังหวัด</label>
                            <div class="col-sm-4">
                                <select name="province" id="" class="form-control">
                                    <option value="">กรุณาเลือกจังหวัด</option>
                                    @foreach($provinces as $row)
                                        <?php
                                        $province=$customer->province==$row->code?"selected":"";
                                        ?>
                                        <option value="{!!$row->code !!}" {!!$province !!}>{!!$row->name_th !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="postcode" type="text" required value="{!!$customer->postcode !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ชื่อบริษัท</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="company_name" type="text" required value="{!! $customer->company_name !!}">
                                <input class="form-control" name="sale_id" type="hidden" required value="{!! $customer->sale_id !!}">
                            </div>

                            <label class="col-sm-2 control-label">เลขประจำตัวผู้เสียภาษี</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="tax_id" type="text" required value="{!! $customer->tax_id !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="company_id" value="{!! $customer->company_id !!}">
                            <input type="hidden" name="role" value="{!! $customer->role !!}">
                        </div>

                        {{--@if(empty($customer->user_company->id))--}}
                                {{--@include('customer.user_company_form')--}}
                            {{--@else--}}
                                {{--@include('customer.user_company_edit')--}}
                        {{--@endif--}}
                            <div class="modal-footer">
                                <a href="{!! url('customer/customer/list') !!}"><button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button></a>
                                <button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
                            </div>
                            {!!Form::close(); !!}
                </div>
            </div>
        </div>
    </div>
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
        // Override

        $(function () {
            $("#sale_id1").select2({
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

        $(function () {
            $("#province_cm").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });


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
                postcode 	        : 'required',
                tax_id              : 'required'
            },
            errorPlacement: function(error, element) { element.addClass('error'); }
        });

        $('#change-active-status-btn').on('click', function () {
            if($("#p_form").valid()) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $("#p_form").submit();
            }
        });

        $(function () {
            $('.add_directer').on('click', function (e){
                e.preventDefault();
                var tRowTmp = [
                    '<tr class="item-row">',
                    '<input type="hidden" name="" value="" />',
                    '<td><input type="text" name="directer_company[]" value="" class="toValidate form-control input-sm tDesc"/></td>',
                    '<td><input type="hidden"></td>',
                    '<td><a class="btn btn-danger unit-card-delete-button action-item"><i class="fa-trash"></i></a></td>',
                    '</tr>'].join('');

                $('#itemsTable').append(tRowTmp);
            });

            $('body').on("click", '.unit-card-delete-button', function() {
                //alert('aaa');
                $(this).closest('tr.item-row').remove();
                return false;
            });

        });
    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection