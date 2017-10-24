<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.home');
    }

    public function show()
    {
        // $winnaars = DB::table('winnaar')->where('user_id', '=', 'id' And 'qualified', 0);
        return view('home.home');
//             , compact('winnaars'));
    }

    public function store()
    {

        return view('home.inschrijving');
    }

}
