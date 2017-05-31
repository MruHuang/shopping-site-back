<?php

namespace App\GiftManagement;

use App\Model\member as mbSQL;

class GiftSQL
{
    //
    public function GetAllMemberIntegral(){
    	$result = mbSQL::
        GetAllMember()
        ->sum('member.memberIntegral')
        ;
        return $result;
    }
     public function UpdateMemberIntegral($GiftIntegral){
        $result = mbSQL::
        GetAllMember()->get();
        foreach ($result as $key => $value) {
            mbSQL::CheckMemberID($value['memberID'])
            ->update(['member.memberIntegral'=>(int)($value['memberIntegral']*$GiftIntegral)]);
        }
        return true;
    }
}
