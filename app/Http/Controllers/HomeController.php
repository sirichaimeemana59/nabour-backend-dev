<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**rootAdminHome
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('redirect-user');
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

    public function login()
    {
        return view('auth.login');
    }
}
