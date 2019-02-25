@extends('base-admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">อัพโหลดหลักฐานการชำระเงิน</h3>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="field-1">Id ใบเสร็จรับเงิน</label>
                            <div class="col-sm-4">
                                {!! Form::text('id',null,array('class'=>'form-control', 'id'=>'receipt_id')) !!}
                            </div>
                            <div class="col-sm-2 text-left">
                                {{--<button type="button" class="btn btn-primary upload" data-toggle="modal" data-target="#upload-receipt">อัพโหลดไฟล์</button>--}}
                                <button type="button" class="btn btn-primary search-receipt">ค้นหาใบเสร็จ</button>
                            </div>
                        </div>

                    </div>

                        {{--<div class="col-sm-6 text-right">--}}
                            {{--<button type="button" class="btn btn-danger remove-receipt" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Retriving data">ลบใบเสร็จ</button>--}}
                        {{--</div>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="upload_bill">
    <div class="row" style="text-align:center;">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แนบหลักฐานการชำระเงิน</h3>
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                {!! Form::open(array('url'=>['root/admin/upload_file/receipt/file/submit'],'method'=>'post','class'=>'form-horizontal','id'=>'upload-receipt')) !!}
                                {!! Form::hidden('id-invoice',null,array('id'=>'id-invoice')) !!}
                                <div class="form-group">
                                    <div class="row col-sm-12" style="margin-top: 25px;">
                                        <span id="attachment"><i class="fa fa-camera"></i> {{ trans('messages.feesBills.attach_evidence') }}</span>
                                        {{--<div class=" field-hint">{{ trans('messages.upload_file_description') }}</div>--}}
                                        <div id="previews">
                                    </div>
                                    </div>
                                </div>
                                <div class="row com-sm-4">
                                    <button class="btn-info btn-primary btn-lg save-show" type="submit">บันทึก</button>
                                    <button class="btn-info btn-warning btn-lg save-show" type="reset">ยกเลิก</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('script')
    <script type="text/javascript" src="{!!url('/')!!}/js/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/nabour-upload-file.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.upload_bill').hide();
            //$('.save-show').hide();

                $('.search-receipt').on('click', function () {
                    var id = $('#receipt_id').val();
                    $('#id-invoice').val(id);
                    var b =$(this);
                    b.button('loading');
                    //console.log(id);
                    //alert(id);
                    $('#status-action').val('retrieve');
                    retriveData(id,b);
                    //$('.search-receipt').show();
                });

            function retriveData (id,b) {
                //alert(b);
                    $.ajax({
                        url : $('#root-url').val()+"/root/admin/search/receipt",
                        type : 'post',
                        dataType: 'json',
                        data : ({'id':id}),
                        success: function (r) {
                            //console.log(r);
                            if(r == 1){
                                $('.upload_bill').show();
                               // $('.search-receipt').hide();
                            }else{
                                alert('ไม่พบใบแจ้งหนี้เลขที่ : '+id);
                                $('.upload_bill').hide();
                                //$('.search-receipt').show();
                            }
                            b.button('reset');
                        },
                        error : function () {
                            alert('ไม่พบใบแจ้งหนี้เลขที่ : '+id);
                            b.button('reset');
                            $('.upload_bill').hide();
                        }
                    })
            }
        });
    </script>

    @endsection