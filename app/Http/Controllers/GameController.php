<?php

namespace App\Http\Controllers;
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
        $is_valid = false;
        $wedstrijd = Wedstrijd::where('is_active', '=', '1')->exists();

        if ($wedstrijd === true) {

        }

        $actieve_wedstrijd = Wedstrijd::where('is_active', '1')->get();

        return view("wedstrijd.wedstrijd", compact('actieve_wedstrijd', 'wedstrijd'));

    }

    public function create(Request $request)
    {
        $rules = [
            //
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'periode' => 'integer|min:4',
            'is_active' => 'boolean',
        ];
        $i = 1;

        $date = Carbon::now();
        // $wedstrijdID = Wedstrijd::first();
        $verantwoordelijke = User::where('role_id', 1)->get();

        //    dd($verantwoordelijke[0]->id);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        // dd($verantwoordelijke);

        if ($role[0]->role_id == 1) {
            if ($request->isMethod('POST')) {
                $valid = $this->validate($request,$rules);
                if ($valid){
                    try {
                        $wedstrijd = new Wedstrijd();
                        $wedstrijd->user_id = $verantwoordelijke[0]->id;
                        $wedstrijd->name = $request->name;
                        $wedstrijdNaam = $request->name;
                        $wedstrijd->periode = $request->periode;
                        $wedstrijd->start_date = $request->start_date;
                        $wedstrijd->end_date = $request->end_date;
                        $volgendeWedstrijd = $request->end_date;
                        $wedstrijd->is_active = $request->is_active;
                        $wedstrijd->save();
                        for ($i; $i < 4; $i++) {
                            $wedstrijd = new Wedstrijd();
                            $wedstrijd->user_id = $verantwoordelijke[0]->id;
                            $wedstrijd->name = $wedstrijdNaam . $i;
                            $wedstrijd->start_date = $volgendeWedstrijd;
                            $volgendeWedstrijd = date('Y-m-d', strtotime($volgendeWedstrijd . ' + ' . $request->periode . ' days'));
                            $wedstrijd->end_date = $volgendeWedstrijd;
                            $wedstrijd->is_active = 0;
                            $wedstrijd->save();

                        }
                        $request->session()->flash('flash_message', 'Wedstrijd toegevoegd');
    //                Session::flash('success', '');
                        return redirect()->back();
                    } catch (\Exception $ex) {
                        $request->session()->flash('flash_message', 'error, kijk alle velden goed na'.$ex);
                    }
                }

            }


        } else {
            $request->session()->flash('flash_message', 'error, u mag geen wedstrijd aanmaken');
            return redirect()->back();
        }

        return view('wedstrijd.create');
    }

    public function update(Request $request, $wedstrijdId)
    {
        $rules = [
            //
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'periode' => 'integer|min:4',
            'is_active' => 'boolean',
        ];

        $wedstrijdID = Wedstrijd::first();
        //  $wedstrijdId = Wedstrijd::first();
        //  $new = $actieve_wedstrijd->id;

        $wedstrijd = Wedstrijd::findOrFail($wedstrijdId);
//         dd($wedstrijd);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 1) {
            if ($request->isMethod('POST')) {
                $valid = $this->validate($request, $rules);
                if ($valid) {
                    try {
                        $wedstrijd->name = $request->name;
                        $wedstrijd->periode = $request->periode;
                        $wedstrijd->start_date = $request->start_date;
                        $wedstrijd->end_date = $request->end_date;
                        $wedstrijd->is_active = $request->is_active;
                        $wedstrijd->save();

                        $request->session()->flash('flash_message', 'Wedstrijd aangepast');
                        return redirect()->back();
                    } catch (Exception $ex) {
                        $request->session()->flash('flash_message', 'Wedstrijd niet aangepast');

                    }
                }

            }

        } else {
            $request->session()->flash('flash_message', 'error, u mag geen wedstrijd aanpassen');
        }

        return view("wedstrijd.edit", compact('wedstrijdId'));
    }
}

