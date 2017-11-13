<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Location extends Model
{
    //
     use SoftDeletes;

     use SearchableTrait;
     

     protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'location' => 10
            
        ]
    ];

    public function vendors(){
    	return $this->belongsToMany('App\Vendor');
    }

    public function location(){
        return $this->belongsTo('App\Vendor');
    }


}
