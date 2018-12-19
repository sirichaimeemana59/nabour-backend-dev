@extends('base-admin')
@section('content')
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

            function searchPage (page) {
                var data = $('form').serialize()+'&page='+page;
                $('#panel-q-list').css('opacity','0.6');
                $.ajax({
                    url     : $('#root-url').val()+"/sales/quotation/list",
                    data    : data,
                    dataType: "html",
                    method: 'post',
                    success: function (h) {
                        $('#panel-q-list').html(h);
                        $('#panel-q-list').css('opacity','1');
                    }
                })
            }
        })
    </script>

    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection