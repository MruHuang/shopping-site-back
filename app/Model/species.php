<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class species extends Model
{
    //
    protected $table = 'species';
    protected $primaryKey = 'speciseID';
	protected $guarded = [];
    public $timestamps = true;

    public function scopeGetAllSpecies($query){
    	return $query;
    }

    public function scopeGetSpecies(
    	$query,
    	$StartNumber,
        $EndNumber
    ){
    	return $query->orderBy('speciseID')
        ->offset($StartNumber - 1)
        ->limit($EndNumber - $StartNumber + 1);
    }
    public function scopeGetShowSpecies(
         $query
    ){
       return $query->orderBy('speciseID')
       ->where('speciseName','<>','預設');
    }
}
