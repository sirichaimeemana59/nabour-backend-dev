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

        @if(Auth::user()->role !=2 )
                <a href="{!!url('/customer/service/quotation/add/'.$id.'/'.$ip=1)!!}" ><button type="button" class="btn btn-info  action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> สร้างใบเสนอราคาใหม่</button></a>
            @else
                <a href="{!!url('/customer/service/sales/quotation/add/'.$id.'/'.$ip=1)!!}" ><button type="button" class="btn btn-info  action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> สร้างใบเสนอราคาใหม่</button></a>
        @endif
        {{--<a href="{!!url('/service/quotation/success/'.$id)!!}" ><button type="button" class="btn btn-success action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-check"> </i>  ทำรายการเสร็จสิ้น</button></a>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ใบเสนอราคา</h3>
                </div>


                <table class="table table-bordered table-striped" id="panel-package-list">
                    <thead>
                    <tr>
                        <th width="120px">เลขที่ใบเสนอราคา</th>
                        <th width="120px">เอกสารสัญญา</th>
                        <th width="200px">นิติบุคคล</th>
                        <th width="120px">ราคาสุทธิ</th>
                        <th width="60px">สถานะ</th>
                        <th width="110px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotation1 as $row)
                        <tr>
                            <td>{!! $row->quotation_code !!}</td>
                            @if(!empty($row->latest_contract->contract_code))
                                    <td>{!! $row->latest_contract->contract_code !!}</td>
                                @else
                                    <td>ไม่พบข้อมูล</td>
                            @endif
                            <?php
                            $price=$row->product_price_with_vat!=null?$row->product_price_with_vat:$row->grand_total_price
                            ?>

                            @if(!empty($row->latest_contract->property_id))
                                <td>{!!$row->latest_contract->latest_property->property_name_th !!}</td>
                            @else
                                <td>ไม่พบข้อมูล</td>
                            @endif

                            <td class="text-right">{!! number_format($price,2) !!}</td>
                            @if(!empty($row->latest_contract->status))
                                    @if($row->latest_contract->status ==1)
                                        <td>เซ็นสัญญาแล้ว</td>
                                    @endif
                                @else
                                    <td>ยังไม่เซ็นสัญญา</td>
                            @endif
                            <td class="action-links">
                                @if(empty($row->latest_contract->quotation_id) AND $count_ <1)
                                    @if(Auth::user()->role !=2)
                                        <a href="{!! url('customer/service/contract/sign/form/'.$row->id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                                            @else
                                                <a href="{!! url('customer/service/sales/contract/sign/form/'.$row->id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                                                    @endif
                                                    <i class="fa-check"></i>
                                                </a>
                                                @else
                                                    @if(Auth::user()->role !=2)
                                                        <a href="{!! url('customer/service/contract/sign/form/'.$row->id.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                                                            <i class="fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a href="{!! url('customer/service/sales/contract/sign/form/'.$row->id.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                                                            <i class="fa-eye"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                                @if(Auth::user()->role !=2)
                                                    <a href="{!! url('service/quotation/print_quotation/'.$row->id) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา" target="_blank">
                                                        <i class="fa-print"></i>
                                                    </a>
                                                @else
                                                    <a href="{!! url('service/sales/quotation/print_quotation/'.$row->id) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา" target="_blank">
                                                        <i class="fa-print"></i>
                                                    </a>
                                                @endif
                                                @if(empty($row->latest_contract->quotation_id))
                                                    @if(Auth::user()->role !=2)
                                                        <a href="{!! url('customer/service/quotation/update/form/'.$row->id) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                                                            @else
                                                                <a href="{!! url('customer/service/sales/quotation/update/form/'.$row->id) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                                                                    @endif
                                                                    <i class="fa-pencil-square-o"></i>
                                                                </a>
                                                            @endif

                                                            @if(empty($row->latest_contract->quotation_id))
                                                                <a href="#" class="view-quotation btn btn-danger" data-toggle="modal" data-target="#delete" data-placement="top" title="ลบใบเสนอราคา" onclick="mate_del('{!!$row->id!!}','{!! $row->lead_id !!}')" >
                                                                    <i class="fa-trash"></i>
                                                                </a>
                                                            @endif

                                                            <?php
                                                            if(Auth::user()->role !=2){
                                                                $class='edit-service';
                                                            }   else{
                                                                $class='edit-service-detail';
                                                            }
                                                            ?>

                                                            <a href="#" class="edit {!! $class !!} btn btn-info view-member"   data-toggle="modal" data-target="#edit-package" data-placement="top" title="{{ trans('messages.detail') }}" data-vehicle-id="{!!$row->quotation_code!!}" >
                                                                <i class="fa-eye"></i>
                                                            </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

    {{--delete--}}
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ลบใบเสนอราคา</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role ==2)
                                        {!! Form::model(null,array('url' => array('service/sales/quotation/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                    @else
                                        {!! Form::model(null,array('url' => array('service/quotation/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @endif
                                <br>
                                    <input type="hidden" name="id2" id="id2">
                                    <input type="hidden" name="page" id="page">
                                    <input type="hidden" name="lead_id" id="lead_id">
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

        //detail
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
        //end detail

        //detail sales
        $('#panel-package-list').on('click','.edit-service-detail' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#service-content1').empty();
            $.ajax({
                url : $('#root-url').val()+"/service/sales/quotation/detail",
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
        //end detail sales

        function mate_del(id,lead_id) {
            document.getElementById("id2").value = id;
            document.getElementById("page").value = 1;
            document.getElementById("lead_id").value = lead_id;
        }

    </script>
@endsection