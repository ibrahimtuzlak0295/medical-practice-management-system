<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Practice;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $practices = Practice::all();
        return view('employees.create', compact('practices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Request\Employee\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->all());
        } catch (Exception $e) {
            return back()->withError(__('Failure saving a new employee! Please try again.')); 
        }
        return redirect()->route('employees.show', $employee)->withSuccess(__('Success!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $practices = Practice::all();
        return view('employees.edit', compact('employee', 'practices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Request\Employee\UpdateEmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update($request->all());
        } catch (Exception $e) {
            return back()->withError(__('Failure updating employee! Please try again.')); 
        }
        return redirect()->route('employees.show', $employee)->withSuccess(__('Success!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
        } catch (Exception $e) {
            return back()->withError(__('Failure deleting employee! Please try again.')); 
        }
        return redirect()->route('employees.index')->withSuccess(__('Employee deleted successfully!'));
    }
}
