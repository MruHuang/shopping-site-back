<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="padding: 0px;"><img src="{{ asset('img/BlueStarSC.png') }}" style="width: 85px;"></a>
        </div>
        <div class="navbar-left"><a class="navbar-brand search_nav_title_style" style="color: #337ab7; font-size: 50px; margin-top: 10px;" href="#">藍星購物</a></div>
        <!-- <div class="navbar-header">
             <a class="navbar-brand search_nav_title_style" href="{{-- route('HomeGet') --}}">藍星購物</a>
        </div> -->
        <div class="collapse navbar-collapse search_nav_text_style">
            <a href="{{ route('LogOut') }}" class="navbar-link navbar-text navbar-right" onclick="delCookie()">登出</a>
            <p class="navbar-text navbar-right"><a href="#" class="navbar-link">你好! 管理員</a></p>
        </div>
    </div>
</nav>
<script type="text/javascript">
	function delCookie(){
		ClearCookies('commodity_name');
		ClearCookies('commodity_price');
		ClearCookies('commodity_amount');
		ClearCookies('commodity_introduction');
		ClearCookies('commodity_video');
	}
</script>