<?php

namespace App\Http\Controllers;
use App\Deelnemer;
use App\wedstrijd;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;


class RegisterController extends Controller
{
    //geen auth nodig gezien iedereen deze pagina kan bezoeken


    public function index()
    {

        $wedstrijdId = wedstrijd::where('is_active', 1)->get();
//dd($wedstrijdId);
        $wedstrijdId = $wedstrijdId[0]->id;
        //  dd($wedstrijdId);

//        $gameID = $wedstrijdId[0]->id;
        // $encryptedGameId = encrypt($wedstrijdId[0]->id);
        //  echo $encryptedGameId;
        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }

    //store function controleert of ip uniek is en controleert vervolgens via request de input alvorens deelnemr aante make
    public function store(Request $request, Session $session)
    {
        $wedstrijdId = wedstrijd::where('is_active', 1)->get();
        //    dd($wedstrijdId);
        $gameID = $wedstrijdId[0]->id;
        $rules = [

            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'streetname' => 'string|min:2|max:255',
            'streetnumber' => 'integer|max:9999',
            'postcode' => 'integer|max:9999',
            'question' => 'required|integer',
            'deelnemerIP' => 'ip|unique'
        ];
        $deelnemerIP = \Request::ip();
        //checke of de method post is
        $method = $request->method();
        // dd( $request->input('streetname'));
        //   dd($deelnemerIP);
        if ($request->isMethod('POST')) {
            if (!Deelnemer::where('ip', '=', $deelnemerIP)->exists()) {
                $valid = $this->validate($request, $rules);
                if ($valid) {
                    try {
                        $deelnemer = new Deelnemer();


                        //$decrypted = Crypt::decrypt($wedstrijdID);
                        //$deelnemer->wedstrijd_id = Crypt::decrypt($wedstrijdId);

                        $deelnemer->wedstrijd_id = $gameID;
                        $deelnemer->firstname = $request->first_name;
                        $deelnemer->lastname = $request->last_name;
                        $deelnemer->email = $request->email;
                        $deelnemer->streetname = $request->streetname;
                        $deelnemer->streetnumber = $request->streetnumber;
                        $deelnemer->postcode = $request->postcode;
                        $deelnemer->qualified = 0;
                        $deelnemer->is_deleted = 0;
                        $deelnemer->question = $request->question;
                        $deelnemer->ip = $deelnemerIP;
                        $deelnemer->save();
                        $request->session()->flash('flash_message', 'De inzending is gelukt');
                    } catch (Exception $e) {
                        //


                        $request->session()->flash('flash_message', 'Fout tijdens het inserten');
                        // return view('inschrijving.inschrijving', compact('encryptedGameId'));
                    }
                }
            } else {
                $request->session()->flash('flash_message', 'U  hebt al meegedaan');
                // return view('inschrijving.inschrijving', compact('encryptedGameId'));

            }

        }
        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }
}
