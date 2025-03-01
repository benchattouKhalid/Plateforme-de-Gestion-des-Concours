@extends('layouts.adminApp')

@section('content')
<h1>Create New User</h1>
<form action="{{ route('store') }}" method="POST" class="row">
    @csrf

    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="gestionnaire_global">gestionnaire global</option>
            <option value="gestionnaire_local">gestionnaire local</option>
        </select>
    </div>
    <div class="mb-3 col-md-6">
        <label for="region">Region</label>
        <select name="region" id="region" class="form-control">
            <option value="">All region</option>
            @foreach($regions as $region)
                <option value="{{ $region->name }}"
                    {{ isset($user) && $user->region->name == $region->name ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div  class="mb-3">
    <button type="submit" class="btn btn-success col-md-2 ">Create User</button>
    </div>
</form>
@endsection
