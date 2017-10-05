<?php

namespace App\UserManagement;

use App\Model\member as mbSQL;

class UserSQL
{
    //
    public function GetAllMember(
        $start_number,
        $end_number,
        $order_type,
        $search_text
    ){
        if($search_text != null){
        	$result = mbSQL::GetAllMember()
            ->LikeSelect($search_text)
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        else{
            $result = mbSQL::GetAllMember()
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        return $result;
    }

    public function GetBlackMember(
        $start_number,
        $end_number,
        $order_type,
        $search_text
    ){
        if($search_text != null){
            $result = mbSQL::GetBlackMember()
            ->LikeSelect($search_text)
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        else{
            $result = mbSQL::GetBlackMember()
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        return $result;
    }

    public function GetApplyMember(
        $start_number,
        $end_number,
        $order_type,
        $search_text
    ){
        if($search_text != null){
            $result = mbSQL::GetApplyMember()
            ->LikeSelect($search_text)
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        else{
            $result = mbSQL::GetApplyMember()
            ->OrderMember(
                $start_number,
                $end_number,
                $order_type
            )
            ->get();
        }
        return $result;
    }

    public function UpdateMember($id){
        $result = mbSQL::CheckMemberID($id)
        ->update(['isRegistered'=>1,
            'isBlacklist'=>0]);
        return true;
    }

    public function UpdateBlackMember($id){
        $result = mbSQL::CheckMemberID($id)
        ->update(['isBlacklist'=>1]);
        return true;
    }

    public function UpdateMemberIntegral(
        $id,
        $Integral
    ){
        $result = mbSQL::CheckMemberID($id)
        ->update(['memberIntegral'=>$Integral]);
        return true;
    }

    public function UpdateMemberCancel(
        $id,
        $Cancel
    ){
        $result = mbSQL::CheckMemberID($id)
        ->update(['memberCancel'=>$Cancel]);
        return true;
    }

    public function UpdateMemberData(
        $memberID,
        $memberAccount,
        $memberName,
        $memberLineid,
        $memberPhone,
        $memberIntegral,
        $memberCancel
    ){
        $result = mbSQL::CheckMemberID($memberID)
        ->update([
            'memberAccount'=>$memberAccount,
            'memberName'=>$memberName,
            'memberLineid'=>$memberLineid,
            'memberPhone'=>$memberPhone,
            'memberIntegral'=>$memberIntegral,
            'memberCancel'=>$memberCancel
        ]);
        return true;
    }

    public function DeleteMember($id){
        $result = mbSQL::CheckMemberID($id)
        ->delete();
        return true;
    }

    public function GetOneMember($id){
        $result = mbSQL::CheckMemberID($id)
        ->get();
        return $result;
    }

    public function GetAllMemberCount($search_text=null){
        if($search_text!=null){
            return $result = mbSQL::GetAllMember()->LikeSelect($search_text)
            ->count();  
        }else{
            return $result = mbSQL::GetAllMember()
            ->count();  
        }
    }

    public function GetBlackMemberCount($search_text=null){
        if($search_text!=null){
            return $result = mbSQL::GetBlackMember()->LikeSelect($search_text)
            ->count();  
        }else{
            return $result = mbSQL::GetBlackMember()
            ->count();  
        }
    }

    public function GetApplyMemberCount($search_text=null){
        if($search_text!=null){
            return $result = mbSQL::GetApplyMember()->LikeSelect($search_text)
            ->count();  
        }else{
            return $result = mbSQL::GetApplyMember()
            ->count();  
        }
    }
}
