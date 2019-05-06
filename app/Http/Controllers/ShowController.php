<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index() {
        return view('index');
    }
    
    public function nsw() {
        return view('state.nsw');
    }
    
    public function vic() {
        return view('state.vic');
    }
    public function qld() {
        return view('state.qld');
    }
    
    public function sa() {
        return view('state.sa');
    }
    public function wa() {
        return view('state.wa');
    }
    
    public function tas() {
        return view('state.tas');
    }
    
}
