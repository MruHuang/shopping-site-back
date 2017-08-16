
<div class="fade message_modal">
    <div class="modal-dialog " style="margin-top: 250px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">限量商品修改</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action=" {{ route('UpdateLimiteddata') }} ">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="page_type" value="{{ $type }}">
                  <input type="hidden" name="type" value="{{ $Area }}">
                  <input type="hidden" name="commodity_id" value="{{ $message_data['commodityID'] }}">
                  <input type="hidden" name="limited_id" value="{{ $message_data['limitedID'] }}">
                  <input type="hidden" name="post_type" value="{{ $message_data['post_type'] }}">

                  <div class="form-group">
                    <label>商品名稱</label>
                    <input type="text" class="form-control" value="{{ $message_data['commodiyName'] }}" disabled>
                  </div>
                  <div class="form-group">
                    <label>限時限量價格(必填)</label>
                    <input type="text" class="form-control" name="limited_price" value="{{ $message_data['limitedPrice'] }}"  placeholder="輸入限時限量價格">
                  </div>

                  <div class="form-group">
                    <label>下架時間(必填)</label>
                     @if($message_data['offTime']!=null)
                          <?php 
                              $time = preg_split("/ /",$message_data['offTime']);
                          ?>
                          <input type="date" class="form-control" name="offTime" value="{{ $time[0] }}">
                    @else
                          <input type="date" class="form-control" name="offTime">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>限時數量(必填)</label>
                    <input type="text" class="form-control" name="limited_amount" value="{{ $message_data['limitedAmount'] }}" placeholder="輸入數量">
                  </div>

                  <button type="submit" class="btn btn-success">修改完成</button>
                </form>
                <div class="alert alert-warning" role="alert">
                  注意：若是使用IE瀏覽器者<br/>
                  日期的輸入格式為：XXXX-XX-XX<br/>
                  例如：2017-08-04<br/>
                </div>
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