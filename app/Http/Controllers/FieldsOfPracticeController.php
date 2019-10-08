<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FieldsOfPractice;
use Illuminate\Support\Facades\Redirect;
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
        return view('fields-of-practice.index', [
            'fields_of_practice' => FieldsOfPractice::paginate(10)
        ]);
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
        $fieldOfPractice = new FieldsOfPractice;

        $fieldOfPractice->fill([
            'name' => $request->input('name')
        ]);

        try {
            $fieldOfPractice->save();
            return Redirect::back()->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure creating field of practice! Please try again.')); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FieldsOfPractice $fieldsOfPractice)
    {
        return view('fields-of-practice.show', [
            'field_of_practice' => $fieldsOfPractice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FieldsOfPractice $fieldsOfPractice)
    {
        return view('fields-of-practice.edit', [
            'field_of_practice' => $fieldsOfPractice
        ]);
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
        $fieldsOfPractice->fill([
            'name' => $request->input('name')
        ]);

        try {
            $fieldsOfPractice->save();
            return Redirect::route('fields-of-practice.show', [
                'field_of_practice' => $fieldsOfPractice
            ])->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure updating field of practice! Please try again.')); 
        }
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
            return Redirect::route('fields-of-practice.index')->withSuccess(__('Field of practice deleted successfully!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure deleting field of practice! Please check if there are practices still connected to this field of practice and try again.')); 
        }
    }
}
