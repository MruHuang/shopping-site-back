<?php

namespace App\IntegralManagement;

use App\Model\promotion as ptSQL;
use App\Model\member as memberSQL;

class IntegralSQL
{
    //
    public function GetIntegral(){
    	$result = ptSQL::get();
        return $result;
    }
    public function UpdateIntegral(
        $integralProportion,
        $freight,
        $freeFreight
    ){
        ptSQL::where('ID',ptSQL::find(3)->ID)->update([
            'integralProportion'=> $integralProportion,
            'freight'=> $freight,
            'freeFreight'=> $freeFreight
        ]);
        return true;
        
    }

    public function UpdateIntegralProportion($integralProportion)
    {
        ptSQL::where('ID',ptSQL::find(3)->ID)->update([
            'integralProportion'=> $integralProportion
        ]);
        return true;
        
    }

    public function UpdateIntegralFreight($freight,$freeFreight)
    {
        ptSQL::where('ID',ptSQL::find(3)->ID)->update([
            'freight'=>$freight,
            'freeFreight'=>$freeFreight
        ]);
        return true;
        
    }

    public function UpdateRemittance($RemittanceAccount){
        ptSQL::where('ID',ptSQL::find(3)->ID)->update([
            'RemittanceAccount'=> $RemittanceAccount
        ]);
        return true;
    }

    public function GetMemberData(){
        $result = memberSQL::GetAllMember()->get();
        return $result;
    }

    public function UpdateLatestNews($new_content){
        ptSQL::where('ID',ptSQL::find(3)->ID)->update([
            'latest_news'=> $new_content
        ]);
        return true;
    }
}
