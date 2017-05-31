@extends('layouts.UserMaster')

@section('title','Commodity Management')

@section('anyone_head')

@show

@section('menu')
    @include('partials.Menu')
@stop

@section('content')
<div class="panel panel-default" style="margin-top: 25px;">
    <div class="panel-heading">
        <h2 class="panel-title">商品管理</h2>
    </div>
    <div class="panel-body">
        @if($type =='Addcommodity')
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="{{ route('AddCommodity') }}" >新增商品</a></li>
              <li role="presentation"><a href="{{ route('commodity',[
                'page_type'=>'ShelvesCommodity',
                'type'=>'commodity'
                ]) }}">上架商品</a></li>
              <li role="presentation"><a href="{{ route('CommoditySpecies') }}">商品總類</a></li>
            </ul>
            <div class="panel panel-default" style="border-top:none;">
                <div class="panel-body">
                    @include('partials.CommodityManagement_1')
                </div>
            </div>
        @elseif($type=='ShelvesCommodity')
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="{{ route('AddCommodity') }}" >新增商品</a></li>
              <li role="presentation" class="active"><a href="{{ route('commodity',[
                'page_type'=>'ShelvesCommodity',
                'type'=>'commodity'
                ]) }}">上架商品</a></li>
              <li role="presentation"><a href="{{ route('CommoditySpecies') }}">商品總類</a></li>
            </ul>
            <div class="panel panel-default" style="border-top:none;">
                <div class="panel-body">
                    @include('partials.CommodityManagement_2')
                </div>
            </div>
        @elseif($type=='Commodityspecies')
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="{{ route('AddCommodity') }}" >新增商品</a></li>
              <li role="presentation"><a href="{{ route('commodity',[
                'page_type'=>'ShelvesCommodity',
                'type'=>'commodity'
                ]) }}">上架商品</a></li>
              <li role="presentation" class="active"><a href="{{ route('CommoditySpecies') }}">商品總類</a></li>
            </ul>
            <div class="panel panel-default" style="border-top:none;">
                <div class="panel-body">
                    @include('partials.CommodityManagement_3')
                </div>
            </div>
        @endif
        
    </div>
</div>
@stop

@if(count($message_text))
    @section('message')
        @include('partials.Message')
    @stop
@endif

@section('js_area')
<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@show