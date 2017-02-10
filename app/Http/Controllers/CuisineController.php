<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuisine;
class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //
        $query = $request->get('q');
       
        if ($query!='')
        {
            
             $datas = Cuisine::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Cuisine::where('cuisine','!=','')->orderBy('id','DESC')->paginate(20);
           
        }
       
       
      

        return view('cuisine.home',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('cuisine.form');
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
        $cuisine=new Cuisine;
        $cuisine->cuisine=$request['cuisine'];
        $cuisine->save();
        return redirect('cuisine');
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
        $cuisine=Cuisine::findorfail($id);
        return view('cuisine.form',compact('cuisine'));
        //print_r($cuisine);
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
        $cuisine = Cuisine::find($id);

        $cuisine->cuisine = $request['cuisine'];

        $cuisine->save();
        return redirect('cuisine');
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
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return 'deleted';
    }
}
