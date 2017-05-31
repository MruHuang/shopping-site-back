<?php

namespace App\SessionManagement;


   
use Session;

class SessionManagement
{
    //
    public function RememberSession(
        $managment_account,
        $managment_password
    ){
            Session::forget('Managment');

            Session::put('Managment.login', 'login');
            Session::put('Managment.managment_account', $managment_account);
            Session::put('Managment.managment_password', $managment_password);
    		return true;
    }

    public function Logout(){
        Session::forget('Managment');
    }

    public function LoginSessionCheck(){
        $result = Session::get('Managment.login', null);
        if($result == 'login')
            return true;
        else
            return false;
    }

    public function LoginCount(){
        $number = Session::get('Managment.LoginCount', null);
        Session::put('Managment.LoginCount', ++$number);
        return $number;
    }

}
