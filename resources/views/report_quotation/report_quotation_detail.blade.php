@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">รวมยอดสุทธิใบเสนอราคา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Quotation</a></li>
                <li class="active">
                    <strong>List Quotation</strong>
                </li>
            </ol>
        </div>
    </div>

    {{-- //search --}}
    {{--{!! Auth::user()->role !!}--}}
    {{--<div class="row">--}}
        {{--<div class="col-sm-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                    {{--<h3 class="panel-title">{!! trans('messages.search') !!}</h3>--}}
                {{--</div>--}}
                {{--<div class="panel-body search-form">--}}
                    {{--<form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-3 block-input">--}}
                                {{--<input class="form-control" size="25" placeholder="{!! trans('messages.name') !!}" name="name">--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 text-right">--}}
                                    {{--<button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>--}}
                                    {{--<button type="button" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}



                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--end search--}}
    <a href="{!! url('report_quotation_excel') !!}"><button type="button" class="btn btn-info btn-primary action-float-right"><i class="fa fa-download"> </i> ดาวน์โหลด</button></a>

    {{--content--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">รวมยอดสุทธิใบเสนอราคา</h3>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('report_quotation.report_quotation_detail_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}

@endsection

@section('script')
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/nabour-search-form.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript">

        $('.p-search-property').on('click',function () {
            propertyPage (1);
        });


        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/report_quotation/report_count",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection