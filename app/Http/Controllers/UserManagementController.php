<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserManagement\User as US;
use View;
use Log;

class UserManagementController extends Controller
{
    //
    private $us;
    public function __construct(US $us){
    	$this->us = $us;
    }

    // public function GetUserData($user_type = null){
    // 	$result = $this->us->UserData($user_type);
    //     //return $result;
    // 	return view::make('UserManagement',[
    //         'message_text'=>null,
    //         'AllInformation'=>$result,
    //         'user_type'=>$user_type
    //         ]);
    // }

    public function GetUserData(Request $Request,$user_type = null,$message_text = null){
        //return $Request->All();
        if($Request->All() == null){
            $user_type = $user_type;
            $order_type = "created_at";
            $this_page = 1;
            $search_text = null;
            $search_key = null;

        }else{
            $user_type = $Request->input('user_type');
            $this_page = $Request->input('this_page');
            $order_type = $Request->input('order_type');
            $search_text = $Request->input('search_text');
            $search_key = "%".$search_text."%";
        }

        if($search_text != null){
            $count_page = $this->us->CountInformation($user_type,$search_key);
        }else{
            $count_page = $this->us->CountInformation($user_type);
        }
        $count_page = (($count_page%5)==0)?(int)($count_page/5):((int)($count_page/5)+1);

        $start_number = ($this_page-1)*5+1;
        $end_number = $this_page*5;
        $result = $this->us->UserData(
            $user_type,
            $start_number,
            $end_number,
            $order_type,
            $search_key
            );
        //return $result;
        return view::make('UserManagement',[
            'message_text'=>$message_text,
            'AllInformation'=>$result,
            'user_type'=>$user_type,
            'search_text'=>$search_text,
            'this_page'=>$this_page,
            'order_type'=>$order_type,
            'count_page'=>$count_page
        ]);
    }

    public function UpdateUserData(
    	$memberID,
        $action_type,
        $user_type
	){
    	$message_text =null;
        try{
            $result = $this->us->UpdateMember(
                $memberID,
                $action_type,
                $user_type
            );
        }catch(\Exception $e){
            $message_text ="更改狀態失敗。";
        }finally{
            return  redirect()->route('loginUserData',['user_type'=>$user_type,'message_text'=>$message_text]);
        }
    }

    public function PostUpdateUserData(Request $Request){
        //return $Request->all();
        $memberID = $Request->input('memberID');
        $action_type = $Request->input('action_type');
        $user_type = $Request->input('user_type');
        $message_text =null;
        try{
            $result = $this->us->UpdateMember(
                $memberID,
                $action_type,
                $user_type
            );
        }catch(\Exception $e){
            $message_text ="更改狀態失敗。";
        }finally{
            return  redirect()->route('loginUserData',['user_type'=>$user_type,'message_text'=>$message_text]);
        }
    }

    // public function UpdateUserIntegral(Request $Request){
    //     //return  $Request->All();
    //     $message_text = null;
    //     $user_type = $Request->input('user_type');
    //     $memberID = $Request->input('memberID');
    //     $memberIntegral = $Request->input('memberIntegral');
    //     try{
    //         $result = $this->us->UpdateMemberIntegral(
    //             $memberID,
    //             $memberIntegral
    //         );
    //         $message_text = "更改成功";
    //     }catch(\Exception $e){
    //         $message_text = "更改失敗";
    //     }finally{
    //         return  redirect()->route('loginUserData',['user_type'=>$user_type,'message_text'=>$message_text]);
    //     }
    // }

    public function UpdateMemberData(Request $Request){
        // return  $Request->All();
        $message_text = "123";
        $user_type = $Request->input('user_type');
        $memberID = $Request->input('memberID');
        $memberName = $Request->input('memberName');
        $memberEmail = $Request->input('memberEmail');
        $memberIntegral = $Request->input('memberIntegral');
        $memberCancel = $Request->input('memberCancel');
       
        try{
            $result = $this->us->UpdateMemberData(
                $memberID,
                $memberName,
                $memberIntegral,
                $memberCancel,
                $memberEmail
            );
            $message_text = "更改成功";
        }catch(\Exception $e){
            Log::info($e);
            $message_text = "更改失敗";
        }finally{
            return  redirect()->route('loginUserData',['user_type'=>$user_type,'message_text'=>$message_text]);
        }
    }

    public function UpdateUserCancel(Request $Request){
    	//return  $Request->All();
    	$message_text = null;
        $user_type = $Request->input('user_type');
        $memberID = $Request->input('memberID');
        $memberCancel = $Request->input('memberCancel');
        try{
            $result = $this->us->UpdateMemberCancel(
                $memberID,
                $memberCancel
            );
            $message_text = "更改成功";
        }catch(\Exception $e){
            $message_text = "更改失敗";
        }finally{
            return  redirect()->route('loginUserData',['user_type'=>$user_type,'message_text'=>$message_text]);
        }
    }

    public function Search_user(Request $Request,$message_text = null){
        //return  $Request->All();
        $user_type = $Request->input('user_type');
        $order_type = "created_at";
        $this_page = 1;
        $search_text = $Request->input('search_text');
        $search_key = "%".$search_text."%";

        $start_number = ($this_page-1)*5+1;
        $end_number = $this_page*5;

        $count_page = $this->us->CountInformation($user_type,$search_key);
        $count_page = (($count_page%5)==0)?(int)($count_page/5):((int)($count_page/5)+1);

        $result = $this->us->UserData(
            $user_type,
            $start_number,
            $end_number,
            $order_type,
            $search_key
        );

        //return $result;

        return view::make('UserManagement',[
            'message_text'=>$message_text,
            'AllInformation'=>$result,
            'user_type'=>$user_type,
            'search_text'=>$search_text,
            'this_page'=>$this_page,
            'order_type'=>$order_type,
            'count_page'=>$count_page
        ]);
    }
}
