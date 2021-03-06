<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderManagement\Order as OD;
use View;
use Log;

class OrderManagementController extends Controller
{
    //
    private $od;
    public function __construct(OD $od){
    	$this->od = $od;
    }

    public function GetOrder(
        $type,
        $this_page = 1,
        $order_type = 'created_at',
        $message_text= null,
        $order_detailed = null,
        $memberData = null
    ){
        $page_number = 20;
        $start_number = ($this_page-1)*$page_number+1;
        $end_number = $this_page*$page_number;
    	$result = $this->od->OrderData(
            $type,
            $start_number,
            $end_number,
            $order_type
        );
    	//return $order_detailed;
        //return $result;
        $count_page = $this->GetOrderNumber($type);
        $count_page = ($count_page/$page_number)+1;
        //return $result;
        return View::make('OrderManagement',[
            'AllInformation'=>$result,
            'type'=>$type,
            'message_text'=>$message_text,
            'order_detailed'=>$order_detailed,
            'this_page'=>$this_page,
            'count_page'=>$count_page,
            'order_type'=>$order_type,
            'memberData'=>$memberData
        ]);
    }

    public function UpdateOrder(Request $Request)
    {
        //return $Request->all();
        $orderID = $Request->input('order_id');
        $action_type = $Request->input('order_state');
        $order_type = $Request->input('order_type');
        $this_page = $Request->input('this_page');
        $order_orderType = $Request->input('order_orderType');
        // return $this->od->UpdateOrder(
        //         $orderID,
        //         $action_type
        //     );
        try{
            $message_text = $this->od->UpdateOrder(
                $orderID,
                $action_type
            );
        }catch(\Exception $e){
            $message_text = "訂單狀況更新失敗";
            $message_text = $e;
        }finally{
            // return $e;
            return $this->GetOrder($order_type,$this_page,$order_orderType,$message_text,null,null);
        }
    }

    public function SingleOrder(
        $orderID,
        $orderState,
        $this_page,
        $order_type
    ){
        $order_detailed = $this->od->OrderDetailed($orderID);
        //return $order_detailed;
        $order_detailed['order_data'] = $this->od->SingleOrder($orderID);
        //return $order_detailed;
        return $this->GetOrder($orderState,$this_page,$order_type,null,$order_detailed,null);
    }

    public function GetMemberData(
        $memberID,
        $orderState,
        $this_page,
        $order_type
    ){
        $memberData = $this->od->MemberData($memberID);
        return $this->GetOrder($orderState,$this_page,$order_type,null,null,$memberData);
    }

    public function GetOrderNumber($type){
        return $result = $this->od->OrderDataNumber($type);
    }

    public function UpdateOrderData(Request $Request){
        //return $Request->all();
        $orderID = $Request->input('orderID');
        $recipient = $Request->input('recipient');
        $checkoutMethod = $Request->input('checkoutMethod');
        $moneyTransferFN = $Request->input('moneyTransferFN');
        $deliveryAdd = $Request->input('deliveryAdd');

        $order_state = $Request->input('order_state');
        $this_page = $Request->input('this_page');
        $order_type = $Request->input('order_type');
        $message_text = "";
        
        if($recipient==null||$moneyTransferFN==null||$deliveryAdd==null){
            $message_text = "資料不完全";
            return $this->GetOrder($order_state,$this_page,$order_type,$message_text,null,null);
        }

        try{
            Log::info('賣家修改前:');
            Log::info($this->od->SingleOrder($orderID));
            $this->od->UpdateOrderData(
                $orderID,
                $recipient,
                $checkoutMethod,
                $moneyTransferFN,
                $deliveryAdd
            );
            $message_text = "訂單修改成功";
            Log::info('賣家修改後:');
            Log::info($this->od->SingleOrder($orderID));
        }catch(\Exception $e){
            $message_text = "訂單修改失敗";
            $message_text = $e;
        }finally{
            return $this->GetOrder($order_state,$this_page,$order_type,$message_text,null,null);
        }

    }
}

