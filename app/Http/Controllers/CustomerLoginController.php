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
            $user = Auth::User();
            
            return $user->id;
        }else{
        	return "error";
        }
        
    }

    public function CartProcess(Request $request){
        //include_once(app_path() . '/textlocal.class.php');
      // Account details
    $username = 'aditya.kadam28@gmail.com';
    $hash = 'Boom@123';
    
    // Message details
    $numbers = array(7738270486,9172681335);
    $sender = urlencode('TXTLCL');
    $message = rawurlencode('This is your message');
 
    $numbers = implode(',', $numbers);
 
    // Prepare data for POST request
    $data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
    // Send the POST request with cURL
    $ch = curl_init('http://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Process your response here
    
        //echo json_decode($cartdata);
    $cartdata = $request['cartdata'];
        $myarray=json_decode($cartdata,true);
        $cart=$myarray[0];
        $cartuser=$myarray[1];
        //print_r($myarray);
        $message = "

<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" summary=\"Request Information\">

  <tr style=\"background:#e4e4e4;\">

    <th style=\"text-align:center;\"colspan=\"2\"><h2>Order Details</h2></th>

  </tr>
  

  <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Name</th>
    <td style=\"text-align:left;padding-left:10px;\">".$cartuser['name']."</td>
  </tr>

  

  <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Email</th>
    <td style=\"text-align:left;padding-left:10px;\">".$cartuser['email']."</td>
  </tr>

    <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Mobile</th>
    <td style=\"text-align:left;padding-left:10px;\">".$cartuser['mobile']."</td>
  </tr>

    <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Address</th>
    <td style=\"text-align:left;padding-left:10px;\">".$cartuser['address']."</td>
  </tr>


   
  

  ";

foreach($cart as $k=>$arr){

        if($k=="menu_plan")
        {
            if($arr==1){
                $val="One day meal";
            }else if($arr==5){
                $val="One Week meal";
            }else if($arr==15){
                $val="Fifteen day meal";
            }else if($arr==30){
                $val="Thirty day meal";
            }
        $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Menu Plan</th>
            <td style=\"text-align:left;padding-left:10px;\">".$val."</td>
          </tr>";
        }

        if($k=="menu_name")
        {
            $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Menu Name</th>
            <td style=\"text-align:left;padding-left:10px;\">".$arr."</td>
          </tr>";
        }
        if($k=="menu_price")
        {
            $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Menu Price</th>
            <td style=\"text-align:left;padding-left:10px;\">".$arr."</td>
          </tr>";
        }

        

        if($k=="menu_qty")
        {
            $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Quantity</th>
            <td style=\"text-align:left;padding-left:10px;\">".$arr."</td>
          </tr>";
        }

        if($k=="menu_startdate")
        {
            $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Start Date</th>
            <td style=\"text-align:left;padding-left:10px;\">".$arr."</td>
          </tr>";
        }

        if($k=="order_price")
        {
            $message.=" <tr>
            <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Total Cost</th>
            <td style=\"text-align:left;padding-left:10px;\">".$arr."</td>
          </tr>";
        }
            
}


  $message.= "  
</table>

";

//echo $message;
$to='aditya.kadam28@gmail.com';
$to2=$cartuser['email'];
$subject = "New order received - Chabaza";

$subject2 = "Thankyou for ordering - Chabaza";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@digitaldecode.us>' . "\r\n";


mail($to,$subject,$message,$headers);

mail($to2,$subject2,$message,$headers);
       
        /*$user=$myarray[1];
        foreach($cart as $arr){

            
        }

        foreach($user as $k => $ar){
               // echo $k;
                
            }*/


            
            echo $response;
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
            return 'success@#@'.$CustomerInsertId;
        }else{
            return 'error';
        }




         







    }
}
