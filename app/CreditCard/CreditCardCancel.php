<?php

namespace App\CreditCard;

use App\CreditCard\CreditCardSQL as CCS;
use App\OrderManagement\OrderSQL as oSQL;
use View;
use Log;
class CreditCardCancel
{
    private $ccs;
    private $os;
    public function __construct(CCS $ccs,oSQL $os){
        $this->ccs = $ccs;
        $this->os = $os;
    }

    public function CreditCardCancel($random_number){
        $OrderData = $this->ccs->GetOrderData($random_number);
        $cancel_url = env('CreadCardURL_Cancel', false);
        $ONO = $random_number;
        $MID = env('MID', null);
        $MAC_KEY = env('MAC_KEY',null);

        $data = array(
            "ONO"=>$ONO,
            "MID"=>$MID
        );
        $data_json = json_encode($data);
        $mac = hash('sha256', $data_json.$MAC_KEY);
        $ksn = 1;
        $postdata = array('data'=>$data_json,'mac'=>$mac,'ksn'=>$ksn);
		$result =  $this->curl_post($cancel_url,$postdata);
        Log::info('CancelOrder:'.$OrderData[0]['orderID'].'->'.$result);
        $data_replace = preg_split('/=/',$result);
        //取消結果
        if(count($data_replace)==2){
            $data_array = (array)json_decode($data_replace[1]);
            if($data_array['returnCode'] =="00"){
                if($data_array['txnData']->RC=="00"){
                   //取消成功
                   return $this->CancelOrder($OrderData[0]['orderID']);
                }else{
                    //取消失敗
                    $message_text = "維修中，請聯絡管理員";
                    return  $message_text;
                }
            }else{
                $message_text = "維修中，請聯絡管理員";
                return  $message_text;
            }
        }else{
            $message_text = "維修中，請聯絡管理員";
            return  $message_text;
        }
    }

    public function checkOrder($random_number){
        $message_text='null';
        $OrderData = $this->ccs->GetOrderData($random_number);
        $ONO = $random_number;
        $message_text = null;
        $MID = env('MID', null);
        $MAC_KEY = env('MAC_KEY',null);
        $checkONO_url = env('InquireOrderURL', false);
        $data = array(
            "MID"=>$MID,
            "ONO"=>$ONO,
        );
        $data_json = json_encode($data);
        $mac = hash('sha256', $data_json.$MAC_KEY);
        $ksn = 1;
        $postdata = array('data'=>$data_json,'mac'=>$mac,'ksn'=>$ksn);
        $result =  $this->curl_post($checkONO_url,$postdata);
        Log::info('checkOrder:'.$OrderData[0]['orderID'].'->'.$result);
        // return $result;
        $data_replace = preg_split('/=/',$result);
        if(count($data_replace)==2){
            $data_array = (array)json_decode($data_replace[1]);
            if($data_array['returnCode'] =="00"){
                if($data_array['txnData']->RC=="00"){
                    return $this->CreditCardCancel($ONO);
                }else if($data_array['txnData']->RC=="GD"){
                    return $this->CancelOrder($OrderData[0]['orderID']);
                }else{
                    return $this->CancelOrder($OrderData[0]['orderID']);
                }
            }else{
                $message_text = "維修中，請聯絡管理員";
                return  $message_text;
            }
        }else{
            $message_text = "維修中，請聯絡管理員";
            return  $message_text;
        }
    }

    public function curl_post($url,$data){
    	$ch = curl_init();
    	$options = array(
		  CURLOPT_URL=>$url,
		  CURLOPT_REFERER=>$url,
		  CURLOPT_FOLLOWLOCATION =>true,
		  CURLOPT_ENCODING=>"Big5",
		  CURLOPT_RETURNTRANSFER=>true,
		  CURLOPT_AUTOREFERER=>0,
		  CURLOPT_POST=>true,
		  CURLOPT_POSTFIELDS=>http_build_query($data), // 直接給array
		  CURLOPT_CONNECTTIMEOUT=>10,
		  CURLOPT_TIMEOUT=>30,
		  CURLOPT_HEADER=>0,
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
        return $result;
        // echo $result;
    }

    public function CancelOrder($orderID){
        $result = $this->os->UpdateCancelOrder($orderID);
        if($result==true){
            $singleOrderData = $this->os->GetSingle($orderID);
            $memberData = $this->os->GetMemberID($singleOrderData[0]['memberID']);
            $memberCancel = (int)$memberData[0]['memberCancel']+1;
            $result = $this->os->UpdateMemberCancel($singleOrderData[0]['memberID'],$memberCancel);
        }
        $message_text =  "取消訂單成功";
        return $message_text;
    }
}