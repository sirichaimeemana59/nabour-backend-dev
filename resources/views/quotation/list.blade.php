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

    <?php /*@if($status->status ==0)
        <a href="{!!url('/service/quotation/add/'.$id.'/'.$ip=1)!!}" ><button type="button" class="btn btn-info  action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-plus"> </i> สร้างใบเสนอราคาใหม่</button></a>
        <a href="{!!url('/service/quotation/success/'.$id)!!}" ><button type="button" class="btn btn-success action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-check"> </i>  ทำรายการเสร็จสิ้น</button></a>
    @else
        <a href="{!!url('/service/quotation/cancel/'.$id)!!}" ><button type="button" class="btn btn-danger action-float-right" data-toggle="modal" data-target="#modal-lead"><i class="fa fa-check"> </i>  ยกเลิกใบเสนอราคา</button></a>
    @endif */ ?>
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
                            <div id="panel-q-list">
                                @include('quotation.list-element')
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
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <link rel="stylesheet" href="{!!url('/js/select2/select2.css')!!}">
    <link rel="stylesheet" href="{!!url('/js/select2/select2-bootstrap.css')!!}">
    <script type="text/javascript">
        $(function () {

        })
    </script>
@endsection