@extends('layouts.Master')

@section('title','Login')

@section('anyone_head')
	@include('partials.head.LoginHead')
@show

@section('content')
<div class="panel panel-info login_form_style">
  <div class="panel-heading clearfix">
  	<img style="float: left; width: 18%;" src=" {{ asset('img/BlueStarSC.png') }}">
    <h3 class="login_title">藍星購物</h3>
  </div>
  <div class="panel-body">
    <form role="form" method="POST" style="font-size: 20px;" action=" {{ route('LoginPost') }}  ">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <label>帳號</label>
	    <input type="text" class="form-control" style="height: 45px; font-size: 18px;" name="managment_account" placeholder="輸入帳號">
	    <div style="margin-top: 20px;"></div>
	    <label>密碼</label>
	    <input type="password" class="form-control" style="height: 45px; font-size: 18px;" name="managment_password" placeholder="輸入密碼">
	    <div style=" width: 50%; margin-left: auto; margin-right: auto; margin-top: 15px;">
	        <button style="height: 50px; font-size: 20px;" class="btn btn-info login_button_sytle" type="submit">登　入</button>
	    </div>
	</form>
  </div>
  <div class="panel-footer" style="padding: 0px;">
	<div class=" alert alert-success" style="margin: 0;">
		<div class="row">
			<div class="col-xs-offset-1" style="font-size: 30px;">優質健康，環保節能</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-5" style="font-size: 30px;">團購優勢，共享優惠</div>
		</div>
	 	<!-- &nbsp;&nbsp;&nbsp;&nbsp; -->
	</div>
  </div>
</div>

@stop

@if(count($message_text))
	@section('message')
		@include('partials.Message')
	@show
@endif

@section('js_area')
	<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@show
