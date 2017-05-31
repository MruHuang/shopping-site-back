<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class member_commodity extends Model
{
    //
    protected $table = 'member_commodity';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeClassCheck(
    	$query,
    	$speciestype
	){
    	$query->where('member_commodity.commodityClass',$speciestype);
    }

    public function scopeCommodityID(
    	$query,
    	$id
	){
    	$query->where('member_commodity.commodityID',$id);
    }
}
