<!-- resources/views/concours/apply.blade.php -->
<style>
    .custom-h3{
        background: #343a40;
    }
    .custom-h3-2{
        background: #343a40;
    }
</style>
@extends('layouts.adminApp')
@section('content')
<div class="container mt-2">
    <h2>Details for Candidate: {{ $candidat->nom }} {{ $candidat->prenom }}</h2>
    <form >

        <h3 class="custom-h3 text-center w-100  text-white py-2"> Informations personnelles</h3>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="nom" class="form-label"><strong>Nom</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->nom }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="prenom" class="form-label"><strong>Prénom</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->prenom }}" readonly>
        </div>

        <div class="mb-1 col-md-4">
            <label for="email" class="form-label"><strong>Email</strong></label>
            <input type="email" class="form-control" value="{{ $candidat->email }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="sexe"><strong>Sexe</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->sexe }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="CIN" class="form-label"><strong>CIN</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->CIN }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="telephone" class="form-label"><strong>Téléphone</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->telephone }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="adresse" class="form-label"><strong>Adresse</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->adresse }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="lieu_de_naissance" class="form-label"><strong>lieu de naissance</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->lieu_de_naissance }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="date_naissance" class="form-label"><strong>Date de Naissance</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->date_naissance }}" readonly>
        </div>
    </div>
    <div class="mb-3">
        <label for="region_id" class="form-label"><strong>Region</strong></label>
        <input type="text" class="form-control" value="{{ $candidat->region_name }}" readonly>
    </div>

    <div class="mb-3">
        <label for="ville_id" class="form-label"><strong>Ville</strong></label>
        <input type="text" class="form-control" value="{{ $candidat->ville_name }}" readonly>

    </div>


    <h3 class="custom-h3-2 text-center w-100  text-white py-2 mt-5">Informations pédagogiques</h3>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="diplome" class="form-label"><strong>Diplôme (BTS,DTS,DEUST...)</strong> </label>
            <input type="text" class="form-control" value="{{ $candidat->diplome }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="specialte_diplome" class="form-label"><strong>specialte_diplome</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->specialte_diplome }}" readonly>
        </div>
        <div class="mb-1 col-md-4">
            <label for="moyenne" class="form-label"><strong>moyenne</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->moyenne }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="niveauEtude" class="form-label"><strong>Niveau d'Étude</strong></label>
            <input type="text" class="form-control" value="{{ $candidat->niveauEtude }}" readonly>
        </div>

        <div class="mb-1 col-md-6">
            <label for="experienceProfessionnel" class="form-label"><strong>Expérience Professionnelle</strong></label>
            <textarea class="form-control" id="experienceProfessionnel" name="experienceProfessionnel" rows="3" ></textarea>
        </div>
    </div>
        

        <strong>
        </div>
        <h3>Uploaded Documents:</h3>
@if($candidat->documents->isNotEmpty())
    <ul>
        @foreach($candidat->documents as $document)
            <li>
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">
                    {{ $document->file_name ?? 'View File' }}
                </a>
            </li>
        @endforeach
    </ul>
@else
    <p>No files uploaded.</p>
@endif

    </form>
    <div class="row mt-5 d-flex justify-content-center">
    @if($candidat->status === 'pending')
    <form action="{{ route('admin.candidats.confirm', $candidat->id) }}" method="POST" class="d-inline col-md-2 ">
        @csrf
        <button type="submit" class="btn btn-success btn-sm col-md-12">Confirm</button>
    </form>
    <form action="{{ route('admin.candidats.reject', $candidat->id) }}" method="POST" class="d-inline col-md-2 ">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm col-md-12">Reject</button>
    </form>
    </div>



@endif
</div>

@endsection


