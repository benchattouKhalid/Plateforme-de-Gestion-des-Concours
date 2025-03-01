@extends('layouts.adminApp')

@section('content')
<div class="container mt-4">
    <h2>Filter Concours by Date</h2>

    <!-- Dropdown for filtering by date -->
    <form action="{{ route('admin.concours.by.date') }}" method="GET">
        <div class="row">
            <div class="col-md-4">
                <label for="date_concours" class="form-label">Select Date</label>
                <select name="date_concours" id="date_concours" class="form-select">
                    <option value="">-- Select a Date --</option>
                    @foreach($dates as $date)
                        <option value="{{ $date->date_concours }}"
                            {{ request('date_concours') == $date->date_concours ? 'selected' : '' }}>
                            {{ $date->date_concours }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Display filtered concours -->
    @if($filteredConcours->isNotEmpty())
        <h3 class="mt-4">Concours on {{ request('date_concours') }}</h3>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Age Limit</th>
                    <th>Number of Posts</th>
                    <th>Resultat Ecrit</th>
                    <th>Resultat Orale</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filteredConcours as $concours)
                <tr>
                    <td>{{ $concours->nom }}</td>
                    <td>{{ $concours->age_limit }}</td>
                    <td>{{ $concours->nombres_de_postes }}</td>
                    <td>
                        @if($concours->resultat_ecrit)
                            <a href="{{ asset('uploads/' . $concours->resultat_ecrit) }}" target="_blank">View</a>
                        @else
                            Not Uploaded
                        @endif
                    </td>
                    <td>
                        @if($concours->resultat_orale)
                            <a href="{{ asset('uploads/' . $concours->resultat_orale) }}" target="_blank">View</a>
                        @else
                            Not Uploaded
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('date_concours'))
        <h3 class="mt-4">No Concours Found for {{ request('date_concours') }}</h3>
    @endif
</div>
@endsection
