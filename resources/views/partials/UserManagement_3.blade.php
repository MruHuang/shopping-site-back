<table class="table table-bordered">
    <tr>
        <th class="text-center"><a class="order_type" data-orderType = "memberAccount">帳號</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberName">會員名稱</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberPhone">手機</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberLineid">line-id</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberIntegral">紅利點數</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "recommender">推薦人</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberCancel">取消訂購次數</a></th>
        <th class="text-center order_type" ></th>
    </tr>
    <?php $MAX = count($AllInformation) ?>
    @for($i=0;$i<$MAX;$i++)
        <tr>
            <td class="text-center">{{$AllInformation[$i]['memberAccount']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberName']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberPhone']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberLineid']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberIntegral']}}</td>
            <td class="text-center">{{$AllInformation[$i]['recommenderName']}}</td>
            <td class="text-center">{{$AllInformation[$i]['memberCancel']}}</td>
            <td class="text-center"><a href="{{ route('UpdateUserData',[
            'memberID'=>$AllInformation[$i]['memberID'],
            'action_type'=>'Member',
            'user_type'=>'Black'
            ]) }}" class="btn btn-primary">解除封鎖</a></td>
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