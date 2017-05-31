<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class commodity extends Model
{
    //
    protected $table = 'commodity';
	protected $guarded = [];
    public $timestamps = true;

  	public function scopeGetAllCommodity($query){
    	return $query;
    } 

    public function scopeCheckID(
    	$query,
    	$id
	){
    	return $query
    	->where('commodity.commodityID',$id)
    	;
    } 

    public function scopeJoinGroupbuy($query){
    	return $query
    	->leftjoin('groupbuy_commodity', 'commodity.commodityID', 'groupbuy_commodity.commodityID')
        ->leftjoin('commodity as commodity2', 'commodity.commodityID', 'commodity2.commodityID');
    }

    public function scopeJoinLimited($query){
    	return $query
    	->leftjoin('limited_commodity', 'commodity.commodityID', 'limited_commodity.commodityID')
        ->leftjoin('commodity as commodity2', 'commodity.commodityID', 'commodity2.commodityID');
    }

    

    public function scopeJoinSpecies($query){
    	return $query
    	->leftjoin('species', 'commodity.speciseID', 'species.speciseID');
    }

    

    public function scopeCheckOnShelves($query){
    	return $query
    	->where('commodity.IsShelves', 1);
    }

    public function scopeSelectCommodity(
    	$query,
    	$search_text
	){
    	return $query
    	->where('commodity.commodityName', 'like', $search_text)
    	->orwhere('commodity.commodityPrice', 'like', $search_text)
    	->orwhere('commodity.commodityIntroduction', 'like', $search_text);
    }

    public function scopeGetRange(
        $query,
        $StartNumber,
        $EndNumber,
        $species
    ){
        return $query
        ->orderBy('commodity.'.$species)
        ->offset($StartNumber - 1)
        ->limit($EndNumber - $StartNumber + 1) 
        ;
    }

    public function scopeCheckHiddenType($query){
        return $query
        ->whereNull('commodity.hiddenType')
        ->orwhere('commodity.hiddenType','<>',1);
    }

}
