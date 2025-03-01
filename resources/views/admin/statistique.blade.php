@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1 class="mb-4">Statistiques des Candidats</h1>

    <!-- Form for selecting a region -->
    <form action="{{ route('admin.statistique.filter') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="region" class="form-label">Sélectionnez une Région</label>
            <select name="region" id="region" class="form-select" required>
                <option value="">-- Sélectionnez une Région --</option>
                @foreach($regions as $region)
                    <option value="{{ $region->name }}" {{ isset($regionName) && $regionName == $region->name ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Afficher les Candidats</button>
    </form>

    <!-- Display the results if candidates exist -->
    @isset($candidats)
    
        <h2>Résultats pour la région : {{ $regionName }}</h2>
        @if($candidats->isEmpty())
            <p class="text-muted">Aucun candidat trouvé pour cette région.</p>
        @else
        <h3>Nombre de condidats : {{$candidats->count()}}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>candidatNumber</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Région</th>
                        <th>Ville</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidats as $candidat)
                        <tr>

                            <td>{{ $candidat->candidatNumber }}</td>
                            <td>{{ $candidat->nom }}{{ $candidat->prenom }}</td>
                            <td>{{ $candidat->email }}</td>
                            <td>{{ $candidat->region_name }}</td>
                            <td>{{ $candidat->ville_name }}</td>
                            <td>{{ $candidat->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endisset
</div>
@endsection
