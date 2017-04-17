<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuFilter;
class MenuFilterController extends Controller
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
            
             $datas = MenuFilter::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = MenuFilter::where('menufilter','!=','')->orderBy('id','DESC')->paginate(20);
           
        }
       
       
      

        return view('menufilters.home',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('menufilters.form');
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
        $menufilter=new MenuFilter;
        $menufilter->menufilter=$request['menufilter'];
        $menufilter->save();
        return redirect('menufilter');
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
         $menufilter=MenuFilter::findorfail($id);
        return view('menufilters.form',compact('menufilter'));
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
        $menufilter = MenuFilter::find($id);

        $menufilter->menufilter = $request['menufilter'];

        $menufilter->save();
        return redirect('menufilter');
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
         $menufilter = MenuFilter::find($id);
        $menufilter->delete();
        return 'deleted';
    }
}
