<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Deelnemer;
use App\EmailManager;
use App\Http\Requests\WedstrijdRequest;
use App\Participant;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class DeelnemerController extends Controller
{
    //

    public function index()
    {
        $deelnemerslijst = Deelnemer::all();
        return view('deelnemers.show', compact('deelnemerslijst'));
    }

    public function edit(Request $request, WedstrijdRequest $wedstrijdRequest, $id)
    {
        $deelnemer = Deelnemer::findOrFail($id);

        $method = $request->method();
        if ($method === 'POST') {


            Session::flash('success', 'Deelnemer werd aangepast');

        }
        return view('deelnemers.show');
    }


    public function DownloadExcel()
    {
        Excel::create('participants', function ($excel) {
            $excel->sheet('Participants', function ($list) {
                $list->fromArray(Participant::all(), null, 'A4', false, false);
            });
        })
            ->download('xls');
    }

    public function SendMail()
    {
        $participants = Participant::all();
        Mail::send('participants.participants', ['parts' => $participants], function ($message) {
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
        $participants = Participant::all();
        Mail::send('participants.participants', ['parts' => $participants, 'errors' => []], function ($message) {
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
            $winning_participant = Period::whereNotNull('winner_email')
                ->take(1)
                ->get()
                ->first();
            $message->to($winning_participant->winner_email)->subject('Proficiat u heeft gewonnen!');
        });
        return;
    }

}
