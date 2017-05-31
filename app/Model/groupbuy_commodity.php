<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class groupbuy_commodity extends Model
{
    //
    protected $table = 'groupbuy_commodity';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeCheckID(
    	$query,
    	$id
	){
    	return $query
    	->where('groupbuy_commodity.groupbuyID',$id)
    	;
    } 

    public function scopeCheckCommodityID(
        $query,
        $id
    ){
        return $query
        ->where('groupbuy_commodity.commodityID',$id)
        ;
    } 

    public function scopeGetSelvesGroupbuy(
        $query
    ){
        return $query
        ->where('groupbuy_commodity.isShelves',1)
        ->rightjoin('commodity','groupbuy_commodity.commodityID','commodity.commodityID')
        ;
    } 

    public function scopeCheckOnShelves(
        $query
    ){
        return $query->where('groupbuy_commodity.isShelves',1);
    }

}
