<?php

namespace App\Http\Controllers;
use App\Persons;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(){
        return response()->json(Persons::all(),200);
    }
}
