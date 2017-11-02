<?php

namespace App\Http\Controllers;
use App\Deelnemer;
use App\Http\Requests\InschrijvingRequest;
use App\wedstrijd;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class InschrijvingController extends Controller
{
    //geen auth nodig gezien iedereen deze pagina kan bezoeken


    public function index()
    {

        $wedstrijdId = wedstrijd::where('is_active', 0)->get();

        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }

    public function store(Request $request, InschrijvingRequest $inschrijfrequest, Session $session)
    {
        $wedstrijdID = $request->input('wedstrijdId');
        $deelnemerIP = \Request::ip();
        //checke of de method post is
        $method = $request->method();

        if (!Deelnemer::where('ip', '=', $deelnemerIP)->exists()) {

            try {
                $deelnemer = new Deelnemer();


                $decrypted = Crypt::decrypt($wedstrijdID);
                //$deelnemer->wedstrijd_id = Crypt::decrypt($wedstrijdId);

                $deelnemer->wedstrijd_id = $decrypted;
                $deelnemer->firstname = $inschrijfrequest->firstname;
                $deelnemer->lastname = $inschrijfrequest->lastname;
                $deelnemer->email = $inschrijfrequest->email;
                $deelnemer->street = $inschrijfrequest->street;
                $deelnemer->streetnumber = $inschrijfrequest->streetnumber;
                $deelnemer->postcode = $inschrijfrequest->postcode;
                $deelnemer->qualified = 0;
                $deelnemer->is_deleted = 0;
                $deelnemer->question = $inschrijfrequest->question;
                $deelnemer->ip = $deelnemerIP;
                $deelnemer->save();
                return view('inschrijving.bevestiging');
            } catch (DecryptException $e) {
                //

                $request->session()->flash('flash_message', 'Fout tijdens het decrypteren');

            }

        } else {

            $request->session()->flash('flash_message', 'U  hebt al meegedaan');
        }

    }
}
