<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Menu;
use App\MenuFilter;
use Illuminate\Support\Facades\Validator;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function ApiMenuList(Request $request){

        $query = $request->get('cuisine');
       
        if ($query!='')
        {
            
             $datas = Menu::select('id','menu','price','menu_type','image')->where('id','=',$query)->orderBy('id','DESC')->paginate(200);
           
        }
        else
        {
            $datas = Menu::select('id','menu','price','menu_type','image')->where('menu','!=','')->orderBy('id','DESC')->paginate(200);
           
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
        'absurl'       => "http://chabaza.com/app/storage/app/public/menus/" 
    ))));

    }


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
        $menufilter=MenuFilter::get();
        return view('menu.form',compact('vendor','menufilter'));
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
        $file_name='';
        if($request->file('image')!==null){
        $ext=$request->file('image')->guessClientExtension();
        $file_name=rand(1111,9999).'menu.'.$ext;
        $request->file('image')->storeAs('public/menus/',$file_name);
        }
        $Menu= Menu::create([
            'vendor_id' => $request['vendor'],
            'menu' => $request['menu'],
            'price' => $request['price'],
            'image' => $file_name,
            'description' => $request['description'],
            'menu_type' => $request['menu_type']
        ]);
         $MenuInsertId = $Menu->id;
        if(isset($Menu)){
            $Menu_Object = Menu::find($MenuInsertId);

            $menu_menufilter=$request['menu_menufilter'];
            if(isset($request['menu_menufilter'])){
                 $Menu_Object->menufilter()->sync($menu_menufilter);
            }
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
        $menu=Menu::where('id','=',$id)->first();
          $vendor=Vendor::get();
        $menufilter=MenuFilter::get();
        //print_r($menu);
        return view('menu.form',compact('menu','menufilter','vendor'));
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

        $validator = Validator::make($request->all(), [
             'menu' => 'required|max:255',
            'price' => 'required'
           
        ],[
    'price.digits' => 'Numbers only',
        ]);

        if ($validator->fails()) {
            return redirect('menu/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $Menu=Menu::find($id);
       // print_r($request->file('image'));
        if($request->file('image')!== null){

        $ext=$request->file('image')->guessClientExtension();
        $file_name=rand(1111,9999).'menu.'.$ext;
        $request->file('image')->storeAs('public/menus/',$file_name);
        $Menu->image=$file_name;
        }else{
            $Menu->image=$request['prev_image'];
        }

        
        $Menu->vendor_id = $request['vendor'];
        $Menu->menu = $request['menu'];
        $Menu->price = $request['price'];
        $Menu->description = $request['description'];
        $Menu->menu_type = $request['menu_type'];
        $Menu->save();
        if(isset($Menu)){
            $Menu_Object = Menu::find($id);

            $menu_menufilter=$request['menu_menufilter'];
            if(isset($request['menu_menufilter'])){
                 $Menu_Object->menufilter()->sync($menu_menufilter);
            }else{
                $Menu_Object->menufilter()->sync(array());
            }
           
            return redirect('menu');
        }else{
            return redirect('menu/'.$id.'/edit');
        }

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

        $Menu = Menu::find($id);
        $Menu->delete();
        return 'deleted';
    }
}
