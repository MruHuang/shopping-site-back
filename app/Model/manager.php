<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    //
    protected $table = 'manager';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeManagerCheck(
    	$query,
    	$managment_account,
        $managment_password
    ){
    	return $query
    	->where('managerAccount', $managment_account)
    	->where('managerPassword', $managment_password);
    }

    public function scopeLoginCheck(
        $query,
        $managment_account
    ){
        return $query
        ->where('managerAccount', $managment_account);
    }
}
