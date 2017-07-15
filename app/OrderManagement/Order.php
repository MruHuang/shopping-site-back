<?php

namespace App\OrderManagement;

use App\OrderManagement\OrderSQL as oSQL;
use App\CreditCard\CreditCardCancel as CCC;
use App\Mail\MailSent as Email;
use Log;
class Order
{
    //
    private $os;
    private $mailer;
    private $ccc;
    public function __construct(oSQL $os,Email $mailer,CCC $ccc){
        $this->os = $os;
        $this->mailer = $mailer;
        $this->ccc = $ccc;
    }
    
    public function OrderData(
        $order_type,
        $start_number,
        $end_number,
        $order_ordertype 
    ){  
        if($order_type == 'All')
            $result = $this->os->GetAllOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Unpaid')
            $result = $this->os->GetUnpaidOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Check')
            $result = $this->os->GetCheckOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Ready')
            $result = $this->os->GetReadyOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Delivery')
            $result = $this->os->GetDeliveryOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Carryout')
            $result = $this->os->GetCarryoutOrder($start_number,$end_number,$order_ordertype);
        else if($order_type == 'Cancel')
            $result = $this->os->GetCancelOrder($start_number,$end_number,$order_ordertype);
        return $result;
    }

    public function UpdateOrder(
        $orderID,
        $action_type
    ){  
        if($action_type == 'Unpaid'){
            $result = $this->os->UpdateUnpaidOrder($orderID);
            if($result== true) $message_text =  "訂單狀況更新成功";
        }
        else if($action_type == 'Check'){
            $result = $this->os->UpdateCheckOrder($orderID);
            if($result== true) $message_text =  "訂單狀況更新成功";
        }
        else if($action_type == 'Ready'){
            $result = $this->os->UpdateReadyOrder($orderID);
            if($result== true) $message_text =  "訂單狀況更新成功";
        }
        else if($action_type == 'Delivery'){
            $result = $this->os->UpdateDeliveryOrder($orderID);
            if($result== true) $message_text =  "訂單狀況更新成功";
        }
        else if($action_type == 'Carryout'){
            //增加積分//
            $singleOrderData = $this->os->GetSingle($orderID);
            $memberData = $this->os->GetMemberID($singleOrderData[0]['memberID']);
            $integralData = $this->os->GetIntegral();
            $integralProportion = $integralData[0]['integralProportion'];
            $addIntegral = (int)($singleOrderData[0]['totalPrice'] * $integralProportion /100);
            $newIntegral = $memberData[0]['memberIntegral'] + $addIntegral;
            $this->os->UpdateIntegral($singleOrderData[0]['memberID'],$newIntegral);
            //修改訂單狀態//
            
            $result = $this->os->UpdateCarryoutOrder($orderID);
            if($result== true) $message_text =  "訂單狀況更新成功";
        }
        else if($action_type == 'Cancel'){
            $OrderData = $this->os->GetSingle($orderID);
            if($OrderData[0]['checkoutMethod'] == 'CreditCard'){
                $message_text =  $this->ccc->checkOrder($OrderData[0]['randomNum']);
            }else{
                $result = $this->os->UpdateCancelOrder($orderID);
                if($result==true){
                    $singleOrderData = $this->os->GetSingle($orderID);
                    $memberData = $this->os->GetMemberID($singleOrderData[0]['memberID']);
                    $memberCancel = (int)$memberData[0]['memberCancel']+1;
                    $result = $this->os->UpdateMemberCancel($singleOrderData[0]['memberID'],$memberCancel);
                }
                $message_text =  "訂單狀況更新成功";
            }
        }
        return $message_text;
    }

    public function updateIsOrder($commodityID){
        $OrderIDArray =  $this->os->GetOrderID($commodityID);
        $commodity = $this->os->GetCommodityData($commodityID);
        $totalAmount = 0;
        $promotion = $this->os->GetIntegral();
        for($i =0; $i< count($OrderIDArray); $i++)
        {
                $totalAmount = $totalAmount+ $OrderIDArray[$i]['commodityAmount'];
        }
        try{
            $freight = $promotion[0]['freight'];
            $freeFreight = $promotion[0]['freeFreight'];
            $finallyPrice = $this->GetfinallyPrice($totalAmount,$commodity);
            for($i =0;$i< count($OrderIDArray); $i++){
                $totalPrice = $OrderIDArray[$i]['commodityAmount']*$finallyPrice;
                $OrderData = $this->os->GetSingle($OrderIDArray[$i]['orderID']);
                $UpdateOrderData = $this->IsUseIntegral($totalPrice,$OrderData);
                $UpdateOrderData['freight'] = 0;
                if($UpdateOrderData['totalPrice']<$freeFreight){
                    $UpdateOrderData['freight'] = $freight;
                    $UpdateOrderData['totalPrice'] = (int)$UpdateOrderData['totalPrice']+$freight;
                }
                $this->os->updateIsOrder($OrderIDArray[$i]['orderID'],$UpdateOrderData['totalPrice'],$UpdateOrderData['useIntegral'],$UpdateOrderData['freight']);
            }
            $this->os->UpdateOrderDetailed($commodityID,$totalAmount,$finallyPrice);
            $result = '成功';
        }catch(\Exception $e){
            $result = '失敗';
            //$result = $e;
        }finally{
            return $result;
        }
    }

    public static function Static_updateIsOrder($commodityID){
        $OrderIDArray =  oSQL::Static_GetOrderID($commodityID);
        $commodity = oSQL::Static_GetCommodityData($commodityID);
        $totalAmount = 0;
        $result = null;
        $promotion = oSQL::Static_GetIntegral();
        for($i =0; $i< count($OrderIDArray); $i++)
        {
                $totalAmount = $totalAmount+ $OrderIDArray[$i]['commodityAmount'];
        }
        try{
            $freight = $promotion[0]['freight'];
            $freeFreight = $promotion[0]['freeFreight'];
            $finallyPrice = self::Static_GetfinallyPrice($totalAmount,$commodity);
            for($i =0;$i< count($OrderIDArray); $i++){
                $totalPrice = $OrderIDArray[$i]['commodityAmount']*$finallyPrice;
                $OrderData = oSQL::Static_GetSingle($OrderIDArray[$i]['orderID']);
                $UpdateOrderData = self::Static_IsUseIntegral($totalPrice,$OrderData);
                $UpdateOrderData['freight'] = 0;
                if($UpdateOrderData['totalPrice']<$freeFreight){
                    $UpdateOrderData['freight'] = $freight;
                    $UpdateOrderData['totalPrice'] = (int)$UpdateOrderData['totalPrice']+$freight;
                }
                oSQL::Static_updateIsOrder($OrderIDArray[$i]['orderID'],$UpdateOrderData['totalPrice'],$UpdateOrderData['useIntegral'],$UpdateOrderData['freight']);
            }
            oSQL::Static_UpdateOrderDetailed($commodityID,$totalAmount,$finallyPrice);
            $result = '成功';
        }catch(\Exception $e){
            $result = '失敗';
            //$result = $e;
        }finally{
            return $result;
        }
    }

    public function GetfinallyPrice($totalAmount,$commodity){
        if($totalAmount >= $commodity[0]['groupbuyAmountD'] && $commodity[0]['groupbuyAmountD']!=null)
            return $commodity[0]['groupbuyPriceD'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountC'] && $commodity[0]['groupbuyAmountC']!=null)
            return $commodity[0]['groupbuyPriceC'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountB'] && $commodity[0]['groupbuyAmountB']!=null)
            return $commodity[0]['groupbuyPriceB'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountA'] && $commodity[0]['groupbuyAmountA']!=null)
            return $commodity[0]['groupbuyPriceA'];   
        else
            return $commodity[0]['groupbuyPrice'];   
    }

    public static function  Static_GetfinallyPrice($totalAmount,$commodity){
        if($totalAmount >= $commodity[0]['groupbuyAmountD'] && $commodity[0]['groupbuyAmountD']!=null)
            return $commodity[0]['groupbuyPriceD'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountC'] && $commodity[0]['groupbuyAmountC']!=null)
            return $commodity[0]['groupbuyPriceC'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountB'] && $commodity[0]['groupbuyAmountB']!=null)
            return $commodity[0]['groupbuyPriceB'];   
        else if($totalAmount >= $commodity[0]['groupbuyAmountA'] && $commodity[0]['groupbuyAmountA']!=null)
            return $commodity[0]['groupbuyPriceA'];   
        else
            return $commodity[0]['groupbuyPrice'];   
    }

    public function IsUseIntegral($totalPrice,$OrderData){
        $UpdateOrderData = array();
        $useIntegral = 0 ;
        if($OrderData[0]['useIntegral']!= 0){
            $memberData = $this->os->GetMemberID($OrderData[0]['memberID']);
            $useIntegral = $memberData[0]['memberIntegral'];
            if($totalPrice>$useIntegral){
                $totalPrice = $totalPrice - $useIntegral;
                $overIntegral = 0;
            }else{
                $overIntegral = $useIntegral - $totalPrice;
                $totalPrice = 0;
                $useIntegral = $totalPrice;
            }
            try{
                $this->os->UpdateMemberIntegral($OrderData[0]['memberID'],$overIntegral);
            }catch(\Exception $e){
                return "程序錯誤";
            }
        }
        $UpdateOrderData['totalPrice'] = $totalPrice;
        $UpdateOrderData['useIntegral'] = $useIntegral;
        return $UpdateOrderData;
    }

    public static function Static_IsUseIntegral($totalPrice,$OrderData){
        $UpdateOrderData = array();
        $useIntegral = 0 ;
        if($OrderData[0]['useIntegral']!= 0){
            $memberData = oSQL::Static_GetMemberID($OrderData[0]['memberID']);
            $useIntegral = $memberData[0]['memberIntegral'];
            if($totalPrice>$useIntegral){
                $totalPrice = $totalPrice - $useIntegral;
                $overIntegral = 0;
            }else{
                $overIntegral = $useIntegral - $totalPrice;
                $totalPrice = 0;
                $useIntegral = $totalPrice;
            }
            try{
                oSQL::Static_UpdateMemberIntegral($OrderData[0]['memberID'],$overIntegral);
            }catch(\Exception $e){
                return "程序錯誤";
            }
        }
        $UpdateOrderData['totalPrice'] = $totalPrice;
        $UpdateOrderData['useIntegral'] = $useIntegral;
        return $UpdateOrderData;
    }

    public function SetGroupbuyRemind($commodityID){
       //return $this->os->GetOrderData($commodityID);
        $OrderIDArray =  $this->os->GetOrderID($commodityID);
        $result=null;
        try{
            for($i =0;$i< count($OrderIDArray); $i++){
                $GroupbuyRemindData  = $this->os->GetOrderData($OrderIDArray[$i]['orderID']);
                $this->mailer->SentMailGroupbuyRemind(
                    $GroupbuyRemindData[0]['orderID'],
                    $GroupbuyRemindData[0]['memberName'].'先生/小姐',
                    $GroupbuyRemindData[0]['memberEmail']
                );
            }
            $result = '成功';
        }catch(\Exception $e){
            $result = '失敗';
            //$result = $e;
        }finally{
            return $result;
        }
    }

    public static function Static_SetGroupbuyRemind($commodityID){
       //return oSQL::GetOrderData($commodityID);
        $OrderIDArray =  oSQL::Static_GetOrderID($commodityID);
        $result=null;
        try{
            for($i =0;$i< count($OrderIDArray); $i++){
                $GroupbuyRemindData  = oSQL::Static_GetOrderData($OrderIDArray[$i]['orderID']);
                Email::Static_SentMailGroupbuyRemind(
                    $GroupbuyRemindData[0]['orderID'],
                    $GroupbuyRemindData[0]['memberName'].'先生/小姐',
                    $GroupbuyRemindData[0]['memberEmail']
                );
            }
            $result = '成功';
        }catch(\Exception $e){
            $result = '失敗';
            //$result = $e;
        }finally{
            return $result;
        }
    }

    public function OrderDataNumber($order_type){  
        if($order_type == 'All')
            $result = $this->os->GetNumberAllOrder();
        else if($order_type == 'Unpaid')
            $result = $this->os->GetNumberUnpaidOrder();
        else if($order_type == 'Check')
            $result = $this->os->GetNumberCheckOrder();
        else if($order_type == 'Ready')
            $result = $this->os->GetNumberReadyOrder();
        else if($order_type == 'Delivery')
            $result = $this->os->GetNumberDeliveryOrder();
        else if($order_type == 'Carryout')
            $result = $this->os->GetNumberCarryoutOrder();
        else if($order_type == 'Cancel')
            $result = $this->os->GetNumberCancelOrder();
        return $result;
    }

    // public function SetGroupbuyRemind($commodityID){
    //    //return $this->os->GetOrderData($commodityID);
    //     $result='1234';
    //     try{
    //         $this->mailer->SentMailGroupbuyRemind(
    //                 "123",
    //                 'abc先生小姐',
    //                 'peter1180041@gmail.com'
    //         );
    //         $result = '成功';
    //     }catch(\Exception $e){
    //         $result = '失敗';
    //         $result = $e;
    //     }finally{
    //         return $result;
    //     }
    // }

    public function OrderDetailed($orderID){
         $OrderDetailedData = $this->os->GetOrderInformation($orderID);
         if($OrderDetailedData[0]['groupbuyID']!=null){
            $OrderIDArray =  $this->os->GetOrderID($OrderDetailedData[0]['groupbuyID']);
            $commodity = $this->os->GetCommodityData($OrderDetailedData[0]['groupbuyID']);
            $totalAmount = 0;
            for($i =0; $i< count($OrderIDArray); $i++)
            {
                    $totalAmount = $totalAmount+ $OrderIDArray[$i]['commodityAmount'];
            }
            $finallyPrice = $this->GetfinallyPrice($totalAmount,$commodity);
            $OrderDetailedData[0]['groupbuyPrice'] = $finallyPrice;
         }
         return $OrderDetailedData;
    }

    public function SingleOrder($orderID){
        $result = $this->os->GetSingle($orderID);
        return $result;
    }
    public function MemberData($memberID){
        $result = $this->os->MemberData($memberID);
        return $result;
    }
}
