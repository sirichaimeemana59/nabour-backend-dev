@extends('detail-base')
@section('content')
    <div class="top-bar-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="info-bar">
                    </div>
                    <!-- /#top-bar -->
                </div>
            </div>
        </div>
    </div>
    <div id="main" class="feature section-feature">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div id="title" class="container">
                        <h1 class="bg-hex-text">{!! trans('messages.PropertyForm.page_head') !!}</h1>
                        <h2 class="bg-hex-text">{!! trans('messages.PropertyForm.page_sub_head') !!}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default home-panel">
                        <div class="panel-body" id="verify-form">
                            <div class="label label-warning" style="display:none;" id="error-verify-section">{!! trans('messages.PropertyForm.wrong_code') !!}</div>
                            <div class="label label-warning" style="display:none;" id="error-status-section">{!! trans('messages.PropertyForm.wrong_status') !!}</div>
                            {!! Form::open(['url'=>'home/property/form/code','class'=>'form-horizontal']) !!}
                            <div style="margin-bottom:10px;">{!! trans('messages.PropertyForm.code_description') !!}</div>
                            <div class="form-group @if($fail) validate-has-error @endif">
                                <label class="col-sm-4 control-label">{!! trans('messages.PropertyForm.code_label') !!}</label>
                                <div class="col-sm-7">
                                    {!! Form::text('code',null,array('class'=>'form-control','id'=>'input-code')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-7">
                                    {!! Form::button(trans('messages.PropertyForm.check_code_label'),['class'=>'btn green','id'=>'verify-btn']) !!}
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/base.css">
    <script type="text/javascript">
        $(function () {

            $('#verify-btn').on('click',function () {
                if($('#input-code').val() != "" && $('#input-email').val() != "") {
                    var $btn = $(this);
                    $btn.attr('disabled','disabled');
                    $('#error-verify-section').hide();
                    var request = $.ajax({
                        url		: "{!!url('home/code')!!}",
                        method	: "POST",
                        data 	: { code : $('#input-code').val() },
                        dataType: "json"
                    });
                    request.done(function( result ) {

                        if( result.status == 1 ) {
                            location.href = "{!! url('home/form') !!}"
                        } else if( result.status == 0 ) {
                            $('#error-verify-section').fadeIn(400);
                            $btn.removeAttr('disabled');
                        } else {
                            $('#error-status-section').fadeIn(400);
                            $btn.removeAttr('disabled');
                        }
                    });
                }
            })
        });
    </script>
@endsection
