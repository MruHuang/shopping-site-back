<link href="{{ asset('css/croppic.css')}}" rel="stylesheet">
<form role="form" method="POST" id="commodityadd_form" action=" {{ route('AddingCommodity') }} " data-messsage='{{ $message_text }}' accept-charset="UTF-8" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="action" value="insert">
  <div class="form-group">
    <label>商品名稱 (必填)</label>
    <input type="text" class="form-control" id="commodity_name" name="commodity_name" placeholder="輸入商品名稱">
  </div>
  <div class="form-group">
    <label>原價 (必填)</label>
    <input type="text" class="form-control" id="original_price" name="original_price" placeholder="輸入原價">
  </div>
  <div class="form-group">
    <label>會員價格 (必填)</label>
    <input type="text" class="form-control" id="commodity_price" name="commodity_price" placeholder="輸入會員價格">
  </div>
  <div class="form-group">
    <label>商品總類 (必填)</label>
    <select class="form-control" id="SpeciseID" id="commodity_speciesID" name="commodity_speciesID" value="" >
    <?php $MAX = count($AllInformation)?>
    @for($i = 0; $i<$MAX ;$i++)
        <option value="{{ $AllInformation[$i]['speciseID'] }}">{{ $AllInformation[$i]['speciseName'] }}</option>
    @endfor
    </select>
  </div>
  <div class="form-group">
    <label>數量 (必填)</label>
    <input type="text" class="form-control" id="commodity_amount" name="commodity_amount" placeholder="輸入數量">
  </div>
  <div class="form-group">
    <label>商品介紹 (選填)</label>
    <textarea class="form-control" rows="3" id="commodity_introduction" name="commodity_introduction" placeholder="輸入產品介紹"></textarea>
  </div>

 
  <div class="form-group">
    <label>檔案主圖檔 (必填)</label><br>
    <a class="btn btn-primary croppic_btn" data_image="A">上傳</a><br>
    <input type="hidden" name="commodityPhotoA" id="commodityPhotoA" value="">
    <img src="">
  </div>

  <div class="form-group">
    <label>檔案副圖檔一 (選填)</label><br>
    <a class="btn btn-primary croppic_btn" data_image="B">上傳</a><br>
    <input type="hidden" name="commodityPhotoB" id="commodityPhotoB" value="">
    <img src="">
  </div>

  <div class="form-group">
    <label>檔案副圖檔二 (選填)</label><br>
    <a class="btn btn-primary croppic_btn" data_image="C">上傳</a><br>
    <input type="hidden" name="commodityPhotoC" id="commodityPhotoC" value="">
    <img src="">
  </div>

  <div class="form-group">
    <label>檔案副圖檔三 (選填)</label><br>
    <a class="btn btn-primary croppic_btn" data_image="D">上傳</a><br>
    <input type="hidden" name="commodityPhotoD" id="commodityPhotoD" value="">
    <img src="">
  </div>

  <div class="form-group">
    <label>檔案副圖檔四 (選填)</label><br>
    <a class="btn btn-primary croppic_btn" data_image="E">上傳</a><br>
    <input type="hidden" name="commodityPhotoE" id="commodityPhotoE" value="">
    <img src="">
  </div>

  
  <div class="form-group">
    <label>影片連結 (選填)</label>
    <input type="text" class="form-control" id="commodity_video" name="commodity_video" placeholder="URL:">
  </div>
  <a class="btn btn-default" id="submit_btn">送出</a>
</form>

<div class="fade message_modal" id="croppic_message" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body">
                <div class="row form1">
                  <div class="col-lg-6 cropHeaderWrapper">
                  <label>檔案上傳：</label>
                    <div id="croppic"  style="width: 450px; height: 300px; position:relative; background-color: #b0c4de; margin-top: 20px;"></div>
                    <span class="btn btn-primary" id="cropContainerHeaderButton" style="margin-top: 20px;">選照片</span>
                    <a class="btn btn-primary" style="margin-top: 20px; display: none;" data_image="0" id="img_confirm">確認</a>
                  </div><!-- /col-lg-6 -->
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
@if($delCookie==1)
<script type="text/javascript">
    ClearCookies('commodity_name');
    ClearCookies('commodity_price');
    ClearCookies('original_price');
    ClearCookies('commodity_amount');
    ClearCookies('commodity_introduction');
    ClearCookies('commodity_video');
</script>
@endif
<script type="text/javascript">
  
  $(document).ready(function() {
    init();
    $('#SpeciseID').change(function(event) {
      console.log($(this).val);
    });
    $('.croppic_btn').click(function(event) {
      var image_type =  $(this).attr('data_image');
      $('#croppic_message').show();
      $('#croppic_message #img_confirm').attr('data_image',image_type);
    });
    $('#submit_btn').click(function(event) {
      putCookies();
      $("#commodityadd_form").submit();
    });
    $(document).on('click', '.cropControlCrop', function() {
      $('#img_confirm').show();
    });
    $(document).on('click', '#img_confirm', function() {
      $(this).hide();
      var image_name = $('.croppedImg').attr('src');
      var image_type = $(this).attr('data_image');
      $('.cropControlRemoveCroppedImage').trigger('click');
      $('.message_close').trigger('click');
      $('#commodityPhoto'+image_type).next().attr('src',image_name);
      $('#commodityPhoto'+image_type).next().css('width','20%');
      $('#commodityPhoto'+image_type).next().css('margin','20px');
      image_name = image_name.split("/temp/");
      image_name = image_name[1];
      $('#commodityPhoto'+image_type).val(image_name);
      $('#commodityPhoto'+image_type).prev().prev().attr('disabled',"true");
    });
  });

  function init(){
    getHtmlCookies();
    // var message_text = $('#commodityadd_form').attr('message_text');
    // if(message_text=='成功加入商品'){
      
    // }
  }
</script>
<script type="text/javascript" src=" {{ asset('js/Cookies.js') }} "></script>
<script src="{{ asset('js/croppic.js')}}"></script>
   <!--  <script src="assets/js/main.js"></script> -->
    <script>
    var croppicHeaderOptions = {
        //uploadUrl:'img_save_to_file.php',
        cropData:{
          "dummyData":1,
          "dummyData2":"asdas"
        },
        cropUrl:"{{ asset('img_crop_to_file.php')}}",
        customUploadButtonId:'cropContainerHeaderButton',
        modal:false,
        processInline:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    var croppic = new Croppic('croppic', croppicHeaderOptions);
  </script>

@if(count($errors->all())||count($message_text))
  @section('message')
    @include('partials.Message')
  @show
@endif