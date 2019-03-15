@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">นำเข้าข้อมูลลูกค้า</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">ลูกค้า</a></li>
                <li class="active">
                    <strong>นำเข้าข้อมูลลูกค้า</strong>
                </li>
            </ol>
        </div>
    </div>

    @if(!empty($msg))
        <div class="row">
            <div class="alert alert-danger">
                <strong>เกิดข้อผิดพลาด!</strong> {!! $msg !!}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">นำเข้าข้อมูลลูกค้า</h3>
                </div>
                <div class="panel-body" id="landing-property-list">
                    {!! Form::model(null,array('url' => array('customer/import/add/customer'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="data_import" id="data_import" cols="50" rows="10" placeholder="ชื่อ,นามสกุล,เบอร์โทร,อีเมล์,ที่อยู่,id ของจังหวัด,รหัสไปรษณี,ชื่อบริษัท,id แหล่งที่มา,id ประเภท,id ของพนักงานขาย,tax_id"></textarea>
                        </div>
                    </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>--}}
                    <button type="submit" class="btn btn-primary change-active-status-btn">บันทึก</button>
                </div>
                {!!Form::close(); !!}
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('script')

    <script type="text/javascript" src="{{ url('/') }}/js/jquery-validate/jquery.validate.min.js"></script>

    <script>
        $(function(){
            $("#p_form").validate({
                rules: {
                    data_import  	: 'required'
                },
                errorPlacement: function(error, element) { element.addClass('error'); }
            });

            $('.change-active-status-btn').on('click', function () {
                if($("#p_form").valid()) {
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                    $("#p_form").submit();
                }
            });
        })
    </script>
    @endsection