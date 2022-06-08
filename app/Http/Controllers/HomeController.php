<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SnProduk;
use App\User;
use App\RiwayatSN;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hitScan = RiwayatSN::count();
        $hitUser = User::count();
        $hitSn = SnProduk::count();
        $hitModel = SnProduk::where('model')->count();

        return view('home',compact('hitScan','hitUser','hitSn','hitModel'));
    }

    
}
