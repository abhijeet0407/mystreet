<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Menu extends Model
{
    //
    use SoftDeletes;

     use SearchableTrait;


     protected $fillable = [
        'menu', 'price', 'vendor_id','menu_type'
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
            'menus.menu' => 20,
            'menus.price' => 20,
            'menus.menu_type' =>10,
            'vendors.name' =>10
            
        ],
        'joins' => [
            'vendors' => ['vendors.id','menus.vendor_id'],
        ],
    ];


    public function vendors()
    {
        return $this->hasMany('vendors');
    }

    public function menufilter()
    {
        return $this->belongsToMany('App\MenuFilter','menu_menufilter','menu_id','menufilter_id');
    }
}
