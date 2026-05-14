@extends('layouts.main')


@section('content')
<br>
<div class="container">
    <h2>Change Password</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.user.change-password') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input id="current_password" type="password" name="current_password" class="form-control" required>
            @error('current_password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="new_password">New Password</label>
            <input id="new_password" type="password" name="new_password" class="form-control" required>
            @error('new_password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <div class="mt-4 d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary px-4">Update Password</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">Cancel</a>
        </div>

    </form>
</div><br>
@endsection