<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    //begin scherm als user me role verantwoordelijke inlogt
    public function show()
    {
        return view('adminpagina');
    }

    //wedstrijd  instellen
    public function game()
    {
        return view('adminpagina');
    }

    // lijst van alle verantwoordelijke?

    // wedstrijdverantwoordelijke instellen
    public function editVerantwoordelijke()
    {
        return view('adminpagina');
    }

    // aanmaken van een verantwoordelijke
    public function storeVerantwoordelijke()
    {
        return view('adminpagina');
    }


    //lijst van alle wedstrijd deelnemers
    public function showDeelnemer()
    {
        return view('deelnemerspagina');
    }

//edit  van alle wedstrijd deelnemers per id
    public function editDeelnemer()
    {
        return view('editdeelnemerspagina');
    }
}
