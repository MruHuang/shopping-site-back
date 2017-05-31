<?php

namespace App\MemberCommodity;

use App\Model\groupbuy_commodity as gcSQL;
use App\Model\Member_commodity as mcSQL;
use App\Model\merchandise_order as odSQL;

class MemberCommodityInformation
{

    public function GetCommodityCount(
        $ID,
        $speciestype
    ){
        $result = mcSQL::ClassCheck($speciestype)
        ->CommodityID($ID)
        ->get();
        $count_number = 0;
        foreach ($result as $key => $value) {
            $count_number += $value['commodityAmount'];
        }
        return $count_number;
    }

    public function GetGroupbuyCount(
        $ID,
        $speciestype
    ){
        $result = odSQL::GroupBuy()
        ->join('order_detailed',function($query) use ($ID, $speciestype){
            $query
            ->on('merchandise_order.orderID','order_detailed.orderID')
            ->where('order_detailed.commodityArea', $speciestype)
            ->where('order_detailed.commodityID',$ID);
        })
        ->get();
        $count_number = 0;
        foreach ($result as $key => $value) {
            $count_number += $value['commodityAmount'];
        }
        return $count_number;
    }

    public function GetGroupbuyCommodity($ID){
        $result = gcSQL::CheckID($ID)->get();
        return $result;
    }

}
