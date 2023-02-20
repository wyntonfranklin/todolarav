<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Offices;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        // get all employees
        $employees = Employees::all();
        // get all offices
        $offices = Offices::all();
        return view('employees.index',
            ['employees'=>$employees
            ,'offices'=>$offices]);
    }

    // create new employee
    public function create()
    {
        // get all offices
        $offices = Offices::all(['officeCode','city','country','phone']);
        // all employees with columns
        $employees = Employees::all(['employeeNumber','firstName','lastName','jobTitle']);
        return view('employees.create',[
            'offices'=>$offices, 'employees'=>$employees]);
    }

    // store new employee
    public function store(Request $request)
    {

        // validate request
        $request->validate([
            'employeeNumber' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'extension' => 'required',
            'email' => 'required',
            'officeCode' => 'required',
            'reportsTo' => 'required',
            'jobTitle' => 'required',
        ]);

        // create new employee
        $employee = new Employees();
        $employee->employeeNumber = $request->get("employeeNumber");
        $employee->lastName = $request->get("lastName");
        $employee->firstName = $request->get("firstName");
        $employee->extension = $request->get("extension");
        $employee->email = $request->get("email");
        $employee->officeCode = $request->get("officeCode");
        $employee->reportsTo = $request->get("reportsTo");
        $employee->jobTitle = $request->get("jobTitle");
        $employee->timestamps = false;
        // save employee
        $employee->save();
        // flash message
        $request->session()->flash('status', 'Employee created successfully');

        // redirect to employees index
        return redirect()->route('employees.index');
    }
}
