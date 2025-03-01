<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Region;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    // Render the statistics form with regions
    public function index()
    {

        $regions = Region::all(); // Fetch all regions for the dropdown
        return view('admin.statistique', compact('regions'));
    }

    // Handle form submission and filter candidates by region
    public function filterByRegion(Request $request)
    {
        $request->validate([
            'region' => 'required|string', // Validate the selected region
        ]);

        $regionName = $request->input('region');
        $candidats = Candidat::where('region_name', $regionName)->get(); // Filter candidates by region

        $regions = Region::all(); // Fetch regions again for the dropdown
        return view('admin.statistique', compact('regions', 'candidats', 'regionName'));
    }
}
