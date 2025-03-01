@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1>Concours Statistique</h1>

    <!-- Concours Filter -->
    <form method="GET" action="{{ route('admin.statistique.concours') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="concours_id" class="form-label">Select Concours:</label>
                <select name="concours_id" id="concours_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select Concours --</option>
                    @foreach($concours as $concour)
                        <option value="{{ $concour->id }}" {{ request('concours_id') == $concour->id ? 'selected' : '' }}>
                            {{ $concour->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <!-- Display Results -->
    @if(request('concours_id'))
        <h2>Results for: {{ $concours->find(request('concours_id'))->nom }}</h2>
        <table class="table table-striped">
            <thead>
                <tr class="d-flex">
                    <th class="col-3">Region</th>
                    <th class="col-3">Number of Confirmed Candidats</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr class="d-flex">
                        <td class="col-3">{{ $item->region_name }}</td>
                        <td class="col-3">{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No candidats found for this concours.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <p>Please select a concours to see the statistics.</p>
    @endif
</div>
@endsection
