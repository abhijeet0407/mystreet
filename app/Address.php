<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Address extends Model
{
    //
    use SoftDeletes;

    use SearchableTrait;


     protected $fillable = [
        'user_id', 'label', 'flat_no','street_address', 'city', 'zip_code', 'landmark'
    ];


     protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'addresses.label' => 20,
           
            
        ],
        'joins' => [
            'users' => ['users.id','addresses.user_id'],

        ],
    ];
    public function users(){
    	return $this->belongsToMany('App\User');
    }
}
