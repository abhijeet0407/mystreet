<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menuorder;
use App\Vendor;
use App\Customer;
use App\User;
use App\Menu;
class menuorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = $request->get('q');
       
        if ($query!='')
        {
            
             $datas = Menuorder::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Menuorder::where('menu_item','!=','')->orderBy('id','DESC')->paginate(20);
           
        }
       
       $vendor=Vendor::get();
       $customer=Customer::get();
       $user=User::get();
       $menu=Menu::get();
      

        return view('orders.home',compact('datas','vendor','customer','menu','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function storeOrder(Request $request)
    {
         $orderdata = json_decode($request['orderdata']);

         foreach ($orderdata as $order) {
            $Customer= Menuorder::create([
            'menu_item' => $order->menu_item,
            'menu_name' => $order->menu_name,
            'menu_qty' => $order->menu_qty,
            'menu_type' => $order->menu_type,
            'menu_plan' => $order->menu_plan,
            'menu_startdate' => $order->menu_startdate,
            'menu_deliverytime' => $order->menu_deliverytime,
            'menu_days' => $order->menu_days,
            'menu_price' => $order->menu_price,
            'order_price' => $order->order_price,
            'customerId' => $order->customerId,
            'order_no' => $order->order_no,
            'transaction_no' => '',
            'order_status' => ''
            
        ]);
        }

        /*$Customer= Menuorder::create([
            'menu_item' => $request['menu_item'],
            'menu_name' => $request['menu_name'],
            'menu_qty' => $request['menu_qty'],
            'menu_type' => $request['menu_type'],
            'menu_plan' => $request['menu_plan'],
            'menu_startdate' => $request['menu_startdate'],
            'menu_deliverytime' => $request['menu_deliverytime'],
            'menu_days' => $request['menu_days'],
            'menu_price' => $request['menu_price'],
            'order_price' => $request['order_price'],
            'customerId' => $request['customerId'],
            
        ]);*/

        return $orderdata;

    }



}
