<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

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
        if (Auth::id()) {
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
        if (Auth::id()) {
            //  echo "de rol".$role;
            $adminList = User::all();
            //dd($adminList);
            return view('admin.show', compact('adminList'));
        }
    }
//    // wedstrijdverantwoordelijke instellen
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ];
        $admin = User::findOrFail($id);
        $adminList = User::all();
        $activeAdmin = User::where('id', $id)->get();
        // dd($activeAdmin);
        $userid = Auth::id();
        $role = User::where('id', '=', $userid)->get();
        if (Auth::id()) {
            if ($request->isMethod('POST')) {
                $valid = $this->validate($request, $rules);
                if ($valid) {
                    try {
                        $admin->name = $request->name;
                        $admin->email = $request->email;
                        $admin->role_id = $request->role_id;
                        $admin->save();

                        $request->session()->flash('flash_message', 'admin aangepast');
                        return redirect()->back();
                    } catch (Exception $ex) {
                        $request->session()->flash('flash_message', 'admin niet aangepast');
                    }
                }

                // return view('admin.show', compact('adminList'));
            }
        }

        return view('admin.edit', compact('admin'));

    }


}
