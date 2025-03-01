@extends('layouts.app')
@section('content')


<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>Confirmation de la demande
            </h3>
        </div>
        <div class="card-body">
            <p>Merci pour votre candidature !
            </p>
            <p>Votre numéro de candidat est: <strong>{{ $candidatNumber }}</strong></p>
            
            <p>Veuillez conserver ces informations pour vos archives.</p>
        </div>
    </div>
</div>

@endsection
