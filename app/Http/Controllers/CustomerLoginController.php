<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
use App\Menuorder;

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

    public function RsaProcess(Request $request){

        $url = "https://test.ccavenue.com/transaction/getRSAKey";
        $fields = array(
                'access_code'=>"AVFV72EG00BL93VFLB",
                //'order_id'=>'23'
               'order_id'=>$request['order_id']
        );
       // print_r($fields);

        $postvars='';
        $sep='';
        foreach($fields as $key=>$value)
        {
                $postvars.= $sep.urlencode($key).'='.urlencode($value);
                $sep='&';
        }

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch, CURLOPT_CAINFO, 'http://chabaza.com/app/public/cacert.pem');
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        return $result;
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






    /**/


    function encrypt($plainText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
        {
              $encryptedText = mcrypt_generic($openMode, $plainPad);
                  mcrypt_generic_deinit($openMode);
                        
        } 
        return bin2hex($encryptedText);
    }

    function decrypt22($encryptedText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText=$this->hextobin($encryptedText);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);
        return $decryptedText;
        
    }
    //*********** Padding Function *********************

     function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    function hextobin($hexString) 
     { 
            $length = strlen($hexString); 
            $binString="";   
            $count=0; 
            while($count<$length) 
            {       
                $subString =substr($hexString,$count,2);           
                $packedString = pack("H*",$subString); 
                if ($count==0)
            {
                $binString=$packedString;
            } 
                
            else 
            {
                $binString.=$packedString;
            } 
                
            $count+=2; 
            } 
            return $binString; 
          } 




    /**/



    /**/
    function order_mailer(){
        $order_id='1710180216411041';
        $cart_first=Menuorder::select('customerId')->where('order_no', '=', $order_id)->first();

        
        $user_id=$cart_first->customerId;
        $user_details=Customer::where('user_id','=',$user_id)->first();
       // echo $user_details->name;
        $cart2=Menuorder::where('order_no', '=', $order_id)->get();

        print_r($cart2);
        foreach($cart2 as $cart){
            //echo $cart->menu_plan;
           // echo $arr;
            
                if($cart->menu_plan=='1'){
                    $val="One day meal";
                }else if($cart->menu_plan=='5'){
                    $val="One Week meal";
                }else if($cart->menu_plan=='15'){
                    $val="Fifteen day meal";
                }else if($cart->menu_plan=='30'){
                    $val="Thirty day meal";
                }
                echo $val;
           
        }
        $to='khairnar.abhi@gmail.com';
        $subject='cart';
        $message='cart body';
        $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@chabaza.com>' . "\r\n";


//mail($to,$subject,$message,$headers);

    }
    function SuccessCart(Request $request){
        $workingKey='A33EC01955E79CC8261D05573806F75A';     //Working Key should be provided here.
    $encResponse=$request["encResp"];         //This is the response sent by the CCAvenue Server
    $rcvdString=$this->decrypt22($encResponse,$workingKey);      //Crypto Decryption used as per the specified working key.
    $order_status="";
    $decryptValues=explode('&', $rcvdString);
    $dataSize=sizeof($decryptValues);
    echo "<center>";

    for($i = 0; $i < $dataSize; $i++) 
    {
        $information=explode('=',$decryptValues[$i]);
        if($i==3)   $order_status=$information[1];
        if($i==0)   $order_id=$information[1];
        if($i==1)   $tracking_id=$information[1];
    }

    Menuorder::where('order_no', '=', $order_id)
        ->update([
            'transaction_no' => $tracking_id,
            'order_status' => $order_status 
            
        ]);

    if($order_status==="Success")
    {

        $cart_first=Menuorder::select('customerId')->where('order_no', '=', $order_id)->first();

        
        $user_id=$cart_first->customerId;
        $user_details=Customer::where('user_id','=',$user_id)->first();
        //echo $user_details->name;
        $cart=Menuorder::where('order_no', '=', $order_id)->get();

         $message = "

<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" summary=\"Request Information\">

  <tr style=\"background:#e4e4e4;\">

    <th style=\"text-align:center;\"colspan=\"2\"><h2>Order Details</h2></th>

  </tr>
  

  <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Name</th>
    <td style=\"text-align:left;padding-left:10px;\">".$user_details->name."</td>
  </tr>

  

  <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Email</th>
    <td style=\"text-align:left;padding-left:10px;\">".$user_details->email."</td>
  </tr>

    <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Mobile</th>
    <td style=\"text-align:left;padding-left:10px;\">".$user_details->mobile."</td>
  </tr>

    <tr>
    <th style=\"text-align:left;padding-left:10px;\" width=\"25%\" scope=\"row\">Address</th>
    <td style=\"text-align:left;padding-left:10px;\">".$user_details->address."</td>
  </tr>


   
  

  ";

foreach($cart as $k=>$arr){

        if($k=="menu_plan")
        {
            if($arr=='1'){
                $val="One day meal";
            }else if($arr=='5'){
                $val="One Week meal";
            }else if($arr=='15'){
                $val="Fifteen day meal";
            }else if($arr=='30'){
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
$to3='khairnar.abhi@gmail.com';
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

mail($to3,$subject,$message,$headers);


        echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
        
    }
    else if($order_status==="Aborted")
    {
        echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
    
    }
    else if($order_status==="Failure")
    {
        echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
    }
    else
    {
        echo "<br>Security Error. Illegal access detected";
    
    }

    echo "<br><br>";

    echo "<table cellspacing=4 cellpadding=4>";
    for($i = 0; $i < $dataSize; $i++) 
    {
        $information=explode('=',$decryptValues[$i]);
            echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
    }

    echo "</table><br>";
    echo "</center>";
    }
    /**/
}
