<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
class CustomerLoginController extends Controller
{
    //
    public function CustomerAuth(Request $request)
    {	
    	$email = $request['email'];
    	$password = $request['password'];
    	
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            
            return "success";
        }else{
        	return "error";
        }
        
    }

    public function CustomerRegister(Request $request)
    {
    	$email=$request['email'];
    	$password=$request['password'];
    	$name=$request['name'];
    	$mobile=$request['mobile'];

    	$validator = Validator::make($request->all(), [
             'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'mobile' => 'required|digits:10'
            
            
        ],[
    'email.unique' => 'Email address is already registered and active or the user is deleted by administrator!',
        ]);



        if ($validator->fails()) {
            return implode(', ',$validator->errors()->all());
        }

        $Customer= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'userrole' => 'customer'
        ]);


        $CustomerInsertId = $Customer->id;

        if(isset($CustomerInsertId)){
            $Customer_attr=new Customer;
            $Customer_attr->name=$request['name'];
            $Customer_attr->email=$request['email'];
            $Customer_attr->user_id=$CustomerInsertId;
            $Customer_attr->phone=$request['mobile'];
            $Customer_attr->address=$request['address'];

            $Customer_attr->save();
        }
            
        if(isset($Customer_attr)){
            return 'success';
        }else{
            return 'error';
        }




         







    }
}
