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
                <li class="active">
                    <strong>ใบเสนอราคา</strong>
                </li>
            </ol>
        </div>
    </div>

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
                                <input class="form-control" size="25" placeholder="เลขที่ใบเสนอราคา" name="q_no">
                            </div>

                            <div class="col-sm-3">
                                <select name="leads_id" id="leads_id" class="form-control" required>
                                    <option value="">รายชื่อ Leads</option>
                                    @foreach($customers as $row)
                                        <option value="{!! $row['id'] !!}">{!! $row['firstname']." ".$row['lastname'] !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <select name="sale_id" id="sale_id" class="form-control" required>
                                    <option value="">พนักงานขาย</option>
                                    @foreach($sales as $key => $row)
                                        <option value="{!! $key !!}">{!! $row !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3 text-right">
                                <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                <button type="button" class="btn btn-secondary" id="submit-search">{!! trans('messages.search') !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">รายการใบเสนอราคา</h3>
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            <div id="panel-q-list">
                                @include('quotation.list-element')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view-quotaion">
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
                                {{--@if(Auth::user()->role ==2)--}}
                                    {{--{!! Form::model(null,array('url' => array('service/sales/quotation/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}--}}
                                {{--@else--}}
                                    {!! Form::model(null,array('url' => array('service/quotation/delete'),'class'=>'form-horizontal','id'=>'p_form')) !!}

                                {{--@endif--}}
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

    {{--Check--}}
    <div class="modal fade" id="check">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ยกเลิกการลบใบเสนอราคา</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role ==2)
                                    {!! Form::model(null,array('url' => array('service/sales/quotation/check'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('service/quotation/check'),'class'=>'form-horizontal','id'=>'p_form')) !!}

                                @endif
                                <br>
                                <input type="hidden" name="id3" id="id3">
                                <div style="text-align: center;">
                                    <img src="https://cdn1.iconfinder.com/data/icons/jetflat-multimedia-vol-4/90/0042_089_check_well_ready_okey-512.png" alt="" width="50%">
                                    <br><br><br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" >ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end Check--}}

@endsection
@section('script')
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <link rel="stylesheet" href="{!!url('/js/select2/select2.css')!!}">
    <link rel="stylesheet" href="{!!url('/js/select2/select2-bootstrap.css')!!}">
    <script type="text/javascript">
        $(function () {
            $("#sale_id,#leads_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });

            $('#submit-search').on('click',function (){
                searchPage(1);
            });

            $('#search-form').on('keydown', function(e) {
                if(e.keyCode == 13) {
                    e.preventDefault();
                    searchPage (1);
                }
            });

            $('.reset-s-btn').on('click',function () {
                $(this).closest('form').find("input").val("");
                $(this).closest('form').find("select option:selected").removeAttr('selected');
                searchPage (1);
            });

            $('.panel-body').on('click','.paginate-link', function (e){
                e.preventDefault();
                searchPage($(this).attr('data-page'));
            });

            $('.panel-body').on('change','.paginate-select', function (e){
                e.preventDefault();
                searchPage($(this).val());
            });

            $('#panel-q-list').on('click','.view-quotation' ,function (){
                var id = $(this).data('q-id');
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
                        $(window).resize();
                    },
                    error : function () {

                    }
                })
            });

            function searchPage (page) {
                var data = $('form').serialize()+'&page='+page;
                $('#panel-q-list').css('opacity','0.6');
                $.ajax({
                    url     : $('#root-url').val()+"/quotation/list",
                    data    : data,
                    dataType: "html",
                    method: 'post',
                    success: function (h) {
                        $('#panel-q-list').html(h);
                        $('#panel-q-list').css('opacity','1');
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                })
            }
        })
        function mate_del(id) {
            document.getElementById("id2").value = id;
        }

        function mate_check(id) {
            document.getElementById("id3").value = id;
        }
    </script>

    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection