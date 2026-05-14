@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User Detail</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>

    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
