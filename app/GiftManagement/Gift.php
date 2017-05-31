<?php

namespace App\GiftManagement;

use App\GiftManagement\GiftSQL as gSQL;

class Gift
{
    //
    private $gSQL;
    public function __construct(gSQL $gSQL){
        $this->gSQL = $gSQL;
    }

    public function GetAllMemberIntegral(){
        $result = $this->gSQL->GetAllMemberIntegral();
        return $result;
    }

    public function UpdateMemberIntegral($GiftIntegral){
        $GiftIntegral = (1+$GiftIntegral*0.01);
        $result = $this->gSQL->UpdateMemberIntegral($GiftIntegral);
        return $result;
    }
}
