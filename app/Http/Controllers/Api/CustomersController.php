<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use Image;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
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
            'customer_name' => 'required|unique:customers|max:255',
            'customer_phone' => 'required',

        ]);

        if($request->customer_photo) {
            $position = strpos($request->customer_photo, ';');
            $sub = substr($request->customer_photo, 0 ,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->customer_photo)->resize(240,200);
            
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);


            $employee = new Customer();
            $employee->customer_name = $request->customer_name;
            $employee->customer_phone = $request->customer_phone;
            $employee->customer_address = $request->customer_address;
            $employee->customer_email = $request->customer_email;
          
           $employee->customer_photo = $image_url;
           $employee->save();


        }else{

            $employee = new Customer();
            $employee->customer_name = $request->customer_name;
            $employee->customer_phone = $request->customer_phone;
            $employee->customer_address = $request->customer_address;
            $employee->customer_email = $request->customer_email;
          
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
        $customer = DB::table('customers')->where('id',$id)->first();
        return response()->json($customer);
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
        Customer::where('id',$id)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = DB::table('customers')->where('id',$id)->first();
        $photo = $employee->customer_photo;
        if($photo){
            unlink($photo);
            DB::table('customers')->where('id',$id)->delete();
        }else{
            DB::table('customers')->where('id',$id)->delete();

        }
    }
}
