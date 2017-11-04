<?php

namespace App\Http\Controllers;

use App\Http\Requests\WedstrijdRequest;
use App\Wedstrijd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WedstrijdController extends Controller
{
    public function index()
    {

            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();

        //  $new = $actieve_wedstrijd->id;


        $wedstrijdId = Wedstrijd::first();
//echo $wedstrijdId;
        return view("wedstrijd.wedstrijd", compact('actieve_wedstrijd', 'wedstrijdId'));

    }

    public function create(Request $request, WedstrijdRequest $wedstrijdRequest)
    {
        if ($request->isMethod('POST')) {


            $wedstrijd = new Wedstrijd();

            $wedstrijd->name = $wedstrijdRequest->name;
            $wedstrijd->start_date = $wedstrijdRequest->start_date;
            $wedstrijd->end_date = $wedstrijdRequest->end_date;
            $wedstrijd->is_active = $wedstrijdRequest->is_active;
            $wedstrijd->save();
            Session::flash('success', 'Wedstrijd toegevoegd');

        }
        return view('wedstrijd.wedstrijd');
    }

    public function edit(Request $request, WedstrijdRequest $wedstrijdRequest, $id)
    {
        if ($request->isMethod('POST')) {

            $wedstrijd = Wedstrijd::findOrFail($id);
            $wedstrijd->name = $wedstrijdRequest->name;
            $wedstrijd->start_date = $wedstrijdRequest->start_date;
            $wedstrijd->end_date = $wedstrijdRequest->end_date;
            $wedstrijd->is_active = $wedstrijdRequest->is_active;
            $wedstrijd->save();
            Session::flash('success', 'Wedstrijd aangepast');
        }
        return view('wedstrijd.wedstrijd');


    }
}

