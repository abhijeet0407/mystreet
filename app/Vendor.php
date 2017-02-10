<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Vendor extends Model
{
    //
    use SoftDeletes;
     use SearchableTrait;

    public function cuisines(){
    	return $this->belongsToMany('App\Cuisine')->withTimestamps();
    }

    public function locations(){
    	return $this->belongsToMany('App\Location')->withTimestamps();
    }

    public function location(){
        return $this->belongsTo('App\Location','location_id');
    }

   

    public function user(){ 
        return $this->hasOne('App\User');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }


    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'name' => 20,
            'email' => 20,
            'phone' =>20,
            'address' =>20
            
        ]
        
    ];




}
