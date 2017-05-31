@extends('layouts.UserMaster')

@section('title','Order Management')

@section('anyone_head')

@show

@section('menu')
	@include('partials.Menu')
@stop

@section('content')
<div class="panel panel-default" style="margin-top: 25px;">
    <div class="panel-heading">
        <h2 class="panel-title" id="OrderType" data_type="{{ $type }}" data_orderType = '{{ $order_type }}'>訂單管理</h2>
    </div>
    <div class="panel-body">
    @if($type=='All')
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @elseif($type=='Unpaid')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @elseif($type=='Check')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @elseif($type=='Ready')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @elseif($type=='Delivery')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @elseif($type=='Carryout')
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @else
    	<ul class="nav nav-tabs">
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'All']) }}">ALL</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Unpaid']) }}">未付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Check']) }}">待確認付款</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Ready']) }}">待交貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Delivery']) }}">已送貨</a></li>
          <li role="presentation"><a href="{{ route('GetOrder',['type'=>'Carryout']) }}">歷史紀錄</a></li>
          <li role="presentation" class="active"><a href="{{ route('GetOrder',['type'=>'Cancel']) }}">取消訂單</a></li>
        </ul>
    @endif
        <div class="panel panel-default" style="border-top:none;">
            <div class="panel-body" style="padding: 0px;">
                <table class="table" style="margin-bottom: 0px;">
                    <tr>
                        <th><a class="orderType" href="{{ route('GetOrder',['type'=>$type,'this_page'=>'1','order_type'=>'created_at']) }}">購買時間</a></th>
                        <th><a class="orderType" href="{{ route('GetOrder',['type'=>$type,'this_page'=>'1','order_type'=>'recipient']) }}">會員名稱</a></th>
                        <th><a class="orderType" href="{{ route('GetOrder',['type'=>$type,'this_page'=>'1','order_type'=>'orderID']) }}">訂單編號</a></th>
                        <th><a class="orderType" href="{{ route('GetOrder',['type'=>$type,'this_page'=>'1','order_type'=>'totalPrice']) }}">總價</a></th>
                        <th><a class="orderType" href="{{ route('GetOrder',['type'=>$type,'this_page'=>'1','order_type'=>'moneyTransferFN']) }}">匯款後五碼</th>
                        <th>訂單詳細</th>
                        @if($type!='Cancel')
                        	<th>進入下個流程</th>
                        @endif
                        <th>訂單狀況</th>
                    </tr>
                    <?php $MAX=count($AllInformation) ?>
                    @for($i=0;$i<$MAX;$i++)
                    <tr>
                        <td><?php 
                                $time = preg_split("/ /",$AllInformation[$i]['created_at']);
                                echo $time[0];
                            ?>
                        </td>
                        <td><a href="{{ route('GetMemberData',[
                        'memberID'=>$AllInformation[$i]['memberID'],
                        'orderState'=>$type,
                        'this_page'=>$this_page,
                        'order_type'=>$order_type]) }}">{{ $AllInformation[$i]['memberName'] }}</a></td>
                        <td class="orderID">{{ $AllInformation[$i]['orderID'] }}</td>
                        
                        {{--@if($AllInformation[$i]['is_ordered']==false && $AllInformation[$i]['orderClass']=='groupbuy')--}}
                        @if($AllInformation[$i]['useIntegral']=='0' && $AllInformation[$i]['totalPrice']=='0')
                          <td>暫無</td>
                        @else
                          <td>{{ $AllInformation[$i]['totalPrice'] }}</td>
                        @endif
                        
                        @if($AllInformation[$i]['moneyTransferFN']==0)
                          <td>未輸入</td>
                        @else
                          <td>{{ $AllInformation[$i]['moneyTransferFN'] }}</td>
                        @endif

                        <td><a href="{{ route('SingleOrder',[
                        'orderID'=>$AllInformation[$i]['orderID'],
                        'orderState'=>$type,
                        'this_page'=>$this_page,
                        'order_type'=>$order_type
                        ]) }}">詳細</a></td>

                        @if($AllInformation[$i]['orderState']!='Cancel')
                        <td>
                            @if($AllInformation[$i]['orderState']!='Carryout')
                            <a data-orderID="{{ $AllInformation[$i]['orderID'] }}" 
                               data-orderState="{{ $AllInformation[$i]['orderState']}}" 
                               class="btn btn-primary order_confirm_btn">確認</a>
                            @endif
                            <a data-orderID="{{ $AllInformation[$i]['orderID'] }}" class="btn btn-danger order_cancel_btn">刪除訂單</a>
                        </td>
                        @endif
                        <td>
                            <select class="form-control updateOrder" data-orderID="{{ $AllInformation[$i]['orderID'] }}" value="">
                            @if($AllInformation[$i]['orderState']=='Unpaid')
                                <option value="Unpaid" selected>未付款</option>
                                <option value="Check">待確認付款</option>
                                <option value="Ready">待交貨</option>
                                <option value="Delivery">已送貨</option>
                                <option value="Carryout">完成交易</option>
                                <option value="Cancel">取消訂單</option>
                            @elseif($AllInformation[$i]['orderState']=='Check')
                                <option value="Unpaid">未付款</option>
                                <option value="Check" selected>待確認付款</option>
                                <option value="Ready">待交貨</option>
                                <option value="Delivery">已送貨</option>
                                <option value="Carryout">完成交易</option>
                                <option value="Cancel">取消訂單</option>
                            @elseif($AllInformation[$i]['orderState']=='Ready')
                                <option value="Unpaid">未付款</option>
                                <option value="Check">待確認付款</option>
                                <option value="Ready" selected>待交貨</option>
                                <option value="Delivery">已送貨</option>
                                <option value="Carryout">完成交易</option>
                                <option value="Cancel">取消訂單</option>
                            @elseif($AllInformation[$i]['orderState']=='Delivery')
                                <option value="Unpaid">未付款</option>
                                <option value="Check">待確認付款</option>
                                <option value="Ready">待交貨</option>
                                <option value="Delivery" selected>已送貨</option>
                                <option value="Carryout">完成交易</option>
                                <option value="Cancel">取消訂單</option>
                            @elseif($AllInformation[$i]['orderState']=='Carryout')
                                <option value="Unpaid">未付款</option>
                                <option value="Check">待確認付款</option>
                                <option value="Ready">待交貨</option>
                                <option value="Delivery">已送貨</option>
                                <option value="Carryout" selected>完成交易</option>
                                <option value="Cancel">取消訂單</option>
                            @else
                            	<option value="Unpaid">未付款</option>
                                <option value="Check">待確認付款</option>
                                <option value="Ready">待交貨</option>
                                <option value="Delivery">已送貨</option>
                                <option value="Carryout">完成交易</option>
                                <option value="Cancel" selected>取消訂單</option>
                            @endif 
                            </select>
                        </td>
                    </tr>
                    @endfor
                </table>
                <select class="form-control this_page" style="width:7%; margin-left: auto; margin-right: auto;">
        				    @for($i=1;$i<=$count_page;$i++)
        				        @if($i == $this_page)
        				            <option selected>{{ $i }}</option>
        				        @else
        				            <option>{{ $i }}</option>
        				        @endif
        				    @endfor
        				</select>
                <div class="text-center" style="margin-top: 10px;">第{{ $this_page }}/{{ (int)$count_page }}頁</div>

                <form role="form" method="POST" id="update_order" action=" {{ route('UpdateOrder') }} ">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="order_id" id="order_id" value="">
                  <input type="hidden" name="order_state" id="order_state" value="">
                  <input type="hidden" name="order_type" id="order_type" value="">
                  <input type="hidden" name="this_page" value="{{ $this_page }}">
                  <input type="hidden" name="order_orderType" value="{{ $order_type }}">
                </form>
                <!--<div class="text-center" style="margin: 20px;">
                    <select>
                        <?php //$PageMAX = 10?>
                        {{--@for($i=1;$i<=$PageMAX;$i++)--}}
                            <option>{{-- $i --}}</option>
                        {{--@endfor--}}
                    </select>  
                </div>-->
            </div>
        </div>
    </div>
</div>

<div class="fade message_modal" style="display: none;" id="order_message_confirm">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">再確認</h4>
            </div>
            <div class="modal-body">
              <p id="order_message_content">您確定要更改訂單的狀態</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close" style="margin-left: 20px; float: right;">Close</button>
                <button type="button" data-orderID='' data-orderState='' class="btn btn-default" id="order_confirm" style="float: right;">確認</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="fade message_modal" style="display: none;" id="order_message_del">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">再確認</h4>
            </div>
            <div class="modal-body">
              <p id="order_message_del_content">您確定要取消訂單</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close" style="margin-left: 20px; float: right;">Close</button>
                <button type="button" data-orderID='' class="btn btn-default" id="order_cancel" style="float: right;">刪除</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
$(document).ready(function() {
  var this_page;
  var data_orderType;
  var order_type = $('#OrderType').attr('data_type');
  $('.updateOrder').change(function(event) {
      order_type = $('#OrderType').attr('data_type');
      var order_id = $(this).attr('data-orderID');
      var order_state = $(this).val();
      $('#order_id').val(order_id);
      $('#order_state').val(order_state);
      $('#order_type').val(order_type);
      $('#update_order').submit();
    });

  $('#order_confirm').click(function(event) {
    var order_id = $(this).attr('data-orderID');
    var order_state = $(this).attr('data-orderState');
    if(order_state == 'Unpaid') 
      order_state = 'Check';
    else if(order_state == 'Check') 
      order_state = 'Ready';
    else if(order_state == 'Ready') 
      order_state = 'Delivery';
    else if(order_state == 'Delivery') 
      order_state = 'Carryout';
    $('#order_id').val(order_id);
    $('#order_state').val(order_state);
    $('#order_type').val(order_type);
    $('#update_order').submit();
  });

  $('#order_cancel').click(function(event) {
    var order_id = $(this).attr('data-orderID');
    order_state = 'Cancel';
    $('#order_id').val(order_id);
    $('#order_state').val(order_state);
    $('#order_type').val(order_type);
    $('#update_order').submit();
  });

  $('.this_page').change(function(event) {
  	this_page = $(this).val();
  	data_orderType = $('#OrderType').attr('data_orderType');
  	var url = $('.nav-tabs .active').children().attr('href');
  	url = url+"/"+this_page+'/'+data_orderType;
  	document.location.href=url;
  	console.log(href);
  });

  $('.orderType').click(function(event) {
  	/* Act on the event */
  });

  $('.order_confirm_btn').click(function(event) {
    var orderID = $(this).attr('data-orderID'); 
    var orderState = $(this).attr('data-orderState');
    $('#order_confirm').attr('data-orderID',orderID);
    $('#order_confirm').attr('data-orderState',orderState);
    var order_message_content = '您確定要更改'+orderID+'訂單的狀態';
    $('#order_message_content').text(order_message_content);
    $('#order_message_confirm').show();
  });

  $('.order_cancel_btn').click(function(event) {
    var orderID = $(this).attr('data-orderID');
    $('#order_cancel').attr('data-orderID',orderID);
    var order_message_del_content = '您確定要取消'+orderID+'訂單';
    $('#order_message_del_content').text(order_message_del_content);
    $('#order_message_del').show();
  });

});
</script>
@stop

@if(count($order_detailed))
    @include('partials.OrderDetailedMessage')
@endif

@if(count($memberData))
    @include('partials.MemberDataMessage')
@endif

@if(count($message_text))
  @section('message')
    @include('partials.Message')
  @show
@endif

@section('js_area')
<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@show