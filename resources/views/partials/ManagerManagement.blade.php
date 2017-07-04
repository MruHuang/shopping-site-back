<form role="form" method="POST" action=" {{ route('PostmanagerRegister') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label>管理者帳號</label>
    <input type="text" class="form-control" id ="manager_account" name="manager_account"  placeholder="輸入帳號">
    <div style="margin-top: 10px;"></div>
    <label>密碼</label>
    <input type="password" class="form-control" id ="manager_password" name="manager_password" placeholder="輸入密碼">
    <div style="margin-top: 10px;"></div>
    <label>密碼再確認</label>
    <input type="password" class="form-control" id ="manager_again_password" name="manager_again_password" placeholder="輸入密碼再確認">
    <div style="margin-top: 10px;"></div>
    <label>信箱</label>
    <input type="text" class="form-control" id ="manager_Email" name="manager_Email" placeholder="輸入信箱 Ex：XXXX@XXXX.com">
    <button class="btn btn-info register_button_style" style="float: right; margin-top: 20px;" type="submit" id="submit_btn" >送出</button>
</form>