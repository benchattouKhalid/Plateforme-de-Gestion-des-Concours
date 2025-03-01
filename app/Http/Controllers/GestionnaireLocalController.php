<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionnaireLocalController extends Controller
{
    public function index(){
        return view('Gestionnaire_Local.dashboard');
    }
}
