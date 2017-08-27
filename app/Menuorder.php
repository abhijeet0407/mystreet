<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
class Menuorder extends Model
{
    //
    use SoftDeletes;

     use SearchableTrait;


     protected $fillable = [
        'menu_item', 'menu_name', 'menu_qty','menu_type', 'menu_plan', 'menu_startdate','menu_deliverytime','menu_days','menu_price','order_price','customerId'
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
            'menu' => 20,
            'price' => 20,
            'menu_type' =>10,
            
            
        ]
        
    ];


}
