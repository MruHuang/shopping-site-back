<div class="fade message_modal">
    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">商品修改</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action=" {{ route('UpdateCommodity') }}  ">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="page_type" value="{{ $type }}">
                  <input type="hidden" name="type" value="{{ $Area }}">
                  <input type="hidden" name="commodity_id" value="{{ $message_data[0]['commodityID'] }}">
                  <div class="form-group">
                    <label>商品名稱</label>
                    <input type="text" class="form-control" name="commodity_name" value="{{ $message_data[0]['commodityName'] }}" placeholder="輸入商品名稱">
                  </div>

                  <div class="form-group">
                    <label>商品總類</label>
                    <select class="form-control" name="commodity_speciesID" value="">
                        <?php $MAX = count($message_data['species']) ?>
                        @for($i= 0; $i< $MAX; $i++)
                          @if($message_data['species'][$i]['speciseID']==$message_data[0]['speciseID'])
                            <option value="{{ $message_data['species'][$i]['speciseID'] }}" selected>{{ $message_data['species'][$i]['speciseName'] }}</option>
                          @else
                            <option value="{{ $message_data['species'][$i]['speciseID'] }}">{{ $message_data['species'][$i]['speciseName'] }}</option>
                          @endif
                        @endfor
                    </select>
                  </div>

                  <div class="form-group">
                    <label>原價</label>
                    <input type="text" class="form-control" name="original_price" value="{{ $message_data[0]['originalPrice'] }}" placeholder="輸入原價">
                  </div>

                  <div class="form-group">
                    <label>會員價格</label>
                    <input type="text" class="form-control" name="commodity_price" value="{{ $message_data[0]['commodityPrice'] }}" placeholder="輸入會員價格">
                  </div>

                  <div class="form-group">
                    <label>數量</label>
                    <input type="text" class="form-control" name="commodity_amount" value="{{ $message_data[0]['commodityAmount'] }}" placeholder="輸入數量">
                  </div>
                  
                  <div class="form-group">
                    <label>商品介紹</label>
                    <textarea class="form-control" name="commodity_introduction" rows="3">{{ $message_data[0]['commodityIntroduction'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label>影片連結</label>
                    <input type="text" class="form-control" name="commodity_video" value="{{ $message_data[0]['commodityVideo'] }}" placeholder="URL:">
                  </div>

                  <button type="submit" class="btn btn-success">修改完成</button>
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