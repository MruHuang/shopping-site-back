
<div class="fade message_modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body" >
                <form role="form"  method="POST" action=" {{ Route('UpdateOrderData') }} "> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="orderID"  value="{{ $order_detailed['order_data'][0]['orderID'] }}">
                    <input type="hidden" name="order_state" id="order_state" value="{{ $type }}">
                    <input type="hidden" name="order_type" id="order_type" value="{{ $order_type }}">
                    <input type="hidden" name="this_page" value="{{ $this_page }}">
                    <div class="row" style="margin-right: 20px;margin-left: 20px;">
                        <div class="form-group">
                            <label>收件人</label>
                            <input class="form-control" type="text" name="recipient"  value="{{ $order_detailed['order_data'][0]['recipient'] }}">
                        </div>
                        <div class="form-group">
                            <label>付款方式</label>
                            <select class="form-control" name="checkoutMethod" value="">
                            @if($order_detailed['order_data'][0]['checkoutMethod']== 'ATM')
                                <option value="ATM" selected>ATM</option>
                                <option value="CreditCard">CreditCard</option>
                            @else($order_detailed['order_data'][0]['checkoutMethod']== 'CreditCard')
                                <option value="CreditCard" selected>CreditCard</option>
                                <option value="ATM">ATM</option>
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>匯款後五碼</label>
                            <input class="form-control" type="text" name="moneyTransferFN" value="{{ $order_detailed['order_data'][0]['moneyTransferFN'] }}">
                        </div>
                        <div class="form-group">
                            <label>地址</label>
                            <input class="form-control" type="text" name="deliveryAdd" value="{{ $order_detailed['order_data'][0]['deliveryAdd'] }}">
                        </div>
                        <div class="form-group">
                            <label>使用紅利點數</label>
                            <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['useIntegral'] }}" disabled>
                        </div>
                        <div class="form-group text-right" >
                            <button type="submit" class="btn btn-success">修改</button>
                        </div>
                        
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>商品名稱</th>
                            <th>商品分類</th>
                            <th>購買數量</th>
                            <th>價格</th>
                        </tr>
                        <?php $MAX = count($order_detailed)-1 ?>
                        @for($i=0;$i<$MAX;$i++)
                        <tr>
                            @if($order_detailed[$i]['commodityArea'] == 'commodity')
                                <td>{{ $order_detailed[$i]['commodityName'] }}</td>
                                <td>一般商品</td>
                                <td>{{ $order_detailed[$i]['commodityAmount'] }}</td>
                                <td>{{ $order_detailed[$i]['commodityPrice']*$order_detailed[$i]['commodityAmount'] }} 元</td>
                            @elseif($order_detailed[$i]['commodityArea'] == 'groupbuy')
                                <td>{{ $order_detailed[$i]['commodityName'] }}</td>
                                <td>團購商品</td>
                                <td>{{ $order_detailed[$i]['commodityAmount'] }}</td>
                                <td>{{ $order_detailed[$i]['groupbuyPrice']*$order_detailed[$i]['commodityAmount'] }} 元</td>
                            @else
                                <td>{{ $order_detailed[$i]['commodityName'] }}</td>
                                <td>限時限量商品</td>
                                <td>{{ $order_detailed[$i]['commodityAmount'] }}</td>
                                <td>{{ $order_detailed[$i]['limitedPrice']*$order_detailed[$i]['commodityAmount'] }} 元</td>
                            @endif
                            </tr>
                        @endfor
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->