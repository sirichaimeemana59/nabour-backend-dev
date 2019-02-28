@extends('base-admin')
@section('content')
    @if(!empty($count_test))
    <div class="row">
        <div class="alert alert-danger">
            <strong>เกิดข้อผิดพลาด!</strong> หลักฐานการชำระเงินของคุณเกินจำนวนที่ระบบกำหนดให้คือ 3 จำนวน กรุณาตรวจสอบ
        </div>
    </div>
    @endif
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

    <div class="detail-invoice">
        <div class="row" style="text-align:center;">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ข้อมูลใบเสร็จ</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                {!! Form::open(array('url'=>['root/admin/upload_file/receipt/file/submit'],'method'=>'post','class'=>'form-horizontal','id'=>'upload-receipt')) !!}
                                {{--{!! Form::hidden('id-invoice',null,array('id'=>'id-invoice')) !!}--}}
                                <div class="row" style="margin: 15px;">
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>เลขที่ใบเสร็จ</b></div>
                                        <div class="col-sm-8 receipt-no" style="text-align: left;"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>เรื่อง</b></div>
                                        <div class="col-sm-8 receipt-name" style="text-align: left;"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>จำนวนเงิน</b></div>
                                        <div class="col-sm-8" style="text-align: left;"><span class="receipt-amount"></span> บาท</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>ประเภทการชำระเงิน</b></div>
                                        <div class="col-sm-8 payment-type" style="text-align: left;"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>ประเภทใบเสร็จ</b></div>
                                        <div class="col-sm-8 receipt-type" style="text-align: left;"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>โครงการ</b></div>
                                        <div class="col-sm-8 property-name" style="text-align: left;"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4" style="text-align: left;"><b>หมายเลขที่พักอาศัย</b></div>
                                        <div class="col-sm-8 property-unit" style="text-align: left;"></div>
                                    </div>
                                    {{--<div class="row com-sm-4">--}}
                                        {{--<button class="btn-info btn-primary btn-lg" type="submit">บันทึก</button>--}}
                                        {{--<button class="btn-info btn-warning btn-lg" type="reset">ยกเลิก</button>--}}
                                    {{--</div>--}}
                                    <br>
                                    {{--<div class="preview-img">--}}
                                        <div class="img img-thumbnail"></div>
                                    {{--<div class="preview-img">show</div>--}}
                                    {{--</div>--}}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
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
                                            <input type="hidden" name="count" id="count">

                                    </div>
                                    </div>
                                </div>
                                <div class="row com-sm-4">
                                    <button class="btn-info btn-primary btn-lg save-show" type="submit">บันทึก</button>
                                    {{--<button class="btn-info btn-warning btn-lg save-show" type="reset">ยกเลิก</button>--}}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete-img">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">คุณแน่ใจหรือไม่ ? ในการลบหลักฐานการชำระเงิน</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                <form method="post" action="{!! url('root/admin/receipt/delete/image') !!}">
                                <br>
                                <div style="text-align: center;">
                                    <div class="delete-zone"></div>
                                    <div class="file-id"></div>
                                    <div class="url-img" style="text-align: center;"></div>
                                    <br>
                                    <button class="btn-info btn-primary btn-lg" type="submit">ลบ</button>
                                    <button class="btn-info btn-warning btn-lg" type="reset" data-dismiss="modal">ยกเลิก</button>
                                    {{--<button type="button" class="close btn-info btn-warning btn-lg" data-dismiss="modal" style="text-align: left;">ยกเลิก</button>--}}
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--End Model Delete--}}

    @endsection
@section('script')
    <script type="text/javascript" src="{!!url('/')!!}/js/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/nabour-upload-file.js"></script>
            <script type="text/javascript" src="{{url('/')}}/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
            <script type="text/javascript" src="{{url('/')}}/js/nabour-onload-receipt-view.js?v=<?php echo time(); ?>"></script>
            <link rel="stylesheet" href="{{url('/')}}/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript">
        $(function(){
            $('.upload_bill').hide();
            $('.detail-invoice').hide();

            $('.test').on('click',function(){
                var data = $('#prevews').val();
                console.log(data);
            })

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
                var root = $('#root-url').val();
                    $.ajax({
                        url : $('#root-url').val()+"/root/admin/search/receipt",
                        type : 'post',
                        dataType: 'json',
                        data : ({'id':id}),
                        success: function (r) {

                            if(r != 2){
                                $('.alert-danger').hide();
                                $('.upload_bill').show();
                                $('.detail-invoice').show();
                                $('.receipt-name').html(r.name);
                                $('.receipt-no').html(r.receipt_no);
                                $('.receipt-amount').html(r.grand_total);
                                $('.property-name').html(r.property.property_name_th);
                                $('.property-unit').html(r.to);
                                $('.payment-type').html(r.payment_label);
                                $('.receipt-type').html(r.receipt_type);

                                $('.img').html('');
                                $.each(r.invoice_file, function (i,val) {

                                    imgAppend = $('<img>').attr({'src':"{{ env('URL_S3') }}"+/bills/+val.url+val.name,'width':'80px'});

                                    $entry = $('<div>').attr({'class':'preview-img-item'}).append(
                                        $('<a>').attr({'href':"{{ env('URL_S3') }}"+/bills/+val.url+val.name,'class':'thumb gallery','rel':'gal-1'}).html(
                                            $('<img>').attr({'src':"{{ env('URL_S3') }}"+/bills/+val.url+val.name,'width':'80px','class':'img-thumbnail'}),
                                        ),
                                        $('<span>').attr({'class':'remove-img-preview remove-file','data-e-id':val.name,'data-e-url':val.url,'data-file-id':val.id,'data-e-type':'event-file'}).html('x'));
                                    $('.img').append($entry);
                                    // $('.preview-img').html(link)


                                //console.log(i.length());

                                });
                                $('#count').val(r.invoice_file.length);

                                //console.log();

                                $('.img-thumbnail').on("click",".remove-file", function(e) {
                                    e.preventDefault();
                                    var id = $(this).data('e-id');
                                    var url = $(this).data('e-url');
                                    var model = $(this).data('e-type');
                                    var file_id = $(this).data('file-id');
                                    //alert(id);
                                    $('#delete-img').modal('show');
                                    imgAppend = $('<img>').attr({'src':"{{ env('URL_S3') }}"+/bills/+url+id,'width':'180px'});
                                     $('.delete-zone').html('<input type="hidden" name="delete_img['+model+'][]" value="'+id+'" />');
                                     $('.file-id').html('<input type="hidden" name="file-id" value="'+file_id+'" />');
                                     $('.url-img').html(imgAppend);
                                });

                            }else{
                                alert('ไม่พบใบแจ้งหนี้เลขที่ : '+id);
                                $('.upload_bill').hide();
                                $('.detail-invoice').hide();
                                //$('.search-receipt').show();
                            }
                            b.button('reset');
                        },
                        error : function () {
                            alert('ไม่พบใบแจ้งหนี้เลขที่ : '+id);
                            b.button('reset');
                            $('.upload_bill').hide();
                            $('.detail-invoice').hide();
                        }
                    })
            }
        });
    </script>

    @endsection