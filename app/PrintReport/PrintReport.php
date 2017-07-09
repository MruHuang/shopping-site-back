<?php

namespace App\PrintReport;
use App\PrintReport\PrintReportSQL as pSQL;

class PrintReport{

    private $ps;
    public function __construct(pSQL $ps){
        $this->ps = $ps;
    }
    //銷售明細
    public function SalesDetails(){
        $cellData = $this->ps->SalesDetails();
        $result = [
            ['商品名稱','商品種類','銷售數量','商品價格','原價','結單日期','會員名稱','收件人','付款方式'],
        ];  
        
        foreach ($cellData as $key => $value ){
            $array2 = [];
            $Name = $value->CMN == null ? ($value->LCN == null ? $value->GCN : $value->LCN) : ($value->CMN);
            $Price = $value->CMP == null ? ($value->LCP == null ? $value->GCP : $value->LCP) : ($value->CMP);
            array_push($array2, $Name); 
            array_push($array2, $value->commodityArea); 
            array_push($array2, $value->commodityAmount); 
            array_push($array2, $value->buyPrice); 
            array_push($array2, $Price); 
            array_push($array2, $value->updated_at); 
            array_push($array2, $value->memberName); 
            array_push($array2, $value->recipient); 
            array_push($array2, $value->checkoutMethod); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //每日出貨明細(物)
    public function DailyShipmentsCommodity($date){
        $cellData = $this->ps->DailyShipmentsCommodity($date);
        $result = [
            ['商品名稱','出貨數量','出貨日期','限時數量','一般數量','團購數量'],
        ]; 
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->commodityName); 
            array_push($array2, $value->NUM); 
            array_push($array2, $date); 
            array_push($array2, $value->TNum); 
            array_push($array2, $value->CNum); 
            array_push($array2, $value->GNum); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //每日出貨明細(人)
    public function DailyShipmentsPerson($date){
        $cellData = $this->ps->DailyShipmentsPerson($date);
        $result = [
            ['訂購人名稱','出貨日期','收件人','手機','地址','一般商品','限時商品','團購商品','購買數量'],
        ]; 
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->memberName); 
            array_push($array2, $value->ShipmentsDate); 
            array_push($array2, $value->recipient); 
            array_push($array2, $value->memberPhone); 
            array_push($array2, $value->deliveryAdd); 
            array_push($array2, $value->CMN); 
            array_push($array2, $value->LCN); 
            array_push($array2, $value->GCN); 
            array_push($array2, $value->commodityAmount); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //每日貨款收入統計
    public function DailyPay($date){
        $cellData = $this->ps->DailyPay($date);
        $result = [
            ['訂單日期','訂購人名稱','訂單編號','訂單金額','付款方式','ATM後五碼'],
        ];
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->updated_at); 
            array_push($array2, $value->recipient); 
            array_push($array2, $value->orderID); 
            array_push($array2, $value->totalPrice); 
            array_push($array2, $value->checkoutMethod); 
            array_push($array2, $value->moneyTransferFN); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //單項商品銷售明細
    public function SingleSalesDetails($date_start,$date_end){
        $cellData = $this->ps->SingleSalesDetails($date_start,$date_end);
        $result = [
            ['商品名稱','起始日期','結算日期','銷售數量'],
        ]; 
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->commodityName); 
            array_push($array2, $date_start); 
            array_push($array2, $date_end); 
            array_push($array2, $value->NUM); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //VIP客戶
    public function VIP($date_start,$date_end){
        $cellData = $this->ps->VIP($date_start,$date_end);
        $result = [
            ['會員名稱','起始日期','結算日期','下訂次數','購買總金額','會員手機','會員E-Mail'],
        ]; 
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->memberName); 
            array_push($array2, $date_start); 
            array_push($array2, $date_end); 
            array_push($array2, $value->Num); 
            array_push($array2, $value->Price); 
            array_push($array2, $value->memberPhone); 
            array_push($array2, $value->memberEmail); 
            array_push($result, $array2); 
        }
        return $result;
    }
    //會員紅利
    public function MemberIntegral($date){
        $cellData = $this->ps->MemberIntegral($date);
        $result = [
            ['會員名稱','入會日期','推薦人','紅利點數','以使用點數','未使用點數'],
        ];  
        foreach ($cellData as $key => $value ){
            $array2 = [];
            array_push($array2, $value->memberName); 
            array_push($array2, $value->created_at); 
            array_push($array2, $value->recommenderName); 
            array_push($array2, $value->memberIntegral); 
            array_push($array2, $value->memberUseIntegral); 
            array_push($array2, $value->memberIntegral); 
            array_push($result, $array2); 
        }
     
        return $result;
    }
}