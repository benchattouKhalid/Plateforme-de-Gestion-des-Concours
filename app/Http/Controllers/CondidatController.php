<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CondidatController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); // Get the logged-in candidate
        $concours = $user->concours; // Get the contest they applied for

        return view('candidat.dashboard', compact('concours', 'user'));
    }
}
