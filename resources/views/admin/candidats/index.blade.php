@extends('layouts.adminApp')

@section('content')
<h1>Manage Candidates</h1>

<!-- Concours Filter Form -->
<form method="GET" action="{{ route('admin.candidats.index') }}" class="mb-4 d-flex">
    <div class="me-3">
        <label for="concours_id" class="form-label">Filter by Concours:</label>
        <select name="concours_id" id="concours_id" class="form-select" onchange="this.form.submit()">
            <option value="">All</option>
            @foreach ($concours as $concour)
                <option value="{{ $concour->id }}" {{ request('concours_id') == $concour->id ? 'selected' : '' }}>
                    {{ $concour->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="status" class="form-label">Filter by Status:</label>
        <select name="status" id="status" class="form-select" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</form>




<h4>nombres des condidats : {{$candidats->count()}}</h4>
<!-- Candidates Table -->
<table class="table">
    <thead>
        <tr>
            <td>candidatNumber</td>
            <td>Name</td>
            <td>Email</td>
            <td>CIN</td>
            <td>ville</td>
            <td>concours</td>
            <td>status</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        @forelse($candidats as $candidat)
        <tr>
            <td>{{ $candidat->candidatNumber }}</td>
            <td>{{ $candidat->nom }} {{ $candidat->prenom }}</td>
            <td>{{ $candidat->email }}</td>
            <td>{{ $candidat->CIN }}</td>
            <td>{{ $candidat->ville_name }}</td>
            <td>{{ $candidat->concours->nom ?? 'N/A' }}</td>
            <td><span class="badge bg-secondary">{{ ucfirst($candidat->status) }}</span></td>
            <td>


                    <a href="{{ route('admin.candidats.show', $candidat->id) }}" class="btn btn-info btn-sm">View</a>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">No candidates found for the selected concours.</td>
        </tr>
        @endforelse
    </tbody>
</table>


@endsection
