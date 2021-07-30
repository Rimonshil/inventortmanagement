<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Image;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
        $validateData = $request->validate([
            'email' => 'required|unique:suppliers',
            'name' => 'required',
            'phone_number'=>'required'

        ]);

        if($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0 ,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);


            $employee = new Supplier();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->shopname = $request->shopname;
            $employee->phone_number = $request->phone_number;
           $employee->photo = $image_url;
           $employee->save();


        }else{

            $employee = new Supplier;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->shopname = $request->shopname;
            $employee->phone_number = $request->phone_number;
           $employee->save();

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
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
        Supplier::where('id',$id)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dlt = DB::table('suppliers')->where('id',$id)->first();
        $photo = $dlt->photo;
        if($photo){
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();

        }else{
            DB::table('suppliers')->where('id',$id)->delete();

        }
        
    }
}
