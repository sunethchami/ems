<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Employee;
use \App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $employees = DB::table('companies')
            ->rightJoin('employees', 'companies.id', '=', 'employees.company_id')
            ->paginate(10);
         
        //return $employees;
        return view('employee.index')->with('results',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create')->with('companies',$companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email'
         ]);
         
         $employee = new Employee;
         
         $employee->first_name = $request->first_name;
         $employee->last_name = $request->last_name;
         $employee->company_id = $request->company_id;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $save = $employee->save();

         if($save){
            flash('The recode have been added successfully.','success');
            return back();
        }else{
            flash('Something went wrong,please try again later','error'); 
            return back();
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
        $companies = Company::all();
        $employee = Employee::find($id);
        return view('employee.edit')->with('employee',$employee)
                ->with('companies',$companies);        
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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email'
         ]);
        
        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $save = $employee->update();
        
        if($save){
            flash('The recode have been updated successfully.','success'); 
            return redirect('employee');
        }else{
            flash('Something went wrong,please try again later','error'); 
            return redirect('employee');
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
        $employee = Employee::find($id);
        $result = $employee->delete();
        
        if($result){
            flash('The recode have been deleted successfully.','success');
            return redirect('employee');
        }else{
            flash('Something went wrong,please try again later','error'); 
            return redirect('employee');
        } 
        
    }
}
