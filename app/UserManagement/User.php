<?php

namespace App\UserManagement;

use App\UserManagement\UserSQL as uSQL;
use App\Mail\MailSent as MS;

class User
{
    //
    private $us;
    private $mailer;
    public function __construct(uSQL $us, MS $mailer){
        $this->us = $us;
        $this->mailer = $mailer;
    }

    public function UserData(
        $user_type,
        $start_number,
        $end_number,
        $order_type,
        $search_text
    ){  
        if($user_type == 'All')
            $result = $this->us->GetAllMember(
                $start_number,
                $end_number,
                $order_type,
                $search_text
            );
        else if($user_type == 'Black')
            $result = $this->us->GetBlackMember(
                $start_number,
                $end_number,
                $order_type,
                $search_text
            );
        else if($user_type == 'Apply')
            $result = $this->us->GetApplyMember(
                $start_number,
                $end_number,
                $order_type,
                $search_text
            );
        return $result;
    }

    public function UpdateMember(
        $memberID,
        $action_type,
        $comform_type
    ){  
        if($action_type == 'Member'){
            $result = $this->us->UpdateMember($memberID);
            if($comform_type == 'Apply'){
                $MemberData = $this->us->GetOneMember($memberID);
                $this->mailer->SentMailInsertUser(
                    $MemberData[0]['memberName'].'先生/小姐',
                    $MemberData[0]['memberAccount'],
                    $MemberData[0]['memberEmail']
                );
            }
        }
        else if($action_type == 'Black')//封鎖
            $result = $this->us->UpdateBlackMember($memberID);
        else if($action_type == 'Apply')//不同意
            $result = $this->us->DeleteMember($memberID);
        return $result;
    }

    public function CountInformation($user_type,$search_text= null){
        if($user_type == 'All')
            $result = $this->us->GetAllMemberCount($search_text);
        else if($user_type == 'Black')
             $result = $this->us->GetBlackMemberCount($search_text);
        else if($user_type == 'Apply')
             $result = $this->us->GetApplyMemberCount($search_text);
        return $result;
    }

    public function UpdateMemberIntegral(
        $memberID,
        $Integral
    ){
        return $result = $this->us->UpdateMemberIntegral(
            $memberID,
            $Integral
        );
    }

    public function UpdateMemberCancel(
        $memberID,
        $Cancel
    ){
        return $result = $this->us->UpdateMemberCancel(
            $memberID,
            $Cancel
        );
    }
}
