<?php

namespace App\Http\Controllers;

use App\Deelnemer;
use App\Email;
use App\Http\Requests\InschrijvingRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function edit(Request $request, InschrijvingRequest $RegisterReq, $id)
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
                    $deelnemer->firstname = $RegisterReq->firstname;
                    $deelnemer->lastname = $RegisterReq->lastname;
                    $deelnemer->email = $RegisterReq->email;
                    $deelnemer->streetname = $RegisterReq->streetname;
                    $deelnemer->streetnumber = $RegisterReq->streetnumber;
                    $deelnemer->postcode = $RegisterReq->postcode;
                    $deelnemer->qualified = $request->input('qualified');
                    $deelnemer->is_deleted = $request->input('is_deleted');
                    $deelnemer->question = $RegisterReq->question;
                    $deelnemer->save();
                    $request->session()->flash('flash_message', 'Deelnemer werd aangepast');
                    return redirect()->back();
                } catch (Exception $exception) {
                    $request->session()->flash('flash_message', 'fout tijdens het toevoegen');
                    // echo $exception;

                }
            }
            return view('deelnemers.edit', compact('deelnemer'));
        }
    }

//download excel, installeert een xls file op uw pc met lijst van alle deelnemers
    public function DownloadExcel()
    {
        Excel::create('deelnemers', function ($excel) {
            $excel->sheet('Deelnemers', function ($list) {
                $list->fromArray(Deelnemer::all(), null, 'A4', false, false);
            });
        })
            ->download('xls');
    }

//verstuurd een email naar emailverantwoordelijke met list van alle deelnemers
    public function SendMail()
    {
        $actieveAdmin = User::where('role_id', 1)->get();
        // $emailVerantwoordelijke = Email::where('wedstrijd_id', '=', 3)->get();
        // dd($emailVerantwoordelijke[0]->name);

        // dd(env('DB_DATABASE'));
        if ()
        $deelnemers = Deelnemer::all();
        Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers], function ($message) {
            $actieveAdmin = User::where('role_id', 1)->get();
            $activeAdminEmail = $actieveAdmin[0]->email;
            dd($activeAdminEmail);
            //    dd($activeAdminId);
            //     $emailVerantwoordelijke = Email::with('users')->where('user_id', '=', $activeAdminId)->get();

            //   dd($emailVerantwoordelijke[0]->email);

            $message->to($activeAdminEmail)->subject('Deelnemerslijst');
        });
        dd('Mail Send Successfully');
        // Session::flash("success", ("Deelnemerslijst naar e-mailmanagers verstuurd!"));
        return redirect()->back();
    }


    public function SendAutoMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers, 'errors' => []], function ($message) {


            $emailVerantwoordelijke = User::where('role_id', 1)->get();
            $message->to($emailVerantwoordelijke[0]->email)->subject('Deelnemerslijst');

        });
        return;
    }

    public function SendWinningMail()
    {

        //  dd($userEmail[0]->email);
        Mail::send('mail.email', [], function ($message) {
            $winnaarID = DB::table('winnaar')->orderByRaw('created_at', 'desc')->get();
            // dd();
            $winnaarID = $winnaarID[0]->id;

            $userEmail = User::where('id', $winnaarID)->get();
            //  $winnaar = Winnaar::with('deelnemer')->where('id', '=', 'deelnemer_id')->take(1)->get()->first();

            $message->to($userEmail[0]->email)->subject('Proficiat u heeft 5 meter bier gewonnen!');
        });
        return;
    }

}
