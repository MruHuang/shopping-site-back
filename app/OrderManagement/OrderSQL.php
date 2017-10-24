<?php

namespace App\OrderManagement;

use App\Model\merchandise_order as odSQL;
use App\Model\Order_detailed as oddSQL;
use App\Model\promotion as ptSQL;
use App\Model\member as mbSQL;
use App\Model\groupbuy_commodity as gcSQL;
use DB;
class OrderSQL
{
    //
    public function GetAllOrder(
        $start_number,
        $end_number,
        $order_type
    ){
    	return $result = odSQL::GetAll()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID') 
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass,
            merchandise_order.is_ordered
            "))
        ->get();
    }
    public function GetUnpaidOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetUnpaid()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function GetCheckOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetCheck()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function GetReadyOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetReady()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function GetDeliveryOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetDelivery()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function GetCarryoutOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetCarryout()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function GetCancelOrder(
        $start_number,
        $end_number,
        $order_type
    ){
        return $result = odSQL::GetCancel()
        ->OrderOrder(
            $start_number,
            $end_number,
            $order_type
        )
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select(DB::raw("
            member.memberID,
            member.memberName,
            merchandise_order.orderID,
            merchandise_order.totalPrice,
            merchandise_order.checkoutMethod,
            merchandise_order.useIntegral,
            merchandise_order.moneyTransferFN,
            merchandise_order.orderState,
            merchandise_order.created_at,
            merchandise_order.orderClass
            "))
        ->get();
    }

    public function UpdateUnpaidOrder($id){
        $result = odSQL::CheckOrderID($id)
       ->update(['orderState'=>'Unpaid','moneyTransferFN'=>'0']);
        return true;
    }

    public function UpdateCheckOrder($id){
        $result = odSQL::CheckOrderID($id)
        ->update(['orderState'=>'Check']);
        return true;
    }

    public function UpdateReadyOrder($id){
        $result = odSQL::CheckOrderID($id)
        ->update(['orderState'=>'Ready']);
        return true;
    }

    public function UpdateDeliveryOrder($id){
        $result = odSQL::CheckOrderID($id)
        ->update(['orderState'=>'Delivery']);
        return true;
    }

    public function UpdateCarryoutOrder($id){
        $result = odSQL::CheckOrderID($id)
        ->update(['orderState'=>'Carryout']);
        return true;
    }

    public function UpdateCancelOrder($id){
        $result = odSQL::CheckOrderID($id)
        ->update(['orderState'=>'Cancel']);
        return true;
    }

    //種量
    public function GetNumberAllOrder(){
        return $result = odSQL::GetAll()
        ->count();
    }

    public function GetNumberUnpaidOrder(){
        return $result = odSQL::GetUnpaid()
        ->count();
    }

    public function GetNumberCheckOrder(){
        return $result = odSQL::GetCheck()
        ->count();
    }

    public function GetNumberReadyOrder(){
        return $result = odSQL::GetReady()
        ->count();
    }

    public function GetNumberDeliveryOrder(){
        return$result = odSQL::GetDelivery()
        ->count();
    }

    public function GetNumberCarryoutOrder(){
        return $result = odSQL::GetCarryout()
        ->count();
    }

    public function GetNumberCancelOrder(){
        return $result = odSQL::GetCancel()
        ->count();
    }

    //此commodityID為各商品分類之ID(groupbuyID)
    public function GetOrderID($commodityID){
        $result = oddSQL::GetOrderDetailed($commodityID)->get();
        return $result;
    }

    public static function Static_GetOrderID($commodityID){
        $result = oddSQL::GetOrderDetailed($commodityID)->get();
        return $result;
    }

    public function GetCommodityData($commodityID){
        $result = gcSQL::CheckID($commodityID)->get();
        return $result;
    }

    public static function Static_GetCommodityData($commodityID){
        $result = gcSQL::CheckID($commodityID)->get();
        return $result;
    }

    public function updateIsOrder($orderID,$totalPrice,$useIntegral,$freight){
        $result = odSQL::CheckOrderID($orderID,$totalPrice)
        ->update(['is_ordered'=>1,'totalPrice'=>$totalPrice,'useIntegral'=>$useIntegral,'freight'=>$freight]);
        return true;
    }

    public static function Static_updateIsOrder($orderID,$totalPrice,$useIntegral,$freight){
        $result = odSQL::CheckOrderID($orderID,$totalPrice)
        ->update(['is_ordered'=>1,'totalPrice'=>$totalPrice,'useIntegral'=>$useIntegral,'freight'=>$freight]);
        return true;
    }

    public function UpdateMemberIntegral($memberID,$overIntegral)
    {
        $result = mbSQL::CheckMemberID($memberID)
        ->update(['memberIntegral'=>$overIntegral]);
        return true;
    }

    public static function Static_UpdateMemberIntegral($memberID,$overIntegral)
    {
        $result = mbSQL::CheckMemberID($memberID)
        ->update(['memberIntegral'=>$overIntegral]);
        return true;
    }

    public function UpdateMemberCancel($memberID,$memberCancel)
    {
        $result = mbSQL::CheckMemberID($memberID)
        ->update(['memberCancel'=>$memberCancel]);
        return true;
    }

    public function GetOrderData($orderID){
        $result = odSQL::CheckOrderID($orderID)
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select('member.memberAccount','member.memberName','member.memberEmail','merchandise_order.memberID','merchandise_order.orderID')
        ->get();
        return $result;
    }

    public static function Static_GetOrderData($orderID){
        $result = odSQL::CheckOrderID($orderID)
        ->leftjoin('member','member.memberID','merchandise_order.memberID')
        ->select('member.memberAccount','member.memberName','member.memberEmail','merchandise_order.memberID','merchandise_order.orderID')
        ->get();
        return $result;
    }

     public function GetOrderInformation($orderID){
        return $result = oddSQL::JoinCommodity()
        ->CheckOrderID($orderID)
        ->get();
    }

    public function GetSingle($order){
        $result = odSQL::
        CheckOrderID($order)
        ->get();
        return $result;
    }

    public static function Static_GetSingle($order){
        $result = odSQL::
        CheckOrderID($order)
        ->get();
        return $result;
    }
    
    public function GetIntegral(){
        $result = ptSQL::get();
        return $result;
    }  

    public static function Static_GetIntegral(){
        $result = ptSQL::get();
        return $result;
    }    

    public function GetMemberID($memberID){
        $result = mbSQL::CheckMemberID($memberID)->get();
        return $result;
    }

    public static function Static_GetMemberID($memberID){
        $result = mbSQL::CheckMemberID($memberID)->get();
        return $result;
    }
    public function UpdateIntegral($memberID,$newIntegral){
        $result = mbSQL::CheckMemberID($memberID)
        ->update(['memberIntegral'=>$newIntegral]);
        return true;
    }
    
    public function MemberData($memberID){
        return $result = mbSQL::CheckMemberID($memberID)->get();
    }

    public function UpdateOrderDetailed($commodityID,$totalAmount,$finallyPrice){
        $result = oddSQL::GetOrderDetailed($commodityID)
        ->update(['buyNum'=>$totalAmount,'buyPrice'=>$finallyPrice]);
    } 
    public static function Static_UpdateOrderDetailed($commodityID,$totalAmount,$finallyPrice){
        $result = oddSQL::GetOrderDetailed($commodityID)
        ->update(['buyNum'=>$totalAmount,'buyPrice'=>$finallyPrice]);
    }

    public function UpdateOrderData(
        $orderID,
        $recipient,
        $checkoutMethod,
        $moneyTransferFN,
        $deliveryAdd
    ){
        $result = odSQL::CheckOrderID($orderID)
        ->update(['recipient'=>$recipient,
                  'checkoutMethod'=>$checkoutMethod,
                  'moneyTransferFN'=>$moneyTransferFN,
                  'deliveryAdd'=>$deliveryAdd]);
        return $result;
    }
}
