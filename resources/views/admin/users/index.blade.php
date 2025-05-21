@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mb-4">User Management</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
    <thead>
      <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->role }}</td>
      <td>
      <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
      onsubmit="return confirm('Delete this user?');">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm">Delete</button>
      </form>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endsection