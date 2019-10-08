<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Practice;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Practice::paginate(10);
    }
}
