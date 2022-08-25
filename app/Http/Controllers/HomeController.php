<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Company;
use \App\Models\Employee;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyCount = Company::count();
        $employeeCount = Employee::count();
        
        return view('home')->with('company_count',$companyCount)
                ->with('employee_count',$employeeCount);
    }
}
