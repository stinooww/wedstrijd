<?php

namespace App\Http\Controllers;

use App\Deelnemer;
use App\Http\Requests\InschrijvingRequest;
use Illuminate\Http\Request;

class InschrijvingController extends Controller
{
    //


    public function index()
    {
        $wedstrijdId = "1";
        // DB::table('wedstrijd')->where('is_active','=', '1');
        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }

    public function store(InschrijvingRequest $inschrijfrequest, Request $request)
    {
        $deelnemer = new Deelnemer();
        $deelnemer->wedstrijd_id = Crypt::decrypt(Input::get('wedstrijd_id'));
        $deelnemer->firstname = $inschrijfrequest->firstname;
        $deelnemer->lastname = $inschrijfrequest->lastname;
        $deelnemer->email = $inschrijfrequest->email;
        $deelnemer->street = $inschrijfrequest->street;
        $deelnemer->streetnumber = $inschrijfrequest->streetnumber;
        $deelnemer->postcode = $inschrijfrequest->postcode;
        $deelnemer->disqualified = 0;
        $deelnemer->is_deleted = 0;
        $deelnemer->question = $inschrijfrequest->question;
        $deelnemer->ip = $request->ip();
        return view('inschrijving.inschrijving');
    }
}
