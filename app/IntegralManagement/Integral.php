<?php

namespace App\IntegralManagement;

use App\IntegralManagement\IntegralSQL as iSQL;
use App\Mail\MailSent as MS;

class Integral
{
    //
    private $isql;
    public function __construct(iSQL $isql,MS $mailer){
        $this->isql = $isql;
        $this->mailer = $mailer;
    }

    public function GetIntegral(){
        $result = $this->isql->GetIntegral();
        return $result;
    }

    public function UpdateIntegral(
        $integralProportion,
        $freight,
        $freeFreight
    ){
        $result = $this->isql->UpdateIntegral(
            $integralProportion,
            $freight,
            $freeFreight
        );
        return $result;
    }

    public function UpdateIntegralProportion($integralProportion)
    {
        $result = $this->isql->UpdateIntegralProportion($integralProportion);
        return $result;
    }

    public function UpdateIntegralFreight($freight,$freeFreight)
    {
        $result = $this->isql->UpdateIntegralFreight($freight,$freeFreight);
        return $result;
    }

    public function UpdateRemittance($RemittanceAccount)
    {
        $result = $this->isql->UpdateRemittance($RemittanceAccount);
        return $result;
    }

    public function SendAllEmail($email_content){
        $MemberData = $this->isql->GetMemberData();
        for ($i=0; $i < count($MemberData); $i++) {
            $this->mailer->SendAllEmail(
                    $MemberData[$i]['memberName'].'先生/小姐',
                    $MemberData[$i]['memberAccount'],
                    $MemberData[$i]['memberEmail'],
                    $email_content
            );
        }
        return true;
    }
}
