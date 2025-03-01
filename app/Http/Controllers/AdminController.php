<?php

namespace App\Http\Controllers;
use App\Models\Candidat;
use App\Models\Concours;
use App\Models\Centre;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("admin.dashboard");
    }


    // Show form to create a new Concours
    public function createConcours()
    {
        // Retrieve centers for the selection dropdown
        $centres = Centre::all();

        return view('admin.create_concours', compact('centres'));
    }

    // Store a new Concours in the database
    public function storeConcours(Request $request)
    {

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'specialiste' => 'required|string|max:255',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'grade' => 'required|string|max:255' ,
            'centre_id' => 'required|exists:centres,id',
            'avis' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'age_limit' => 'nullable|integer',
            'nombres_de_postes' => 'nullable|integer',
            'date_concours' => 'nullable|date',

        ]);



        $concours = new Concours($request->only(['nom','avis', 'description',
         'specialiste', 'dateDebut', 'dateFin','grade' , 'centre_id','age_limit','nombres_de_postes','date_concours']));

        // Handle the 'avis' file upload if present
    if ($request->hasFile('avis')) {
        $file = $request->file('avis');
        $filePath = $file->store('avis', 'public'); // Store in 'storage/app/public/avis'
        $concours->avis = $filePath; // Assign the file path to the 'avis' attribute
    }

        $concours->save();

        return redirect()->route('admin.dashboard')->with('success', 'Concours created successfully!');
    }

    public function confirmConcours($id)
{
    $concours = Concours::findOrFail($id);
    $concours->status = 'confirmed';
    $concours->save();

    return redirect()->back()->with('success', 'Concours confirmed successfully.');
}

public function rejectConcours($id)
{
    $concours = Concours::findOrFail($id);
    $concours->status = 'rejected';
    $concours->save();

    return redirect()->back()->with('success', 'Concours rejected successfully.');
}

public function showPendingConcours()
{
    // Retrieve only pending concours
    $pendingConcours = Concours::where('status', 'pending')->get();

    return view('admin.pending', compact('pendingConcours'));
}

public function editConcours($id)
{
    $concours = Concours::findOrFail($id);
    $centres = Centre::all(); // Fetch centres for dropdown if needed
    return view('admin.edit_concours', compact('concours', 'centres'));
}

public function updateConcours(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'specialiste' => 'required|string|max:255',
        'dateDebut' => 'required|date',
        'dateFin' => 'required|date|after:dateDebut',
        'grade' => 'required|string|max:255',
        'centre_id' => 'required|exists:centres,id',
        'avis' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'age_limit' => 'nullable|integer',
        'nombres_de_postes' => 'nullable|integer',
        'date_concours' => 'nullable|date',
    ]);

    $concours = Concours::findOrFail($id);

    // Update basic fields
    $concours->update($request->only(['nom', 'description', 'specialiste', 'dateDebut', 'dateFin', 'grade', 'centre_id']));

    // Handle file upload for 'avis'
    if ($request->hasFile('avis')) {
        $file = $request->file('avis');
        $filePath = $file->store('avis', 'public'); // Store the file
        $concours->avis = $filePath; // Update file path
    }

    $concours->save();

    return redirect()->route('admin.dashboard')->with('success', 'Concours updated successfully!');
}





    //confirm----------------- and ----------------reject-----condidat

    public function index_condidat(Request $request)
{
    $user = auth()->user(); // Get the logged-in user
    $concours = Concours::all(); // Fetch all concours
    $query = Candidat::query(); // Initialize the query

    // Filter by region if the user is gestionnaire_local
    if ($user->role === 'gestionnaire_local' && $user->region) {
        $query->where('region_name', $user->region); // Filter by region name
    }

    // Apply concours filter if selected
    if ($request->has('concours_id') && $request->concours_id != '') {
        $query->where('concours_id', $request->concours_id);
    }

    // Apply status filter if selected
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $candidats = $query->paginate(10); // Paginate the filtered results

    return view('admin.candidats.index', compact('candidats', 'concours'));
}





    public function confirm($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->status = 'confirmed';
        $candidat->save();

        return redirect()->route('admin.candidats.index')->with('success', 'Candidate confirmed successfully.');
    }

    public function reject($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->status = 'rejected';
        $candidat->save();

        return redirect()->route('admin.candidats.index')->with('success', 'Candidate rejected successfully.');
    }

    public function show($id)
    {



    $candidat = Candidat::with(['region', 'ville'])->findOrFail($id); // Load region and ville relationships if necessary
    // Decode the documents field if it's stored as JSON
    $documents = $candidat->documents ? json_decode($candidat->documents, true) : [];
    return view('admin.candidats.show', compact('candidat'));
    }


    public function concoursStatistique(Request $request)
    {
    // Get all concours for the filter dropdown
    $concours = Concours::all();

    // Initialize filtered data
    $data = [];

    // Check if a concours is selected
    if ($request->has('concours_id') && $request->concours_id) {
        $selectedConcours = $request->concours_id;

        // Fetch data: count candidats by region for the selected concours and confirmed status
        $data = Candidat::select('region_name', \DB::raw('COUNT(*) as total'))
            ->where('concours_id', $selectedConcours)
            ->where('status', 'confirmed') // Only confirmed candidats
            ->groupBy('region_name')
            ->having('total', '>', 0) // Exclude regions with no candidats
            ->get();
    }

    return view('admin.statistique.concours_statistique', compact('concours', 'data'));
    }

    public function filterByDate(Request $request)
    {
    // Fetch all unique concours dates for the dropdown
    $dates = Concours::select('date_concours')->distinct()->orderBy('date_concours', 'asc')->get();

    // Initialize filtered concours
    $filteredConcours = collect();

    // Check if a date is selected
    if ($request->has('date_concours') && $request->date_concours) {
        $selectedDate = $request->date_concours;

        // Fetch all concours for the selected date
        $filteredConcours = Concours::where('date_concours', $selectedDate)->get();
    }

    return view('admin.statistique.concours_by_date', compact('dates', 'filteredConcours'));
    }


    public function filterByRegionAndConcours(Request $request)
{
    $concours = Concours::all(); // Fetch all concours
    $regions = Candidat::select('region_name')->distinct()->pluck('region_name'); // Fetch all unique region names

    $data = []; // Initialize filtered data

    // Apply filters
    if ($request->has('region_name') || $request->has('concours_id')) {
        $query = Candidat::query();

        $query->where('status', 'confirmed'); // Only confirmed candidats

        // Filter by region
        if ($request->filled('region_name')) {
            $query->where('region_name', $request->region_name);
        }

        // Filter by concours
        if ($request->filled('concours_id')) {
            $query->where('concours_id', $request->concours_id);
        }

        // Group by region name and count candidats
        $data = $query->select('region_name', \DB::raw('COUNT(*) as total_candidats'))
            ->groupBy('region_name')
            ->get();
    }

    return view('admin.statistique.concoursEtRegion', compact('concours', 'regions', 'data'));
}







}
