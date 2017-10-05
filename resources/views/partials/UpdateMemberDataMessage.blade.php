<div class="fade message_modal " id='UpdateMemberDataMessage' style='display:none'>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">更改會員基本資料</h4>
            </div>
            <div class="modal-body" >
                <form role="form" method="POST" style="margin: 0px;" action=" {{ route('UpdateMemberData') }}">
                    <div class="row" style="margin-right: 20px;margin-left: 20px;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_type" value="All">
                    <input type="hidden" name="memberID" id='memberID'>
                        <div class="form-group">
                            <label>會員帳號</label>
                            <input class="form-control" type="text" id='memberAccount' name='memberAccount'>
                        </div>
                        <div class="form-group">
                            <label>會員名稱</label>
                            <input class="form-control" type="text" id='memberName' name='memberName'>
                        </div>
                        <div class="form-group">
                            <label>會員LineID</label>
                            <input class="form-control" type="text" id='memberLineid' name='memberLineid'>
                        </div>
                        <div class="form-group">
                            <label>會員手機</label>
                            <input class="form-control" type="text" id='memberPhone' name='memberPhone'>
                        </div>
                        <div class="form-group">
                            <label>會員積分</label>
                            <input class="form-control" type="text" id='memberIntegral' name='memberIntegral' >
                        </div>
                        <div class="form-group">
                            <label>此會員取消次數</label>
                            <input class="form-control" type="text" id='memberCancel' name='memberCancel' >
                        </div>
                        <button class='btn btn-primary'>確定更改</button>
                    </div>
                </form>
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