<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order_detailed extends Model
{
    //
    protected $table = 'order_detailed';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeGetOrderID(
    	$query,
    	$commodityID
    ){
    	return $query->where('commodityID',$commodityID)
                ->select('orderID');
    }

    public function scopeGetOrderDetailed(
        $query,
        $commodityID
    ){
        return $query->where('commodityID',$commodityID);
    }

    public function scopeJoinCommodity($query){
        $query
        ->leftjoin('groupbuy_commodity', function ($join) {
            $join->on('groupbuy_commodity.groupbuyID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'groupbuy'
            );
        })
        ->leftjoin('limited_commodity', function ($join) {
            $join->on('limited_commodity.limitedID', 'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'timelimit'
            );
        })
        ->leftjoin('commodity', function ($join) {
            $join->on('commodity.commodityID',  'order_detailed.commodityID')
            ->where('order_detailed.commodityArea',  'commodity'
            )
            ->orOn('commodity.commodityID',  'limited_commodity.commodityID')
            ->orOn('commodity.commodityID',  'groupbuy_commodity.commodityID');
        })
        ->select('commodity.commodityName as commodityName',
            'order_detailed.commodityArea as commodityArea',
            'order_detailed.commodityAmount',
            'groupbuy_commodity.groupbuyID as groupbuyID',
            'limited_commodity.limitedID as limitedID',
            'commodity.commodityID as commodityID',
            'commodity.commodityPrice as commodityPrice',
            'limited_commodity.limitedPrice as limitedPrice',
            'groupbuy_commodity.groupbuyPrice as groupbuyPrice'
            );
        ;
    }

    public function scopeCheckOrderID(
        $query,
        $orderID
    ){
        $query->where('orderID',$orderID);
    }
}
