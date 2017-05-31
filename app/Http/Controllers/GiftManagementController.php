<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GiftManagement\Gift as GF;
use View;

class GiftManagementController extends Controller
{
    //
    private $gf;
    public function __construct(GF $gf){
    	$this->gf = $gf;
    }

    public function AllIntegral($message_text=null){
    	$result = $this->gf->GetAllMemberIntegral();
        return View::make('Giftpoints',['result'=>$result,'message_text'=>$message_text]);
    }

    public function UpdateMemberIntegral(Request $Request){
        $GiftIntegral = $Request->input('GiftIntegral');
        $message_text =null;
        //return $this->gf->UpdateMemberIntegral($GiftIntegral);
        try{
            $this->gf->UpdateMemberIntegral($GiftIntegral);
            $message_text = "贈送成功";
        }catch(\Exception $e){
            $message_text = "贈送失敗";
            $message_text = $e;
        }finally{
            //return $message_text;
            return $this->AllIntegral($message_text);
        }
    }
}
