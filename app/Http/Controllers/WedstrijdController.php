<?php

namespace App\Http\Controllers;

use App\Http\Requests\WedstrijdRequest;
use App\User;
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
        return view("wedstrijd.wedstrijd", compact(['actieve_wedstrijd', 'wedstrijdId']));

    }

    public function create(Request $request, WedstrijdRequest $wedstrijdRequest)
    {
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 1) {
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
    }

    public function edit(Request $request, WedstrijdRequest $wedstrijdRequest, $id)
    {

        $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();

        //  $new = $actieve_wedstrijd->id;

        $wedstrijd = Wedstrijd::find(1);
        if ($request->isMethod('POST')) {


            $wedstrijd->name = $wedstrijdRequest->name;
            $wedstrijd->start_date = $wedstrijdRequest->start_date;
            $wedstrijd->end_date = $wedstrijdRequest->end_date;
            $wedstrijd->is_active = $wedstrijdRequest->is_active;
            $wedstrijd->save();
            Session::flash('success', 'Wedstrijd aangepast');
        }
        return view("wedstrijd.edit", compact(['actieve_wedstrijd', 'wedstrijdId']));



    }
}

