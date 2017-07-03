
<div class="fade message_modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body" >
                <div class="row" style="margin-right: 20px;margin-left: 20px;">
                    <div class="form-group">
                        <label>收件人</label>
                        <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['recipient'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>付款方式</label>
                        <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['checkoutMethod'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>匯款後五碼</label>
                        <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['moneyTransferFN'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>地址</label>
                        <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['deliveryAdd'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>使用紅利點數</label>
                        <input class="form-control" type="text" value="{{ $order_detailed['order_data'][0]['useIntegral'] }}" disabled>
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