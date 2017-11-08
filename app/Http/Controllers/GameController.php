<?php

namespace App\Http\Controllers;
use App\Http\Requests\WedstrijdRequest;
use App\User;
use App\Wedstrijd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class GameController extends Controller
{
    public function index()
    {
        if (Wedstrijd::all()) {
            $actieve_wedstrijd = Wedstrijd::where('is_active', 1)->get();
            //   dd($actieve_wedstrijd);
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
        $i = 0;
        $date = Carbon::now();
        // $wedstrijdID = Wedstrijd::first();
        $verantwoordelijke = User::where('role_id', 2)->get();

        //    dd($verantwoordelijke[0]->id);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            if ($request->isMethod('POST')) {

                try {
                    $wedstrijd = new Wedstrijd();
                    $wedstrijd->user_id = $verantwoordelijke[0]->id;
                    $wedstrijd->name = $wedstrijdRequest->name;
                    $wedstrijdNaam = $wedstrijdRequest->name;
                    $wedstrijd->start_date = $wedstrijdRequest->start_date;
                    $wedstrijd->end_date = $wedstrijdRequest->end_date;
                    $volgendeWedstrijd = $wedstrijdRequest->end_date;
                    $wedstrijd->is_active = $wedstrijdRequest->is_active;
                    $wedstrijd->save();
                    for ($i; $i < 3; $i++) {
                        $wedstrijd = new Wedstrijd();
                        $wedstrijd->user_id = $verantwoordelijke[0]->id;
                        $wedstrijd->name = $wedstrijdNaam . $i;
                        $wedstrijd->start_date = $volgendeWedstrijd;
                        $volgendeWedstrijd = date('Y-m-d', strtotime($volgendeWedstrijd . ' + ' . $wedstrijdRequest->duur . ' days'));
                        $wedstrijd->end_date = $volgendeWedstrijd;
                        $wedstrijd->is_active = 0;
                        $wedstrijd->save();

                    }






                    $request->session()->flash('flash_message', 'Wedstrijd toegevoegd');
//                Session::flash('success', '');
                    return redirect()->back();
                } catch (\Exception $ex) {
                    $request->session()->flash('flash_message', 'error, probeer opnieuw');
                }

            }


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
                try {
                    $wedstrijd->name = $wedstrijdRequest->name;
                    $wedstrijd->start_date = $wedstrijdRequest->start_date;
                    $wedstrijd->end_date = $wedstrijdRequest->end_date;
                    $wedstrijd->is_active = $wedstrijdRequest->is_active;
                    $wedstrijd->save();

                    $request->session()->flash('flash_message', 'Wedstrijd aangepast');
                    return redirect()->back();
                } catch (Exception $ex) {
                    $request->session()->flash('flash_message', 'Wedstrijd niet aangepast');

                }


            }

        }

        return view("wedstrijd.edit", compact('wedstrijdId'));
    }
}

