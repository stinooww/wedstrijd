<?php


namespace App\Http\Controllers;

use App\winnaar;

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
        $winnaars = winnaar::with('deelnemer')->where('disqualified', 0)->get();
        return view('home.home', compact('winnaars'));
    }


}
