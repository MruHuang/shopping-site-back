<div class="container" style="width: 80%; margin-right: auto; margin-left: auto; margin-top: 20px;">
    <div class="row">
        <div class="col-xs-2">
            <a href="{{ route('loginUserData',['user_type'=>'Apply']) }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">用戶管理</a>
        </div>
        <div class="col-xs-2">
            <a href="{{ route('ManageManager') }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">管理員管理</a>
        </div>
        <div class="col-xs-2">
            <a href="{{ route('AddCommodity') }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">商品管理</a>
        </div>
        <div class="col-xs-2">
            <a href="{{ route('GetOrder',['type'=>'All']) }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">訂單管理</a>
        </div>
        <div class="col-xs-2">
            <a href="{{ route('GetAll') }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">優惠管理</a>
        </div>
        <div class="col-xs-2">
            <a href="{{ route('AllIntegral') }}" class="btn btn-primary shoppingCar_main_btn" style="width: 100%">贈送紅利點數</a>
        </div>
    </div>
</div>
