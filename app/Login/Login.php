<?php

namespace App\Login;

use App\SessionManagement\SessionManagement as SM;
use App\Login\LoginSQL as lgSQL;

class Login
{
    //
    private $lg;
    private $sm;
    public function __construct(lgSQL $lg, SM $sm){
        $this->lg = $lg;
        $this->sm = $sm;
    }

    public function Login(
        $managment_account,
        $managment_password
    ){  
        if($this->sm->LoginSessionCheck())
            return true;
        else if($this->sm->LoginCount() <= 5){
            if(
                $this->lg->LoginCheck(
                    $managment_account,
                    $managment_password
                )
            ){
                $this->sm->RememberSession(
                    $managment_account,
                    $managment_password
                );
                return true;
            }else{
               // $this->sm->ForgetSession();
                return false;
            }
        }
        else
            return false;
    }

    public function logout(){
        $this->sm->Logout();
    }
}
