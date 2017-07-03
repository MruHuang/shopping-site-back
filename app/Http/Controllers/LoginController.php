<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Login\Login as LG;
use App\Model\manager as MSQL;

use View;

class LoginController extends Controller
{
    //
    private $lg;
    public function __construct(LG $lg){
    	$this->lg = $lg;
    }

    public function login(
        Request $Request,
        $message_text=null
	){
        $managment_account = $Request->input('managment_account');
        $managment_password = $Request->input('managment_password');
        $result = $this->lg->Login(
            $managment_account,
            $managment_password
        );
    	if($result){
            $message_text = null;
            return  redirect()->route('loginUserData',['user_type'=>'Apply','message_text'=>$message_text]);
        }
    	else{
            $message_text = "登入失敗";
    		return View::make('Login',[
                'message_text'=>$message_text
                ]);
        }
    }

    public function logout(){
        $this->lg->logout();
        return View::make('Login',[
            'message_text'=>null
        ]);
    }

    // public function managerRegister(Request $Request){
    //     //return $Request->all();
    //     $message_text = "null";

    //     try{
    //         $manager = new MSQL();
    //         $manager->managerAccount = $Request->input('manager_account');
    //         $manager->managerPassword = bcrypt($Request->input('manager_password'));
    //         $manager->managerPermission = 100;
    //         $manager->managerEmail = $Request->input('manager_Email');
    //         $manager->save();

    //         $message_text = '註冊成功';
    //     }catch(\Exception $e){
    //         $message_text = '註冊失敗';
    //         $message_text = $e;
    //     }finally{
    //         return View::make('managerRegister',[
    //             'message_text'=>$message_text
    //             ]);
    //     }   
    // }
}
