<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;
class AddressController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $query = $request->get('q');
       
        if ($query!='')
        {
            
             $datas = Address::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Address::orderBy('id','DESC')->paginate(20);
           
        }
       
       $vendor=Vendor::get();
      

        return view('address.home',compact('datas'));
    }

    public function storeAddress(Request $request)
    {
    	$orderdata = json_decode($request['orderdata']);
    	 $Customer= Address::create([
    	 	'user_id' => $request['user_id'],
            'label' => $request['label'],
            'flat_no' => $request['flat_no'],
            'street_address' => $request['street_address'],
            'city' => $request['city'],
            'zip_code' => $request['zip_code'],
            'landmark' => $request['landmark']
           

    	 ]);

    }
}
