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
            
             $datas = Location::select('id','location','location_image')->where('location','like','%'.$query.'%')->orderBy('id','DESC')->paginate(200);
           
        }
        else
        {
            $datas = Location::select('id','location','location_image')->where('location','!=','')->orderBy('id','DESC')->paginate(200);
           
        }
        //return $datas;
        $data= $datas->toArray()['data'];
        //return $data;
        return json_encode(array(array('data' => $data,'pagination' => array(
        'total'        => $datas->total(),
        'per_page'     => $datas->perPage(),
        'current_page' => $datas->currentPage(),
        'last_page'    => $datas->lastPage(),
        'from'         => $datas->firstItem(),
        'to'           => $datas->lastItem(),
        'absurl'       => "http://chabaza.com/app/public/storage/locations/" 
    ))));

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
        $file_name='';
        if($request->file('location_image')!==null){
        $ext=$request->file('location_image')->guessClientExtension();
        $file_name=rand(1111,9999).'location.'.$ext;
        $request->file('location_image')->storeAs('public/locations/',$file_name);
         }
        $location=new Location;
        $location->location=$request['location'];
        $location->location_image=$file_name;
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

        if($request->file('location_image')!== null){

        $ext=$request->file('location_image')->guessClientExtension();
        $file_name=rand(1111,9999).'location.'.$ext;
        $request->file('location_image')->storeAs('public/locations/',$file_name);
        $location->location_image=$file_name;
        }else{
            $location->location_image=$request['prev_location_image'];
        }

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
