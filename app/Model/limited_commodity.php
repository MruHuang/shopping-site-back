<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class limited_commodity extends Model
{
    //
    protected $table = 'limited_commodity';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeCheckID(
    	$query,
    	$id
	){
    	return $query
    	->where('limited_commodity.limitedID',$id)
    	;
    } 

    public function scopeCheckCommodityID(
        $query,
        $id
    ){
        return $query
        ->where('limited_commodity.commodityID',$id)
        ;
    } 
    
    public function scopeCheckOnShelves(
        $query
    ){
        return $query->where('limited_commodity.isShelves',1);
    }
}
