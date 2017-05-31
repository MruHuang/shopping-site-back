<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\IntegralManagement\Integral as IT;
use View;

class IntegralManagementController extends Controller
{
    //
	private $it;
    public function __construct(IT $it){
    	$this->it = $it;
    }
    public function GetInregral($message_text=null){
        $result = $this->it->GetIntegral();
        //return $result;
        return View::make('PreferentialManagement',['AllInformation'=>$result[0],'message_text'=>$message_text]);
    }
    public function UpdateIntegral(
    	$integralProportion,
        $freight,
        $freeFreight
    ){
    	$result = $this->it->UpdateIntegral(
    		$integralProportion,
	        $freight,
	        $freeFreight
        );
        return $result;
    }

    public function UpdateIntegralProportion(Request $Request)
    {  
        $integralProportion = $Request->input('integral_proportion');
        try{
            $result = $this->it->UpdateIntegralProportion(
                $integralProportion
            );
            $message_text = "修改成功";
        }catch(\Exception $e){
            $message_text = "修改失敗，請try again。";
        }finally{
            return $this->GetInregral($message_text);
        }
    }

    public function UpdateIntegralFreight(Request $Request)
    {  
        $freight = $Request->input('freight');
        $freeFreight = $Request->input('freeFreight');
        try{
            $result = $this->it->UpdateIntegralFreight(
                $freight,
                $freeFreight
            );
            $message_text = "修改成功";
        }catch(\Exception $e){
            $message_text = "修改失敗，請try again。";
        }finally{
            return $this->GetInregral($message_text);
        }
    }

    public function UpdateRemittance(Request $Request)
    {
        $RemittanceAccount = $Request->input('RemittanceAccount');
        try{
            $result = $this->it->UpdateRemittance(
                $RemittanceAccount
            );
            $message_text = "修改成功";
        }catch(\Exception $e){
            $message_text = "修改失敗，請try again。";
        }finally{
            return $this->GetInregral($message_text);
        }
    }

    public function SendAllEmail(Request $Request)
    {
        $email_content = $Request->input('email_content');
        //return $email_content;
        $result = '123';
        try{
            $result = $this->it->SendAllEmail(
                $email_content
            );
            $message_text = "傳送成功";
        }catch(\Exception $e){
            //$message_text =$e;
            $message_text = "傳送失敗，請try again。";
        }finally{
            //return $message_text;
            return $this->GetInregral($message_text);
        }
    }
}
