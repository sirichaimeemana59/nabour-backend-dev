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
                <li>
                   <strong>{{ trans('messages.Settings.page_profile_head') }}</strong>
                </li>

			</ol>
    	</div>
    </div>

    <section class="mailbox-env">
        <div class="row">
            <div class="col-sm-9 mailbox-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('messages.Settings.page_profile_head') }}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($user,array('url'=>'settings','method'=>'post', 'class'=>'form-horizontal','id'=>'settings-profile-form')) !!}
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="firstname">{{ trans('messages.fname') }}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('fname',null,array('class'=>'form-control','maxlength'=>200)) !!}
                                </div>
                                <label class="col-sm-2 control-label" for="firstname">{{ trans('messages.lname') }}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('lname',null,array('class'=>'form-control','maxlength'=>200)) !!}
                                </div>
                            </div>

                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label more-margin">{{ trans('messages.gender') }}</label>
                                <div class="col-sm-4">
                                    <div class="form-group gender-input @if($errors->user->has('gender')) validate-has-error @endif">
                                        <div class="radio_custom col-sm-12">
                                            {!! Form::radio('gender', 'm',null,['id'=>'check_m']) !!}
                                            <label for="check_m">{{ trans('messages.male') }}</label>
                                            {!! Form::radio('gender', 'f',null,['id'=>'check_f']) !!}
                                            <label for="check_f">{{ trans('messages.female') }}</label>
                                            <?php echo $errors->user->first('gender','<span class="validate-has-error gender-error">:message</span>'); ?>
                                        </div>
    								</div>
    							</div>

                                <label class="col-sm-2 control-label" for="email">{{ trans('messages.email') }}</label>

                                <div class="col-sm-4">
                                    <span style="padding-top: 7px;float:left">
                                        {{ $user->email }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="profile-image">{{ trans('messages.profile_img') }}</label>

                                <div class="col-sm-4">
                                    <div class="profile-img">
                                        @if($user->profile_pic_name)
                                        <img src="{{ env('URL_S3')."/profile-img/".$user->profile_pic_path.$user->profile_pic_name }}" alt="user-image" class="settings-profile-img" />
                                        @else
                                        <img src="{{url('/')}}/images/user-4.png" alt="user-image" class="settings-profile-img" />
                                        @endif
                                    </div>
                                    <span id="upload-profile-pic">
                                        <i class="fa fa-camera"></i> {{ trans('messages.change') }}
                                    </span>
                                    <div id="profile-img-input"></div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="img-container">
                                        <img class="img-responsive" />
                                    </div>
                                </div>
                                <input type="hidden" id="img-x" name="img-x"/>
                                <input type="hidden" id="img-y" name="img-y"/>
                                <input type="hidden" id="img-w" name="img-w"/>
                                <input type="hidden" id="img-h" name="img-h"/>
                                <input type="hidden" id="img-tw" name="img-tw"/>
                                <input type="hidden" id="img-th" name="img-th"/>
                            </div>

                            @if(Auth::user()->role > 1)
                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="birthdate">{{ trans('messages.dob') }}</label>

                                <div class="col-sm-10">
                                    <?php $dob = date('Y/m/d',strtotime($user->dob)); ?>
                                    {!! Form::text('dob',$dob,array('class'=>'form-control datepicker','data-format'=>'yyyy/mm/dd','readonly', 'data-end-date'=>'-10y', 'view-mode'=>'years','data-language'=>App::getLocale())) !!}
                                </div>
                            </div>
                            @endif

                            <div class="form-group-separator"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="phone">{{ trans('messages.tel') }}</label>

                                <div class="col-sm-10">
                                    {!! Form::text('phone',null,array('class'=>'form-control','maxlength'=>100)) !!}
                                </div>
                            </div>

                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <a href="{!! url('settings') !!}" class="btn btn-white">{{ trans('messages.reset') }}</a>
                                    <button type="button" class="btn btn-primary" id="save-profile-btn">{{ trans('messages.save') }}</button>
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
                        <li class="active">
                            <a href="{!! url('settings') !!}">
                                {{ trans('messages.Settings.page_profile_head') }}
                            </a>
                        </li>
                        <li>
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
<script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/cropper/cropper.min.js"></script>
<script type="text/javascript">
    $(function () {
    var root = $('#root-url').val();
    var i = 0;

    $('#upload-profile-pic').dropzone({
        uploadMultiple:false,
        url: root+'/upload-profile-pic',
        acceptedFiles: "image/*",
        addedfile: function(file)
        {
            $('#profile-img-input').html('');
            $entry = $('<div>').append(
                        $('<div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div>')
                    );
            file.entry = $entry;
            file.progressBar = $entry.find('.progress-bar');
            $('#profile-img-input').html($entry);
        },
        uploadprogress: function(file, progress, bytesSent)
        {
            file.progressBar.width(progress + '%');
        },

        success: function(file,xhr)
        {

            $('.settings-profile-img').attr({'src':root+"/upload_tmp/"+xhr.name,'width':'80px'});
            $('.img-container').html('');
            $('.img-container').append($('<img/>').attr({'src':root+"/upload_tmp/"+xhr.name}));
            $('#profile-img-input').append(
                $('<input>').attr({'type':'hidden','name':'pic_name','value':xhr.name})
            );

            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success').fadeOut(500,function() { $(this).parent().remove()});

            var $image = $(".img-container img");
            var $x = $("#img-x");
            var $y = $("#img-y");
            var $w = $("#img-w");
            var $h = $("#img-h");

            // Plugin Initialization
            $image.cropper({
                aspectRatio: 1,
                preview: '.profile-img',
                done: function(data) {
                    $x.val( data.x );
                    $y.val( data.y );
                    $w.val( data.width );
                    $h.val( data.height );
                }
            });
        },
        error: function(file)
        {
            if(file.accepted) {
                file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                this.removeFile(file);
            } else {
                $('#previews').children(':last').remove();
            }
        }
    });

    $("#settings-profile-form").validate({
            ignore:'',
            rules: {
                fname    : 'required',
                lname    : 'required'
            },
            errorPlacement: function(error, element) {}
        });

    $('#save-profile-btn').on('click',function () {
        if($('#settings-profile-form').valid()) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $('#settings-profile-form').submit();
        }
    });
})
</script>
<link rel="stylesheet" href="{!! url('/') !!}/js/cropper/cropper.min.css">
@endsection
