<?php

namespace App\Login;

use App\Model\manager as mgSQL;
use App\SessionManagement\SessionManagement as SM;
use Hash;

class LoginSQL
{
    //
   //  public function LoginCheck(
   //      $managment_account,
   //      $managment_password
   //  ){
   //  	$result = mgSQL::ManagerCheck(
			// $managment_account,
   //          $managment_password
   //  	)
   //      ->count();
   //      if ($result == 1)
   //          return true;
   //      else
   //          return false;
   //  }

    public function LoginCheck(
        $managment_account,
        $managment_password
    ){
        $result = mgSQL::LoginCheck(
            $managment_account
        )->get();
        if(count($result)!=0){
            $result = Hash::check($managment_password,$result[0]['managerPassword']);
            if ($result) return true;
            else return false;
        }else{
            return false;
        }
    }
}
