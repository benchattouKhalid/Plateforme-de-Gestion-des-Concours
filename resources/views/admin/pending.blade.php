@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1>Pending Concours</h1>
    @if ($pendingConcours->isEmpty())
        <p>No pending concours at the moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingConcours as $concour)
                    <tr>
                        <td>{{ $concour->nom }}</td>
                        <td>{{ $concour->description }}</td>
                        <td>{{ $concour->dateDebut }}</td>
                        <td>{{ $concour->dateFin }}</td>
                        <td>
                            <a href="{{ route('admin.concours.confirm', $concour->id) }}" class="btn btn-success btn-sm">Confirm</a>
                            <a href="{{ route('admin.concours.reject', $concour->id) }}" class="btn btn-danger btn-sm">Reject</a>
                            <a href="{{ route('admin.concours.edit', $concour->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

