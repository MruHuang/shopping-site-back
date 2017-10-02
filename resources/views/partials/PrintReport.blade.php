<form role="form" method="POST" id="print_report_area" action=" {{ route('PostPrintReport') }}">
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
    <div id="date_start_area" style="display:none;">
        <label id="date_start_title">起始日期</label>
        {{--  <input type="date" class="form-control" id ="date_start" name="date_start" min="2000-01-01" max="9999-12-31">  --}}
        <input id="thedate" class="form-control" type="text" id ="date_start" name="date_start" />
    </div>
    
    <div style="margin-top: 10px;"></div>
    <div id="date_end_area" style="display:none;">
        <label id="date_end_title">結束日期</label>
        {{--  <input type="date" class="form-control" id ="date_end" name="date_end" min="2000-01-01" max="9999-12-13">  --}}
        <input id="thedate2" class="form-control" type="text" id ="date_end" name="date_end" />
    </div>
    <div style="margin-top: 10px;"></div>
    <button class="btn btn-info register_button_style" style="float: right; margin-top: 20px;" type="submit" id="submit_btn" >下載</button>
</form>

<script type="text/javascript">
    var Today=new Date();
    var date=Today.getFullYear()+ "-" + (Today.getMonth()+1<10 ? '0' : '')+(Today.getMonth()+1) + "-" + (Today.getDate()<10 ? '0' : '')+Today.getDate();
    
    $(document).ready(function(event){
        $('#report_type').change(function(event){
            var report_type = $('#report_type').val();
            changeForm(report_type);
        });
        $('#submit_btn').click(function(event){
            event.preventDefault();
            var report_type = $('#report_type').val();
            if(report_type=='single_Sales_Details'||report_type=='VIP'){
                checkdate();
            }else{
                $('#print_report_area').submit();
            }
        });
        $('#thedate').datepicker({
            dateFormate: 'yy-mm-dd',
            maxDate: 0  , //限制最小日期，從今天開始。過去日期不可選。
        });
        $('#thedate2').datepicker({
            dateFormate: 'yy-mm-dd',
            maxDate: 0  , //限制最小日期，從今天開始。過去日期不可選。
        });
    });

    function changeForm(report_type){
        if(report_type == 'sales_Details'){
            $('#date_start_area').hide();
            $('#date_end_area').hide();
        }else if(report_type == 'daily_Shipments_Person'){
            $('#date_start').val(date);
            $('#date_start_title').text('選擇日期');
            $('#date_start_area').show();
            $('#date_end_area').hide();
        }else if(report_type == 'daily_Shipments_Commodity'){
            $('#date_start').val(date);
            $('#date_start_title').text('選擇日期');
            $('#date_start_area').show();
            $('#date_end_area').hide();
        }else if(report_type == 'daily_Pay'){
            $('#date_start').val(date);
            $('#date_start_title').text('選擇日期');
            $('#date_start_area').show();
            $('#date_end_area').hide();
        }else if(report_type == 'single_Sales_Details'){
            $('#date_start').val('');
            $('#date_end').val('');
            $('#date_start_title').text('起始日期');
            $('#date_start_area').show();
            $('#date_end_area').show();
        }else if(report_type == 'VIP'){
            $('#date_start').val('');
            $('#date_end').val('');
            $('#date_start_title').text('起始日期');
            $('#date_start_area').show();
            $('#date_end_area').show();
        }else{
            $('#date_start_area').hide();
            $('#date_end_area').hide();
        }
    }

    function checkdate(){
        var date_start = $('#date_start').val();
        var date_end = $('#date_end').val();
        if(date_start==''&&date_end==''){
            alert('請選擇日期');
        }else if(date_start>date_end){
            alert('結束日期需大於起始日期');
        }else{
            $('#print_report_area').submit();
        }
    }


</script>
