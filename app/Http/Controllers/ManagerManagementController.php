<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerRegisterRequest;
use App\Model\manager as MSQL;
use View;
use Hash;

class ManagerManagementController extends Controller
{
    //
    public function managerRegister(ManagerRegisterRequest $Request){
        //return $Request->all();
        $message_text = "null";
        $managerAccount = $Request->input('manager_account');
        if(MSQL::LoginCheck($managerAccount)->count()){
            $message_text = '帳號重複，註冊失敗';
            return View::make('ManageManager',['message_text'=>$message_text]);
        }else{
            try{
                $manager = new MSQL();
                $manager->managerAccount = $Request->input('manager_account');
                $manager->managerPassword = bcrypt($Request->input('manager_password'));
                $manager->managerPermission = 100;
                $manager->managerEmail = $Request->input('manager_Email');
                $manager->save();

                $message_text = '註冊成功';
            }catch(\Exception $e){
                $message_text = '註冊失敗';
                $message_text = $e;
            }finally{
                return View::make('ManageManager',['type'=>'ManagerManagement','message_text'=>$message_text]);
            }  
        } 
    }
}
