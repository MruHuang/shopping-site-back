
@extends('layouts.UserMaster')

@section('title','User Management')

@section('anyone_head')

@show

@section('menu')
	@include('partials.Menu')
@stop

@section('content')

<div class="panel panel-default" style="margin-top: 25px;">
    <form role="form" method="POST" id="GetUserData" style="margin: 0px;" action=" {{ route('GetUserData') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="user_type" name="user_type" value="{{ $user_type }}">
            <input type="hidden" id="this_page" name="this_page" value="{{ $this_page }}">
            <input type="hidden" id="order_type" name="order_type" value="{{ $order_type }}">
            <input type="hidden" id="search_text" name="search_text" value="{{ $search_text }}">
    </form>
    <div class="panel-heading">
        <h2 class="panel-title">用戶管理</h2>
    </div>
    <div class="panel-body">
        @if($user_type=='Apply')
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a id="Apply_btn">申請註冊</a></li>
          <li role="presentation"><a id="All_btn">會員名單</a></li>
          <li role="presentation"><a id="Black_btn">黑名單</a></li>
        </ul>
        <div class="panel panel-default" style="border-top:none;">
            @if($search_text!=null)
                目前搜尋：{{ $search_text }}
            @endif
            <form role="form" method="POST" style="margin: 0px;" action=" {{ route('Search_user') }}">
                <button class="btn btn-success" type="submit" style="float: right; margin: 10px 10px;">搜尋</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_type" value="{{ $user_type }}">
                <input type="text" id="search_key" name="search_text"  class="form-control" style="width: 20%; margin:10px 10px; float: right;" placeholder="搜尋">
            </form>
            <div class="panel-body">
                @include('partials.UserManagement_1') 
            </div>
        </div>
        @endif
        @if($user_type=='All')
        <ul class="nav nav-tabs">
            <li role="presentation"><a id="Apply_btn">申請註冊</a></li>
            <li role="presentation" class="active"><a id="All_btn">會員名單</a></li>
            <li role="presentation"><a id="Black_btn">黑名單</a></li>
        </ul>
        <div class="panel panel-default" style="border-top:none;">
            @if($search_text!=null)
                目前搜尋：{{ $search_text }}
            @endif
            <form role="form" method="POST" style="margin: 0px;" action=" {{ route('Search_user') }}">
                <button class="btn btn-success" type="submit" style="float: right; margin: 10px 10px;">搜尋</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_type" value="{{ $user_type }}">
                <input type="text" id="search_key" name="search_text"  class="form-control" style="width: 20%; margin:10px 10px; float: right;" placeholder="搜尋">
            </form>

            <div class="panel-body">
                @include('partials.UserManagement_2') 
            </div>
        </div>
        @endif
        @if($user_type=='Black')
             <ul class="nav nav-tabs">
                <li role="presentation"><a id="Apply_btn">申請註冊</a></li>
                <li role="presentation"><a id="All_btn">會員名單</a></li>
                <li role="presentation" class="active"><a id="Black_btn">黑名單</a></li>
            </ul>
            <div class="panel panel-default" style="border-top:none;">
                @if($search_text!=null)
                    目前搜尋：{{ $search_text }}
                @endif
                <form role="form" method="POST" style="margin: 0px;" action=" {{ route('Search_user') }}">
                    <button class="btn btn-success" type="submit" style="float: right; margin: 10px 10px;">搜尋</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_type" value="{{ $user_type }}">
                    <input type="text" id="search_key" name="search_text"  class="form-control" style="width: 20%; margin:10px 10px; float: right;" placeholder="搜尋">
                </form>

                <div class="panel-body">
                    @include('partials.UserManagement_3') 
                </div>
            </div>
        @endif
    </div>
</div>


<script type="text/javascript">
    var this_page = 1;
    var order_type = 'created_at';
    var search_text = null;

    $('#Apply_btn').click(function(event) {
        $('#user_type').val('Apply');
        $('#this_page').val('1');
        $('#order_type').val('created_at');
        $('#search_text').val(null);
        $('#GetUserData').submit();
    });

    $('#All_btn').click(function(event) {
        $('#user_type').val('All');
        $('#this_page').val('1');
        $('#order_type').val('created_at');
        $('#search_text').val(null);
        $('#GetUserData').submit();
    });

    $('#Black_btn').click(function(event) {
        $('#user_type').val('Black');
        $('#this_page').val('1');
        $('#order_type').val('created_at');
        $('#search_text').val(null);
        $('#GetUserData').submit();
    });

    $('.order_type').click(function(event) {
        order_type = $(this).attr('data-orderType');
        $('#this_page').val('1');
        $('#order_type').val(order_type);
        $('#GetUserData').submit();

    });

    $('#search_btn').click(function(event) {
        search_text = $('#search_key').val();
        $('#this_page').val('1');
        $('#order_type').val('created_at');
        $('#search_text').val(search_text);
        $('#GetUserData').submit();
    });

    $('.this_page').change(function(event) {
        this_page = $(this).val();
        $('#this_page').val(this_page);
        $('#GetUserData').submit();
    });

    {{--  $('.user_integral').click(function(event) {
    	$(this).parent().next().show();
    });

    $('.update_user_Account').click(function(event) {
    	$(this).parent().next().show();
    });
    
    $('.user_cancel').click(function(event) {
        $(this).parent().next().show();
    });  --}}

    $('.update_memberData_btn').click(function(event) {
        var memberID = $(this).attr('data-memberID');

        var memberAccount = $('#memberAccount-'+memberID).text();
        var memberName = $('#memberName-'+memberID).text();
        var memberLineid = $('#memberLineid-'+memberID).text();
        var memberPhone = $('#memberPhone-'+memberID).text();
        var memberIntegral = $('#memberIntegral-'+memberID).text();
        var memberCancel = $('#memberCancel-'+memberID).text(); 
        var memberEmail = $('#memberEmail-'+memberID).text(); 

        $('#memberID').val(memberID);
        $('#memberAccount').val(memberAccount);
        $('#memberName').val(memberName);
        $('#memberLineid').val(memberLineid);
        $('#memberPhone').val(memberPhone);
        $('#memberIntegral').val(memberIntegral);
        $('#memberCancel').val(memberCancel); 
        $('#memberEmail').val(memberEmail);
        console.log('#memberAccount-'+memberID);
        console.log(memberAccount);
        $('#UpdateMemberDataMessage').show();
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
