<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = Salary::all();
        return response()->json($salary);
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
       
        $Salary = new Salary();
        $Salary ->employee_id = $request ->employee_id;
        $Salary ->amount = $request ->amount;
        $Salary ->salary_date = $request ->salary_date;
        $Salary ->salary_month = $request ->salary_month;
        $Salary ->salary_year = $request ->salary_year;

        $Salary->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salary = DB::table('salaries')->where('id',$id)->first();
        return response()->json($salary);
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
        Salary::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('salaries')->where('id',$id)->delete();
    }

    public function paid(Request $request,$id)
    {

        $validate = $request->validate([
            'salary_month' =>'required'
        ]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month',$month)->first();

        if($check) {
            return response()->json('Salary Already Added');
        }else{
            $Salary = new Salary();
            $Salary ->employee_id = $id;
            $Salary ->amount = $request ->amount;
            $Salary ->salary_date = date('d/m/y');
            $Salary ->salary_month = date('F');
            $Salary ->salary_year = date('Y');
    
            $Salary->save();
        }

       
       
    }
}
