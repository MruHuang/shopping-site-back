<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\order_detailed as oddSQL;

class merchandise_order extends Model
{
    //
    protected $table = 'merchandise_order';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeGetAll($query){
    	$query->where('orderState','<>','Carryout')
        ->where('orderState','<>','Cancel');
    }

    public function scopeGetUnpaid($query){
    	$query->where('orderState','Unpaid');
    }

    public function scopeGetCheck($query){
        $query->where('orderState','Check');
    }

    public function scopeGetReady($query){
    	$query->where('orderState','Ready');
    }

    public function scopeGetDelivery($query){
    	$query->where('orderState','Delivery');
    }

    public function scopeGetCarryout($query){
    	$query->where('orderState','Carryout');
    }

    public function scopeGetCancel($query){
        $query->where('orderState','Cancel');
    }

    public function scopeCheckOrderID(
    	$query,
    	$orderID
	){
    	return $query->where('orderID', $orderID);
    }

    public function scopeJoinOrder_detailed($query){
    	return $query
    	->join('order_detailed', 'merchandise_order.orderID', 'order_detailed.orderID')
    	;
    }

    public function order_detailed(){
    	return $this->
    	hasOne(oddSQL::class, 'orderID','orderID');
    }

    public function scopeGroupBuy($query){
        $query->where('orderClass','groupbuy');
    }

    public function scopeNoShipped($query){
        $query->where('orderState','<>','Carryout')
        ->where('orderState','<>','Delivery')
        ->where('orderState','<>','Cancel');
    }

    public function scopeOrderOrder(
        $query,
        $StartNumber,
        $EndNumber,
        $species
    ){
        return $query->orderBy('merchandise_order.'.$species,'desc')
        ->offset($StartNumber - 1)
        ->limit($EndNumber - $StartNumber + 1);
    }

    public function scopeCheckONO(
    	$query,
    	$ONO
	){
    	$query->where('randomNum', $ONO);
    }

    public function scopeCheckoutMethodCreditCard($query){
    	$query->where('checkoutMethod','CreditCard');
    }
}
