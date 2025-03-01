@extends('layouts.adminApp')

@section('content')
<div class="container">
    <h1>Filter by Region and Concours</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.statistique.region.concours') }}" class="mb-4">
        <div class="row g-3">
            <!-- Region Filter -->
            <div class="col-md-3">
                <label for="region_name" class="form-label">Select Region:</label>
                <select name="region_name" id="region_name" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select Region --</option>
                    @foreach($regions as $regionName)
                        <option value="{{ $regionName }}" {{ request('region_name') == $regionName ? '' : '' }}>
                            {{ $regionName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Concours Filter -->
            <div class="col-md-3">
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
    @if(request('region_name') || request('concours_id'))
        <h2>Results</h2>
        <table class="table table-striped ">
            <thead>
                <tr class="d-flex">
                    <th class="col-3"> Region</th>
                    <th class="col-3">Number of Confirmed Candidats</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr class="d-flex">
                        <td class="col-3">{{ $item->region_name }}</td>
                        <td class="col-3">{{ $item->total_candidats }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No candidats found for the selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <p>Please select a region and/or concours to see the statistics.</p>
    @endif
</div>
@endsection
