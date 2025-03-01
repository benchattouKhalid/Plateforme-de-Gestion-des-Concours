@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1>Edit Concours</h1>

    <form class="row" action="{{ route('admin.concours.update', $concours->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 col-md-4">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $concours->nom) }}" required>
        </div>

        <div class="mb-3 col-md-8">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $concours->description) }}</textarea>
        </div>

        <div class="mb-3 col-md-4">
            <label for="specialiste" class="form-label">Specialiste</label>
            <input type="text" name="specialiste" id="specialiste" class="form-control" value="{{ old('specialiste', $concours->specialiste) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="age_limit" class="form-label">age limit</label>
            <input type="text" name="age_limit" id="age_limit" class="form-control" value="{{ old('age_limit', $concours->age_limit) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="nombres_de_postes" class="form-label">nombres de postes</label>
            <input type="number" name="nombres_de_postes" id="nombres_de_postes" class="form-control" value="{{ old('nombres_de_postes', $concours->nombres_de_postes) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="date_concours" class="form-label">date_concours</label>
            <input type="date" name="date_concours" id="date_concours" class="form-control" value="{{ old('date_concours', $concours->date_concours) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="dateDebut" class="form-label">Date Début</label>
            <input type="date" name="dateDebut" id="dateDebut" class="form-control" value="{{ old('dateDebut', $concours->dateDebut) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="dateFin" class="form-label">Date Fin</label>
            <input type="date" name="dateFin" id="dateFin" class="form-control" value="{{ old('dateFin', $concours->dateFin) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade', $concours->grade) }}" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="centre_id" class="form-label">Centre</label>
            <select name="centre_id" id="centre_id" class="form-select" required>
                @foreach ($centres as $centre)
                    <option value="{{ $centre->id }}" {{ $concours->centre_id == $centre->id ? 'selected' : '' }}>
                        {{ $centre->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-5">
            <label for="avis" class="form-label">Avis fichier</label>
            <input type="file" name="avis" id="avis" class="form-control">
            @if ($concours->avis)
                <p> avis : <a href="{{ asset('storage/' . $concours->avis) }}" target="_blank">Download</a></p>
            @endif
        </div>
        <div class="col-md-12">
                    <button type="submit" class="btn btn-primary col-md-2">Update Concours</button>

        </div>
    </form>
</div>
@endsection
