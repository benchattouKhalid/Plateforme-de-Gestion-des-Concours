@extends('layouts.adminApp')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Concours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create New Concours</h2>
    <form action="{{ route('admin.concours.store') }}" method="POST" enctype="multipart/form-data" class="row ">
        @csrf
        <div class="mb-3 col-md-4 ">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3 col-md-8">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3 col-md-4">
            <label for="specialiste" class="form-label">Specialiste</label>
            <input type="text" class="form-control" id="specialiste" name="specialiste" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="age_limit" class="form-label">Age Limit</label>
            <input type="number" name="age_limit" id="age_limit" class="form-control" value="{{ old('age_limit', $concours->age_limit ?? '') }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="nombres_de_postes" class="form-label">Nombres de Postes</label>
            <input type="number" name="nombres_de_postes" id="nombres_de_postes" class="form-control" value="{{ old('nombres_de_postes', $concours->nombres_de_postes ?? '') }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="date_concours" class="form-label">Date Concours</label>
            <input type="date" name="date_concours" id="date_concours" class="form-control" value="{{ old('date_concours', $concours->date_concours ?? '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" class="form-control" id="grade" name="grade" required>
        </div>
        <div class="mb-3 col-md-4" >
            <label for="dateDebut" class="form-label">Date Debut</label>
            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="dateFin" class="form-label">Date Fin</label>
            <input type="date" class="form-control" id="dateFin" name="dateFin" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="centre_id" class="form-label">Centre</label>
            <select class="form-select" id="centre_id" name="centre_id" required>
                @foreach ($centres as $centre)
                    <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4 " >
            <label for="avis" class="form-label">Avis </label>
            <input type="file" name="avis" id="avis" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
        </div>

        <button type="submit" class="  btn btn-primary col-md-2">Create Concours</button>
    </form>
</div>
</body>
</html

@endsection
