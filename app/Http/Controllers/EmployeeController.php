<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Practice;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Redirect;
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
        return view('employees.index', [
            'employees' => Employee::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create', [
            'practices' => Practice::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Request\Employee\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee;
        $employee->fill([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'practice_id' => $request->input('practice_id'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);

        try {
            $employee->save();
            return Redirect::back()->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure saving a new employee! Please try again.')); 
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
        return view('employees.show', [
            'employee' => Employee::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employees.edit', [
            'employee' => Employee::findOrFail($id),
            'practices' => Practice::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Request\Employee\UpdateEmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->fill([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'practice_id' => $request->input('practice_id'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);

        try {
            $employee->save();
            return Redirect::route('employees.show', [
                'employee' => $employee
            ])->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure updating employee! Please try again.')); 
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
        try {
            Employee::findOrFail($id)->delete();
            return Redirect::route('employees.index')->withSuccess(__('Employee deleted successfully!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure deleting employee! Please try again.')); 
        }
    }
}
