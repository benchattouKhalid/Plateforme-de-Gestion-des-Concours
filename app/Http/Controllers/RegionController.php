<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ville;

class RegionController extends Controller
{
    public function getVilles($regionId)
    {
        $villes = Ville::where('region_id', $regionId)->get(['id', 'name']);
        return response()->json($villes);
    }

}
