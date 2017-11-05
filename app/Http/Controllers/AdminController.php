<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    //begin scherm als user me role verantwoordelijke inlogt
    public function index()
    {
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if ($role[0]->role_id == 2) {
            return view('dashboard.home');
        }
    }
//
//    //wedstrijd  instellen
//    public function game()
//    {
//        return view('adminpagina');
//    }
//
//    // lijst van alle verantwoordelijke die alleen wordt getoont als user ne role id van 2 heeft
    public function show()
    {

        $userid = Auth::id();
        $role = User::where('id', $userid)->get();
        if ($role[0]->role_id == 2) {
            //  echo "de rol".$role;
            $adminList = User::all();
            //dd($adminList);
            return view('admin.show', compact('adminList'));
        }
    }
//    // wedstrijdverantwoordelijke instellen
    public function update(Request $request, $id)
    {
        $adminList = User::all();
        $activeAdmin = User::where('id', $id)->get();
        // dd($activeAdmin);
        if ($request->isMethod('POST')) {

            $activeAdmin->$request->input('name');
            $activeAdmin->$request->input('email');
            $activeAdmin->$request->input('role_id');
            $activeAdmin->save();
            Session::flash('success', 'Wedstrijd aangepast');
            return view('admin.show', compact('adminList'));
        } else {
            Session::flash('danger', 'Wedstrijd niet aangepast');
        }

        return view('admin.edit', compact('id'));

    }


}
