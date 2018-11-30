@extends('base-admin')
@section('content')
    <script type='text/javascript' src='//code.jquery.com/jquery-1.11.0.js'></script>
    <script language="javascript">
        $(function() {

            $('#flag-exp-dt').click(function() {
                updateTotal();
            });

            $('#price').keyup(function() {
                updateTotal();
            });

            var updateTotal = function () {
                var price = parseInt($('#price').val());
                var vat = parseFloat(((price*7)/100) || 0).toFixed(2);
                var vat1 = parseFloat((price*7)/100);
                var total_vat = parseFloat((price + vat1) || 0).toFixed(2);


                $('#vat_value').val(vat);
                $('#vat').val(total_vat);

            };
        });
    </script>
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">เพิ่มค่าบริการ</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{!!trans('messages.page_home')!!}</a>
                </li>
                <li>Package</li>
                <li class="active">
                    <strong>เพิ่มค่าบริการ</strong>
                </li>
            </ol>
        </div>
    </div>

    <a href="#" data-toggle="modal" data-target="#add-officer-modal" class="action-float-right create-invoice-btn btn btn-primary">เพิ่มค่าบริการ</a>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-service-list">
                <div class="panel-heading">
                    <h3 class="panel-title">ค่าบริการของระบบ Nabour</h3>
                </div>
               @include('product.list_service_element')
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-officer-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">เพิ่มข้อมูลบริการ</h4>
                </div>
                {{--content--}}
                <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form">
                            {!! Form::model(null,array('url' => array('service/package/add_service'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
                            <br>
                            <?php
                            if(!empty($max_cus)){
                                $cut_c=substr($max_cus,2);
                                $sum_c=$cut_c+1;
                                $new_id="0000".$sum_c;
                                $count=strlen($new_id);
                                if($count>5){
                                    $count_c=$count-5;
                                    $cut_new_id=substr($new_id,$count_c);
                                    $cus="PK".$cut_new_id;
                                }else{
                                    $cus="PK".$new_id;
                                }
                            }else{
                                $cus="PK00001";
                            }
                            ?>
                            <input type="hidden" name="product_code" value="{!! $cus !!}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ชื่อบริการ</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="name" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">รายละเอียด</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="" cols="65" rows="9" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ราคา</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="price" id="price" type="text" required>
                                </div>
                            </div>
                            <input type="hidden" name="is_delete" value="0">
                            <input type="hidden" name="status" value="2">

                            <div class="form-group">
                                <label class="control-label col-sm-2">Vat 7 %</label>
                                <div class="col-sm-9">
                                    <input id="flag-exp-dt" value="1" type="checkbox" name="vat1" class="cbr cbr-turquoise">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-9 add-v-exp-dt" style="display:none;">
                                    Vat 7 % <input type="text" class="form-control"  name="vat_value" id="vat_value" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-9 add-v-exp-dt" style="display:none;">
                                    ราคาสุทธิ <input type="text" class="form-control" name="vat_total" id="vat" readonly>
                                </div>
                            </div>
                            <br>
                            {{--End content--}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
                    <button type="submit" class="btn btn-primary" name="submit" >บันทึก</button>
                </div>
                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>


    {{--update --}}
    <div class="modal fade" id="edit-service">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">แก้ไขข้อมูลบริการ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="service-content1" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">{!!trans('messages.loading')!!}...</span>
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
                    <h4 class="modal-title">ลบข้อมูลบริการ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                {!! Form::model(null,array('url' => array('service/package/delete_service'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                <br>
                                <input type="hidden" name="id2" id="id2">
                                <div style="text-align: center;">
                                    <img src="https://cdn3.iconfinder.com/data/icons/tango-icon-library/48/edit-delete-512.png" alt="" width="50%">
                                    <br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
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

    {{--open--}}
    <div class="modal fade" id="delete_open">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">เปิดใช้ข้อมูลบริการ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                {!! Form::model(null,array('url' => array('service/package/delete_service_open'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                <br>
                                <input type="hidden" name="id3" id="id3">
                                <div style="text-align: center;">
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-ui-elements-16/117/correct-512.png" alt="" width="45%">
                                    <br><br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" >เปิดใช้งาน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-vehicle.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-search-form.js')!!}"></script>
    <script type="text/javascript">
        // Override
        function validateForm () {
            $("#p_form").validate({
                rules: {
                    name    : 'required',
                    detail    : 'required',
                },
                errorPlacement: function(error, element) { element.addClass('error'); }
            });
        }


        function mate_del(id) {
            document.getElementById("id2").value = id;
        }

        function mate_open(id) {
            document.getElementById("id3").value = id;
        }

        //update
        $('#panel-service-list').on('click','.edit-service' ,function (){
            var id = $(this).data('vehicle-id');
            $('.v-loading').show();
            $('#service-content1').empty();
            $.ajax({
                url : $('#root-url').val()+"/service/list_update_service",
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


        $('#flag-exp-dt').on('click',function () {
            if($(this).is(':checked')) {
                $('.add-v-exp-dt').show();
            } else {
                $('.add-v-exp-dt').hide();
            }
        });
    </script>
@endsection