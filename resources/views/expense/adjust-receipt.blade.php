@extends('base-admin')
@section('content')
@if ($message = Session::pull('message'))
    <div class="alert alert-{{ Session::pull('class') }} alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
@endif
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขข้อมูลใบสำคัญจ่าย</h3>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="field-1">Id ใบสำคัญจ่าย</label>
                            <div class="col-sm-4">
                                {!! Form::text('id',Request::old('id'),array('class'=>'form-control', 'id'=>'receipt_id')) !!}
                            </div>
                            <div class="col-sm-2 text-left">
                                <button type="button" class="btn btn-primary search-receipt">ค้นหาใบสำคัญจ่าย</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="bill-block">
    <div class="row">
        <div class="col-sm-12">
            <div id="form-content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            กรุณาระบุ id ของใบสำคัญจ่ายและกดปุ่มค้นหา
                        </div>
                    </div>
                </div>
            </div>     
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" src="{{ url('/') }}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/datepicker/bootstrap-datepicker.th.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/number.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/inputmask/jquery.inputmask.bundle.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/js/select2/select2.css">
<link rel="stylesheet" href="{{ url('/') }}/js/select2/select2-bootstrap.css">
    <script type="text/javascript">
        $(function(){
                $('.search-receipt').on('click', function () {
                    var id = $('#receipt_id').val();
                    $('#id-invoice').val(id);
                    var b =$(this);
                    b.button('loading');
                    $('#status-action').val('retrieve');
                    retriveData(id,b);
                });
                
            $('body').on('click','#create-receipt-btn',function (){
                var payValid = validatePayment();
                var allGood = validateTransaction();
                var validBank = checkBankPayment();
                if($('#create-receipt-form').valid() && allGood && payValid && validBank) {
                    $('#create-receipt-form').submit();
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                }
            });

            function retriveData (id,b) {
                $.ajax({
                    url : $('#root-url').val()+"/root/admin/edit/expense",
                    type : 'post',
                    dataType: 'html',
                    data : ({'id':id}),
                    success: function (r) {
                        $('#form-content').html(r);
                        $('#bill-block').show();
                        //b.button('reset');
                    },
                    complete:function () {
                        b.button('reset');
                    }
                })
            }
            
        });
    </script>

    @endsection