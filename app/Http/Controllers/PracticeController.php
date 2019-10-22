<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practice\StorePracticeRequest;
use App\Http\Requests\Practice\UpdatePracticeRequest;
use App\Practice;
use App\FieldsOfPractice;
use App\Rules\MinImageWidth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practices = Practice::paginate(10);
        return view('practices.index', compact('practices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fieldsOfPractice = FieldsOfPractice::all();
        return view('practices.create', compact('fieldsOfPractice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Practice\StorePracticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePracticeRequest $request)
    {
        try {
            $practice = Practice::create($request->all());
            $practice->fieldsOfPractice()->sync($request->input('fields_of_practice'));
        } catch (Exception $e) {
            return back()->withError(__('Failure saving a new practice! Please try again.'));
        }
        return redirect()->route('practices.show', $practice)->withSuccess(__('Success!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice)
    {
        $fieldsOfPractice = FieldsOfPractice::all();
        return view('practices.show', compact('practice', 'fieldsOfPractice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Practice $practice)
    {
        $fieldsOfPractice = FieldsOfPractice::all();
        return view('practices.edit', compact('practice', 'fieldsOfPractice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Practice\UpdatePracticeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePracticeRequest $request, Practice $practice)
    {
        try {
            $practice->update($request->all());
            $practice->fieldsOfPractice()->sync($request->input('fields_of_practice'));
        } catch (Exception $e) {
            return back()->withError(__('Failure updating! Please try again.')); 
        }
        return redirect()->route('practices.show', $practice)->withSuccess(__('Success!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practice $practice)
    {
        try {
            $practice->delete();
        } catch (Exception $e) {
            return back()->withError(__('Failure deleting! Please check if there are employees or fields of practice still connected to this practice and try again.'));
        }
        return redirect()->route('practices.index')->withSuccess(__('Practice deleted successfully!'));
    }
}
