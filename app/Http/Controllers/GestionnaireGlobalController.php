<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionnaireGlobalController extends Controller
{
    public function index(){
        return view('Gestionnaire_Global.dashboard');
    }
}
