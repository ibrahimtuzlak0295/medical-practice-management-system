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
use Illuminate\Support\Facades\Redirect;
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
        return view('practices.index', [
            'practices' => Practice::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practices.create', [
            'fields_of_practice' => FieldsOfPractice::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Practice\StorePracticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePracticeRequest $request)
    {
        $practice = new Practice;

        $practice->fill([
            'name' =>  $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website')
        ]);

        if($request->hasFile('logo')) {
            $practice->logo = $request->logo->store('logos', [
                'disk' => 'public'
            ]);
        }

        try {
            $practice->save();
            $practice->fieldsOfPractice()->sync($request->input('fields_of_practice'));
            return Redirect::back()->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure saving a new practice! Please try again.')); 
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
        return view('practices.show', [
            'practice' => Practice::findOrFail($id),
            'fields_of_practice' => FieldsOfPractice::all()
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
        return view('practices.edit', [
            'practice' => Practice::findOrFail($id),
            'fields_of_practice' => FieldsOfPractice::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Practice\UpdatePracticeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePracticeRequest $request, $id)
    {
        $practice = Practice::findOrFail($id);

        $practice->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
        ]);

        if($request->hasFile('logo')) {
            $practice->logo = $request->logo->store('logos', [
                'disk' => 'public'
            ]);
        }

        try {
            $practice->save();
            $practice->fieldsOfPractice()->sync($request->input('fields_of_practice'));
            return Redirect::back()->withSuccess(__('Success!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure updating! Please try again.')); 
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
            Practice::findOrFail($id)->delete();
            return Redirect::route('practices.index')->withSuccess(__('Practice deleted successfully!'));
        } catch (Exception $e) {
            return Redirect::back()->withError(__('Failure deleting! Please check if there are employees or fields of practice still connected to this practice and try again.'));
        }
    }
}
