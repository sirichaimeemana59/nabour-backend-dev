@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">ใบสัญญา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>Service</li>
                <li class="active">
                    <strong>รายการใบสัญญา</strong>
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
                                <input class="form-control" size="25" placeholder="เลขที่สัญญา" name="c_no">
                            </div>

                            <div class="col-sm-3">
                                <input class="form-control" size="25" placeholder="ชื่อบริษัท" name="c_id">
                            </div>

                            <div class="col-sm-6 text-right">
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
                    <h3 class="panel-title">รายการใบสัญญา</h3>
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div id="panel-c-list">
                                @include('contract.list-element-sales')
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            $("#sale_id,#c_id").select2({
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

            function searchPage (page) {
                var data = $('form').serialize()+'&page='+page;
                $('#panel-c-list').css('opacity','0.6');
                $.ajax({
                    url     : $('#root-url').val()+"/sales/contract/list",
                    data    : data,
                    dataType: "html",
                    method: 'post',
                    success: function (h) {
                        $('#panel-c-list').html(h);
                        $('#panel-c-list').css('opacity','1');
                        //$('[data-toggle="tooltip"]').tooltip();
                        //cbr_replace();
                    }
                })
            }
        })
    </script>

    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection