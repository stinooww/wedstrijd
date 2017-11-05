<?php

namespace App\Http\Controllers;
use App\Deelnemer;
use App\Http\Requests\InschrijvingRequest;
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
    public function store(Request $request, InschrijvingRequest $inschrijfrequest, Session $session)
    {
        $wedstrijdId = wedstrijd::where('is_active', 1)->get();
        //    dd($wedstrijdId);
        $gameID = $wedstrijdId[0]->id;
//        $gameID = $wedstrijdId[0]->id;
        // $encryptedGameId = Crypt::encrypt($wedstrijdId[0]->id);

        // $wedstrijdID = $request->input('encryptedGameId');
        $deelnemerIP = \Request::ip();
        //checke of de method post is
        $method = $request->method();
        // dd( $request->input('streetname'));
        //   dd($deelnemerIP);
        if ($request->isMethod('POST')) {
            if (!Deelnemer::where('ip', '=', $deelnemerIP)->exists()) {

                try {
                    $deelnemer = new Deelnemer();


                    //$decrypted = Crypt::decrypt($wedstrijdID);
                    //$deelnemer->wedstrijd_id = Crypt::decrypt($wedstrijdId);

                    $deelnemer->wedstrijd_id = $gameID;
                    $deelnemer->firstname = $inschrijfrequest->firstname;
                    $deelnemer->lastname = $inschrijfrequest->lastname;
                    $deelnemer->email = $inschrijfrequest->email;
                    $deelnemer->streetname = $inschrijfrequest->streetname;
                    $deelnemer->streetnumber = $inschrijfrequest->streetnumber;
                    $deelnemer->postcode = $inschrijfrequest->postcode;
                    $deelnemer->qualified = 0;
                    $deelnemer->is_deleted = 0;
                    $deelnemer->question = $inschrijfrequest->question;
                    $deelnemer->ip = $deelnemerIP;
                    $deelnemer->save();
                    return view('inschrijving.bevestiging');
                } catch (Exception $e) {
                    //


                    Session::flash('flash_message', 'Fout tijdens het decrypteren');
                    return view('inschrijving.inschrijving', compact('encryptedGameId'));
                }

            } else {
                $request->session()->flash('flash_message', 'U  hebt al meegedaan');
                return view('inschrijving.inschrijving', compact('encryptedGameId'));

            }

        }
        return view('inschrijving.inschrijving', compact('wedstrijdId'));
    }
}
