<div class="fade message_modal" >
    <div class="modal-dialog " style="margin-top: 250px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">團購商品修改</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action=" {{ route('UpdateGroupbuydata') }} ">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="page_type" value="{{ $type }}">
                  <input type="hidden" name="type" value="{{ $Area }}">
                  <input type="hidden" name="commodity_id" value="{{ $message_data['commodityID'] }}">
                  <input type="hidden" name="groupbuy_id" value="{{ $message_data['groupbuyID'] }}">
                  <input type="hidden" name="post_type" value="{{ $message_data['post_type'] }}">

                  <div class="form-group">
                    <label>商品名稱</label>
                    <input type="text" class="form-control" value="{{ $message_data['commodiyName'] }}" disabled>
                  </div>

                  <div class="form-group">
                    <label>團購價格</label>
                    <input type="text" class="form-control" name="groupbuy_price" value="{{ $message_data['groupbuyPrice'] }}" placeholder="輸入團購價格">
                  </div>
                  <div class="form-group">
                    <label>下架時間</label>
                    @if($message_data['offTime']!=null)
                          <?php 
                              $time = preg_split("/ /",$message_data['offTime']);
                          ?>
                          <input type="date" class="form-control" name="offTime" value="{{ $time[0] }}">
                    @else
                          <input type="date" class="form-control" name="offTime">
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>優惠條件(一)</label>
                        <br/>
                        <label>數量：</label>
                        <input type="text" class="form-control" name="groupbuy_amountA" value="{{ $message_data['groupbuyAmountA'] }}" placeholder="輸入數量">
                        <label>價錢：</label>
                        <input type="text" class="form-control" name="groupbuy_priceA" value="{{ $message_data['groupbuyPriceA'] }}" placeholder="輸入價錢">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>優惠條件(二)</label>
                        <br/>
                        <label>數量：</label>
                        <input type="text" class="form-control" name="groupbuy_amountB" value="{{ $message_data['groupbuyAmountB'] }}" placeholder="輸入數量">
                        <label>價錢：</label>
                        <input type="text" class="form-control" name="groupbuy_priceB" value="{{ $message_data['groupbuyPriceB'] }}" placeholder="輸入價錢">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>優惠條件(三)</label>
                        <br/>
                        <label>數量：</label>
                        <input type="text" class="form-control" name="groupbuy_amountC" value="{{ $message_data['groupbuyAmountC'] }}" placeholder="輸入數量">
                        <label>價錢：</label>
                        <input type="text" class="form-control" name="groupbuy_priceC" value="{{ $message_data['groupbuyPriceC'] }}" placeholder="輸入價錢">
                      </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                          <label>優惠條件(四)</label>
                          <br/>
                          <label>數量：</label>
                          <input type="text" class="form-control" name="groupbuy_amountD" value="{{ $message_data['groupbuyAmountD'] }}" placeholder="輸入數量">
                          <label>價錢：</label>
                          <input type="text" class="form-control" name="groupbuy_priceD" value="{{ $message_data['groupbuyPriceD'] }}" placeholder="輸入價錢">
                        </div>
                    </div>
                  </div>
                  <button type="submit" class=" btn btn-success">修改完成</button>
                </form>
                <div class="alert alert-success" role="alert">
                  優惠條件：當產品購買數量到一定程度時 會以較優惠的價格計算價錢<br/>
                  例如：優惠條件(一) 數量：10 價錢：200<br/>
                  當此商品被購買量大於10的時候 結算價錢會以每個200元來計算
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