<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Customer extends Model
{
    //
    use SoftDeletes;
    use SearchableTrait;

     public function user(){ 
        return $this->hasOne('App\User');
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
