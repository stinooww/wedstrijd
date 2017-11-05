<?php

namespace App\Http\Controllers;


use App\Deelnemer;
use App\EmailManager;
use App\Http\Requests\WedstrijdRequest;
use App\Winnaar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class DeelnemerController extends Controller
{
    //

    public function index()
    {
        $deelnemerslijst = Deelnemer::all();
        //  echo $deelnemerslijst[0]->id;
        return view('deelnemers.show')->with(compact('deelnemerslijst'));
    }

    public function edit(Request $request, WedstrijdRequest $wedstrijdRequest, $id)
    {
        // $deelnemer = $request->$id;
        $deelnemer = Deelnemer::findOrFail($id);

        $method = $request->method();
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

                Session::flash('success', 'Deelnemer werd aangepast');
            } catch (Exception $exception) {
                Session::flash('danger', 'Deelnemer fout' . $exception);
            }
        }
        return view('deelnemers.show');
    }


    public function DownloadExcel()
    {
        Excel::create('deelnemers', function ($excel) {
            $excel->sheet('Deelnemers', function ($list) {
                $list->fromArray(Participant::all(), null, 'A4', false, false);
            });
        })
            ->download('xls');
    }

    public function SendMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers], function ($message) {
            $emailmanagers = EmailManager::all();
            foreach ($emailmanagers as $m) {
                $message->to($m->email)->subject('Deelnemerslijst');
            }
        });
        Session::flash("success", ("Deelnemerslijst naar e-mailmanagers verstuurd!"));
        return redirect()->back();
    }

    public function SendAutoMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('participants.participants', ['deelnemerslijst' => $deelnemers, 'errors' => []], function ($message) {
            $emailmanagers = EmailManager::all();
            foreach ($emailmanagers as $m) {
                $message->to($m->email)->subject('Deelnemerslijst');
            }
        });
        return;
    }

    public function SendWinningMail()
    {
        Mail::send('mail.winningmail', [], function ($message) {
            $winnendeDeelnemer = Winnaar::with('deelnemer')->where('id', '=', 'deelnemer_id')->take(1)->get()->first();
            $message->to($winnendeDeelnemer->email)->subject('Proficiat u heeft gewonnen!');
        });
        return;
    }

}
