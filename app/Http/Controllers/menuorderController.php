<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menuorder;
class menuorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $Customer= Menuorder::create([
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
            
        ]);

    }



}
