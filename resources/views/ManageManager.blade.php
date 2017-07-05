
@extends('layouts.UserMaster')

@section('title','Manager Management')

@section('anyone_head')

@show

@section('menu')
	@include('partials.Menu')
@stop

@section('content')

<div class="panel panel-default" style="margin-top: 25px;">
    <div class="panel-heading">
        <h2 class="panel-title">管理者管理</h2>
    </div>
    <div class="panel-body">
    @if($type=='ManagerManagement')
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="{{ route('ManageManager',['type'=>'ManagerManagement']) }}">管理員註冊</a></li>
          {{-- <li role="presentation"><a id="">管理員編輯</a></li> --}}
          <li role="presentation"><a href="{{ route('ManageManager',['type'=>'PrintReport']) }}">列印報表</a></li>
        </ul>
        <div class="panel panel-default" style="border-top:none;">
            <div class="panel-body">
                @include('partials.ManagerManagement') 
            </div>
        </div>
    </div>
    @elseif($type=='PrintReport')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('ManageManager',['type'=>'ManagerManagement']) }}">管理員註冊</a></li>
          {{-- <li role="presentation"><a id="">管理員編輯</a></li> --}}
          <li role="presentation" class="active"><a href="{{ route('ManageManager',['type'=>'PrintReport']) }}">列印報表</a></li>
        </ul>
        <div class="panel panel-default" style="border-top:none;">
            <div class="panel-body">
                @include('partials.PrintReport') 
            </div>
        </div>
    </div>
    @endif
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
