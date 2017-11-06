<?php

namespace App\Http\Controllers;

use App\Http\Requests\WedstrijdRequest;
use App\User;
use App\Wedstrijd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        if (Wedstrijd::all()) {
            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();
            //  dd($actieve_wedstrijd[0]->id);
        }

        $wedstrijd = Wedstrijd::find(1);
        //  $new = $actieve_wedstrijd->id;
//dd($wedstrijd);
        $wedstrijdID = Wedstrijd::first();
//dd( $wedstrijdID->id);
        return view("wedstrijd.wedstrijd", compact('actieve_wedstrijd'));

    }

    public function create(Request $request, WedstrijdRequest $wedstrijdRequest)
    {
        if (Wedstrijd::all()) {
            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();

        }
        // $wedstrijdID = Wedstrijd::first();
        $verantwoordelijke = User::where('role_id', 2)->get();

        //    dd($verantwoordelijke[0]->id);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            if ($request->isMethod('POST')) {


                $wedstrijd = new Wedstrijd();
                $wedstrijd->user_id = $verantwoordelijke[0]->id;
                $wedstrijd->name = $wedstrijdRequest->name;
                $wedstrijd->start_date = $wedstrijdRequest->start_date;
                $wedstrijd->end_date = $wedstrijdRequest->end_date;
                $wedstrijd->is_active = $wedstrijdRequest->is_active;
                $wedstrijd->save();
                $request->session()->flash('flash_message', 'Wedstrijd toegevoegd');
//                Session::flash('success', '');
                return redirect()->back();
            }
            $request->session()->flash('flash_message', 'error, probeer opnieuw');

        } else {
            $request->session()->flash('flash_message', 'error, u mag geen wedstrijd aanmaken');
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

        $wedstrijd = Wedstrijd::findOrFail($wedstrijdId);
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

                $request->session()->flash('flash_message', 'Wedstrijd aangepast');
                return redirect()->back();
            }
            $request->session()->flash('flash_message', 'Wedstrijd niet aangepast');

        }

        return view("wedstrijd.edit", compact('wedstrijdId'));
    }
}
