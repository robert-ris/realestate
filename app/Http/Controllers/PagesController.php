<?php

namespace App\Http\Controllers;

use App\Properties;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $properties = Properties::orderBy('created_at', 'desc')->paginate(1);
        return view('properties.index')->with('properties', $properties);
    }
}
