<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class member extends Model
{
    //
    protected $table = 'member';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeGetAllMember($query){
        return $query
        ->where('member.isBlacklist',0)
        ->where('member.isRegistered', 1)
        ->leftjoin('member as MB','MB.memberID','member.recommender')
        ->select(DB::raw("member.memberID ,member.memberAccount ,member.memberName ,member.memberPhone ,member.memberIntegral ,member.memberLineid,member.memberEmail ,member.memberCancel ,MB.memberName as recommenderName"));
    }

    public function scopeGetBlackMember($query){
        return $query
        ->where('member.isBlacklist', 1)
        ->where('member.isRegistered', 1)->leftjoin('member as MB','MB.memberID','member.recommender')
        ->select(DB::raw("member.memberID ,member.memberAccount ,member.memberName ,member.memberPhone ,member.memberIntegral ,member.memberLineid ,member.memberCancel ,MB.memberName as recommenderName"));
    }

    public function scopeGetApplyMember( $query){
        return $query
        ->where('member.isRegistered', 0)->leftjoin('member as MB','MB.memberID','member.recommender')
       ->select(DB::raw("member.memberID ,member.memberAccount ,member.memberName ,member.memberPhone ,member.memberIntegral ,member.memberLineid ,member.memberCancel ,MB.memberName as recommenderName"));
    }

    public function scopeCheckMemberID(
    	$query,
    	$ID
	){
    	return $query
    	->where('member.memberID', $ID);
    }


    public function scopeOrderMember(
        $query,
        $StartNumber,
        $EndNumber,
        $species
    ){
        return $query->orderBy('member.'.$species)
        ->offset($StartNumber - 1)
        ->limit($EndNumber - $StartNumber + 1);
    }

    public function scopeLikeSelect(
        $query,
        $search_text
    ){
        return $query
        ->where('member.memberAccount', 'like',$search_text )
        ->orwhere('member.memberName', 'like',$search_text )
        ->orwhere('member.memberEmail', 'like',$search_text )
        ->orwhere('member.memberPhone', 'like',$search_text );
    }
    
}
