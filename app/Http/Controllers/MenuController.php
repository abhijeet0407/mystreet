<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Menu;
use Illuminate\Support\Facades\Validator;
class MenuController extends Controller
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
            
             $datas = Menu::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Menu::orderBy('id','DESC')->paginate(20);
           
        }
       
       $vendor=Vendor::get();
      

        return view('menu.home',compact('datas','vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendor=Vendor::orderBy('name')->get();
        return view('menu.form',compact('vendor'));
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
        $validator = Validator::make($request->all(), [
             'menu' => 'required|max:255',
            'price' => 'required'
           
        ],[
    'price.digits' => 'Numbers only',
        ]);

        if ($validator->fails()) {
            return redirect('menu/create')
                        ->withErrors($validator)
                        ->withInput();
        }


        $Menu= Menu::create([
            'vendor_id' => $request['vendor'],
            'menu' => $request['menu'],
            'price' => $request['price'],
            'menu_type' => $request['menu_type']
        ]);

        if(isset($Menu)){
            return redirect('menu');
        }else{
            return back()->withInput();
        }

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
}
