<?php

namespace App\CreditCard;

use App\Model\commodity as cmSQL;
use App\Model\groupbuy_commodity as gcSQL;
use App\Model\limited_commodity as lcSQL;
use App\Model\Member as mbSQL;
use App\Model\Member_commodity as mcSQL;
use App\Model\merchandise_order as odSQL;
use App\Model\promotion as ptSQL;

class CreditCardSQL
{
    // //檢查訂單為信用卡付款，並修改訂單情況至以付款(代出貨)
    // public function OrderUpdateToReady($ONO){
    //     odSQL::CheckoutMethodCreditCard()
    //     ->CheckONO($ONO)
    //     ->update(['orderState'=>'Ready']);
    //     return true;
    // }
    // //計算該筆訂單的數量(正常一筆)
    // public function CheckCreditCardTransactionComplete($ONO){
    //     $result = ccSQL::CheckTransactionComplete()
    //     ->CheckONO($ONO)
    //     ->get();
    //     return $result->count();
    // }
    // //取消訂單
    // public function OrderUpdateToCancel($ONO){
    //     odSQL::CheckoutMethodCreditCard()
    //     ->CheckONO($ONO)
    //     ->update(['orderState'=>'Cancel']);
    //     return true;
    // }

    // //取消訂單
    // public function OrderUpdateToUnpaid($ONO){
    //     odSQL::CheckoutMethodCreditCard()
    //     ->CheckONO($ONO)
    //     ->update(['orderState'=>'Unpaid']);
    //     return true;
    // }
    // //檢查該訂單是否存在
    // public function ChangeOrderONO(
    //     $ONO,
    //     $random_number
    // ){
    //     odSQL::CheckoutMethodCreditCard()
    //     ->CheckONO($ONO)
    //     ->update(['randomNum'=>$random_number]);
    //     return true;
    // }
    //取得ORDERID
    public function GetOrderData($ONO){
        $result = odSQL::CheckoutMethodCreditCard()
        ->CheckONO($ONO)
        ->get();
        return $result;
    }
}
