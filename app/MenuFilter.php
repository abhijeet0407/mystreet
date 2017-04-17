<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class MenuFilter extends Model
{
    //
    use SoftDeletes;
    use SearchableTrait;
     protected $table = 'menufilters';
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'menufilter' => 10
            
        ]
    ];

    public function menus(){
    	return $this->belongsToMany('App\Menu');
    }
}
