<table class="table table-bordered">
    <tr>
        <th class="text-center"><a class="order_type" data-orderType = "memberAccount">帳號</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberName">會員名稱</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberPhone">手機</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberLineid">line-id</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberIntegral">積分</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "recommender">推薦人</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberCancel">取消訂購次數</a></th>
        <th class="text-center"></th>
    </tr>
    <?php $MAX = count($AllInformation) ?>
    @for($i=0;$i<$MAX;$i++)
        <tr>
            <td class="text-center">{{$AllInformation[$i]['memberAccount']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberName']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberPhone']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberLineid']}}</td>
            <td class="text-center">
                <div class="row">
                    <form class="update_user_integral" method="post" action=" {{ route('UpdateUserIntegral') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_type" value="{{ $user_type }}">
                        <input type="hidden" name="memberID" value="{{ $AllInformation[$i]['memberID'] }}">
                        <div class="col-xs-7" style="padding-right: 0px;">
                            <input class="form-control user_integral" type="text" name="memberIntegral" style="width: 100px;" value="{{$AllInformation[$i]['memberIntegral']}}">
                        </div>
                        <div class="col-xs-5" style="padding-left: 0px; display: none;">
                            <button type="submit" class="btn btn-danger">更改</a>
                        </div>
                    </form>
                </div>
            </td>
            <td class="text-center">{{$AllInformation[$i]['recommenderName']}}</td>
            <td class="text-center">
                <div class="row">
                    <form class="update_user_cancel" method="post" action=" {{ route('UpdateUserCancel') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_type" value="{{ $user_type }}">
                        <input type="hidden" name="memberID" value="{{ $AllInformation[$i]['memberID'] }}">
                        <div class="col-xs-7" style="padding-right: 0px;">
                            <input class="form-control user_cancel" type="text" name="memberCancel" style="width: 100px;" value="{{$AllInformation[$i]['memberCancel']}}">
                        </div>
                        <div class="col-xs-5" style="padding-left: 0px; display: none;">
                            <button type="submit" class="btn btn-danger">更改</a>
                        </div>
                    </form>
                </div>
            </td>
            <td class="text-center"><a href="{{ route('UpdateUserData',[
            'memberID'=>$AllInformation[$i]['memberID'],
            'action_type'=>'Black',
            'user_type'=>'All'
            ]) }}" class="btn btn-primary">封鎖</a></td>
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