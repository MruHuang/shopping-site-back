<?php

namespace App\CommodityManagement;

use App\Model\commodity as cdSQL;
use App\Model\groupbuy_commodity as gcSQL;
use App\Model\limited_commodity as lcSQL;
use App\Model\merchandise_order as odSQL;
use DB;
class CommoditySQL
{
    //
    /*public function CountCommoditySql(){
        return odSQL::JoinOrder_detailed()
        ->leftjoin('groupbuy_commodity', function ($join) {
            $join->on('groupbuy_commodity.groupbuyID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'groupbuy');
        })
        ->leftjoin('limited_commodity', function ($join) {
            $join->on('limited_commodity.limitedID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'timelimit');
        })
        ->leftjoin('commodity', function ($join) {
            $join->on('commodity.commodityID',  'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'commodity')
            ->orOn('commodity.commodityID',  'limited_commodity.commodityID')
            ->orOn('commodity.commodityID',  'groupbuy_commodity.commodityID');
        })
        ->groupby('commodity.commodityID')
        ->select(DB::raw("commodity.commodityID,sum(order_detailed.commodityAmount) as SumAmount"))
        ->get()
        ;
    }*/

    public function CountCommoditySql(){
        return $result = odSQL::NoShipped()->JoinOrder_detailed()
        ->leftjoin('groupbuy_commodity', function ($join) {
            $join->on('groupbuy_commodity.groupbuyID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'groupbuy');
        })
        ->leftjoin('limited_commodity', function ($join) {
            $join->on('limited_commodity.limitedID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'timelimit');
        })
        ->leftjoin('commodity', function ($join) {
            $join->on('commodity.commodityID',  'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'commodity')
            ->orOn('commodity.commodityID',  'limited_commodity.commodityID')
            ->orOn('commodity.commodityID',  'groupbuy_commodity.commodityID');
        })
        ->groupby('commodity.commodityID')
        ->select(DB::raw("commodity.commodityID ,
            sum(order_detailed.commodityAmount) as SumAmount"))
        ->get();
        
    }

    public function GetCommodityData(){
    	return $result = cdSQL::CheckHiddenType()
        ->JoinSpecies()
        ->select(DB::raw("commodity.commodityID ,
            commodity.commodityName ,
            commodity.commodityPrice,
            commodity.speciseID,
            commodity.commodityAmount,
            commodity.IsShelves,
            commodity.created_at,
            commodity.updated_at,
            species.speciseName"))
        ->get();
    }

    // public function GetGroupbuy(){
    //     return $result = cdSQL::JoinGroupbuy()
    //     ->JoinSpecies()
    //     ->get();
    // }

    public function GetGroupbuy(){
        return $result = cdSQL::CheckHiddenType()
            ->leftjoin('groupbuy_commodity',function($join){
            return $join->on('groupbuy_commodity.commodityID','commodity.commodityID')
            ->where('groupbuy_commodity.isShelves',1);
        })
        ->leftjoin('commodity as commodity2', 'commodity.commodityID', 'commodity2.commodityID')
        ->leftjoin('species', 'commodity.speciseID', 'species.speciseID')
        ->select(DB::raw("
            commodity.commodityID ,
            commodity.commodityName ,
            commodity.commodityPrice ,
            commodity.speciseID,
            commodity.IsShelves,
            commodity.created_at,
            commodity.updated_at,
            species.speciseName,
            groupbuy_commodity.groupbuyID,
            groupbuy_commodity.groupbuyPrice,
            groupbuy_commodity.isShelves"))
        ->get();
    }

    // public function GetLimited(){
    //     return $result = cdSQL::JoinLimited()
    //     ->JoinSpecies()
    //     ->get();
    // }

    public function GetLimited(){
        return $result = cdSQL::CheckHiddenType()
            ->leftjoin('limited_commodity',function($join){
            return $join->on('limited_commodity.commodityID','commodity.commodityID')
            ->where('limited_commodity.isShelves',1);
        })
        ->leftjoin('commodity as commodity2', 'commodity.commodityID', 'commodity2.commodityID')
        ->leftjoin('species', 'commodity.speciseID', 'species.speciseID')
        ->select(DB::raw("
            commodity.commodityID ,
            commodity.commodityName ,
            commodity.commodityPrice ,
            commodity.speciseID,
            commodity.IsShelves,
            commodity.created_at,
            commodity.updated_at,
            species.speciseName,
            limited_commodity.limitedID,
            limited_commodity.limitedPrice,
            limited_commodity.limitedAmount,
            limited_commodity.isShelves"))
        ->get();
    }
    
    public function ShelvesState(
        $commodityID,
        $IsShelves
    ){
        $result = cdSQL::CheckID($commodityID)
        ->update([
            'IsShelves'=>$IsShelves
        ]);
        return true;
    }

    public function unShelveGroupbuy(
        $groupbuyID,
        $IsShelves
    ){
        $result = gcSQL::CheckID($groupbuyID)
        ->update([
            'isShelves'=>$IsShelves
        ]);
        return true;
    }

    public static function Static_unShelveGroupbuy(
        $groupbuyID,
        $IsShelves
    ){
        $result = gcSQL::CheckID($groupbuyID)
        ->update([
            'isShelves'=>$IsShelves
        ]);
        return true;
    }

    public function unShelveTimelimit(
        $limitedID,
        $IsShelves
    ){
        $result = lcSQL::CheckID($limitedID)
        ->update([
            'isShelves'=>$IsShelves
        ]);
        return true;
    }

    public function GetCommodityDetail($ID){
        $result = cdSQL::CheckID($ID)
        ->get();
        return $result;
    }

    public function GetGroupbuyDetail($ID){
        $result = gcSQL::CheckID($ID)
        ->get();
        return $result;
    }

    public function GetLimitedDetail($ID){
        $result = lcSQL::CheckID($ID)
        ->get();
        return $result;
    }

    public function UpdateCommodity(
        $commodityID,
        $commodityName,
        $originalPrice,
        $commodityPrice,
        $speciseID,
        $commodityAmount,
        $commodityIntroduction,
        $commodityVideo
    ){
        $result = cdSQL::CheckID($commodityID)
        ->update([
            'commodityName'=>$commodityName,
            'originalPrice'=>$originalPrice,
            'commodityPrice'=>$commodityPrice,
            'speciseID'=>$speciseID,
            'commodityAmount'=>$commodityAmount,
            'commodityIntroduction'=>$commodityIntroduction,
            'commodityVideo'=>$commodityVideo
        ]);
        return true;
    }

    public function UpdateGroupbuy(
        $groupbuyID,
        $commodityID,
        $groupbuyPrice,
        $isShelves,
        $offTime,
        $groupbuyAmountA,
        $groupbuyPriceA,
        $groupbuyAmountB,
        $groupbuyPriceB,
        $groupbuyAmountC,
        $groupbuyPriceC,
        $groupbuyAmountD,
        $groupbuyPriceD
    ){
        $result = gcSQL::CheckID($groupbuyID)
        ->update([
            'commodityID'=>$commodityID,
            'groupbuyPrice'=>$groupbuyPrice,
            'isShelves'=>$isShelves,
            'offTime'=>$offTime,
            'groupbuyAmountA'=>$groupbuyAmountA,
            'groupbuyPriceA'=>$groupbuyPriceA,
            'groupbuyAmountB'=>$groupbuyAmountB,
            'groupbuyPriceB'=>$groupbuyPriceB,
            'groupbuyAmountC'=>$groupbuyAmountC,
            'groupbuyPriceC'=>$groupbuyPriceC,
            'groupbuyAmountD'=>$groupbuyAmountD,
            'groupbuyPriceD'=>$groupbuyPriceD
        ]);
        return true;
    }

    public function UpdateLimited(
        $limitedID,
        $limitedPrice,
        $limitedAmount,
        $isShelves,
        $offTime
    ){
        $result = lcSQL::CheckID($limitedID)
        ->update([
            'limitedPrice'=>$limitedPrice,
            'limitedAmount'=>$limitedAmount,
            'isShelves'=>$isShelves,
            'offTime'=>$offTime
        ]);
        return true;
    }

    public function InsertCommodity(
        $commodityName,
        $originalPrice,
        $commodityPrice,
        $speciseID,
        $commodityAmount,
        $commodityIntroduction,
        $commodityPhotoA,
        $commodityPhotoB,
        $commodityPhotoC,
        $commodityPhotoD,
        $commodityPhotoE,
        $commodityVideo,
        $IsShelves,
        $AddTime,
        $OffTime
    ){
        $commodity = new cdSQL;
        $commodity->commodityName = $commodityName;
        $commodity->originalPrice = $originalPrice;
        $commodity->commodityPrice = $commodityPrice;
        $commodity->speciseID = $speciseID;
        $commodity->commodityAmount = $commodityAmount;
        $commodity->commodityIntroduction = $commodityIntroduction;
        $commodity->commodityPhotoA = $commodityPhotoA;
        $commodity->commodityPhotoB = $commodityPhotoB;
        $commodity->commodityPhotoC = $commodityPhotoC;
        $commodity->commodityPhotoD = $commodityPhotoD;
        $commodity->commodityPhotoE = $commodityPhotoE;
        $commodity->commodityVideo = $commodityVideo;
        $commodity->IsShelves = $IsShelves;
        $commodity->AddTime = $AddTime;
        $commodity->OffTime = $OffTime;
        $commodity->save();
        return true;
    }

    public function InsertGroupbuy(
        $commodityID,
        $groupbuyPrice,
        $isShelves,
        $addTime,
        $offTime,
        $groupbuyAmountA,
        $groupbuyPriceA,
        $groupbuyAmountB,
        $groupbuyPriceB,
        $groupbuyAmountC,
        $groupbuyPriceC,
        $groupbuyAmountD,
        $groupbuyPriceD
    ){
        /*$result = gcSQL::insert([
            'commodityID'=>$commodityID,
            'groupbuyPrice'=>$groupbuyPrice,
            'isShelves'=>$isShelves,
            'addTime'=>$addTime,
            'offTime'=>$offTime,
            'groupbuyAmountA'=>$groupbuyAmountA,
            'groupbuyPriceA'=>$groupbuyPriceA,
            'groupbuyAmountB'=>$groupbuyAmountB,
            'groupbuyPriceB'=>$groupbuyPriceB,
            'groupbuyAmountC'=>$groupbuyAmountC,
            'groupbuyPriceC'=>$groupbuyPriceC,
            'groupbuyAmountD'=>$groupbuyAmountD,
            'groupbuyPriceD'=>$groupbuyPriceD
        ]);*/

        $Groupbuycommodity = new gcSQL;
        $Groupbuycommodity->commodityID = $commodityID;
        $Groupbuycommodity->groupbuyPrice = $groupbuyPrice;
        $Groupbuycommodity->isShelves = $isShelves;
        $Groupbuycommodity->addTime = $addTime;
        $Groupbuycommodity->offTime = $offTime;
        $Groupbuycommodity->groupbuyAmountA = $groupbuyAmountA;
        $Groupbuycommodity->groupbuyPriceA = $groupbuyPriceA;
        $Groupbuycommodity->groupbuyAmountB = $groupbuyAmountB;
        $Groupbuycommodity->groupbuyPriceB = $groupbuyPriceB;
        $Groupbuycommodity->groupbuyAmountC = $groupbuyAmountC;
        $Groupbuycommodity->groupbuyPriceC = $groupbuyPriceC;
        $Groupbuycommodity->groupbuyAmountD = $groupbuyAmountD;
        $Groupbuycommodity->groupbuyPriceD = $groupbuyPriceD;
        $Groupbuycommodity->save();
        return true;
    }

    public function InsertLimited(
        $commodityID,
        $limitedPrice,
        $limitedAmount,
        $isShelves,
        $addTime,
        $offTime
    ){
        /*$result = lcSQL::insert([
            'commodityID'=>$commodityID,
            'limitedPrice'=>$limitedPrice,
            'limitedAmount'=>$limitedAmount,
            'isShelves'=>$isShelves,
            'addTime'=>$addTime,
            'offTime'=>$offTime
        ]);*/

        $Limitedcommodity = new lcSQL;
        $Limitedcommodity->commodityID = $commodityID;
        $Limitedcommodity->limitedPrice = $limitedPrice;
        $Limitedcommodity->limitedAmount = $limitedAmount;
        $Limitedcommodity->isShelves = $isShelves;
        $Limitedcommodity->addTime = $addTime;
        $Limitedcommodity->offTime = $offTime;
        $Limitedcommodity->save();
        return true;
    }

    public function GetCommodityAmont($commodityID)
    {
        $result = cdSQL::CheckID($commodityID)->select('commodityAmount')->get();
        return $result;
    }

    public function GetLimitedAmount($ID){
        $result = lcSQL::CheckID($ID)
        ->select('limitedAmount','commodityID')
        ->get();
        return $result;
    }

    public function UpdateCommodityAmount(
        $commodityID,
        $commodityAmount
    ){
        $result = cdSQL::CheckID($commodityID)
        ->update([
            'commodityAmount'=>$commodityAmount
        ]);
        return true;
    }

    public function DeleteCommodity($id){
        if (gcSQL::CheckCommodityID($id)->CheckOnShelves()->count() == 0 && 
            lcSQL::CheckCommodityID($id)->CheckOnShelves()->count() == 0 && 
            cdSQL::CheckID($id)->CheckOnShelves()->count() == 0
        ){
            cdSQL::CheckID($id)
            ->update([
                'hiddenType'=>'1'
            ]);
            return true;
        }
        else
             return false;
        
    }
}
