@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Quotation</h1>
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
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.search') !!}</h3>
                </div>
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row">
                            {{--<div class="col-sm-3 block-input">--}}
                            {{--<input class="form-control" size="25" placeholder="รหัสลูกค้า" name="customer">--}}
                            {{--</div>--}}
                            <div class="col-sm-3 block-input">
                                <input class="form-control" size="25" placeholder="ชื่อ Leads" name="name">
                            </div>

                            {{--<div class="col-sm-3 block-input">--}}
                                {{--<input class="form-control" size="25" placeholder="ชื่อบริษัท" name="company_name">--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-3">--}}
                            {{--{!! Form::select('province', $provinces,null,['id'=>'property-province','class'=>'form-control']) !!}--}}
                            {{--</div>--}}

                            <div class="col-sm-3">
                                <select name="sale_id" id="" class="form-control" required>
                                    <option value="">กรุณาเลือกพนักงานขาย</option>
                                    @foreach($sale as $srow)
                                        <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                {{--{!! Form::select('province', $provinces,null,['id'=>'property-province','class'=>'form-control']) !!}--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                {{--@if(Auth::user()->role !=2)--}}
                                    <button type="button" class="btn btn-secondary submit-search">{!! trans('messages.search') !!}</button>
                                {{--@else--}}
                                    {{--<button type="button" class="btn btn-secondary p-search-property-sale">{!! trans('messages.search') !!}</button>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--end search--}}

    {{--content--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">Quotation</h3>
                </div>
                <div class="panel-body" id="panel-q-list">
                    @include('report_quotation.report_list_element')
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
    <script type="text/javascript">
        // Override
        $(function () {
            $('.submit-search').on('click',function (){
                //alert('aaa');
                searchPage(1);
            });


            $('.search-form').on('keydown', function(e) {
                if(e.keyCode == 13) {
                    e.preventDefault();
                    searchPage (1);
                }
            });
        });

        function searchPage (page) {
            var data = $('form').serialize()+'&page='+page;
            $('#panel-q-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/report_quotation",
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

    </script>
@endsection