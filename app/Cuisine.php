<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Cuisine extends Model
{
    //
    use SoftDeletes;
    use SearchableTrait;

    protected $fillable = [
        'cuisine', 'cuisine_image'
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
            'cuisine' => 10
            
        ]
    ];

    public function vendors(){
    	return $this->belongsToMany('App\Vendor');
    }
}
