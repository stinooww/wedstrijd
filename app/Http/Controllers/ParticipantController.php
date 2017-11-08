<?php

namespace App\Http\Controllers;

use App\Deelnemer;
use App\Email;
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
        if ($userid) {
            $deelnemerslijst = Deelnemer::all();
            //  echo $deelnemerslijst[0]->id;
            return view('deelnemers.show')->with(compact('deelnemerslijst'));
        }
    }

    public function edit(Request $request, $id)
    {
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

        // $deelnemer = $request->$id;
        $deelnemer = Deelnemer::findOrFail($id);
        $deelnemerslijst = Deelnemer::all();
        $method = $request->method();
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($userid) {
            if ($method === 'POST') {
                $valid = $this->validate($request, $rules);
                if ($valid) {
                    try {
                        $deelnemer->firstname = $request->first_name;
                        $deelnemer->lastname = $request->last_name;
                        $deelnemer->email = $request->email;
                        $deelnemer->streetname = $request->streetname;
                        $deelnemer->streetnumber = $request->streetnumber;
                        $deelnemer->postcode = $request->postcode;
                        $deelnemer->qualified = $request->input('qualified');
                        $deelnemer->is_deleted = $request->input('is_deleted');
                        $deelnemer->question = $request->question;
                        $deelnemer->save();
                        $request->session()->flash('flash_message', 'Deelnemer werd aangepast');
                        return redirect()->back();
                    } catch (Exception $exception) {
                        $request->session()->flash('flash_message', 'fout tijdens het toevoegen');
                        // echo $exception;

                    }
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
    public function SendMail(Request $request)
    {
        if (Auth::id()) {
            $actieveAdmin = User::where('role_id', 1)->get()->first();
            // $emailVerantwoordelijke = Email::where('wedstrijd_id', '=', 3)->get();
            // dd($emailVerantwoordelijke[0]->name);

            // dd($actieveAdmin);
            if ($actieveAdmin) {
                $deelnemers = Deelnemer::all();
                Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers], function ($message) {
                    $actieveAdmin = User::where('role_id', 1)->get();
                    $activeAdminEmail = $actieveAdmin[0]->email;
                    // dd($activeAdminEmail);
                    //    dd($activeAdminId);
                    //     $emailVerantwoordelijke = Email::with('users')->where('user_id', '=', $activeAdminId)->get();

                    //   dd($emailVerantwoordelijke[0]->email);

                    $message->to($activeAdminEmail)->subject('Deelnemerslijst');
                });
                $request->session()->flash('flash_message', 'Mail Send Successfully');

            } else {
                $request->session()->flash('flash_message', 'Er bevond zich geen wedstrijdverantwoordelijke');
            }
        }
        return redirect()->back();
    }


    public function SendAutoMail()
    {
        $deelnemers = Deelnemer::all();
        Mail::send('deelnemers.show', ['deelnemerslijst' => $deelnemers], function ($message) {
            $emailVerantwoordelijke = User::where('role_id', 1)->get()->first();
            $message->to($emailVerantwoordelijke->email)->subject('Deelnemerslijst');

        });
        return;
    }

    public function SendWinningMail()
    {

        //  dd($userEmail[0]->email);
        Mail::send('mail.email', [], function ($message) {
            $winnaarID = DB::table('winnaar')->orderByRaw('created_at', 'desc')->get()->last();
            $winnaarID = $winnaarID->deelnemer_id;

//dd($winnaarID);
            $userEmail = Deelnemer::where('id', '=', $winnaarID)->get();
            //  $winnaar = Winnaar::with('deelnemer')->where('id', '=', 'deelnemer_id')->take(1)->get()->first();
            //  dd($userEmail);
            $message->to($userEmail[0]->email)->subject('Proficiat u heeft 5 meter bier gewonnen!');
        });
        return;
    }

}
