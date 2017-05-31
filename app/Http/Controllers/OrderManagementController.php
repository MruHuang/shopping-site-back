<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderManagement\Order as OD;
use View;

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
            $this->od->UpdateOrder(
                $orderID,
                $action_type
            );
            $message_text = "訂單狀況更新成功";
        }catch(\Exception $e){
            $message_text = "訂單狀況更新失敗";
            //$message_text = $e;
        }finally{
            //return $e;
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
}

