<?php

namespace App\PrintReport;

use App\Model\merchandise_order as odSQL;
use App\Model\Order_detailed as oddSQL;
use App\Model\promotion as ptSQL;
use App\Model\member as mbSQL;
use App\Model\groupbuy_commodity as gcSQL;
use App\Model\commodity as cmSQL;
use DB;

class PrintReportSQL{
    
    public function SalesDetails(){
        $joinMO = DB::raw('(
            SELECT 
                orderID,orderState, member.memberName, recipient, checkoutMethod, merchandise_order.updated_at
            FROM 
                merchandise_order, member 
            WHERE 
                merchandise_order.memberID = member.memberID
        ) MO');
        $joinLC = DB::raw('(
            SELECT 
                limitedID, commodity.commodityName, commodity.originalPrice
            FROM 
                limited_commodity, commodity 
            WHERE 
                commodity.commodityID = limited_commodity.commodityID
        ) LC');
        $joinGC = DB::raw('(
            SELECT 
                groupbuyID, commodity.commodityName, commodity.originalPrice
            FROM 
                groupbuy_commodity, commodity 
            WHERE 
                commodity.commodityID = groupbuy_commodity.commodityID
        ) GC');

        $result = oddSQL::
        leftjoin($joinMO,
            function($join){
                $join->on('MO.orderID', 'order_detailed.orderID');
            }
        )
        ->leftjoin($joinLC,
            function($join){
                $join->on('order_detailed.commodityID', 'LC.limitedID')
                ->where('commodityArea','timelimit');
            }
        )
        ->leftjoin($joinGC,
            function($join){
                $join->on('order_detailed.commodityID', 'GC.groupbuyID')
                ->where('commodityArea','groupbuy');
            }
        )
        ->leftjoin('commodity as CM',
            function($join){
                $join->on('order_detailed.commodityID','CM.commodityID')
                ->where('commodityArea','commodity');
            }
        )
        ->where('MO.orderState','Carryout')
        ->select(
                DB::raw('CM.commodityName as CMN')
                ,'CM.originalPrice as CMP'
                ,DB::raw('LC.commodityName as LCN')
                ,'LC.originalPrice as LCP'
                ,DB::raw('GC.commodityName as GCN')
                ,'GC.originalPrice as GCP'
                ,'commodityArea'
                ,'order_detailed.commodityAmount'
                ,'buyPrice'
                ,'MO.updated_at'
                ,'MO.memberName'
                ,'MO.recipient'
                ,'MO.checkoutMethod'
        )
        ->get();

        return $result;
    }
    public function DailyShipmentsPerson($date){
        $result = oddSQL::join('commodity','commodity.commodityID','order_detailed.originalID')
        ->join('merchandise_order','merchandise_order.orderID','order_detailed.orderID')
        ->select(DB::raw('commodityName,SUM(order_detailed.commodityAmount) as NUM  ,
             SUM(case when [Shopping_site].[dbo].order_detailed.[commodityArea]=\'timelimit\'then[order_detailed].[commodityAmount] else 0 end) as TNum,
             SUM(case when [Shopping_site].[dbo].order_detailed.[commodityArea]=\'commodity\'then[order_detailed].[commodityAmount] else 0 end) as CNum,
             SUM(case when [Shopping_site].[dbo].order_detailed.[commodityArea]=\'groupbuy\'then[order_detailed].[commodityAmount] else 0 end)as GNum'))
        ->groupBy('order_detailed.originalID','commodity.commodityID','commodity.commodityName')
        ->whereDate('merchandise_order.updated_at',"=",date($date))
        ->where('merchandise_order.orderState','Ready')
        ->orderBy(DB::raw('SUM(order_detailed.commodityAmount) '),'desc')
        ->get(); 
        return $result;
    }
    public function DailyShipmentsCommodity($date){
         $joinMO = DB::raw('(
            SELECT 
                orderID,orderState, member.memberName, member.memberPhone, recipient, merchandise_order.deliveryAdd, merchandise_order.updated_at
            FROM 
                merchandise_order, member 
            WHERE 
                merchandise_order.memberID = member.memberID
        ) MO');
        $joinLC = DB::raw('(
            SELECT 
                limitedID, commodity.commodityName, commodity.originalPrice
            FROM 
                limited_commodity, commodity 
            WHERE 
                commodity.commodityID = limited_commodity.commodityID
        ) LC');
        $joinGC = DB::raw('(
            SELECT 
                groupbuyID, commodity.commodityName, commodity.originalPrice
            FROM 
                groupbuy_commodity, commodity 
            WHERE 
                commodity.commodityID = groupbuy_commodity.commodityID
        ) GC');

        $result = oddSQL::
        leftjoin($joinMO,
            function($join){
                $join->on('MO.orderID', 'order_detailed.orderID');
            }
        )
        ->leftjoin($joinLC,
            function($join){
                $join->on('order_detailed.commodityID', 'LC.limitedID')
                ->where('commodityArea','timelimit');
            }
        )
        ->leftjoin($joinGC,
            function($join){
                $join->on('order_detailed.commodityID', 'GC.groupbuyID')
                ->where('commodityArea','groupbuy');
            }
        )
        ->leftjoin('commodity as CM',
            function($join){
                $join->on('order_detailed.commodityID','CM.commodityID')
                ->where('commodityArea','commodity');
            }
        )
        ->where('MO.orderState','Ready')
        ->whereDate(DB::raw('SUBSTRING(FORMAT(MO.updated_at, \'yyyy-MM-dd HH:mm\'), 1, 11)'),date($date))
        ->groupby(
            'MO.memberName'
            ,DB::raw('SUBSTRING(FORMAT(MO.updated_at, \'yyyy-MM-dd HH:mm\'), 1, 11) ')
            ,'MO.recipient'
            ,'MO.memberPhone'
            ,'MO.deliveryAdd'
            ,DB::raw('CM.commodityName ')
            ,DB::raw('LC.commodityName ')
            ,DB::raw('GC.commodityName')
        )
        ->select(
                'MO.memberName'
                ,DB::raw('SUBSTRING(FORMAT(MO.updated_at, \'yyyy-MM-dd HH:mm\'), 1, 11) as ShipmentsDate')
                ,'MO.recipient'
                ,'MO.memberPhone'
                ,'MO.deliveryAdd'
                ,DB::raw('CM.commodityName as CMN')
                ,DB::raw('LC.commodityName as LCN')
                ,DB::raw('GC.commodityName as GCN')
                ,DB::raw('SUM(order_detailed.commodityAmount) as commodityAmount')
        )

        ->get();
        return $result;
    }
    public function DailyPay($date){
        $result = odSQL::
        where('orderState','Check')
        ->select('updated_at', 'recipient', 'orderID', 'totalPrice', 'checkoutMethod', 'moneyTransferFN')
        ->whereDate('updated_at',"=",date($date))
        ->get();
        return $result;
        
    }
    public function SingleSalesDetails($date_start,$date_end){
         
        $result = oddSQL::join('commodity','commodity.commodityID','order_detailed.originalID')
        ->join('merchandise_order','merchandise_order.orderID','order_detailed.orderID')
        ->select(DB::raw('commodityName,SUM(order_detailed.commodityAmount) as NUM'))
        ->groupBy('order_detailed.originalID','commodity.commodityID','commodity.commodityName')
        ->whereBetween('merchandise_order.created_at',[$date_start,$date_end])
        ->where('merchandise_order.orderState','Carryout')
        ->orderBy(DB::raw('SUM(order_detailed.commodityAmount) '),'desc')
        ->get(); 
        return $result;
    }
    public function VIP($date_start,$date_end){
        $result = mbSQL::
        leftjoin('merchandise_order','merchandise_order.memberID','member.memberID')
        ->leftjoin('order_detailed','merchandise_order.orderID','order_detailed.orderID')
        ->groupBy('member.memberID', 'member.memberAccount','member.memberName','member.memberPhone','member.memberEmail')
        ->select( 'member.memberName',DB::raw('SUM(order_detailed.commodityAmount) as Num'),DB::raw('SUM(buyPrice) as Price'),'member.memberPhone','member.memberEmail')
        ->orderby('Price',' Num')
        ->whereBetween('merchandise_order.created_at',[$date_start,$date_end])
        ->get();
        return $result;
    }
    public function MemberIntegral($date){
        $result = mbSQL::
        leftjoin('member as MB','MB.memberID','member.recommender')
        ->select("member.memberName ,member.created_at ,MB.memberName as recommenderName ,member.memberIntegral ,member.memberUseIntegral ,member.memberIntegral")
        ->orderBy('member.memberIntegral','desc')
        ->get()
       ; 
        return $result;
    }
}