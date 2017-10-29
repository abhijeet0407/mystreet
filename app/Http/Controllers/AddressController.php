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
}
