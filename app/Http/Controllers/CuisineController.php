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

    public function ApiCuisineList(){
         $datas = Cuisine::select('id','cuisine')->where('cuisine','!=','')->orderBy('cuisine','ASC')->paginate(200);
    
    $data= $datas->toArray()['data'];
        //return $data;
        return json_encode(array(array('data' => $data,'pagination' => array(
        'total'        => $datas->total(),
        'per_page'     => $datas->perPage(),
        'current_page' => $datas->currentPage(),
        'last_page'    => $datas->lastPage(),
        'from'         => $datas->firstItem(),
        'to'           => $datas->lastItem(),
        'absurl'       => "http://chabaza.com/app/public/storage/menus/" 
    ))));     

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
        $file_name='';
        if($request->file('cuisine_image')!==null){
        $ext=$request->file('cuisine_image')->guessClientExtension();
        $file_name=rand(1111,9999).'cuisine.'.$ext;
        $request->file('cuisine_image')->storeAs('public/cuisines/',$file_name);
         }
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
        //print_r($request->file('cuisine_image'));
        if($request->file('cuisine_image')!== null){

        $ext=$request->file('cuisine_image')->guessClientExtension();
        $file_name=rand(1111,9999).'cuisine.'.$ext;
        $request->file('cuisine_image')->storeAs('public/cuisines/',$file_name);
        $cuisine->cuisine_image=$file_name;
        }else{
            $cuisine->cuisine_image=$request['prev_cuisine_image'];
        }
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
