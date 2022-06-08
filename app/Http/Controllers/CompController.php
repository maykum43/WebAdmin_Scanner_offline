<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompController extends Controller
{
    public function privacy()
    {
        return view('comp/privacy');
    }
    public function terms()
    {
        return view('comp/terms');
    }
}
