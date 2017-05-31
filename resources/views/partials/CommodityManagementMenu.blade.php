<div class="container" style="width: 80%; margin-right: auto; margin-left: auto; margin-top: 20px;">
    <div class="row">
        <div class="col-xs-3">
            <a href="{{ route('commodity',[
            'page_type'=>'ShelvesCommodity',
            'type'=>'commodity'
            ]) }}" class="btn btn-primary Commodity_Management_Menu_btn">一般區</a>
        </div>
        <div class="col-xs-3">
            <a href="{{ route('commodity',[
            'page_type'=>'ShelvesCommodity',
            'type'=>'groupbuy'
            ]) }}" class="btn btn-primary Commodity_Management_Menu_btn">團購區</a>
        </div>
        <div class="col-xs-3">
            <a href="{{ route('commodity',[
            'page_type'=>'ShelvesCommodity',
            'type'=>'timelimit'
            ]) }}" class="btn btn-primary Commodity_Management_Menu_btn">限時區</a>
        </div>
        <div class="col-xs-3">
            <a href="{{ route('inventory',[
            'page_type'=>'ShelvesCommodity',
            'type'=>'inventory'
            ]) }}" class="btn btn-primary Commodity_Management_Menu_btn">庫存量</a>
        </div>
    </div>
</div>

