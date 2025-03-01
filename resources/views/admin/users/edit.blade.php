@extends('layouts.adminApp')

@section('content')
<h1>Edit User</h1>
<form action="{{ route('update', $user->id) }}" method="POST" class="row">
    @csrf
    @method('PUT')

    <div class="mb-3 col-md-6 ">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    </div>

    <div class="mb-3 col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    </div>

    <div class="mb-3 col-md-6">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="candidat" {{ $user->role == 'gestionnaire_global' ? 'selected' : '' }}>gestionaire globale</option>
            <option value="candidat" {{ $user->role == 'gestionnaire_local' ? 'selected' : '' }}>gestionaire locale</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="region">Region</label>
        <select name="region" id="region" class="form-control">
            <option value="all" {{ $user->region === 'all' ? 'selected' : '' }}>All Regions</option>
            @foreach($regions as $region)
                <option value="{{ $region->name }}"
                    {{ $user->region === $region->name ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="">
    <button type="submit" class="btn btn-success col-md-2">Update</button>
    </div>
</form>
@endsection
