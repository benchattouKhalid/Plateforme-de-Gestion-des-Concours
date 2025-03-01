<!-- resources/views/concours/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <h2>Compétitions disponibles</h2>
    <div class="row">
        @foreach($concours as $c)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $c->nom }}</h5>
                        <p class="card-text"><strong>date d'ebutut :</strong> {{ $c->dateDebut }}</p>
                        <p class="card-text"><strong>date de fin :</strong> : {{ $c->dateFin }} </p>
                        <p class="card-text">{{ $c->description }}</p>
                        <p class="card-text"><strong>Grade : </strong> : {{ $c->grade }}</p>
                        <p class="card-text"><strong>nombre de postes : </strong>  {{ $c->nombres_de_postes }}</p>
                        <p><strong>Speciality:</strong> {{ $c->specialiste }}</p>

                        <p> <strong>Avis :</strong>
                            @if ($c->avis)
                                <a href="{{ asset('storage/' . $c->avis) }}" target="_blank">Télécharger</a>
                            @else
                                N/A
                            @endif
                        </p>
                        <a href="{{ route('concours.apply', $c->id) }}" class="btn btn-primary">Postuler</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

