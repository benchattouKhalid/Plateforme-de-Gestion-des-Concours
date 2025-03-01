<!-- resources/views/concours/apply.blade.php -->
<style>
    .custom-h3{
        background: #343a40;
    }
    .custom-h3-2{
        background: #343a40;
    }
</style>
@extends('layouts.app')
@section('content')
<div class="container mt-2">
    <h2>postuler pour {{ $concours->nom }}</h2>
    <form action="{{ route('concours.submit', $concours->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <h3 class="custom-h3 text-center w-100  text-white py-2"> Informations personnelles</h3>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>

        <div class="mb-1 col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe" required>
                <option value="">Select Sexe</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label for="CIN" class="form-label">CIN</label>
            <input type="text" class="form-control" id="CIN" name="CIN" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="lieu_de_naissance" class="form-label">lieu de naissance</label>
            <input type="text" class="form-control" id="lieu_de_naissance" name="lieu_de_naissance" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="date_naissance" class="form-label">Date de Naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="region_id" class="form-label">Region</label>
        <select name="region_id" id="region_id" class="form-select">
            <option value="">Select a Region</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="ville_id" class="form-label">Ville</label>
        <select name="ville_id" id="ville_id" class="form-select">
            <option value="">Select a Ville</option>
        </select>
    </div>

    <script>
        document.getElementById('region_id').addEventListener('change', function () {
            const regionId = this.value;
            const villeDropdown = document.getElementById('ville_id');

            villeDropdown.innerHTML = '<option value="">Loading...</option>';

            fetch(`/get-villes/${regionId}`)
                .then(response => response.json())
                .then(data => {
                    villeDropdown.innerHTML = '<option value="">Select a Ville</option>';
                    data.forEach(ville => {
                        villeDropdown.innerHTML += `<option value="${ville.id}">${ville.name}</option>`;
                    });
                });
        });
    </script>
    <h3 class="custom-h3-2 text-center w-100  text-white py-2 mt-5">Informations pédagogiques</h3>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="diplome" class="form-label">Diplôme (BTS,DTS,DEUST...) </label>
            <input type="text" class="form-control" id="diplome" name="diplome" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="specialte_diplome" class="form-label">specialte_diplome</label>
            <input type="text" class="form-control" id="specialte_diplome" name="specialte_diplome" required>
        </div>
        <div class="mb-1 col-md-4">
            <label for="moyenne" class="form-label">moyenne</label>
            <input type="text" class="form-control" id="moyenne" name="moyenne" required>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label for="niveauEtude" class="form-label">Niveau d'Étude</label>
            <input type="text" class="form-control" id="niveauEtude" name="niveauEtude" required>
        </div>

        <div class="mb-1 col-md-6">
            <label for="experienceProfessionnel" class="form-label">Expérience Professionnelle</label>
            <textarea class="form-control" id="experienceProfessionnel" name="experienceProfessionnel" rows="3" ></textarea>
        </div>
    </div>
        <div class="mb-1">
            <label for="documents">Téléchargement votre CIN,CV,diplome</label>
            <input type="file" class="form-control" id="documents" name="documents[]" multiple required>
        </div>
        <div class="mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="mt-5 mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="acceptTerms" name="acceptTerms" required>
            <label class="form-check-label" for="acceptTerms">
                I accept the <a href="{{ route('terms') }}" target="_blank">terms and conditions</a>
            </label>
        </div>
        <button type="submit" class="btn btn-success">Submit Application</button>
    </form>
</div>

@endsection


