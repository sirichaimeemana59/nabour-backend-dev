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
                <li class="active">
                    <a href="{!! url('settings') !!}"><i class="fa-gears"></i>{{ trans('messages.Settings.page_head') }}</a>
                </li>
                <li class="active">
                    <strong>{{ trans('messages.Settings.change_password') }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <section class="mailbox-env">
        <div class="row">
            <div class="col-sm-9 mailbox-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('messages.Settings.change_password') }}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'settings/password','method'=>'post', 'class'=>'form-horizontal','id'=>'settings-password-form')) !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="current-password">{{ trans('messages.Settings.current_password') }}</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="old_password" id="current-password" placeholder="{{ trans('messages.Settings.current_password') }}" maxlength=20 {{ ($is_demo)?"disabled":"" }} />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="new-password">{{ trans('messages.Settings.new_password') }}</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="new_password" id="new-password" placeholder="{{ trans('messages.Settings.new_password') }}" maxlength=20 {{ ($is_demo)?"disabled":"" }}/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="confirm-new-password">{{ trans('messages.Settings.confirm_password') }}</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm-new-password" placeholder="{{ trans('messages.Settings.confirm_password') }}"maxlength=20 {{ ($is_demo)?"disabled":"" }}/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @if(!$is_demo)
                                    <button type="button" class="btn btn-primary btn-single pull-right" id="chng-psw-btn">{{ trans('messages.save') }}</button>
                                    @endif
                                </div>
                            </div>


                        {!! Form::close() !!}

                    </div>
                </div>

            </div>

            <!-- Mailbox Sidebar -->
            <div class="col-sm-3 mailbox-left">
                <div class="mailbox-sidebar">
                    <ul class="list-unstyled mailbox-list no-top-margin">
                        <li>
                            <a href="{!! url('settings') !!}">
                                {{ trans('messages.Settings.page_profile_head') }}
                            </a>
                        </li>
                        <li class="active">
                            <a href="{!! url('settings/password') !!}">
                                {{ trans('messages.Settings.change_password') }}
                            </a>
                        </li>
                        <li>
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
<script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
<script type="text/javascript">
    $(function () {
        $.validator.addMethod("regex", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        });
    $("#settings-password-form").validate({
            ignore:'',
            rules: {
                old_password    : {
                    required    : true,
                    minlength   : 4
                },
                new_password    : {
                    required    : true,
                    regex       : true,
                    minlength   : 4,
                    maxlength   : 20
                },
                confirm_password : {
                    equalTo: "#new-password"
                }
            },
            messages: {
                old_password: {
                    required: '{{ trans("messages.Settings.empty_old_password") }}',
                    minlength: '{{ trans("messages.Settings.password_length") }}'
                },
                new_password: {
                    required: '{{ trans("messages.Settings.empty_new_password") }}',
                    regex   : '{{ trans("messages.Settings.alpha_nu_password") }}',
                    minlength: '{{ trans("messages.Settings.password_length") }}'
                },
                confirm_password: {
                    equalTo: '{{ trans("messages.Settings.notmatch_password") }}'
                }
            }
        });
    $('#chng-psw-btn').on('click',function () {
        if($("#settings-password-form").valid()) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $("#settings-password-form").submit();
        }
    })
    @if(Session::has('success.message'))
        toastr.success("{{Session::pull('success.message')}}",null,{"closeButton": true});
    @endif
    @if($errors->has('password'))
        {!! $errors->first('password','toastr.error(":message",null,{"closeButton": true});') !!}
    @endif
})
</script>
@endsection
