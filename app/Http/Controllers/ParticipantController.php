<?php

namespace App\Http\Controllers;

use App\Deelnemer;
use App\Email;
use App\Http\Requests\WedstrijdRequest;
use App\User;
use App\Winnaar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class ParticipantController extends Controller
{
    //

    public function index()
    {
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            $deelnemerslijst = Deelnemer::all();
            //  echo $deelnemerslijst[0]->id;
            return view('deelnemers.show')->with(compact('deelnemerslijst'));
        }
    }

    public function edit(Request $request, WedstrijdRequest $wedstrijdRequest, $id)
    {
        // $deelnemer = $request->$id;
        $deelnemer = Deelnemer::findOrFail($id);
        $deelnemerslijst = Deelnemer::all();
        $method = $request->method();
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            if ($method === 'POST') {
                try {
                    $deelnemer->firstname = $wedstrijdRequest->firstname;
                    $deelnemer->lastname = $wedstrijdRequest->lastname;
                    $deelnemer->email = $wedstrijdRequest->email;
                    $deelnemer->street = $wedstrijdRequest->street;
                    $deelnemer->streetnumber = $wedstrijdRequest->streetnumber;
                    $deelnemer->postcode = $wedstrijdRequest->postcode;
                    $deelnemer->qualified = 0;
                    $deelnemer->is_deleted = 0;
                    $deelnemer->question = $wedstrijdRequest->question;

                    $request->session()->flash('flash_message', 'Deelnemer werd aangepast');
                    return view('deelnemers.show')->with(compact('deelnemerslijst'));
                } catch (Exception $exception) {
                    $request->session()->flash('flash_message', 'Deelnemer fout tijdens toevoegen');
                    // echo $exception;
                    return view('deelnemers.edit', compact('deelnemer'));
                }
            }
            return view('deelnemers.edit', compact('deelnemer'));
        }
    }


    public function DownloadExcel()
    {
        Excel::create('deelnemers', function ($excel) {
            $excel->sheet('Deelnemers', function ($list) {
                $list->fromArray(Deelnemer::all(), null, 'A4', false, false);
            });
        })
            ->download('xls');
    }

    public function SendMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers], function ($message) {
            $emailVerantwoordelijke = Email::with('user')->where('user_id', 'id')->get();
            dd($emailVerantwoordelijke);
//            foreach ($emailVerantwoordelijke as $m) {
//                $message->to($m->email)->subject('Deelnemerslijst');
//            }
            $message->to($emailVerantwoordelijke->email)->subject('Deelnemerslijst');
        });
        Session::flash("success", ("Deelnemerslijst naar e-mailmanagers verstuurd!"));
        return redirect()->back();
    }


    public function SendAutoMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('participants.participants', ['deelnemerslijst' => $deelnemers, 'errors' => []], function ($message) {

            $emailVerantwoordelijke = Email::all();
            foreach ($emailVerantwoordelijke as $m) {
                $message->to($m->email)->subject('Deelnemerslijst');
            }


        });
        return;
    }

    public function SendWinningMail()
    {
        Mail::send('mail.email', [], function ($message) {
            $winnaar = Winnaar::with('deelnemer')->where('id', '=', 'deelnemer_id')->take(1)->get()->first();
            $message->to($winnaar->email)->subject('Proficiat u heeft 5 meter bier gewonnen!');
        });
        return;
    }

}
