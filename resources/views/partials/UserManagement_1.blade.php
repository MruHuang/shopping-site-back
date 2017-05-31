<table class="table table-bordered">
    <tr>
        <th class="text-center"><a class="order_type" data-orderType="memberAccount">帳號</a></th>
        <th class="text-center"><a class="order_type" data-orderType="memberName">會員名稱</a></th>
        <th class="text-center"><a class="order_type" data-orderType="memberPhone">手機</a></th>
        <th class="text-center"><a class="order_type" data-orderType="recommender">推薦人</a></th>
        <th class="text-center"></th>
        <th class="text-center"></th>
    </tr>
    <?php $MAX = count($AllInformation); ?>
    @for($i=0;$i<$MAX;$i++)
    <tr>
        <td class="text-center">{{ $AllInformation[$i]['memberAccount'] }}</td>
        <td class="text-center">{{ $AllInformation[$i]['memberName'] }}</td>
        <td class="text-center">{{ $AllInformation[$i]['memberPhone'] }}</td>
        <td class="text-center">{{ $AllInformation[$i]['recommenderName'] }}</td>
        <td class="text-center"><a data-memberID="{{ $AllInformation[$i]['memberID'] }}" data-actionType="Member" data-userType="Apply" class="agree_btn btn btn-primary">同意</a></td>
        <td class="text-center"><a href="{{ route('UpdateUserData',[
        'memberID'=>$AllInformation[$i]['memberID'],
        'action_type'=>'Apply',
        'user_type'=>'Apply'
        ]) }}" class="btn btn-primary">不同意</a></td>
    </tr>
    @endfor
</table>

<form role="form" method="POST" id="agree_member_form" style="font-size: 20px;" action=" {{ route('PostUpdateUserData') }}  ">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="agree_member_memberID" name="memberID" value="">
    <input type="hidden" id="agree_member_action_type" name="action_type" value="">
    <input type="hidden" id="agree_member_user_type" name="user_type" value="">
</form>

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

<div id="loding_page" style="display: none;">
    @include('partials.Loading')
</div>

<script type="text/javascript">
    $('.agree_btn').click(function(event) {
        var memberID = $(this).attr('data-memberID');
        var action_type = $(this).attr('data-actionType');
        var user_type = $(this).attr('data-userType');
        console.log(memberID,action_type,user_type);
        $('#agree_member_memberID').val(memberID);
        $('#agree_member_action_type').val(action_type);
        $('#agree_member_user_type').val(user_type);
        $('#loding_page').show();
        $('#agree_member_form').submit();
    });
</script>