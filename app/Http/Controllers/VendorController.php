<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuisine;
use App\Location;
use App\User;
use App\Vendor;
use Illuminate\Support\Facades\Validator;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ApiVendorList(Request $request){

        $query = $request->get('q');
        $query2 = $request->get('location');
       
        if ($query!='')
        {
            
            $datas = Vendor::search($query)->with('location')->with('locations')->orderBy('id','DESC')->paginate(20);
           
        }elseif ($query2!='') {
           $datas = Vendor::with('location')->with('locations')->where('location_id','=',$query2)->orderBy('id','DESC')->paginate(20);
        }
        else
        {
            $datas = Vendor::with('location')->with('locations')->with('cuisines')->orderBy('id','DESC')->paginate(20);
           
        }
        //return $datas;
        $data= $datas->toArray()['data'];
        return json_encode(array(array('data' => $data,'pagination' => array(
        'total'        => $datas->total(),
        'per_page'     => $datas->perPage(),
        'current_page' => $datas->currentPage(),
        'last_page'    => $datas->lastPage(),
        'from'         => $datas->firstItem(),
        'to'           => $datas->lastItem()
    ))));

    }

    public function ApiVendorInner(Request $request){

        $query = $request->get('vendor');
        
       
        if ($query!='')
        {
            
          return  $datas = Vendor::where('id','=',$query)->with('location')->with('locations')->with('cuisines')->with('menus')->orderBy('id','DESC')->get();
           
        }
        

    }




    public function index(Request $request)
    {
        //

        $query = $request->get('q');
       
        if ($query!='')
        {
            
            $datas = Vendor::search($query)->with('location')->with('locations')->orderBy('id','DESC')->paginate(20);
           
        }
        else
        {
            $datas = Vendor::with('location')->with('locations')->orderBy('id','DESC')->paginate(20);
           
        }
       
        //$location=Location::get();

        

        return view('vendor.home',compact('datas'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cuisine=Cuisine::get();
        $location=Location::get();
        //return $location;
        return view('vendor/form',compact('cuisine','location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /////////////////

        $validator = Validator::make($request->all(), [
             'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'location' => 'required',
            'cuisine_vendor' => 'required',
            'location_vendor' => 'required'
        ],[
    'email.unique' => 'Email address is already registered and active or the user is deleted by administrator!',
        ]);

        if ($validator->fails()) {
            return redirect('vendor/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $Vendor= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'userrole' => $request['role'],
            'password' => bcrypt($request['password']),
            'userrole' => 'vendor'
        ]);

        $VendorInsertId = $Vendor->id;

        if(isset($VendorInsertId)){
            $Vendor_attr=new Vendor;
            $Vendor_attr->name=$request['name'];
            $Vendor_attr->email=$request['email'];
            $Vendor_attr->user_id=$VendorInsertId;
            $Vendor_attr->phone=$request['phone'];
            $Vendor_attr->location_id=$request['location'];
            $Vendor_attr->address=$request['address'];

            if($Vendor_attr->save()){
                $cuisine_vendor=$request['cuisine_vendor'];
                $Vendor_attr->cuisines()->sync($cuisine_vendor);

                $location_vendor=$request['location_vendor'];
                $Vendor_attr->locations()->sync($location_vendor);
            }



        }
            
        if(isset($Vendor_attr)){
            return redirect('vendor');
        }else{
            return back()->withInput();
        }


        ///////////
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
        $vendor=Vendor::where('user_id','=',$id)->with(array('locations','cuisines'))->get();
       // return $vendor;
        return view('vendor.show',compact('vendor'));
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
        $vendor=Vendor::where('user_id','=',$id)->with(array('locations','cuisines'))->first();
          $cuisine=Cuisine::get();
        $location=Location::get();
        return view('vendor.form',compact('vendor','cuisine','location'));
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
        

        /////////////////
        if($request['change_password_check']==1){
            $validator = Validator::make($request->all(), [
                 'name' => 'required|max:255',
                'password' => 'required|min:6',
                'phone' => 'required|digits:10',
                'address' => 'required',
                'location' => 'required',
                'cuisine_vendor' => 'required',
                'location_vendor' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('vendor/id/edit')
                            ->withErrors($validator)
                            ->withInput();
            }

            /**/
            $Vendor=User::find($id);
           
            $Vendor->name = $request['name'];
           
            $Vendor->password = bcrypt($request['password']);
            $Vendor->save();
            
           
            
        

            $Vendor_attr_id = Vendor::where('user_id','=',$id)->first();
            $Vendor_attr= Vendor::find($Vendor_attr_id->id);
            $Vendor_attr->name=$request['name'];
           
           
            $Vendor_attr->phone=$request['phone'];
            $Vendor_attr->location_id=$request['location'];
            $Vendor_attr->address=$request['address'];

            if($Vendor_attr->save()){
                $cuisine_vendor=$request['cuisine_vendor'];
                $Vendor_attr->cuisines()->sync($cuisine_vendor);

                $location_vendor=$request['location_vendor'];
                $Vendor_attr->locations()->sync($location_vendor);
            }

            /**/

        }else{

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
               
                'phone' => 'required|digits:10',
                'address' => 'required',
                'location' => 'required',
                'cuisine_vendor' => 'required',
                'location_vendor' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('vendor/id/edit')
                            ->withErrors($validator)
                            ->withInput();
            }


            /**/
            $Vendor=User::find($id);
           
            $Vendor->name = $request['name'];
            
            $Vendor->save();
            
           
            
        

            $Vendor_attr_id = Vendor::where('user_id','=',$id)->first();
            $Vendor_attr= Vendor::find($Vendor_attr_id->id);
            $Vendor_attr->name=$request['name'];
            
           
            $Vendor_attr->phone=$request['phone'];
            $Vendor_attr->location_id=$request['location'];
            $Vendor_attr->address=$request['address'];

            if($Vendor_attr->save()){
                $cuisine_vendor=$request['cuisine_vendor'];
                $Vendor_attr->cuisines()->sync($cuisine_vendor);

                $location_vendor=$request['location_vendor'];
                $Vendor_attr->locations()->sync($location_vendor);


            }

            /**/



        }

        
            
        if(isset($Vendor_attr)){
            return redirect('vendor');
        }else{
            return back()->withInput();
        }


        //////////


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
        $User = User::find($id);
        $User->delete();
        return 'deleted';
    }
}
