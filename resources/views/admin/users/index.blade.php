@extends('layouts.adminApp')

@section('content')

@if(session('success_create'))
    <div class="alert alert-success">
        {{ session('success_create') }}
    </div>
    @elseif (session('success_update'))
    <div class="alert alert-success">
        {{ session('success_update') }}
    </div>
    @elseif (session('success_destroy'))
    <div class="alert alert-success">
        {{ session('success_destroy') }}
    </div>
@endif
<h1>Manage Users</h1>
<a href="/users/create"  class="btn btn-sm btn-primary">add user</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
