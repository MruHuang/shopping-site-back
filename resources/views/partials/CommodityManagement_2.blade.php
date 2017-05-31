@include('partials.CommodityManagementMenu')
@if($Area == 'commodity')
    <div class="panel panel-default" style="margin-top: 20px;">
      <div class="panel-heading">
        <h3 class="panel-title">一般區</h3>
      </div>
      <div class="panel-body" style="padding: 0px;">
        <table class="table">
            <tr>
                <th class="text-center">是否上架</th>
                <th class="text-center">商品名稱</th>
                <th class="text-center">商品總類</th>
                <th class="text-center">商品價格</th>
                <th class="text-center">商品數量</th>
                <th class="text-center">新增日期</th>
                <th class="text-center">修改商品內容</th>
                <th class="text-center">刪除</th>
            </tr>
            <?php $MAX = count($AllInformation) ?>
            @for($i=0;$i<$MAX;$i++)
            <tr>
                <td class="text-center">
                    @if($AllInformation[$i]['IsShelves']=="1")
                        <input class="Shelves" type="checkbox" checked />
                        <form role="form" method="POST" action=" {{ route('ShelvesCommodity') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['commodityID'] }}">
                          <input type="hidden" name="ShelvesState" value="false">
                        </form>
                    @else
                        <input class="nuShelves" type="checkbox"/>
                        <form role="form" method="POST" action=" {{ route('ShelvesCommodity') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['commodityID'] }}">
                          <input type="hidden" name="ShelvesState" value="1">
                        </form>
                    @endif
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['commodityName'] }}
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['speciseName'] }}
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['commodityPrice'] }}
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['commodityAmount'] }}
                </td>
                <td class="text-center">
                    <?php 
                        $time = preg_split("/ /",$AllInformation[$i]['created_at']);
                        echo $time[0];
                    ?>
                </td>
                <td class="text-center">
                    <a href="{{ route('GetCommodityDetail',[
                        'page_type'=>$type,
                        'type'=>$Area,
                        'commodity_type'=>'commodity',
                        'ID'=>$AllInformation[$i]['commodityID'],
                        ]) }}" class="btn btn-primary">修改</a>
                </td>
                <td class="text-center">
                    <a class="btn btn-danger delete_btn" data-memberID="{{ $AllInformation[$i]['commodityID'] }}">刪除</a>
                </td>
               <!--  <td class="text-center">
                    <a href="{{-- route('DeleteCommodity',[
                        'page_type'=>$type,
                        'type'=>$Area,
                        'ID'=>$AllInformation[$i]['commodityID']
                        ]) --}}" class="btn btn-danger">刪除</a>
                </td> -->

            </tr>
            @endfor
        </table>
      </div>
    </div>

    <div class="fade message_modal" id="delete_prompt" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                <p>確定要刪除此商品</p>
                <a id="delete_link" href="{{ route('DeleteCommodity',[
                        'page_type'=>$type,
                        'type'=>$Area
                        ]) }}" class="btn btn-danger">刪除</a>
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
    @if(count($message_data))
        @include('partials.CommodityMessage') 
    @endif
    <script type="text/javascript">
        function init(){
            $('.addtime').each(function() {
                var addtime = $(this).text();
                addtime = trim(addtime);
                console.log(addtime);
            });
        }

        function trim(str) {
          return str.replace(/(^\s+)|(\s+$)/g, "");
        }
        $(document).ready(function() {
            var delete_link = $('#delete_link').attr('href');
            init();
            $('.Shelves').change(function(event) {
                $(this).next().submit();
            });
            $('.nuShelves').change(function(event) {
                $(this).next().submit();
            });
            $('.delete_btn').click(function(event) {
                var member_ID = $(this).attr('data-memberID');
                var href = delete_link+"/"+member_ID;
                $('#delete_link').attr('href',href);
                $('#delete_prompt').show();
            });
        });
    </script>
@endif
@if($Area == 'groupbuy')
    <div class="panel panel-default" style="margin-top: 20px;">
      <div class="panel-heading">
        <h3 class="panel-title">團購區</h3>
      </div>
      <div class="panel-body" style="padding: 0px;">
        <table class="table">
            <tr>
                <th class="text-center">是否上架</th>
                <th class="text-center">商品名稱</th>
                <th class="text-center">商品總類</th>
                <th class="text-center">商品價格</th>
                <th class="text-center">新增日期</th>
                <th class="text-center">修改團購內容</th>
            </tr>
            <?php $MAX = count($AllInformation) ?>
            @for($i=0;$i<$MAX;$i++)
            <tr>
                <td class="text-center">
                    @if($AllInformation[$i]['isShelves']==1)
                        <input class="groupbuy_unShelves" type="checkbox" checked />
                        <form role="form" method="POST" action=" {{ route('unShelves') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['groupbuyID'] }}">
                        </form>
                    @else
                        <input class="groupbuy_Shelves" type="checkbox"/>
                        <form role="form" method="POST" action=" {{ route('Shelves_Edit') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['commodityID'] }}">
                          <input type="hidden" name="commodity_name" value="{{ $AllInformation[$i]['commodityName'] }}">
                          <input type="hidden" name="post_type" value="Shelves">
                        </form>
                    @endif
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['commodityName'] }}
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['speciseName'] }}
                </td>
                <td class="text-center">
                    @if($AllInformation[$i]['groupbuyPrice']!=null)
                        {{ $AllInformation[$i]['groupbuyPrice'] }}
                    @else
                        {{ $AllInformation[$i]['commodityPrice'] }}
                    @endif
                </td>
                <td class="text-center">
                    <?php 
                        $time = preg_split("/ /",$AllInformation[$i]['created_at']);
                        echo $time[0];
                    ?>
                </td>
                <td class="text-center">
                    @if($AllInformation[$i]['isShelves']!=1)
                        <button href="" class="btn btn-primary" disabled>修改</button>
                    @else
                        <form role="form" method="POST" action=" {{ route('Shelves_Edit') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['groupbuyID'] }}">
                          <input type="hidden" name="commodity_name" value="{{ $AllInformation[$i]['commodityName'] }}">
                          <input type="hidden" name="post_type" value="Edit">
                        </form>
                        <button class="edit_btn btn btn-primary">修改</button>
                    @endif
                </td>
            </tr>
            @endfor
        </table>
      </div>
    </div>

    <div id="loding_page" style="display: none;">
        @include('partials.Loading')
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.groupbuy_unShelves').change(function(event) {
                $('#loding_page').children().addClass('loading_modal_200');
                $('#loding_page').show();
                $(this).next().submit();
            });
            $('.groupbuy_Shelves').change(function(event) {
                $(this).next().submit();
            });
            $('.edit_btn').click(function(event) {
                $(this).prev().submit();
            });
        });
    </script>
    @if(count($message_data))
        @include('partials.GroupbuyMessage')
    @endif
@endif
@if($Area == 'timelimit')
    <div class="panel panel-default" style="margin-top: 20px;">
      <div class="panel-heading">
        <h3 class="panel-title">限量區  (建議：上架時記得一般商品要下架)</h3>
      </div>
      <div class="panel-body" style="padding: 0px;">
        <table class="table">
            <tr>
                <th class="text-center">是否上架</th>
                <th class="text-center">商品名稱</th>
                <th class="text-center">商品總類</th>
                <th class="text-center">商品價格</th>
                <th class="text-center">新增日期</th>
                <th class="text-center">修改限量內容</th>
            </tr>
            <?php $MAX = count($AllInformation) ?>
            @for($i=0;$i<$MAX;$i++)
            <tr>
                <td class="text-center">
                @if($AllInformation[$i]['isShelves']==1)
                   <input class="timelimit_unShelves" type="checkbox" checked />
                    <form role="form" method="POST" action=" {{ route('unShelves') }} ">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="page_type" value="{{ $type }}">
                      <input type="hidden" name="type" value="{{ $Area }}">
                      <input type="hidden" name="ID" value="{{ $AllInformation[$i]['limitedID'] }}">
                    </form>
                @else
                    <input class ="timelimit_Shelves" type="checkbox"/>
                    <form role="form" method="POST" action=" {{ route('Shelves_Edit') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['commodityID'] }}">
                          <input type="hidden" name="commodity_name" value="{{ $AllInformation[$i]['commodityName'] }}">
                          <input type="hidden" name="post_type" value="Shelves">
                    </form>
                @endif
                    
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['commodityName'] }}
                </td>
                <td class="text-center">
                    {{ $AllInformation[$i]['speciseName'] }}
                </td>
                <td class="text-center">
                    @if($AllInformation[$i]['limitedPrice']!=null)
                        {{ $AllInformation[$i]['limitedPrice'] }}
                    @else
                        {{ $AllInformation[$i]['commodityPrice'] }}
                    @endif
                </td>
                <td class="text-center">
                    <?php 
                        $time = preg_split("/ /",$AllInformation[$i]['created_at']);
                        echo $time[0];
                    ?>
                </td>
                <td class="text-center">
                    @if($AllInformation[$i]['isShelves']!=1)
                        <button href="" class="btn btn-primary" disabled>修改</button>
                    @else
                        <form role="form" method="POST" action=" {{ route('Shelves_Edit') }} ">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="page_type" value="{{ $type }}">
                          <input type="hidden" name="type" value="{{ $Area }}">
                          <input type="hidden" name="ID" value="{{ $AllInformation[$i]['limitedID'] }}">
                          <input type="hidden" name="commodity_name" value="{{ $AllInformation[$i]['commodityName'] }}">
                          <input type="hidden" name="post_type" value="Edit">
                        </form>
                        <button class="edit_btn btn btn-primary">修改</button>
                    @endif
                </td>
            </tr>
            @endfor
        </table>
      </div>
    </div>  
    <script type="text/javascript">
        $(document).ready(function() {
            $('.timelimit_unShelves').change(function(event) {
                $(this).next().submit();
            });
            $('.timelimit_Shelves').change(function(event) {
                $(this).next().submit();
            });
            $('.edit_btn').click(function(event) {
                $(this).prev().submit();
            });
        });
    </script>
    @if(count($message_data))
        @include('partials.TimelimitMessage')
    @endif
    
@endif
@if($Area == 'inventory')
    <div class="panel panel-default" style="margin-top: 20px;">
      <div class="panel-heading">
        <h3 class="panel-title">庫存區</h3>
      </div>
      <div class="panel-body" style="padding: 0px;">
        <table class="table">
            <tr>
                <th class="text-center">商品名稱</th>
                <th class="text-center">商品總類</th>
                <th class="text-center">目前存量</th>
                <th class="text-center">尚未出貨</th>
                <th class="text-center">未售出</th>
                <th class="text-center">修改確認</th>
            </tr>
            <?php $MAX = count($AllInformation); ?>
            @for($i=0;$i<$MAX;$i++)
            <tr>
                <form role="form" method="POST" action=" {{ route('UpdateInventory') }}  ">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="page_type" value="{{ $type }}">
                    <input type="hidden" name="type" value="{{ $Area }}">
                    <input type="hidden" name="commodityID" value="{{ $AllInformation[$i]['commodityID'] }}">
                    <input type="hidden" name="nowAmount" value="{{ $AllInformation[$i]['totalAmount'] }}">
                    <td class="text-center">
                        {{ $AllInformation[$i]['commodityName'] }}
                    </td>
                    <td class="text-center">
                        {{ $AllInformation[$i]['speciseName'] }}
                    </td>
                    <td class="text-center">
                    </td>
                    <td class="text-center">
                        @for($j =0; $j< count($message_data) ; $j++)
                            @if($AllInformation[$i]['commodityID']==$message_data[$j]['commodityID'] )
                            {{$message_data[$j]['SumAmount']}}
                            @endif
                        @endfor
                    </td>
                    <td class="text-center">
                        <input type="text" class="inventory" name="Amount" value="{{ $AllInformation[$i]['totalAmount'] }}">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary" type="submit">確認</button>
                    </td>
                </form>
                
            </tr>
            @endfor
        </table>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            init();
        });

        function init(){
            $(".inventory").each(function(){
                var iniventory = $(this).val();
                sale = $(this).parent().prev().text();
                sale = trim(sale);
                if(sale==""){
                    sale=0;
                }
                //console.log(parseInt(iniventory)-parseInt(sale));
                $(this).parent().prev().prev().text(parseInt(iniventory)+parseInt(sale));
            });
        }
        
        function trim(str) {
          return str.replace(/(^\s+)|(\s+$)/g, "");
        }
    </script>
    <script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
    @if(count($message_text))
        @section('message')
            @include('partials.Message')
        @show
    @endif
@endif