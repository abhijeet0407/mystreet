<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\Response;
class locationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ApiLocationList(Request $request){

        $query = $request->get('q');
       
        if ($query!='')
        {
            
             $datas = Location::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Location::where('location','!=','')->orderBy('id','DESC')->paginate(20);
           
        }

        return Response::json($datas->toArray());

    }
    public function index(Request $request)
    {
        //
        $query = $request->get('q');
       
        if ($query!='')
        {
            
             $datas = Location::search($query)->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Location::where('location','!=','')->orderBy('id','DESC')->paginate(20);
           
        }
       
       
      

        return view('location.home',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('location.form');
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
        $location=new Location;
        $location->location=$request['location'];
        $location->save();
        return redirect('location');
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
        $location=Location::findorfail($id);
        return view('location.form',compact('location'));
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
        $location = Location::find($id);

        $location->location = $request['location'];

        $location->save();
        return redirect('location');
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
        $location = Location::find($id);
        $location->delete();
        return 'deleted';
    }
}
