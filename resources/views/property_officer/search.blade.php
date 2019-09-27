@extends('base-admin')
@section('content')
{{--    @if(!empty($count_test))--}}
{{--        <div class="row">--}}
{{--            <div class="alert alert-danger">--}}
{{--                <strong>เกิดข้อผิดพลาด!</strong> หลักฐานการชำระเงินของคุณเกินจำนวนที่ระบบกำหนดให้คือ 3 จำนวน กรุณาตรวจสอบ--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขค่าน้ำ</h3>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::model(null,array('url' => array('/root/admin/edit/bill_water_form'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                            <label class="col-sm-4 control-label" for="field-1">Id Property</label>
                            <div class="col-sm-4">
                                {!! Form::text('id',null,array('class'=>'form-control', 'id'=>'receipt_id')) !!}
                            </div>
                            <div class="col-sm-2 text-left">
                                {{--<button type="button" class="btn btn-primary upload" data-toggle="modal" data-target="#upload-receipt">อัพโหลดไฟล์</button>--}}
                                <button type="submit" class="btn btn-primary">ค้นหาใบเสร็จ</button>
                            </div>
                        </div>
                        {!! Form::close(); !!}
                    </div>

                    {{--<div class="col-sm-6 text-right">--}}
                    {{--<button type="button" class="btn btn-danger remove-receipt" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Retriving data">ลบใบเสร็จ</button>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
        @endsection
        @section('script')
            <script type="text/javascript" src="{!!url('/')!!}/js/dropzone/dropzone.min.js"></script>
            <script type="text/javascript" src="{{url('/')}}/js/nabour-upload-file.js"></script>
            <script type="text/javascript" src="{{url('/')}}/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
            <script type="text/javascript" src="{{url('/')}}/js/nabour-onload-receipt-view.js?v=<?php echo time(); ?>"></script>
            <link rel="stylesheet" href="{{url('/')}}/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
            <script type="text/javascript">
                $(function(){
                    $('body').on('click','.search-receipt',function(){
                        var id = $('#receipt_id').val();
                        $.ajax({
                            url : $('#root-url').val()+'/root/admin/edit/bill_water',
                            type : 'post',
                            data : ({'id':id}),
                            dataType : 'html',
                            success:function(e){

                            },error:function(){

                            }
                        })
                    });
                });
            </script>

@endsection
