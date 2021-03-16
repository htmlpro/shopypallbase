@extends('admin.layoutLlogin')
@section('content')
<style>
	.wrapper{
		display:  none !important;
	}
  .login-logo img {
    display: none;
}
.login-box, .register-box {
  max-width: 46.8rem;
  width: 100%;
  margin-left: 10vw;
  margin-right: 10vw;
  margin-top: 2vw;
  margin-bottom: 2vw;
}
.login-page, .register-page {
    display: flex;
    align-items: center;
}
.login-box-msg, .register-box-msg {
    font-size: 1.6rem;
}
.has-feedback .form-control {
    border-radius: 6px;
}
.login-box .btn.btn-flat {
    min-height: 4.4rem;
    border-radius: 8px;
    text-transform: uppercase;
    font-weight: bold;
}
.login-page{
  background-image: url({{asset('images/media/2021/01/login-bg.png')}}) !important;
    background-size: 100% 100% !important;
}
.Shopypall-logo {
    width: 12.7rem;
    margin-bottom: 2.5rem;
}
.Shopypall-logo img {
    width: 100%;
    display: block;
    height: auto;
}
.login-box .btn-primary {
    background-color: #008060 !important;
    border-color: #008060 !important;
}

@media only screen and (max-width: 768px) {

.login-page {
    background-size: cover !important;
    background-position: right!important;
}

}

@media only screen and (max-width: 479px) {
  .login-box-body, .register-box-body {
    padding: 60px 20px !important;
}
.login-box, .register-box {
    margin-left: 3vw;
    margin-right: 3vw;
    width: 100% !important;
}

}

</style>
<div class="login-box">
  <div class="login-logo">
 
  	@if(empty($web_setting[15]->value))
        @if($web_setting[66]->value=='1' and $web_setting[67]->value=='0')
      		<img src="{{asset('images/admin_logo/logo-android-blue-v1.png')}}" class="ionic-hide">
        	<img src="{{asset('images/admin_logo/logo-ionic-blue-v1.png')}}" class="android-hide">
        @elseif($web_setting[66]->value=='1' and $web_setting[67]->value=='1' or $web_setting[66]->value=='0' and $web_setting[67]->value=='1')
   			<img src="{{asset('images/admin_logo/logo-laravel-blue-v1.png')}}" class="website-hide">
    	@endif
    @else
    	<img style="width: 60%" src="{{asset('').$web_setting[15]->value}}">
    @endif

    
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="Shopypall-logo">
    <img src="{{asset('images/media/2021/01/Shopypall-logo.png')}}">
    </div>
  <div style="font-size: 22px;">
      <b> {{ trans('labels.welcome_message') }}</b>{{ trans('labels.welcome_message_to') }}</div>
    <p class="login-box-msg">{{ trans('labels.login_text') }}</p>

    <!-- if email or password are not correct -->
    @if( count($errors) > 0)
    	@foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">{{ trans('labels.Error') }}:</span>
                  {{ $error }}
            </div>
         @endforeach
    @endif

    @if(Session::has('loginError'))
        <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">{{ trans('labels.Error') }}:</span>
              {!! session('loginError') !!}
        </div>
    @endif

    {!! Form::open(array('url' =>'admin/checkLogin', 'method'=>'post', 'class'=>'form-validate')) !!}

       <div class="form-group has-feedback">
        {!! Form::email('email', '', array('class'=>'form-control email-validate', 'id'=>'email')) !!}
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                     {{ trans('labels.AdminEmailText') }}</span>
       <span class="help-block hidden"> {{ trans('labels.AdminEmailText') }}</span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       <input type="password" name='password' class='form-control field-validate' value="">
       <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                   {{ trans('labels.AdminPasswordText') }}</span>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
       <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>

      </div>
  	  <img src="">
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-12 col-sm-4">
          {!! Form::submit(trans('labels.login'), array('id'=>'login', 'class'=>'btn btn-primary btn-block btn-flat' )) !!}
        </div>
        <!-- /.col -->
      </div>
    {!! Form::close() !!}

  </div>

  <!-- /.login-box-body -->
</div>
