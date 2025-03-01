@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ $user->prenom }} {{ $user->nom }}</h1>

    @if($concours)
        <h3>Contest Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Contest Name</th>
                    <th>Application Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $concours->nom }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($user->status) }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>You have not applied for any contests yet.</p>
    @endif
</div>
@endsection
