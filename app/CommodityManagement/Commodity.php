<?php

namespace App\CommodityManagement;

use App\CommodityManagement\CommoditySQL as cSQL;

class Commodity
{
    //
    private $cs;
    public function __construct(cSQL $cs){
        $this->cs = $cs;
    }

    public function CommodityData($type){ 
        if($type == 'commodity')
            $result = $this->cs->GetCommodityData();
        else if($type == 'groupbuy')
            $result = $this->cs->GetGroupbuy();
        else if($type == 'timelimit')
            $result = $this->cs->GetLimited();
        return $result;
    }

    public function GetNotSoldCommodity(){
        $commodityData = $this->cs->GetCommodityData();
        $LimitedData = $this->cs->GetLimited(); 
        for($i=0;$i<count($commodityData);$i++){
            for($j=0;$j<count($LimitedData);$j++){
                if($commodityData[$i]['commodityID']==$LimitedData[$j]['commodityID']){
                    $commodityData[$i]['totalAmount'] = $commodityData[$i]['commodityAmount']+$LimitedData[$j]['limitedAmount'];
                }
            }
            
        }
        return $commodityData;
    }

    public function GetCommodityDetail(
        $commodity_type,
        $ID
    ){
        if($commodity_type == 'commodity')
            $result = $this->cs->GetCommodityDetail($ID);
        else if($commodity_type == 'groupbuy')
            $result = $this->cs->GetGroupbuyDetail($ID);
        else if($commodity_type == 'timelimit')
            $result = $this->cs->GetLimitedDetail($ID);
        return $result;
    }

    public function CountCommodity(){
        $result = $this->cs->CountCommoditySql();
        return $result;
    }

    public function ActionCommodity(
        $action = null,
        $commodityName = null,
        $originalPrice = null,
        $commodityPrice = null,
        $speciseID = null,
        $commodityAmount = null,
        $commodityIntroduction = null,
        $commodityPhotoA = null,
        $commodityPhotoB = null,
        $commodityPhotoC = null,
        $commodityPhotoD = null,
        $commodityPhotoE = null,
        $commodityVideo = null,
        $IsShelves = False,
        $AddTime = null,
        $OffTime = null,

        $commodityID = null
    ){  
        if($action == 'insert'){
            $result = $this->cs->InsertCommodity(
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
            );
        }else if($action == 'update'){
            $result = $this->cs->UpdateCommodity(
                $commodityID,
                $commodityName,
                $originalPrice,
                $commodityPrice,
                $speciseID,
                $commodityAmount,
                $commodityIntroduction,
                $commodityVideo
            );
        }else if($action == 'Shelves'){
            $result = $this->cs->ShelvesState(
                $commodityID,
                $IsShelves
            );
        }
        return $result;
    }

    public function ActionGroupbuy(
        $action = null,
        
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
        $groupbuyPriceD,

        $groupbuyID
    ){  
        if($action == 'insert'){
            $result = $this->cs->InsertGroupbuy(
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
            );
        }else if($action == 'update'){
            $result = $this->cs->UpdateGroupbuy(
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
            );
        }else if($action == 'unShelves'){
            $result = $this->cs->unShelveGroupbuy(
                $groupbuyID,
                $isShelves
            );
        }
        return $result;
    }

    public static function Static_ActionGroupbuy(
        $action = null,
        
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
        $groupbuyPriceD,

        $groupbuyID
    ){  
        if($action == 'insert'){
            $result = $this->cs->InsertGroupbuy(
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
            );
        }else if($action == 'update'){
            $result = $this->cs->UpdateGroupbuy(
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
            );
        }else if($action == 'unShelves'){
            $result = cSQL::Static_unShelveGroupbuy(
                $groupbuyID,
                $isShelves
            );
        }
        return $result;
    }

    public function ActionLimited(
        $action = null,
        
        $commodityID,
        $limitedPrice,
        $limitedAmount,
        $isShelves,
        $addTime,
        $offTime,

        $limitedID
    ){  
        if($action == 'insert'){
            $result = $this->cs->InsertLimited(
                $commodityID,
                $limitedPrice,
                $limitedAmount,
                $isShelves,
                $addTime,
                $offTime
            );
        }else if($action == 'update'){
            $result = $this->cs->UpdateLimited(
                $limitedID,
                $limitedPrice,
                $limitedAmount,
                $isShelves,
                $offTime
            );
        }else if($action == 'unShelves'){
            $result = $this->cs->unShelveTimelimit(
                $limitedID,
                $isShelves
            );
        }
        return $result;
    }

    public function getLimitedAmount($ID){
        return $result = $this->cs->GetLimitedAmount($ID);
    }

    public function UpdateCommodityAmount(
        $commodityID,
        $Amount,
        $type
    ){
        $commodityAmountArray = $this->cs->GetCommodityAmont($commodityID);
        $commodityAmount = $commodityAmountArray[0]['commodityAmount'];
        if($type=='addition'){
            $commodityAmount = $commodityAmount+$Amount;
            return $result = $this->cs->UpdateCommodityAmount($commodityID,$commodityAmount);
        }else if($type=='reduce'){
            if($commodityAmount>=$Amount){
                $commodityAmount = $commodityAmount-$Amount;
                return $result = $this->cs->UpdateCommodityAmount($commodityID,$commodityAmount);
            }else{
                return false;
            }
        }
    }

    public function DeleteCommodity($commodityID){
        $result = $this->cs->DeleteCommodity($commodityID);
        return $result;
    }
}
