<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
        	return $email;
        }
        
    }
}
