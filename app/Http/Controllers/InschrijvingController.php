<?php

namespace App\Http\Controllers;
use App\Deelnemer;
use App\Http\Requests\InschrijvingRequest;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;


class InschrijvingController extends Controller
{
    //geen auth nodig gezien iedereen deze pagina kan bezoeken


    public function index()
    {
        $wedstrijdId = "1";
        // DB::table('wedstrijd')->where('is_active','=', '1');
        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }

    public function store(Request $request, InschrijvingRequest $inschrijfrequest)
    {
        //checke of de method post is
        $method = $request->method();
        if ($request->isMethod('post')) {
            $deelnemer = new Deelnemer();
            $wedstrijdId = $request->input('wedstrijd_id');
            try {
                // $decrypted = decrypt($wedstrijdId);
                //$deelnemer->wedstrijd_id = Crypt::decrypt($wedstrijdId);
                $deelnemer->wedstrijd_id = decrypt($wedstrijdId);
                $deelnemer->firstname = $inschrijfrequest->firstname;
                $deelnemer->lastname = $inschrijfrequest->lastname;
                $deelnemer->email = $inschrijfrequest->email;
                $deelnemer->street = $inschrijfrequest->street;
                $deelnemer->streetnumber = $inschrijfrequest->streetnumber;
                $deelnemer->postcode = $inschrijfrequest->postcode;
                $deelnemer->disqualified = 0;
                $deelnemer->is_deleted = 0;
                $deelnemer->question = $inschrijfrequest->question;
                $deelnemer->ip = $inschrijfrequest->ip;
                return view('inschrijving.inschrijving');
            } catch (DecryptException $e) {
                //

            }

        }

    }
}
