<table class="table table-bordered">
    <tr>
        <th class="text-center"><a class="order_type" data-orderType = "memberAccount">帳號</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberName">會員名稱</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberPhone">手機</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberLineid">line-id</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberIntegral">紅利點數</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "recommender">推薦人</a></th>
        <th class="text-center"><a class="order_type" data-orderType = "memberCancel">取消訂購次數</a></th>
        <th class="text-center"></th>
        <th class="text-center"></th>
    </tr>
    <?php $MAX = count($AllInformation) ?>
    @for($i=0;$i<$MAX;$i++)
        <tr>
            <td class="text-center" id="memberAccount-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberAccount']}}</td>
            <td class="text-center" id="memberName-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberName']}}</td>
            <td class="text-center" id="memberPhone-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberPhone']}}</td>
            <td class="text-center" id="memberLineid-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberLineid']}}</td>
            <td class="text-center" id="memberIntegral-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberIntegral']}}</td>
            <td class="text-center" id="recommenderName-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['recommenderName']}}</td>
            <td class="text-center" id="memberCancel-{{$AllInformation[$i]['memberID']}}" >{{$AllInformation[$i]['memberCancel']}}</td>
            <td><button class="btn btn-primary update_memberData_btn" data-memberID="{{$AllInformation[$i]['memberID']}}">修改</button></td>
            <td class="text-center"><a href="{{ route('UpdateUserData',[
            'memberID'=>$AllInformation[$i]['memberID'],
            'action_type'=>'Black',
            'user_type'=>'All'
            ]) }}" class="btn btn-primary">封鎖</a></td>
        </tr>
    @endfor
</table>

@include('partials.UpdateMemberDataMessage')

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

