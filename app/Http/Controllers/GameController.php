<?php

namespace App\Http\Controllers;

use App\Http\Requests\WedstrijdRequest;
use App\User;
use App\Wedstrijd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function index()
    {
        if (Wedstrijd::all()) {
            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();
            // dd($actieve_wedstrijd->id);
        }

        $wedstrijd = Wedstrijd::find(1);
        //  $new = $actieve_wedstrijd->id;
//dd($wedstrijd);
        $wedstrijdID = Wedstrijd::first();
//dd( $wedstrijdID->id);
        return view("wedstrijd.wedstrijd", compact('actieve_wedstrijd', 'wedstrijdID'));

    }

    public function create(Request $request, WedstrijdRequest $wedstrijdRequest)
    {
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            if ($request->isMethod('POST')) {


                $wedstrijd = new Wedstrijd();

                $wedstrijd->name = $wedstrijdRequest->name;
                $wedstrijd->start_date = $wedstrijdRequest->start_date;
                $wedstrijd->end_date = $wedstrijdRequest->end_date;
                $wedstrijd->is_active = $wedstrijdRequest->is_active;
                $wedstrijd->save();
                Session::flash('success', 'Wedstrijd toegevoegd');

            }
            return view('wedstrijd.create');
        }
        return view('wedstrijd.create');
    }

    public function update(Request $request, WedstrijdRequest $wedstrijdRequest, $wedstrijdId)
    {

        if (Wedstrijd::all()) {
            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();
            // dd($actieve_wedstrijd->id);
        }
        $wedstrijdID = Wedstrijd::first();
        //  $wedstrijdId = Wedstrijd::first();
        //  $new = $actieve_wedstrijd->id;

        $wedstrijd = Wedstrijd::where('id', $wedstrijdId)->first();
//         dd($wedstrijd);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            if ($request->isMethod('POST')) {


                $wedstrijd->name = $wedstrijdRequest->name;
                $wedstrijd->start_date = $wedstrijdRequest->start_date;
                $wedstrijd->end_date = $wedstrijdRequest->end_date;
                $wedstrijd->is_active = $wedstrijdRequest->is_active;
                $wedstrijd->save();

                Session::flash('success', 'Wedstrijd aangepast');
                return view("wedstrijd.wedstrijd", compact('actieve_wedstrijd', 'wedstrijdID'));
            }
            Session::flash('danger', 'Wedstrijd niet aangepast');
            return view("wedstrijd.edit", compact('wedstrijdId'));
        }

        return view("wedstrijd.edit", compact('wedstrijdId'));
    }
}

