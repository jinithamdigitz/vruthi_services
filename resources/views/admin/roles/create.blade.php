@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Create Role</h1>
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save Role</button>
    </form>
</div>
@endsection
