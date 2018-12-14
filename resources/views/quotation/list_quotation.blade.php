@extends('base-admin')
@section('content')
    <?php
   /* $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
   //dd($quotation);
    ?>
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">ใบเสนอราคา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>Service</li>
                <li class="active">
                    <strong>ใบเสนอราคา</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($lead->role==1)
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
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {!!$lead->firstname ."   ". $lead->lastname!!} </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร :  {!!$lead->phone!!}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  {!!$lead->email!!}</label>
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($status->status ==0)
        <a href="{!!url('/service/quotation/add/'.$id.'/'.$ip=1)!!}" ><button type="button" class="btn btn-info  action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> สร้างใบเสนอราคาใหม่</button></a>
        <a href="{!!url('/service/quotation/success/'.$id)!!}" ><button type="button" class="btn btn-success action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-check"> </i>  ทำรายการเสร็จสิ้น</button></a>
    @else
        <a href="{!!url('/service/quotation/cancel/'.$id)!!}" ><button type="button" class="btn btn-danger action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-check"> </i>  ยกเลิกใบเสนอราคา</button></a>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ใบเสนอราคา</h3>
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div class="row" id="panel-package-list">
                                @foreach($quotation1 as $row)
                                    <div class="col-sm-4">
                                        <div class="well">
                                           <p>เลขที่ใบเสนอราคา :  {!!$row->quotation_code!!}</p>
                                            <p>Package : {!!$row->lastest_package->name!!}</p>
                                            <p>ราคาสุทธิ : {!! $row->product_price_with_vat !!}</p>
                                            <br>
                                            <div style="text-align: right;">
                                                {{--@if($row->status !=1)--}}
                                                {{--@if($row->remark == 0 AND $remark !=1)--}}
                                                <a href="{!! url('service/contract/sign/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                                                    <i class="fa-check"></i>
                                                </a>
                                                {{--@endif--}}

                                                {{--@if($row->remark == 1)
                                                <a href="{!! url('service/quotation/check_out/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-danger"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ยกเลิกใบเสนอราคา">
                                                   <i class="fa-close"></i>
                                                </a>--}}
                                                <a href="{!! url('service/quotation/print_quotation/'.$row->quotation_code) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา">
                                                    <i class="fa-print"></i>
                                                </a>
                                                    {{--@else--}}
                                                        <a href="{!! url('service/quotation/update/form/'.$row->quotation_code) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                                                            <i class="fa-pencil-square-o"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger view-member"  data-toggle="tooltip" data-placement="top" data-original-title="ลบ">
                                                            <i class="fa-trash"></i>
                                                        </a>
                                                {{--@endif--}}

                                                {{--@endif--}}
                                                    <a href="#" class="edit edit-service btn btn-info view-member"  data-toggle="modal" data-target="#edit-package" data-placement="top" data-original-title="{{ trans('messages.detail') }}" data-vehicle-id="{!!$row->quotation_code!!}" >
                                                        <i class="fa-eye"></i>
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--update --}}
    <div class="modal fade" id="edit-package">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">รายละเอียดใบเสนอราคา</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="service-content1" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">{{ trans('messages.loading') }}...</span>
                </div>
            </div>
        </div>
    </div>
    {{--end update --}}

@endsection
@section('script')
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-create-quotation.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/inputmask/jquery.inputmask.bundle.js')!!}"></script>
    <link rel="stylesheet" href="{!!url('/js/select2/select2.css')!!}">
    <link rel="stylesheet" href="{!!url('/js/select2/select2-bootstrap.css')!!}">
    <script type="text/javascript">

        $(function () {

            $('#unit-select').on('change',function () {
                checkUnitbalance($(this).val());
                $('.property-unit-id').html(
                    $('#unit-select').find(":selected").text()
                );
            });

            $('#create-invoice-btn').on('click',function (){
                var allGood = validateInputCreateForm_invoice()
                if($('#create-invoice-form').valid() && allGood ) {
                    $('#create-invoice-form').submit();
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                    //alert('GO');
                }
            });

            function validateInputCreateForm_invoice () {
                var valid = validateTransaction();
                if($('#for-unit').val() == 0 && $('#unit-select').val() =="0") {
                    valid = false;
                    $('#unit-selectSelectBoxIt').addClass('error');
                } else {
                    $('#unit-selectSelectBoxIt').removeClass('error');
                }
                return valid;
            }
        })

        //update
        $('#panel-package-list').on('click','.edit-service' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#service-content1').empty();
            $.ajax({
                url : $('#root-url').val()+"/service/quotation/detail",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#service-content1').html(r);
                },
                error : function () {

                }
            })
        });
        //end update

    </script>
@endsection