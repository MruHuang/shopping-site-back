@extends('layouts.Master')

@section('title','Register')

@section('anyone_head')
	@include('partials.head.RegisterHead')
@stop

@section('content')
<div class="panel panel-info register_form_style">
  <div class="panel-heading clearfix">
    <img style="float: left; width: 18%;" src=" {{ asset('img/blueStar_logo.png') }}">
    <a href="{{ route('Login') }}"><h3 class="login_title" style="font-size: 45px;">藍星購物</h3></a>
  </div>
  <div class="panel-body">
    <form role="form" method="POST" action=" {{ route('PostmanagerRegister') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h3>會管理者註冊</h3>
            <label>管理者帳號</label>
            <input type="text" class="form-control" id ="manager_account" name="manager_account"  placeholder="輸入帳號">
            <label>密碼</label>
            <input type="password" class="form-control" id ="manager_password" name="manager_password" placeholder="輸入密碼">
            <label>信箱</label>
            <input type="text" class="form-control" id ="manager_Email" name="manager_Email" placeholder="輸入信箱 Ex：XXXX@XXXX.com">
            
            <button class="btn btn-info register_button_style" type="submit" id="submit_btn" >送出</button>
    </form>
  </div>
</div>

@stop

@if(count($errors->all())||count($message_text))
	@section('message')
		@include('partials.Message')
	@stop
@endif

@section('js_area')
	<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@stop
