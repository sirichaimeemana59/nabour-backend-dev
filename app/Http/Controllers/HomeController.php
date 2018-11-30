<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**rootAdminHome
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function rootAdminHome () {
        return view('home');
    }

    public function nabourAdminHome () {
        return view('home');
    }

    public function SalesHome () {
        return view('home');
    }
}
