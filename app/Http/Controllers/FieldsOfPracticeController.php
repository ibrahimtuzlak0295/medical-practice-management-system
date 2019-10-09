<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FieldsOfPractice;
use App\Http\Requests\FieldsOfPractice\StoreFieldsOfPracticeRequest;
use App\Http\Requests\FieldsOfPractice\UpdateFieldsOfPracticeRequest;
use Exception;

class FieldsOfPracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fieldsOfPractice = FieldsOfPractice::paginate(10);
        return view('fields-of-practice.index', compact('fieldsOfPractice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fields-of-practice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FieldsOfPractice\StoreFieldsOfPracticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFieldsOfPracticeRequest $request)
    {
        try {
            $fieldsOfPractice = FieldsOfPractice::create($request->all());
        } catch (Exception $e) {
            return back()->withError(__('Failure creating field of practice! Please try again.')); 
        }
        return redirect()->route('fields-of-practice.show', $fieldsOfPractice)->withSuccess(__('Success!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FieldsOfPractice $fieldsOfPractice)
    {
        return view('fields-of-practice.show', compact('fieldsOfPractice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FieldsOfPractice $fieldsOfPractice)
    {
        return view('fields-of-practice.edit', compact('fieldsOfPractice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FieldsOfPractice\UpdateFieldsOfPracticeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFieldsOfPracticeRequest $request, FieldsOfPractice $fieldsOfPractice)
    {
        try {
            $fieldsOfPractice->update($request->all());
        } catch (Exception $e) {
            return back()->withError(__('Failure updating field of practice! Please try again.')); 
        }
        return redirect()->route('fields-of-practice.show', $fieldsOfPractice)->withSuccess(__('Success!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FieldsOfPractice $fieldsOfPractice)
    {
        try {
            $fieldsOfPractice->delete();
        } catch (Exception $e) {
            return back()->withError(__('Failure deleting field of practice! Please check if there are practices still connected to this field of practice and try again.')); 
        }
        return redirect()->route('fields-of-practice.index')->withSuccess(__('Field of practice deleted successfully!'));
    }
}
