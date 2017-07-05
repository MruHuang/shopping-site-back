<form role="form" method="POST" action=" {{ route('PostPrintReport') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label>選擇報表種類</label>
    <select class="form-control" id="report_type" name="report_type" >
        <option value="sales_Details" SELECTED>銷售明細</option>
        <option value="daily_Shipments_Person">每日出貨明細(人)</option>
        <option value="daily_Shipments_Commodity">每日出貨明細(物)</option>
        <option value="daily_Pay">每日貨款收入統計</option>
        <option value="single_Sales_Details">單項商品銷售明細</option>
        <option value="VIP">VIP客戶</option>
        <option value="member_Integral">會員紅利</option>
    </select>
    <div style="margin-top: 10px;"></div>
    <label>起始日期</label>
    <input type="date" class="form-control" id ="date_start" name="date_start">
    <div style="margin-top: 10px;"></div>
    <label>結束日期</label>
    <input type="date" class="form-control" id ="date_end" name="date_end">
    <div style="margin-top: 10px;"></div>
    <button class="btn btn-info register_button_style" style="float: right; margin-top: 20px;" type="submit" id="submit_btn" >送出</button>
</form>
