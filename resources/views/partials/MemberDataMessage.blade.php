
<div class="fade message_modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body" >
                <div class="row" style="margin-right: 20px;margin-left: 20px;">
                    <div class="form-group">
                        <label>會員名稱</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberName'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>會員Email</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberEmail'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>會員LineID</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberLineid'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>會員手機</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberPhone'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>會員積分</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberIntegral'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>此會員取消次數</label>
                        <input class="form-control" type="text" value="{{ $memberData[0]['memberCancel'] }}" disabled>
                    </div>
                </div>
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