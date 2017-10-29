<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;
use Illuminate\Support\Facades\Validator;
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
    	$validator = Validator::make($request->all(), [
             'user_id' => 'required|max:255',
             'label' => 'required|max:255',
             'flat_no' => 'required|max:255',
             'street_address' => 'required|max:255',
             'city' => 'required|max:255',
             'zip_code' => 'required|max:255',
             'landmark' => 'required|max:255',
            
            
            
        ]);



        if ($validator->fails()) {
            return implode(', ',$validator->errors()->all());
        }	
    	 $Address= Address::create([
    	 	'user_id' => (int)$request['user_id'],
            'label' => $request['label'],
            'flat_no' => $request['flat_no'],
            'street_address' => $request['street_address'],
            'city' => $request['city'],
            'zip_code' => $request['zip_code'],
            'landmark' => $request['landmark']
           

    	 ]);

    	 $AddressId = $Address->id;
    	 if($AddressId!=''){
            return 'success@#@'.$AddressId;
        }else{
            return 'error';
        }

    }

    public function checkAddress(Request $request){
    	$datas = Address::where('user_id','=',$request['user_id'])->orderBy('id','DESC')->paginate(200);
    	$data= $datas->toArray()['data'];
    	if(count($data)>0){
    	return json_encode(array(array('data' => $data,'status' => 'success')));
    	}else{
    		return json_encode(array(array('status' => 'fail')));
    	}
    	
    }
}
