<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Concours;
use App\Models\Region;
use App\Models\Ville;

class ConcoursController extends Controller
{
    // Show all concours
    public function index()
{
    // Fetch all regions

    $concours = Concours::where('status', 'confirmed')->get();
    return view('concours.index', compact('concours'));
}


    // Show application form for a specific concours
    public function showApplicationForm($id)
    {
        $concours = Concours::findOrFail($id);
        $regions = Region::all();
        return view('concours.apply', compact('concours', 'regions'), );
    }

    // Handle application submission
    public function submitApplication(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:male,female',
            'email' => 'required|email|max:255|unique:candidats,email',
            'CIN' => 'required|string|max:20|unique:candidats,CIN',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_de_naissance'=>'required|string|max:100',
            'niveauEtude' => 'required|string|max:100',
            'diplome' => 'required|string|max:100',
            'specialte_diplome'=>'required|string|max:100',
            'moyenne'=> 'required|string|max:100',
            'documents.*' => 'required|nullable|file|mimes:pdf,doc,docx,jpg,png,jfif|max:2048',
            'experienceProfessionnel' => 'nullable|string|max:255',
            'acceptTerms' => 'accepted',
            'region_id' => 'required|exists:regions,id',
            'ville_id' => 'required|exists:villes,id',
            'password' => 'required|string|min:6|confirmed',




        ]);

        $region = Region::findOrFail($request->region_id); // Use `region_id`
        $ville = Ville::findOrFail($request->ville_id);

        $hashedPassword = bcrypt($request->password);



        // Save application to Candidat table with related concours_id
        $candidat = Candidat::create([
            'concours_id' => $id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' =>$request->sexe,
            'email' => $request->email,
            'CIN' => $request->CIN,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'lieu_de_naissance' => $request->lieu_de_naissance,
            'niveauEtude' => $request->niveauEtude,
            'diplome' => $request->diplome,
            'specialte_diplome'=>$request->specialte_diplome,
            'moyenne'=>$request->moyenne,
            'experienceProfessionnel' => $request->experienceProfessionnel,
            'status' => 'pending',
            'region_name' => $region->name,
            'ville_name' => $ville->name,
            'password' => $hashedPassword,

        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filePath = $file->store('documents', 'public');
                $fileName = $file->getClientOriginalName();

                // Save each file in the documents table
                $candidat->documents()->create([
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                ]);
            }
        }

        return view('candidat.confirmation', [
        'candidatNumber' => $candidat->candidatNumber,
        'password' => $candidat->password,
    ])->with('success', 'Application submitted successfully!');
    }
}
