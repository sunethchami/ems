<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \App\Models\Company;
use \App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campanies = Company::paginate(10);
         
        return view('company.index')->with('results',$campanies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'name' => 'required',
            'logo' => 'nullable|mimes:jpg,bmp,png|max:5140|'
            . 'dimensions:min_width=100,min_height=100'
         ]);
        
        if($request->file('logo')){
            $path = $request->file('logo')->store('logos');
        }else{
            $path = "";
        }
        
        $company = new Company;

        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->logo = $path;         
        $save = $company->save();

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
        $company = Company::find($id);
        
        return view('company.edit')
                ->with('company',$company);
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
            'name' => 'required',
            'logo' => 'nullable|mimes:jpg,bmp,png|max:5140|'
            . 'dimensions:min_width=100,min_height=100'
         ]);
        
        $company = Company::find($id);
                        
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        if($request->file('logo')){  
            if ($company->logo != null) {
                $imagePath = $company->logo;
                Storage::disk('public')->delete($imagePath);
            }
            $path = $request->file('logo')->store('logos');
            $company->logo = $path;
        }
        $save = $company->update();
        
        
        if($save){            
            flash('The recode have been updated successfully.','success');                                                                                                                                                                    
            return redirect('company');
        }else{
            flash('Something went wrong,please try again later','error');
            return redirect('company');
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
        $company = Company::find($id);
        $imagePath = $company->logo;
        Storage::disk('public')->delete($imagePath);
        $result = $company->delete();
        if($result){
            
            $employees = Employee::where('company_id',$id)->get();
            
            foreach ($employees as $employee){
                
                $emp = Employee::find($employee->id);
                $emp->delete();
            }
            
            flash('The recode have been deleted successfully.', 'success');
            return redirect('company');
        }else{
            flash('Something went wrong,please try again later','error');
            return redirect('company');
        }
    }
}
