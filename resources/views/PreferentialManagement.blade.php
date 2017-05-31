@extends('layouts.UserMaster')

@section('title','Preferential Management')

@section('anyone_head')

@show

@section('menu')
	@include('partials.Menu')
@stop

@section('content')
<div class="panel panel-default" style="margin-top: 25px;">
    <div class="panel-heading">
        <h2 class="panel-title">優惠管理</h2>
    </div>
    <div class="panel-body form-group">
        <form role="form" method="POST" action=" {{ route('UpdateIntegral') }}  ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<label>購買轉換積分(%)</label>
        	<input class="form-control" type="text" name="integral_proportion" id="integral_proportion" value="{{ $AllInformation['integralProportion'] }}">
        	<div class="panel panel-default">
			  <div class="panel-body" style="padding: 10px;">
			  	<h5>試算：</h5>
			  	<h5>會員購買金額：200000</h5>
			  	<h5 id="integral_trial">積分：{{ 2000*$AllInformation['integralProportion'] }}</h5>
			  </div>
			</div>
			<button type="submit" class="btn btn-primary">確認</button>
        </form>
    </div>
    <br/>

    <div class="panel-body">
        <form role="form" method="POST" action=" {{ route('Updatefreight') }}  ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<label>運費金額</label>
        	<input class="form-control" type="text" name="freight" value="{{ $AllInformation['freight'] }}">
        	<label>免運金額</label>
        	<input class="form-control" type="text" name="freeFreight" value="{{ $AllInformation['freeFreight'] }}">
        	<button class="btn btn-primary" type="submit" style="margin-top: 20px;">確認</button>
        </form>
    </div>

    <div class="panel-body">
        <form role="form" method="POST" action=" {{ route('UpdateRemittance') }}  ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>更改匯款帳號</label>
            <input class="form-control" type="text" name="RemittanceAccount" value="{{ $AllInformation['RemittanceAccount'] }}">
            <button class="btn btn-primary" type="submit" style="margin-top: 20px;">確認</button>
        </form>
    </div>

    <div class="panel-body">
        <h2 style="font-weight: bolder;">全體會員發信系統</h2>
        <form role="form" method="POST" id="send_email_form" action=" {{ route('SendAllEmail') }}  ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>信件內容</label>
            <textarea class="form-control" rows='3' name="email_content"></textarea>
            <a class="btn btn-primary" id="send_email_btn" style="margin-top: 20px;">確認</a>
        </form>
    </div>

</div>

<div id="loding_page" style="display: none;">
    @include('partials.Loading')
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#integral_proportion').change(function(event) {
            var integral_proportion = $(this).val();
            $('#integral_trial').text('積分：'+2000*parseInt(integral_proportion));
        });
        $('#send_email_btn').click(function(event) {
            $('#loding_page').children().addClass('loading_modal_200');
            $('#loding_page').show();
            $('#send_email_form').submit();
        });
    });
</script>

@stop

@if(count($message_text))
    @section('message')
        @include('partials.Message')
    @show
@endif

@section('js_area')
<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@show