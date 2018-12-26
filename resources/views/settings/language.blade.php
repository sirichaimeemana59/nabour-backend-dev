@extends('base-admin')
@section('content')
     <div class="page-title">
        <div class="title-env">
            <h1 class="title">{{ trans('messages.Settings.page_head') }}</h1>
            <p class="description">{{ trans('messages.Settings.page_sub_head') }}</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >
                <li>
                   <a href="{!! url('/') !!}"><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>
                    <a href="{!! url('settings') !!}"><i class="fa-gears"></i>{{ trans('messages.Settings.page_head') }}</a>
                </li>
                <li class="active">
                   <strong>{{ trans('messages.Settings.language') }}</strong>
                </li>

            </ol>
        </div>
    </div>
    <section class="mailbox-env">
        <div class="row">
            <div class="col-sm-9 mailbox-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('messages.Settings.language') }}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'settings/language','method'=>'post', 'class'=>'form-horizontal')) !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">{{ trans('messages.Settings.language_label') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('language',['th'=>'ไทย','en'=>'English'],$user->lang,['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="button" id="save-settings" class="btn btn-primary btn-single pull-right">{{ trans('messages.save') }}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-3 mailbox-left">
                <div class="mailbox-sidebar">
                    <ul class="list-unstyled mailbox-list no-top-margin">
                        <li>
                            <a href="{!! url('settings') !!}">
                                {{ trans('messages.Settings.page_profile_head') }}
                            </a>
                        </li>
                        <li>
                            <a href="{!! url('settings/password') !!}">
                                {{ trans('messages.Settings.change_password') }}
                            </a>
                        </li>
                        <li class="active">
                            <a href="{!! url('settings/language') !!}">
                                {{ trans('messages.Settings.language') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script type="text/javascript">
    $(function () {
        $('#save-settings').on('click',function () {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $(this).parents('form').submit();
        })
    })
</script>
@endsection
